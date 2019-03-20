<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB; 
use App\TicketUpdates; 
use App\CloseTicket;
use App\TicketGenerated;
use App\Sms_setting;
use App\User;
use App\Websitesetting;
use infobip\api\client\SendSingleTextualSms;
use infobip\api\configuration\BasicAuthConfiguration;
use infobip\api\model\sms\mt\send\textual\SMSTextualRequest;
use DateTime;
use Carbon\Carbon;
use App\Region;
use App\EnggDriver;
use App\CronEntry;


class SendSmsEveryFourHours extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendSmsEveryFourHours:sendsms';
  

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */


    public function strReplaceAssoc(array $replace, $subject) 
    { 
       return str_replace(array_keys($replace), array_values($replace), $subject);
    }

   public function msgFunction4hrs($mobileNum, $ticketno,$fename,$linkaffected,$timeexceed) 
    { 

        $getSMSInfo = Websitesetting::select('sms_username','sms_senderid', 'sms_passwrd', 'sms_after_four_hr')->first();
         
         $sendto         = $mobileNum; 
         $sender         = $getSMSInfo->sms_senderid;
         $authApi        = $getSMSInfo->sms_username;
         $authApiPass    = $getSMSInfo->sms_passwrd;

         $client = new SendSingleTextualSms(new BasicAuthConfiguration($authApi, $authApiPass));
         ////////////Message change Word start
         $replace = array( 
             'TICKETNO'     => $ticketno,
             'LINKAFFECTED'=>$linkaffected,
             'TIMEEXCEED' =>$timeexceed,
         );
         $string     = $getSMSInfo->sms_after_four_hr; 
         $message    = $this->strReplaceAssoc($replace,$string);
          // print_r($message);
          // die;
         // Creating request body
        $requestBody = new SMSTextualRequest();
        $requestBody->setFrom($sender);
        $requestBody->setTo([$sendto]);
        $requestBody->setText($message);
        // Executing request
        try {
            $response = $client->execute($requestBody);
            $sentMessageInfo = $response->getMessages()[0];
            //dd($response);
            /*echo "Message ID: " . $sentMessageInfo->getMessageId() . "\n";
            echo "Receiver: " . $sentMessageInfo->getTo() . "\n";
            echo "Message status: " . $sentMessageInfo->getStatus()->getName();*/
        } catch (Exception $exception) {
            //echo "HTTP status code: " . $exception->getCode() . "\n";
            //echo "Error message: " . $exception->getMessage();
            //dd($exception);
        }
    }




    public function handle()
    {
         $checkisblocked = Sms_setting::where('stage','SLA Reminder')->first();
       if($checkisblocked->decision == "Yes")
       {
            $listofall = TicketGenerated::where('status','1')->get();
            $currenttiming = Carbon::now();
            
            $send_to_list = array('ticket_id'=>array(),'max_id'=>array(),'timingexceed'=>array());
            
            foreach($listofall as $row)
            {
                $createdat = Carbon::parse($row->created_at);
                $differenceinday  = 0;//$currenttiming->diffInDays($createdat);
                $differenceinhour  = 0;// $currenttiming->diffInHours($createdat);
                $differenceinminutes = $currenttiming->diffInMinutes($createdat);
                $concat = $this->getexcededtime($differenceinminutes);
                $p1 = explode('days',$concat);
                $diffintheday = $p1[0];
                $q1 = explode('hr',$p1[1]);
                $diffinthehr = $q1[0];
            //    echo $diffintheday."====".$diffinthehr."<br>";
                
                if($diffintheday>0 || $diffinthehr >4)
                {
                    $max_id = TicketUpdates::select('id','employee_id')->where('ticket_id',$row->ticket_id)->orderBy('id','DESC')->first();
                    $ticket_id = $row->ticket_id;
                    $timingexceed = $concat;//$row->created_at;            
                    $fename = User::where('id',$max_id->employee_id)->first();
                    $mobilenumber = '+254721489544';//$fename->phone;
                    $linkname = TicketGenerated::where('ticket_id',$ticket_id)->first();
                    $linkaffected = $linkname->link_affected;
                    $ffename = $fename->name." ".$fename->lastName;
                    $ab = $this->msgFunction4hrs($mobilenumber, $ticket_id,$ffename,$linkaffected,$timingexceed); 
                    $data = ['ticket_id'=>$ticket_id,'designation'=>'FE','mobile'=>$mobilenumber,'cronmsg'=>'Test msg','timepassed'=>$concat];
                       CronEntry::create($data);
                }
            }
            echo 'Command successfully run : SendSmsEveryFourHours:sendsms';
        }


    }





     public function getexcededtime($diffinmin)
    {
       $currenttiming = Carbon::now();
       // $createdat = Carbon::parse($ticketcreateddate);
        $differenceinday  = 0;//$diffinday;
        $differenceinhour  = 0;//$diffinhr;
        $differenceinminutes = $diffinmin;
        // return $differenceinday;
        if($differenceinminutes > 1440)
                {
                    $adddays = (int)($differenceinminutes/1440);
                    $differenceinday = $differenceinday+$adddays;
                    $differenceinminutes = $differenceinminutes%1440;
                   
                   if($differenceinminutes > 60 )
                     {
                       // return $differenceinminutes;
                        $addhrs = (int)($differenceinminutes/60);
                        $differenceinhour = $differenceinhour+$addhrs;
                        if($differenceinhour>23)
                        {
                            $adddays2 = (int)($differenceinhour/24);
                            $differenceinday = $differenceinday+$adddays2;
                            $differenceinhour = $differenceinhour%24;
                        }
                        $differenceinminutes = $differenceinminutes %60;
                     }
                   
                }
                elseif($differenceinminutes<1440 && $differenceinminutes>59)
                {

                       $addhrs2 = (int)($differenceinminutes/60);   
                       $differenceinhour = $differenceinhour+$addhrs2;
                       $differenceinminutes = $differenceinminutes%60;
                       if($differenceinhour>23)
                       {
                        $adddays2 = (int)($differenceinhour/24);
                        $differenceinday = $differenceinday+$adddays2;
                        $differenceinhour = $differenceinhour%24;
                       }
                   
                }
                else{}
                $concat = $differenceinday.' days '.$differenceinhour." hr ".$differenceinminutes." min ";
                return $concat;
    }



}


