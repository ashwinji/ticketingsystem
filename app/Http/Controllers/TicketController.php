<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;
use App\Department;
use App\TicketGenerated;
use App\TicketStatus;
use App\Service;
use App\Client;
use App\TicketProcessing;
use App\TicketUpdates;
use App\Region;
use App\CloseTicket;
use App\TicketPostReply;
use App\Sms_setting;
use anlutro\cURL\cURL; 
use App\Websitesetting;
use infobip\api\client\SendSingleTextualSms;
use infobip\api\configuration\BasicAuthConfiguration;
use infobip\api\model\sms\mt\send\textual\SMSTextualRequest;
use DateTime;
use Carbon\Carbon;
use App\Nature_of_Fault;
use App\Todolist;
use Session;

class TicketController extends Controller
{
  function __construct()
    {
         $this->middleware('permission:open-ticket-list');
         $this->middleware('permission:open-ticket-create', ['only' => ['ticket-generated-create','ticketStore','ticket-generated-store2','ticket-post-reply']]);
         $this->middleware('permission:open-ticket-edit', ['only' => ['ticket-generated-store','ticketStore','ticket-generated-store2','savenewaccessrequest','savenewsecurityrequest','updatefedata','editingaccesstime','savesecurityescortmodeldata','closetheticket','ticketListClosedEditStored','ticketListPendingEditStored','ticketListCancelledEditStored']]);
         $this->middleware('permission:open-ticket-delete', ['only' => ['ticket-processing-delete','ticket-processing-delete','delfedata','deleteassigned_fe']]);

    }
    
    public function strReplaceAssoc(array $replace, $subject) 
    { 
       return str_replace(array_keys($replace), array_values($replace), $subject);
    }


    public function msgFunction($mobileNum, $ticketno,$fename,$linkaffected,$assignorreassign) 
    { 

        $getSMSInfo = Websitesetting::select('sms_username','sms_senderid', 'sms_passwrd', 'sms_message')->first();
         
         $sendto         = $mobileNum; 
         $sender         = $getSMSInfo->sms_senderid;
         $authApi        = $getSMSInfo->sms_username;
         $authApiPass    = $getSMSInfo->sms_passwrd;

         $client = new SendSingleTextualSms(new BasicAuthConfiguration($authApi, $authApiPass));
         ////////////Message change Word start
         $replace = array( 
             'FENAMESSS'     => $fename,
             'TICKETNO'     => $ticketno,
             'LINKAFFECTED'=>$linkaffected,
             'ASSIGNATION' =>$assignorreassign
         );
         $string     = $getSMSInfo->sms_message; 
         $message    = $this->strReplaceAssoc($replace,$string);
         // print_r($message);
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
            echo "HTTP status code: " . $exception->getCode() . "\n";
            echo "Error message: " . $exception->getMessage();
            //dd($exception);
        }
    }
/*After the resolution the sms is to be sent*/
public function msgFunctionafterResolution($mobileNum, $ticketno,$fename,$linkaffected,$createtime,$resolutiontime,$accessrequest,$securityrequest,$pendingtime,$slatiming) 
    { 
         
        $getSMSInfo = Websitesetting::select('sms_username','sms_senderid', 'sms_passwrd', 'sms_after_resolution')->first();
         
         $sendto         = $mobileNum; 
         $sender         = $getSMSInfo->sms_senderid;
         $authApi        = $getSMSInfo->sms_username;
         $authApiPass    = $getSMSInfo->sms_passwrd;

         $client = new SendSingleTextualSms(new BasicAuthConfiguration($authApi, $authApiPass));
         ////////////Message change Word start
         $replace = array( 
             'TICKETNO'     => $ticketno,
             'LINKAFFECTED'=>$linkaffected,
             'CREATETIME' =>$createtime,
             'RESOLVETIME' =>$resolutiontime,
             'ACCTIME' =>$accessrequest,
             'ESCTIME' =>$securityrequest,
             'PENDTIME'=>$pendingtime,
             'SLATIME' =>$slatiming,
         );


         $string     = $getSMSInfo->sms_after_resolution; 
         $message    = $this->strReplaceAssoc($replace,$string);
         //echo $message;die;
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
            echo "HTTP status code: " . $exception->getCode() . "\n";
            echo "Error message: " . $exception->getMessage();
            //dd($exception);
        }
    }
/*After the resolution the sms is to be sent*/
    

    /*Generate Ticket Listing Record*/
    public function ticketGenerate()
    {  
        $data = TicketGenerated::where('status','1')->orderBy('ticket_id', 'DESC')->get();
        
        return view('pages.ticketgenerated', compact('data'));
    }
    /*Generate Ticket form data show */
   public function ticketCreate() 
    {
        $Allstatus = TicketStatus::pluck('name', 'id')->all();
        $data = TicketGenerated::orderBy('ticket_id', 'ASC')->get();
        $empdata = User::selectRaw('id, CONCAT(name," ",lastName) as name')->where('userType','3')->pluck('name', 'id');
        $dept = Department::pluck('name','id')->all();
        $roles = Role::pluck('name','id')->all();
        $nocdata = User::where('userType','1')->pluck('name', 'id')->all();
        $clientdata = Client::pluck('name', 'id')->all();
        $servicedata = Service::pluck('name', 'id')->all();
        $regions = Region::all();
        $logged_in_person =User::where('id',Auth::user()->id)->first();
        $lastid = TicketGenerated::orderBy('id', 'DESC')->first()->id;
        return view('pages.ticketgenerated', compact('dept', 'roles','data','empdata','Allstatus','nocdata','clientdata','servicedata','regions','logged_in_person','lastid'));
    }

        /*Generate ticket create function */
 public function ticketStore(Request $request)
    {
       $this->validate($request, [
            'ticketno'     => 'required',    
            'client_id'     => 'required',    
            'employee_id' => 'required',
            'department_id'     => 'required', 
            'service_affected' => 'required', 
            'status'           => 'required',
            'region'           => 'required',
            'description'           => 'required',
            'reporting_time'           => 'required',
            'linkaffected'           => 'required',
            'clientticketno' =>'required',
        ]);

        if(!empty($request->ticket_id))
        {   
            TicketGenerated::where('ticket_id',$request->ticketno)
                                        ->update(['noc_engg_id'=>Auth::user()->id,
                                                   'client_id' =>$request->client_id,
                                                  'employee_id'=>$request->employee_id,
                                                  'department_id'=>$request->department_id,
                                                  'region'=>$request->region,
                                                  'service_affected'=>$request->service_affected,
                                                  'status'=>'1',
                                                  'priority'=>$request->priority,
                                                  'clientticketno'=>$request->clientticketno,
                                                  'description'=>$request->description,
                                                  'link_affected'=>$request->linkaffected,
                                                  'reporting_time'=>$request->reporting_time,
                                                  'fault_reported_by'=>$request->fault_reported_by,
                                                  'fault_reported_by'=>$request->fault_reported_by]);

           $f_row = TicketUpdates::where('ticket_id',$request->ticket_id)->orderBy('id','ASC')->first(); 
           $f_id = $f_row['id'];
           

            $initialrow = TicketUpdates::find($f_id);
            $initialrow->client_id = $request->client_id;
            $initialrow->employee_id = $request->employee_id;
            $initialrow->link_affected =  $request->linkaffected;
            $initialrow->noc_operator = Auth::user()->id;
            $initialrow->save();

            $data = TicketGenerated::where('status','1')->orderBy('created_at', 'DSC')->get();
        return view('pages.ticketprocessing', compact('data'));
            /*return redirect()->back()
                        ->with('success','User successfully updated.');*/
        }
        else
        {
          $this->validate($request, [
            'ticketno'     => 'required|unique:ticket_generateds,ticket_id',    

        ]);




            $data = new TicketGenerated;  
            $data->ticket_id = $request->ticketno;
            $data->noc_engg_id = Auth::user()->id;
            $data->client_id = $request->client_id;            
            $data->employee_id = $request->employee_id;
            $data->department_id = $request->department_id;
            $data->region = $request->region;
            $data->service_affected = $request->service_affected;          
            $data->status = '1';
            $data->description = $request->description;
            $data->link_affected = $request->linkaffected;
            $data->priority = $request->priority;
            $data->reporting_time = $request->reporting_time;
            $data->clientticketno = $request->clientticketno;
            $data->fault_reported_by = $request->fault_reported_by;
            $data->save();
            $LastInsertId = $data->id;  


            $lastgenerated = TicketGenerated::where('id',$LastInsertId)->first();
            $data2 = new TicketUpdates;
            $data2->ticket_id = $request->ticketno;
            $data2->client_id = $request->client_id;
            $data2->employee_id = $request->employee_id;
            $data2->opening_time = $lastgenerated->reporting_time;//created_at;$request->reporting_time,
            $data2->link_affected =  $request->linkaffected;
            $data2->noc_operator = Auth::user()->id;

            $data2->save();
            
            
            $checkisblocked = Sms_setting::where('stage','Opening Fault')->first();
            $fename = User::where('id',$request->employee_id)->first();
            $femobilenumberforsms = '+254721489544';//$fename->phone; 
            // this will be replaced with mathew mobile '+254721489544';//
            
               if($checkisblocked->decision == "Yes")
               { $sendmessage = $this->msgFunction($femobilenumberforsms, $request->ticketno,$fename->name,$request->linkaffected,'assigned to you');  }
             else
             {        
              }
             
            return redirect()->back()
                        ->with('success','Ticket Generated successfully Your Ticket Number = '.$request->ticketno);
        
        }
        
        
    }

    /*Re-assign FE Form data Insert*/ 
 public function ticketStore2(Request $request)
 {
       $this->validate($request, [
            'noc_operator'  => 'required',
            'ticket_id'     => 'required',    
            'client_id' => 'required',
            'employee_id'     => 'required', 
            'status'           => 'required',
            ]);

       $previous_complaint = TicketUpdates::where('ticket_id', $request->ticket_id)->orderBy('id', 'DESC')->first();
       if(!empty($previous_complaint))
        {
           $closetime= date('Y-m-d H:i:s'); 
           TicketUpdates::where('id',$previous_complaint->id)->update(['closing_time'=>$closetime]);
        }            
                    $ticketno = $request->ticket_id;
                    $data1 = new TicketUpdates;    
                    $data1->noc_operator     = $request->noc_operator;                 
                    $data1->ticket_id        = $request->ticket_id;    
                    $data1->client_id        = $request->client_id;  
                    $data1->employee_id      = $request->employee_id;
                    $data1->opening_time     = date('Y-m-d H:i:s');                   
                    $data1->comments         = $request->comments;
                    $data1->status           = $request->status;                   
                    $data1->save();

//here is we sending the message
                $checkisblocked = Sms_setting::where('stage','Reassign FE')->first();
               $fename = User::where('id',$request->employee_id)->first();
 $fenumberforsms2 = '+254721489544';//$fename->phone; // this will be replaced with mathew mobile number '+254721489544';//
               $linkname = TicketGenerated::where('ticket_id',$request->ticket_id)->first();
               $linkaffected = $linkname->link_affected;
               if($checkisblocked->decision == "Yes")
               { $sendmessage = $this->msgFunction($fenumberforsms2, $request->ticket_id,$fename->name,$linkaffected,'re-assigned to you');  }
             else
             {         }
           //sending the message


     return redirect()->back()->with('success','New Field Engineer Assigned successfully to Ticket Number = '.$ticketno);
 }

    /*    Generate listing page view button redirect to ticket processing page*/
    public function ticketProcessingEdit($id){

          if(count(TicketGenerated::where('ticket_id', $id)->first())<1)
            {
                return \Redirect()->back()->with('error', 'Data not found...');
            }
            $data = TicketGenerated::where('ticket_id', $id)->get();    
            return view('pages.ticketprocessing', compact('data'));
            }
public function ticketProcessingDelete($id){
       
                TicketGenerated::where('ticket_id',$id)->delete();
                TicketUpdates::where('ticket_id',$id)->delete();
                CloseTicket::where('ticket_id',$id)->delete();
                return redirect()->back()->with('success','Ticket No deleted successfully');
            }
            
            
            
            public function ticketProcessingedits($id)
            {
             $ticketrow = TicketGenerated::where('ticket_id',$id)->first();

         $Allstatus = TicketStatus::pluck('name', 'id')->all();
        $data = TicketGenerated::orderBy('ticket_id', 'ASC')->get();
        $empdata = User::selectRaw('id, CONCAT(name," ",lastName) as name')->where('userType','3')->pluck('name', 'id');
        $dept = Department::pluck('name','id')->all();
        $roles = Role::pluck('name','id')->all();
        $nocdata = User::where('userType','1')->pluck('name', 'id')->all();
        $clientdata = Client::pluck('name', 'id')->all();
        $servicedata = Service::pluck('name', 'id')->all();
        $regions = Region::all();
        $logged_in_person =User::where('id',Auth::user()->id)->first();
        
        return view('pages.ticketgenerated', compact('dept', 'roles','data','empdata','Allstatus','nocdata','clientdata','servicedata','regions','logged_in_person','ticketrow'));
            }

            
  
    //modal for new field engineer access site to be saved here every thing is necessary
            public function getaccessinsertmodaldata(Request $request)
            {
                $ticketnumber = $request->id;
                $generats = TicketGenerated::where('ticket_id',$ticketnumber)->first();
                $userlist = User::selectRaw('id, CONCAT(name," ",lastName) as name')->where('userType','3')->get();
                return view('pages.requestAccessFill',compact('ticketnumber','generats','userlist'));               
            }
            public function savenewaccessrequest(Request $request)
           {
                    $this->validate($request, [
                                'site_address'  => 'required',
                                'acc_request_time'     => 'required', 
                                'client_id'=>'required',   
                                'employee_id' => 'required',
                                'comments'     => 'required', 
                                ]);
                                
                                
                                //first we need to check whether the user exist or not
                    $a = TicketUpdates::where('ticket_id',$request->ticket_id)
                                        ->where('employee_id',$request->employee_id)
                                        ->where('nonassignedengg',"NO")
                                        ->first();
                     if(count($a))
                     {
                     TicketUpdates::where('ticket_id',$request->ticket_id)->where('employee_id',$request->employee_id)
                                        ->update(['site_address'=>$request->site_address,
                                                   'client_id' =>$request->client_id,
                                                  'acc_request_time'=>$request->acc_request_time,
                                                  'comments'=>$request->comments]);
                    // return redirect()->back()->with('success','Successfully  NO access inserted Your Record');
                     }
                     else {
                     $savedata = new TicketUpdates;                     
                     $savedata->ticket_id = $request->ticket_id;
                     $savedata->client_id = $request->client_id;
                     $savedata->employee_id = $request->employee_id;
                     $savedata->noc_operator = Auth::user()->id;
                     $savedata->acc_request_time = $request->acc_request_time;
                     $savedata->site_address = $request->site_address;
                     $savedata->comments = $request->comments;
                     $savedata->nonassignedengg = "YESACCESS";
                     $savedata->save();
                     //  return redirect()->back()->with('success','Successfully  yes access inserted Your Record');
                     }
                      return redirect()->back()->with('success','Successfully  inserted Your Record');



           }

           public function getescortinsertmodaldata(Request $request)
           {
                $ticketnumber = $request->id;
                $userlist = User::selectRaw('id, CONCAT(name," ",lastName) as name')->where('userType','3')->get();
                $generats = TicketGenerated::where('ticket_id',$ticketnumber)->first();
                $linkaffected = TicketUpdates::where('ticket_id',$ticketnumber)->first();
                return view('pages.requestSecurityFill',compact('ticketnumber','userlist','generats','linkaffected'));     

           }
           public function savenewsecurityrequest(Request $request)
           {
                 $this->validate($request, [
                                'link_affected'  => 'required',
                                'escort_request_time'     => 'required',    
                                'employee_id' => 'required',
                                'client_id'=>'required',
                                'comments'     => 'required', 
                                ]);
            //first we need to check whether the user exist or not
                    $a = TicketUpdates::where('ticket_id',$request->ticket_id)
                                        ->where('employee_id',$request->employee_id)
                                        ->where('nonassignedengg',"NO")
                                        ->first();
                  if(count($a))
                     {
                     TicketUpdates::where('ticket_id',$request->ticket_id)->where('employee_id',$request->employee_id)
                                        ->update(['link_affected'=>$request->link_affected,
                                                  'escort_request_time'=>$request->escort_request_time,
                                                  'comments'=>$request->comments]);
                     }
                     else {                    
                                
                     $savedata = new TicketUpdates;
                     $savedata->link_affected = $request->link_affected;
                     $savedata->ticket_id = $request->ticket_id;
                     $savedata->client_id = $request->client_id;
                     $savedata->employee_id = $request->employee_id;
                     $savedata->noc_operator = Auth::user()->id;
                     $savedata->escort_request_time = $request->escort_request_time;
                     $savedata->comments = $request->comments;
                     $savedata->nonassignedengg = 'YESSECURITY';                     
                     $savedata->save();
                     }
                    return redirect()->back()->with('success','Successfully  inserted Your Record');
           }
           
           
           
           
            public function geteditfedata(Request $request)
      {
          $rowid = $request->id;
          $fedata = TicketUpdates::where('id',$rowid)->first();
          $tiktid = $fedata->ticket_id;
        
        $reportingtime = TicketGenerated::where('ticket_id',$tiktid)->first();
          $userlist = User::selectRaw('id, CONCAT(name," ",lastName) as name')->where('userType','3')->get();

          return view('pages/requestfeedit',compact('fedata','reportingtime','userlist'));
      }

    public function updatefedata(Request $request)
    {
        $this->validate($request, [
            'opening_time'  => 'required',
            'comments'     => 'required',    
            ]);
        TicketUpdates::where('id',$request->id)
                                        ->update(['employee_id'=>$request->employee_id,
                                                  'opening_time'=>$request->opening_time,
                                                  'closing_time'=>$request->closing_time,
                                                  'comments'=>$request->comments]);
      return redirect()->back()->with('success','Successfully  updated Your client data');

    }


    public function delfedata($id)
    {
        TicketUpdates::where('id',$id)->delete();
        return redirect()->back()->with('success','Successfully  deleted Your client data');

    }

 //modal for access request edit
     public function getmodeldata(Request $request)
     {  
       $id = $request->id;
        $getadata= TicketUpdates::where('id',$id)->first();      
        $tiktid = $getadata->ticket_id;
        $reportingtime = TicketGenerated::where('ticket_id',$tiktid)->first();
        return view('pages.requestAccessEdit', compact('getadata','reportingtime'));

     }  
       /* Ticket Process page Update Access Time record update*/
     public function editaccesstime(Request $request)
         {
           $this->validate($request, [
            'site_address'  => 'required',  
            'acc_request_time' => 'required',
            'acc_granted_time'  => 'required', 
            'comments'  => 'required',                        
              ]);
             $data1 = TicketUpdates::find($request->id);
             $data1->site_address  = $request->site_address;
             $data1->acc_request_time = $request->acc_request_time;
             $data1->acc_granted_time = $request->acc_granted_time;
             $data1->comments  = $request->comments;                           
             $data1->save();            
              return redirect()->back()->with('success','Successfully  Updated Your Record');
           }

   //editing security access time
     public function getsecurityescortmodeldata(Request $request)
     {           
         $idlst = explode("_",$request->id);
         $id = $idlst[0];
         $ticketid = $idlst[1];//$request->ticketid;
         $data= TicketUpdates::where('id',$id)->first();
         $data2 = TicketGenerated::where('ticket_id',$ticketid)->first();
         return view('pages.requestSecurityEdit', compact('data','data2'));
     }
  /* security scord record insert Ticket Processing listing page */
     public function savesecurityescortmodeldata(Request $request)
     {         
            $this->validate($request, [
            'link_affected'  => 'required',  
            'escort_request_time' => 'required',
            'escort_granted_time'  => 'required', 
            'comments'  => 'required',                        
        ]);
             $data1 = TicketUpdates::find($request->id);
             $data1->escort_request_time = $request->escort_request_time;
             $data1->escort_granted_time = $request->escort_granted_time;
             $data1->comments  = $request->comments;                           
             $data1->save(); 
             TicketGenerated::where('ticket_id',$request->ticket_id)->update(['link_affected'=>$request->link_affected]);           
            return redirect()->back()->with('success','Escort Time is update successfully');
                   }

   /*Ticket Processing Part here */

    public function ticketProcessinglist()
    {
        $data = TicketGenerated::where('status','1')->orderBy('reporting_time', 'DSC')->get();
        return view('pages.ticketprocessing', compact('data'));
    }

 /*   Ticket View page Processing */
   public function ticketProcessingView($id){
    $updating = TicketUpdates::join('users', 'ticket_updates.employee_id', '=', 'users.id')
                ->where('ticket_updates.ticket_id',$id)
                 ->select('ticket_updates.*', 'users.name as empassigned','users.lastName as empassigned2','users.phone as usphone')
                 ->get();
    $generating = TicketGenerated::join('departments','ticket_generateds.department_id','=','departments.id')
                              ->where('ticket_generateds.ticket_id',$id)
                               ->select('ticket_generateds.*','departments.name as deptname')  
                               ->get();

        $postReplyMsg = TicketPostReply:: where('ticket_id',$id)->orderBy('id', 'DSC')->get();
        $logged_in_person =User::where('id',Auth::user()->id)->first();
        $regions =Region::pluck('region_name','region_name')->all();
        $allStatus = TicketStatus::pluck('name', 'id')->all();
        $empdata = User::selectRaw('id, CONCAT(name," ",lastName) as name')->where('userType','3')->pluck('name', 'id');
        $dept = Department::pluck('name','id')->all();
        $roles = Role::pluck('name','id')->all();
        $nocdata = User::where('userType','1')->pluck('name', 'id')->all();
        $clientdata = Client::pluck('name', 'id')->all();
        $servicedata = Service::pluck('name', 'id')->all();
        $generateAlldata =TicketGenerated::where('ticket_id',$id)->first();
        $radiobuttonValue= TicketGenerated::where('ticket_id',$id)->first();
        $allCauseoffalut = Nature_of_Fault::pluck('name', 'name')->all();

    return view('pages.ticketprocessingView', compact('updating','generating','logged_in_person','regions','allStatus','empdata','dept','roles','nocdata','clientdata','servicedata','id','generateAlldata','radiobuttonValue','postReplyMsg','allCauseoffalut'));
   }

 /*   Ticket View page Processing  radio button link */
public function ticketProcessingViewRadio(Request $request){
  
    $updating = TicketUpdates::join('users', 'ticket_updates.employee_id', '=', 'users.id')
                ->where('ticket_updates.ticket_id',$request->id)
                 ->select('ticket_updates.*', 'users.name as empassigned','users.phone as usphone')
                 ->get();

  $generating = TicketGenerated::join('departments','ticket_generateds.department_id','=','departments.id')
                              ->where('ticket_generateds.ticket_id',$request->id)
                               ->select('ticket_generateds.*','departments.name as deptname')  
                               ->get();

        $logged_in_person =User::where('id',Auth::user()->id)->first();
        $regions =Region::pluck('region_name','region_name')->all();
        $allStatus = TicketStatus::pluck('name', 'id')->all();
        $empdata = User::selectRaw('id, CONCAT(name," ",lastName) as name')->where('userType','3')->pluck('name', 'id');
        $dept = Department::pluck('name','id')->all();
        $roles = Role::pluck('name','id')->all();
        $nocdata = User::where('userType','1')->pluck('name', 'id')->all();
        $clientdata = Client::pluck('name', 'id')->all();
        $servicedata = Service::pluck('name', 'id')->all();
        $id = $request->id;   
        $generateAlldata=TicketGenerated::where('ticket_id',$id)->first(); 
        $radiobuttonValue= TicketGenerated::where('ticket_id',$id)->first();
        $allCauseoffalut = Nature_of_Fault::pluck('name', 'name')->all();

      return view('pages.ticketprocessingView', compact('updating','generating','logged_in_person','regions','allStatus','empdata','dept','roles','nocdata','clientdata','servicedata','id','generateAlldata','radiobuttonValue','allCauseoffalut'));
}


 
 public function deleteassigned_fe($id)
     {
         TicketUpdates::where('id',$id)->delete();
         return redirect()->back()->with('success','Field Engineer Deleted ....');
     }
 

/* Closing the ticket */
           public function closetheticket(Request $request)
     {
        
      //echo "OK CLOSE";die;

         $this->validate($request, [
            'ticket_id'     => 'required',    
            'resolution_time' => 'required',
            'closing_noc_engg_id'     => 'required', 
            'clearence_officer_onclient_side' => 'required', 
            'cause_of_fault'   => 'required',
            'resolution_remark'  => 'required',
            'status'            => 'required',
            ]);

          $checkgrantdatenull = TicketUpdates::where('ticket_id',$request->ticket_id)
                                               ->where('acc_granted_time',NULL)
                                               ->where('acc_request_time','!=',NULL)
                                                ->first();
            $checkgrantdatenull2 = TicketUpdates::where('ticket_id',$request->ticket_id)
                                               ->where('escort_granted_time',NULL)
                                               ->where('escort_request_time','!=',NULL)
                                               ->first();

           if(count($checkgrantdatenull) || count($checkgrantdatenull2))
           {
             return redirect()->back()->with('error','Access grant time /Escort grant  time is not filled ...');
           }
           else{
         $closeticket = new CloseTicket;   
         $closeticket->ticket_id = $request->ticket_id;
         $closeticket->client_id = $request->client_id;
         $closeticket->resolution_time = $request->resolution_time;
         $closeticket->closing_noc_engineer  = Auth::user()->id;
         $closeticket->clearence_officer_onclient_side = $request->clearence_officer_onclient_side;
         $closeticket->cause_of_fault = $request->cause_of_fault;
         $closeticket->resolution_remark = $request->resolution_remark;
         $closeticket->status  =  $request->status;          
         $getdata = CloseTicket::where('ticket_id',$request->ticket_id)->count();        
         if(!empty($getdata))
         {
            $userid = Auth::user()->id;
            CloseTicket::where('ticket_id', $request->ticket_id)->update(['resolution_time'=>$request->resolution_time,'closing_noc_engineer'=>$userid,'clearence_officer_onclient_side'=>$request->clearence_officer_onclient_side,'cause_of_fault'=>$request->cause_of_fault,'resolution_remark'=>$request->resolution_remark,'status'=>$request->status]);               
          }
         else
         {  
            $closeticket->save();          
         }
        TicketGenerated::where('ticket_id',$request->ticket_id)->update(['status'=>$request->status]);
        TicketUpdates::where('ticket_id',$request->ticket_id)->update(['status'=>$request->status]);
        //if status is pending then we need to enter the end time also
          if($request->status == 3 )
            {
               $pendinginsertiontime = date("Y-m-d h:i:s");
               $lastworking_id = TicketUpdates::select('id')->where('ticket_id',$request->ticket_id)->orderBy('id','DESC')->first();
        if(!empty($lastworking_id)){ 
            TicketUpdates::where('id',$lastworking_id->id)->update(['closing_time'=>$pendinginsertiontime]);
                }              
            }
            if($request->status == 2 || $request->status == 1  || $request->status == 4)
            {
             $lastworking_id = TicketUpdates::select('id')->where('ticket_id',$request->ticket_id)->orderBy('id','DESC')->first();
        if(!empty($lastworking_id)){
            TicketUpdates::where('id',$lastworking_id->id)->update(['closing_time'=>$request->resolution_time]);
                }
                 
            }

        //if status is pending then we need to enter the end time also
        //here we are sending the sms
             
            $checkisblocked = Sms_setting::where('stage','Fault Cleared')->first();
           if($checkisblocked->decision == "Yes" && $request->status ==2)
            {
                
            $max_id = TicketUpdates::select('id','employee_id')->where('ticket_id',$request->ticket_id)->orderBy('id','DESC')->first();
            $fename = User::where('id',$max_id->employee_id)->first();
            $mobilenumber = '+254721489544';//$fename->phone;//'+254721489544';//
            //die;

            $linkname = TicketGenerated::where('ticket_id',$request->ticket_id)->first();
            $linkaffected = $linkname->link_affected;
            $createdtime = TicketGenerated::where('ticket_id',$request->ticket_id)->first();
            $createtime = $createdtime->reporting_time;//$createdtime->created_at;
            $closingtime =$request->resolution_time;  //here the closing time
            $createtime1 =Carbon::parse($createtime);
            $closingtime1 = Carbon::parse($closingtime);
            $ttldiff = $this->getthedifference($closingtime1,$createtime1);
            //calculate the acc time and its difference
            $acctime = '';
            $timinglist = TicketUpdates::where('ticket_id',$request->ticket_id)
                                        ->get();
            $accessdifference = 0;
            $securitydifference =0;
            $sladay =0;$slahr=0;$slamin =0;
            $delayedacctime =0;
            $delayedesctime =0;
            foreach($timinglist as $row)
            {
                if($row->acc_request_time== NULL || $row->acc_granted_time== NULL)
                {
                 $concatacc =0;
                 $delayedacctime = $delayedacctime+0;
                }
                else
                {
               $acc_req = Carbon::parse($row->acc_request_time);
               $acc_gra = Carbon::parse($row->acc_granted_time);
               $delayedacctime = $delayedacctime+$this->getthedifference($acc_gra,$acc_req);         
               }
               $concatacc = $this->arrangetheminutes($delayedacctime);
            /////////////////now for escort//////////////////////
               if($row->escort_request_time== NULL || $row->escort_granted_time== NULL)
                {
                 $concatesc = 0;
                 $delayedesctime = $delayedesctime+0;
                }
                else
                {
               $esc_req = Carbon::parse($row->escort_request_time);
               $esc_gra = Carbon::parse($row->escort_granted_time);
               $delayedesctime = $delayedesctime+$this->getthedifference($esc_gra,$esc_req);  
               
               }
               $concatesc = $this->arrangetheminutes($delayedesctime);
            //////////////////////////end of escort   
     
            }
            
            $pendingtickettime = CloseTicket::where('ticket_id',$request->ticket_id)->first()->pendingtime_min;
            
            $concatpend = $this->arrangetheminutes($pendingtickettime);
             
              $ttldelayed = $delayedacctime+$delayedesctime+$pendingtickettime;
              $ttlrestime = $ttldiff - $ttldelayed;
              $ttlslatime = $this->arrangetheminutes($ttlrestime);

            //$mobilenumber will be replaced with mathew number
            $sendmessage = $this->msgFunctionafterResolution($mobilenumber,$request->ticket_id,$fename->name,$linkaffected,$createtime,$request->resolution_time,$concatacc,$concatesc,$concatpend,$ttlslatime);  
         }

             // else
             // {         }
             if($request->status ==2)
                {$action = "Closing";}
             elseif($request->status ==3)
                {$action = "Pending";}
             elseif($request->status ==4)
                { $action = "Cancellation";}
             else
                { $action ='';}
             
            return redirect()->back()
                        ->with('success','Task of Ticket '.$action.' done successfully');
            }

         return redirect()->back()->with('success','Data Update Successfully...');

          

     }

/* Listing Closed ticket*/

 public function ticketListClosed()
    {

        //$data = CloseTicket::where('status','2')->orderBy('id', 'DESC')->get();    
/*        $data =  CloseTicket::join('ticket_generateds','close_tickets.ticket_id','=','ticket_generateds.ticket_id')
                               ->where('close_tickets.status','=','2')
                               ->where('ticket_generateds.status','=','2')
                               ->select('close_tickets.*','ticket_generateds.*')//,'ticket_generateds.   clientticketno')//,'ticket_generateds.link_affected')
                               ->orderBy('close_tickets.created_at','DSC')
                               ->get();
*/
        $data =  TicketGenerated::join('close_tickets','ticket_generateds.ticket_id','=','close_tickets.ticket_id')
                               ->where('close_tickets.status','=','2')
                               ->where('ticket_generateds.status','=','2')
                               ->select('close_tickets.*','ticket_generateds.*')//,'ticket_generateds.   clientticketno')//,'ticket_generateds.link_affected')
                               ->orderBy('close_tickets.created_at','DSC')
                               ->get();


                      //dd($data);         

        $lstarray = array();
        foreach($data as $row)
        {
            $lnk = TicketUpdates::where('ticket_id',$row->ticket_id)->first();
            $lstarray[] = $lnk->link_affected; 
        }
        // echo "<pre>";
        //  print_r($data);
        // print_r($lstarray);
        // die;
        //Now we are calculating the SLA timing as Mathew again demanded the sla time to be shown
        // in close ticket listing
        $sltarray = array();
        foreach($data as $cc)
        {
            $ticktid = $cc->ticket_id;
            $part1 = TicketGenerated::where('ticket_id', $ticktid)->first();
            $part35 = CloseTicket::where('ticket_id', $ticktid)->first(); 
            $accessRequestdata =  TicketUpdates::where('ticket_id',$ticktid)->get();
            $accdif = 0;
                foreach($accessRequestdata as $vl)
                {  if($vl->acc_granted_time !=0)
                  {
                    $accreq = Carbon::parse($vl->acc_request_time);
                    $accgra = Carbon::parse($vl->acc_granted_time);
                    $mindif = $this->getthedifference($accgra,$accreq);
                    $accdif = $accdif+$mindif;  
                  }
                  else
                  {
                    
                  }
                }
        $ttlacc = $this->arrangetheminutes($accdif);
            
             $escdif = 0;
    foreach($accessRequestdata as $vs)
    {  if($vs->escort_granted_time !=0)
      {
        $escreq = Carbon::parse($vl->escort_request_time);
        $escgra = Carbon::parse($vl->escort_granted_time);
        $mindif = $this->getthedifference($escgra,$escreq);
        $escdif = $escdif+$mindif;  
      }
      else
      {
        
      }
    }
        $ttlesc = $this->arrangetheminutes($escdif);  

$mintoberemove = $accdif+$escdif; 
if(!empty($part35)){
        $cret = Carbon::parse($part1->reporting_time);//created_at);
        $rest = Carbon::parse($part35->resolution_time);   
        $mindf = $this->getthedifference($rest,$cret);
        $sltt = $mindf - $mintoberemove;
        $accurateslt = $this->arrangetheminutes($sltt);
     }   
     else
      {$accurateslt =0;}

         $sltarray[] =$accurateslt;
         
        }
        //echo sizeof($data)."_______".sizeof($sltarray);
        //die;
        
        // here is the calculated 



        return view('pages.ticketListingClosed', compact('data','lstarray','sltarray'));
    }
public function ticketListClosedEdit($id){

        //first get the ticket number
       $row = TicketGenerated::where('id',$id)->first();
        $ticket_id = $row->ticket_id;
        // $dataedit = CloseTicket::where('id',$id)->first();
        $dataedit = CloseTicket::where('ticket_id',$ticket_id)->first();
        $allStatus = TicketStatus::pluck('name', 'id')->all();
        return view('pages.ticketListingClosed', compact('dataedit','allStatus'));
}
public function ticketListClosedStore(Request $request){
     $this->validate($request, [
            'ticket_id'     => 'required',    
            'status'            => 'required',
            ]);         
        CloseTicket::where('ticket_id',$request->ticket_id)->update(['status'=>$request->status]);      
        TicketGenerated::where('ticket_id',$request->ticket_id)->update(['status'=>$request->status]);
        TicketUpdates::where('ticket_id',$request->ticket_id)->update(['status'=>$request->status]);
        
        
        //here the sms will be sent
            if($request->status == '1'){
            $checkisblocked = Sms_setting::where('stage','Reopen Ticket')->first();
            $max_id = DB::select("select employee_id from ticket_updates where id IN (select max(id)from ticket_updates where ticket_id='".$request->ticket_id."')");
            $fename = User::where('id',$max_id[0]->employee_id)->first();
            $femobilenumberforsms3 = '+254721489544';//$fename->phone; //'+254721489544';//
            $linkname = TicketGenerated::where('ticket_id',$request->ticket_id)->first();
            $linkaffected = $linkname->link_affected;
                if($checkisblocked->decision == "Yes")
                { $sendmessage = $this->msgFunction($femobilenumberforsms3, $request->ticket_id,$fename->name,$linkaffected,'re-opened');  }
              else
              {         }
             }
        // here the sms will be sent
        return redirect()->back()->with('success','Status Update Successfully');
}

    
public function ticketListPending(){
        //$data = CloseTicket::where('status','3')->orderBy('id', 'DESC')->get();
/*        $data =  CloseTicket::join('ticket_generateds','close_tickets.ticket_id','=','ticket_generateds.ticket_id')
                               ->where('close_tickets.status','=','3')
                               ->where('ticket_generateds.status','=','3')
                               ->select('close_tickets.*','ticket_generateds.description')
                               ->orderBy('close_tickets.created_at','DSC')
                               ->get();
*/      
       $data =  TicketGenerated::join('close_tickets','ticket_generateds.ticket_id','=','close_tickets.ticket_id')
                              ->where('close_tickets.status','=','3')
                              ->where('ticket_generateds.status','=','3')
                              ->select('close_tickets.*','ticket_generateds.*')
                              ->orderBy('close_tickets.created_at','DSC')
                              ->get();
          $lstarray = array();
        foreach($data as $row)
        {
            $lnk = TicketUpdates::where('ticket_id',$row->ticket_id)->first();
            $lstarray[] = $lnk->link_affected; 
        }
        return view('pages.ticketListingPending', compact('data','lstarray'));
}

public function ticketListPendingEdit($id){
 //       echo $id;
        $tid = TicketGenerated::where('id',$id)->first()->ticket_id;

        // $dataedit = CloseTicket::where('id',$id)->first();
        $dataedit = CloseTicket::where('ticket_id',$tid)->first();
        $allStatus = TicketStatus::pluck('name', 'id')->all();
   //      echo "<pre>";
     //   print_r($dataedit);
       // die;
        return view('pages.ticketListingPending', compact('dataedit','allStatus'));
}
public function ticketListPendingStore(Request $request){
     $this->validate($request, [
            'ticket_id'     => 'required',    
            'status'            => 'required',
            ]);         
        CloseTicket::where('ticket_id',$request->ticket_id)->update(['status'=>$request->status]);      
        TicketGenerated::where('ticket_id',$request->ticket_id)->update(['status'=>$request->status]);
        TicketUpdates::where('ticket_id',$request->ticket_id)->update(['status'=>$request->status]);
        
//here the sms will be sent
            if($request->status == '1'){
            //now pending time will be calculated and stored
                    $currenttime = date('Y-m-d G:i:s');
                    $curr = Carbon::parse($currenttime);
                   $pendinginittime = CloseTicket::where('ticket_id',$request->ticket_id)->first()->resolution_time;
                   $pen = Carbon::parse($pendinginittime);
                   //$curr = Carbon::parse('2019-02-02 05:00:00');
                   //$pen = Carbon::parse('2019-02-01 10:00:00');
                   $pendingdiff_min = $this->getthedifference($curr,$pen);
                   //die;
                   //save this pendingdiff_min in the database
               $prevpendingtime = CloseTicket::where('ticket_id',$request->ticket_id)->first()->pendingtime_min;
                $newpendingtime = $prevpendingtime+$pendingdiff_min;
                 
              CloseTicket::where('ticket_id',$request->ticket_id)->update(['pendingtime_min'=>$newpendingtime]);

            //the pending time will be minus from the total sla timing
           


            $checkisblocked = Sms_setting::where('stage','Reopen Ticket')->first();
            $max_id = DB::select("select employee_id from ticket_updates where id IN (select max(id)from ticket_updates where ticket_id='".$request->ticket_id."')");
            $fename = User::where('id',$max_id[0]->employee_id)->first();
            $femobilenumberforsms3 = '+254721489544';//$fename->phone;
            //this will be replaced with mathew moblile number '+254721489544';//
         
            $linkname = TicketGenerated::where('ticket_id',$request->ticket_id)->first();
            $linkaffected = $linkname->link_affected;
                if($checkisblocked->decision == "Yes")
                { $sendmessage = $this->msgFunction($femobilenumberforsms3, $request->ticket_id,$fename->name,$linkaffected,'re-opened');  }
              else
              {         }
             }


      // here the sms will be sent



        return redirect()->back()->with('success','Status Update Successfully');
}


public function ticketListCancelled(){
      //$data = CloseTicket::where('status','4')->orderBy('id', 'DESC')->get();
      $data =  CloseTicket::join('ticket_generateds','close_tickets.ticket_id','=','ticket_generateds.ticket_id')
                               ->where('close_tickets.status','=','4')
                               ->where('ticket_generateds.status','=','4')
                               ->select('close_tickets.*','ticket_generateds.description')
                               ->orderBy('close_tickets.created_at','DSC')
                               ->get();
        $lstarray = array();
        foreach($data as $row)
        {
            $lnk = TicketUpdates::where('ticket_id',$row->ticket_id)->first();
            $lstarray[] = $lnk->link_affected; 
        }
      return view('pages.ticketListingCancelled', compact('data','lstarray'));
}
public function ticketListCancelledEdit($id){
        $dataedit = CloseTicket::where('id',$id)->first();
        $allStatus = TicketStatus::pluck('name', 'id')->all();
        return view('pages.ticketListingCancelled', compact('dataedit','allStatus'));
}
public function ticketListCancelledStore(Request $request){
     $this->validate($request, [
            'ticket_id'     => 'required',    
            'status'            => 'required',
            ]);         
        CloseTicket::where('ticket_id',$request->ticket_id)->update(['status'=>$request->status]);      
        TicketGenerated::where('ticket_id',$request->ticket_id)->update(['status'=>$request->status]);
        TicketUpdates::where('ticket_id',$request->ticket_id)->update(['status'=>$request->status]);
//here the sms will be sent
            if($request->status == '1'){
            $checkisblocked = Sms_setting::where('stage','Reopen Ticket')->first();
            $max_id = DB::select("select employee_id from ticket_updates where id IN (select max(id)from ticket_updates where ticket_id='".$request->ticket_id."')");
            $fename = User::where('id',$max_id[0]->employee_id)->first();
            $femobilenumberforsms3 ='+254721489544';//$fename->phone;// '+254721489544';//this will be replaced with mathew moblile number
         
            $linkname = TicketGenerated::where('ticket_id',$request->ticket_id)->first();
            $linkaffected = $linkname->link_affected;
                if($checkisblocked->decision == "Yes")
                { $sendmessage = $this->msgFunction($femobilenumberforsms3, $request->ticket_id,$fename->name,$linkaffected,'re-opened');  }
              else
              {         }
             }
      // here the sms will be sent
    return redirect()->back()->with('success','Status Update Successfully');
}





public function ticketPostReply(Request $request){
     $this->validate($request, [
            'ticket_id'     => 'required',    
            'client_id' => 'required',
            'message'            => 'required',
            ]);  

            $data  = \Input::all();
            $fileName = str_random(10).'image';
         if($request->hasFile('attachment'))
            {
                $destinationPath  = 'assets/images/uploads/';
                $file       = $request->attachment;
                  $image_file         = \Input::file('attachment');
                  $image_name         = $image_file->getClientOriginalName();
                  $image              = value(function() use ($image_file, $fileName)
                  {
                    $filename = $fileName. '.' . $image_file->getClientOriginalExtension();
                    return strtolower($filename);
                  });
                  \Input::file('attachment')  ->move($destinationPath, $image);
                  $logoname = $image;
            }
            else
            { $logoname ='';}

             $savedata = new TicketPostReply;
             $savedata->ticket_id = $request->ticket_id;
             $savedata->client_id = $request->client_id;
             $savedata->noc_operator = Auth::user()->id;
             $savedata->message = $request->message;
             $savedata->attachment = $logoname;
             $savedata->save();
            return redirect()->back()->with('success','Post Reply send Message Successfully');
            }
            
             public function arrangetheminutes($min)
            {
                $sladay =0;
                $slahr =0;
                $slamin = $min;// $endtime->diffInMinutes($strttime);

              if($slamin >= 1440)
                {
                    $adddays = (int)($slamin/1440);
                    $sladay = $sladay+$adddays;
                    $slamin = $slamin%1440;


                     if($slamin > 59 )
                     {
                        $addhrs = (int)($slamin/60);
                        $slahr = $slahr+$addhrs;
                        if($slahr>23)
                        {
                            $adddays2 = (int)($slahr/24);
                            $sladay = $sladay+$adddays2;
                            $slahr = $slahr%24;
                        }
                        $slamin = $slamin %60;
                     }
                }
                elseif($slamin<1440 && $slamin>59)
                {

                       $addhrs2 = (int)($slamin/60);   
                       $slahr = $slahr+$addhrs2;
                       $slamin = $slamin%60;
                       if($slahr>23)
                       {
                        $adddays2 = (int)($slahr/24);
                        $sladay = $sladay+$adddays2;
                        $slahr = $slahr%24;
                       }

                }
                elseif($slahr>=24)
                {
                    $adddays3 = (int)($slahr/24);
                    $sladay = $sladay+$adddays3;
                    $slahr = $slahr%24;
                }
                else
                {}

         $ttlslatiming = $sladay." days ".$slahr." hrs ".$slamin." mins";
         return $ttlslatiming;
            }
     public function getthedifference($endtime,$starttime)
     {
        $differencemin = $endtime->diffInMinutes($starttime);
        return $differencemin;
     }


     ///////////////////////////to do list
     public function todolist()
     {
            $todolst = Todolist::orderBy('id','DESC')->get();
            return view('pages.todolist',compact('todolst'));

     }
     public function savetodolist(Request $request)
     {
         $this->validate($request, [
            'task_dtl'     => 'required',    
            'scheduled_dt'     => 'required',    
            ]);
        $data =[
                'noc_id' =>Auth::user()->id,
                'task_dtl' => $request->task_dtl,
                'scheduled_date'=>$request->scheduled_dt,
                'status'=>'Pending',
        ];


       if($request->request_id == '')
       {
        $todo = Todolist::create($data);
         if($todo)
            {
                Session::flash('success', 'Scheduled Task successfully Insert...');
               
            }
            else
            {
                Session::flash('error', 'Failed!!!, Please try again');
            }
               

       }
       else
       {
        $todo = Todolist::where('id', $request->request_id)->update($data);
            if($todo)
            {
                Session::flash('success', 'Scheduled Task successfully updated...');

            }
            else
            {
                Session::flash('error', 'Failed!!!, Please try again');
            }
              
              
       }

      // return \Redirect()->back();
        
       $todolst = Todolist::orderBy('id','DESC')->get();
       return view('pages.todolist',compact('todolst'));
      //  return \Redirect()->back();

     }

     public function edittodo($id)
     {
        $datarow = Todolist::where('id',$id)->first();
        $todolst = Todolist::orderBy('id','DESC')->get();
           return view('pages.todolist',compact('datarow','todolst'));
     }
     public function deletetodo($id)
     {
        $todo = Todolist::where('id',$id)->delete();
         if($todo)
            {
                Session::flash('success', 'Scheduled Task successfully deleted...');
            }
            else
            {
                Session::flash('error', 'Failed!!!, Please try again');
            }
            // return Redirect()->back();
            $todolst = Todolist::orderBy('id','DESC')->get();
       return view('pages.todolist',compact('todolst'));
     }
     public function markascomplete($id)
     {
        $data = ['status'=>'Completed'];
        $todo = Todolist::where('id', $id)->update($data);
            if($todo)
            {
                Session::flash('success', 'Scheduled Task successfully updated...');
            }
            else
            {
                Session::flash('error', 'Failed!!!, Please try again');
            }
            return \Redirect()->back();
     }
     public function markaspending($id)
     {
        $data = ['status'=>'Pending'];
        $todo = Todolist::where('id', $id)->update($data);
            if($todo)
            {
                Session::flash('success', 'Scheduled Task successfully updated...');
            }
            else
            {
                Session::flash('error', 'Failed!!!, Please try again');
            }
            return \Redirect()->back();
     }

}
