<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sms_setting;
use App\TicketGenerated;
use DateTime;
use Carbon\Carbon;
use App\TicketUpdates;
use App\User;
use App\Websitesetting;
use infobip\api\client\SendSingleTextualSms;
use infobip\api\configuration\BasicAuthConfiguration;
use infobip\api\model\sms\mt\send\textual\SMSTextualRequest;
use App\Region;
use App\EnggDriver;
use App\CronEntry;

class SmsController extends Controller
{
    function __construct()
    {   
        $this->middleware('permission:sms-list');
        $this->middleware('permission:sms-edit', ['only' => ['modifysmssetting']]);      
   }
    public function smssettingpage()
    {
    	$smssettinglist = Sms_setting::all();
    	return view ('pages.smssettingpage',compact('smssettinglist'));

    }
    public function modifysmssetting(Request $request)
    {
    	  if($request->checkedvl == 'Yes')
    	 	{ 
            Sms_setting::where('id',$request->stag)->update(['decision'=>'Yes']);
    	 	}
    	 	else{
			Sms_setting::where('id',$request->stag)->update(['decision'=>'No']);
    	 	}
    	
    }

//////////////////////////////////////////////////////////////////
    public function testingthesms1()
    {

 //////////////////////////////
  /* $hr = 4; $a ="critical"; $b="Medium"; $c ="High";
   if($hr ==4 && ($a=="criticals" || $b=="Mediums"))
   {
      echo "IT works";
   }
   elseif($hr==4 && ($a=="critical" || $b=="Medium"))
   {
       echo "this is elseif it works";
   }
   else
   {
    echo "it doesn't work";
   }
   die;*/

 ////////////////////////////////
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
                    //$ab = $this->msgFunction4hrs($mobilenumber, $ticket_id,$ffename,$linkaffected,$timingexceed); 
                    $data = ['ticket_id'=>$ticket_id,'designation'=>'FE','mobile'=>$mobilenumber,'cronmsg'=>'Test msg','timepassed'=>$concat];
                       CronEntry::create($data);
                }
            }
            echo 'Command successfully run : SendSmsEveryFourHours:sendsms';
        }

    }
    public function testingthesms()
    {
     
     $checkisblocked = Sms_setting::where('stage','SLA Escalation')->first();

       if($checkisblocked->decision == "Yes")
       {
            $listofall = TicketGenerated::where('status','1')->get();
            $currenttiming = Carbon::now();
          /*  echo "<pre>";
            print_r($listofall);
            die;*/
            //$send_to_list = array('ticket_id'=>array(),'max_id'=>array(),'timingexceed'=>array());
            
            foreach($listofall as $row)
            {
               //echo $row->created_at.'a';die;
                 $region = $row->region;
                 $createdat = Carbon::parse($row->created_at);//REPORTING time can be written
                 

                  $differenceinminutes = $currenttiming->diffInMinutes($createdat);
                 //$differenceinminutes=181;

                 $ticketid = $row->ticket_id;
                 //$row->priority;die;
                 // echo $differenceinminutes;die;
                if($row->priority == 'Critical')
                {
                    $criticality = 'Critical';
                    
                    if($differenceinminutes>180 && $differenceinminutes<240 )   //3 hrs passed 
                    {  $a =  $this->dothisoperation('3',$differenceinminutes,$criticality,$ticketid);  
                       
                     }
                    elseif($differenceinminutes>240 && $differenceinminutes<480) // 4 hrs passed
                    {    $a = $this->dothisoperation('4',$differenceinminutes,$criticality,$ticketid); 
                    }
                    elseif($differenceinminutes>480 && $differenceinminutes<720) // 8 hrs passed
                    {  $a = $this->dothisoperation('8',$differenceinminutes,$criticality,$ticketid);       }
                   elseif($differenceinminutes>720 && $differenceinminutes<1440) // 12 hrs passed
                    {   $a = $this->dothisoperation('12',$differenceinminutes,$criticality,$ticketid);   }
                    elseif($differenceinminutes>1440) // 24 hrs passed
                    { $a = $this->dothisoperation('24',$differenceinminutes,$criticality,$ticketid);     }

               }
                elseif($row->priority == 'High')
                {
                    $criticality = 'High';
                    if($differenceinminutes>180 && $differenceinminutes<240 )   //3 hrs passed 
                    { $a =  $this->dothisoperation('3',$differenceinminutes,$criticality,$ticketid);       }
                    elseif($differenceinminutes>240 && $differenceinminutes<480) // 4 hrs passed
                    {  $a = $this->dothisoperation('4',$differenceinminutes,$criticality,$ticketid); }
                    elseif($differenceinminutes>480 && $differenceinminutes<720) // 8 hrs passed
                    {  $a = $this->dothisoperation('8',$differenceinminutes,$criticality,$ticketid);       }
                   elseif($differenceinminutes>720 && $differenceinminutes<1440) // 12 hrs passed
                    {   $a = $this->dothisoperation('12',$differenceinminutes,$criticality,$ticketid);   }
                    elseif($differenceinminutes>1440) // 24 hrs passed
                    { $a = $this->dothisoperation('24',$differenceinminutes,$criticality,$ticketid);     }
                    

                }
                elseif($row->priority == 'Medium')
                {
                    $criticality = 'Medium';
                    if($differenceinminutes>180 && $differenceinminutes<240 )   //3 hrs passed 
                    { $a =  $this->dothisoperation('3',$differenceinminutes,$criticality,$ticketid);       }
                    elseif($differenceinminutes>240 && $differenceinminutes<480) // 4 hrs passed
                    {  $a = $this->dothisoperation('4',$differenceinminutes,$criticality,$ticketid); }
                    elseif($differenceinminutes>480 && $differenceinminutes<720) // 8 hrs passed
                    {  $a = $this->dothisoperation('8',$differenceinminutes,$criticality,$ticketid);       }
                   elseif($differenceinminutes>720 && $differenceinminutes<1440) // 12 hrs passed
                    {   $a = $this->dothisoperation('12',$differenceinminutes,$criticality,$ticketid);   }
                    elseif($differenceinminutes>1440) // 24 hrs passed
                    { $a = $this->dothisoperation('24',$differenceinminutes,$criticality,$ticketid);     }
                    

                }
                 elseif($row->priority == 'Low')
                {
                    $criticality = 'Low';
                    if($differenceinminutes>180 && $differenceinminutes<240 )   //3 hrs passed 
                    { $a =  $this->dothisoperation('3',$differenceinminutes,$criticality,$ticketid);       }
                    elseif($differenceinminutes>240 && $differenceinminutes<480) // 4 hrs passed
                    {  $a = $this->dothisoperation('4',$differenceinminutes,$criticality,$ticketid); }
                    elseif($differenceinminutes>480 && $differenceinminutes<720) // 8 hrs passed
                    {  $a = $this->dothisoperation('8',$differenceinminutes,$criticality,$ticketid);       }
                   elseif($differenceinminutes>720 && $differenceinminutes<1440) // 12 hrs passed
                    {   $a = $this->dothisoperation('12',$differenceinminutes,$criticality,$ticketid);   }
                    elseif($differenceinminutes>1440) // 24 hrs passed
                    { $a = $this->dothisoperation('24',$differenceinminutes,$criticality,$ticketid);     }
                    

                }
                else
                {}
                
                
            }
            echo 'Command successfully run : SendSmsEveryFourHours:sendsms';
        }
     
    }
    
public function strReplaceAssoc(array $replace, $subject) 
    { 
       return str_replace(array_keys($replace), array_values($replace), $subject);
    }
    public function msgFunction3hrs($mobileNum, $ticketno,$fename,$linkaffected,$timeexceed,$lastupdated,$ttl,$ttl2) 
    { 
       
        $getSMSInfo = Websitesetting::select('sms_username','sms_senderid', 'sms_passwrd', 'sla_escalation_3hrs_sms')->first();
         $sendto         = $mobileNum; 
         $sender         = $getSMSInfo->sms_senderid;
         $authApi        = $getSMSInfo->sms_username;
         $authApiPass    = $getSMSInfo->sms_passwrd;

         $client = new SendSingleTextualSms(new BasicAuthConfiguration($authApi, $authApiPass));
         ////////////Message change Word start
         $replace = array( 
             'TITLE1'=>$ttl,
             'TITLE2' =>$ttl2,
             'TICKETNO'     => $ticketno,
             'LINKAFFECTED'=>$linkaffected,
             'TIMEEXCEED' =>$timeexceed,
             'FENAME' =>  $fename,
             'TICKETLASTUPDATE'=>$lastupdated,
         );
         $string     = $getSMSInfo->sla_escalation_3hrs_sms; 
         $message    = $this->strReplaceAssoc($replace,$string);
         //echo $message; die;
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
            echo "Message ID: " . $sentMessageInfo->getMessageId() . "\n";
            echo "Receiver: " . $sentMessageInfo->getTo() . "\n";
            echo "Message status: " . $sentMessageInfo->getStatus()->getName();
        } catch (Exception $exception) {
            //echo "HTTP status code: " . $exception->getCode() . "\n";
            //echo "Error message: " . $exception->getMessage();
            //dd($exception);
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

    public function dothisoperation($hrspassed,$differenceinminutes,$criticality,$ticketid)
    {

       //return $hrspassed;
                   
                    $concat = $this->getexcededtime($differenceinminutes);
                    
    $max_id = TicketUpdates::select('id','employee_id','updated_at')->where('ticket_id',$ticketid)->orderBy('id','DESC')->first();
                    $ticket_id =    $ticketid;
                    $timingexceed = $concat;//$row->created_at;            
                    $fename = User::where('id',$max_id->employee_id)->first();
                     $ffename = $fename->name." ".$fename->lastName;
                    $mobilenumber = $fename->phone;
                    $linkname = TicketGenerated::where('ticket_id',$ticket_id)->first();
                    $linkaffected = $linkname->link_affected;
                    $lastupdated = $max_id->updated_at;
                    ////////////////Now Region leader name/////////////////////////
                    $regionid = Region::where('region_name',$linkname->region)->first()->id;
                    
                    $regiontlnumber = EnggDriver::where('region_id',$regionid)
                                                ->where('designation','Team leader')
                                                ->first()->desContactno_one;

                    /////////////////////////////////////////
                                              
                    if($hrspassed=='3' && $criticality=='Critical')
                    {  
                     $relatedpersonsphone = User::whereIn('userRole',['Region Team Leader','NOC Team leader','Operations and Maintenance Manager'])->get();
                    
                     }
                    if($hrspassed=='3' &&  $criticality=='High')
                    {
                       $relatedpersonsphone = User::whereIn('userRole',['Region Team Leader','NOC Team leader','Operations and Maintenance Manager'])->get(); 
                       
                    }
                    if($hrspassed =='3' && $criticality=='Medium')
                    {
                         $relatedpersonsphone = User::whereIn('userRole',['Region Team Leader','NOC Team leader','Operations and Maintenance Manager'])->get(); 
                    }
                    if($hrspassed=='4' && $criticality=='Critical')
                    {  $relatedpersonsphone = User::whereIn('userRole',['NOC Manager','Operations and Maintenance Manager'])->get();
                    }
                    if($hrspassed=='4' && $criticality=='High')
                    {  $relatedpersonsphone = User::whereIn('userRole',['NOC Manager','Operations and Maintenance Manager'])->get();
                    }
                    if($hrspassed=='4' &&  $criticality=='Medium')
                    {  $relatedpersonsphone = User::whereIn('userRole',['NOC Manager','Operations and Maintenance Manager'])->get();
                    }

                    if($hrspassed=='8' && $criticality=='Critical')
                    { 
                    
                      $relatedpersonsphone = User::whereIn('userRole',['NOC Manager','Operations and Maintenance Manager','Quality Assurance Manager','Chief Finance Officer'])->get();

                    }

                    if($hrspassed=='8' &&  $criticality == 'Medium')
                    {  $relatedpersonsphone = User::whereIn('userRole',['NOC Manager','Operations and Maintenance Manager','Quality Assurance Manager','Chief Finance Officer'])->get();
                    }
                    if($hrspassed=='8' && $criticality=='High')
                    {
                        $relatedpersonsphone = User::whereIn('userRole',['NOC Manager','Operations and Maintenance Manager'])->get();
                    }
                    if($hrspassed=='12'  && $criticality=='Critical')
                    {

                     $relatedpersonsphone = User::whereIn('userRole',['Chief Executive Officer'])->get(); 
                    }
                    if( $hrspassed=='24' && $criticality=='Critical')
                    {  $relatedpersonsphone = User::whereIn('userRole',['Chief Executive Officer'])->get(); 
                    }

                    if($hrspassed=='12' && $criticality == 'High')
                    {  $relatedpersonsphone = User::whereIn('userRole',['Chief Finance Officer','Quality Assurance Manager'])->get();
                    }

                    if($hrspassed=='12' && $criticality == 'Medium')
                    {  $relatedpersonsphone = User::whereIn('userRole',['Chief Finance Officer','Quality Assurance Manager'])->get();
                    }
                    if($hrspassed=='12' && $criticality == 'Low')
                    {  $relatedpersonsphone = User::whereIn('userRole',['NOC Team leader'])->get();
                    }
                    if($hrspassed=='24' &&  $criticality == 'High')
                    {
                    $relatedpersonsphone = User::whereIn('userRole',['Chief Executive Officer'])->get();

                    }
                    if($hrspassed=='24' &&  $criticality == 'Medium')
                    {
                    $relatedpersonsphone = User::whereIn('userRole',['NOC Manager','Operations and Maintenance Manager','Quality Assurance Manager','Chief Finance Officer'])->get();


                    }
                    if($hrspassed=='24' &&  $criticality == 'Low')
                    {
                    $relatedpersonsphone = User::whereIn('userRole',['NOC Manager'])->get();
    
                    } 
                    
                   
                  //print_r($relatedpersonsphone);die;
                    
                    foreach($relatedpersonsphone as $rows)
                    {   
                     $relatedpersonphonenumbersms = '+254721489544';//$row->phone; // replace this with mathew phone number
                       
                        if($hrspassed =='3')
                            { 
                                $ttl='FAULT NOTIFICATION'; 
                                $ttl2 = "since it was reported";
                       //$regiontlnumber; this will be replaced with mathew's number
                        //return $hrspassed;  $ph '+254721489544'
                           $regiontlnumber = '+254721489544';
                     $ab = $this->msgFunction3hrs($regiontlnumber, $ticket_id, $ffename,$linkaffected,$timingexceed,$lastupdated,$ttl,$ttl2); 
                     
                     
                            }
                        else{ 
                            $ttl = 'ESCALATION'; $ttl2="and has not been resolved";
                            }

                        $ab = $this->msgFunction3hrs($relatedpersonphonenumbersms, $ticket_id,$ffename,$linkaffected,$timingexceed,$lastupdated,$ttl,$ttl2); 
                       $data = ['ticket_id'=>$ticket_id,'designation'=>$rows->userRole,'mobile'=>$relatedpersonphonenumbersms,'cronmsg'=>'Test msg','timepassed'=>$concat];
                       CronEntry::create($data);
                    }
                     
                         
    }
   
}
