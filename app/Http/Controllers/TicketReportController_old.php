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
use App\Nature_of_Fault;
use Carbon\Carbon;

class TicketReportController extends Controller
{
   function __construct()
    {   
        $this->middleware('permission:report-rfo');
        $this->middleware('permission:report-mttr');   
        $this->middleware('permission:report-fault'); 
        $this->middleware('permission:report-escort');
        $this->middleware('permission:report-access');   
        $this->middleware('permission:report-fault-analysis'); 
    }

    public function ticketReportList(){
        $data = TicketGenerated::orderBy('updated_at', 'DESC')->where('status','2')->get();
        return view('pages.ticketReportList', compact('data'));
    }

    public function ticketReportGenerated($ticket_id){

    $reportdata = TicketGenerated::orderBy('ticket_id', 'DESC')->first();
    $part1 = TicketGenerated::where('ticket_id', $ticket_id)->first();    
    $part2 = TicketUpdates::where('ticket_id', $ticket_id)->orderBy('id', 'ASC')->get();
    $part35 = CloseTicket::where('ticket_id', $ticket_id)->first(); 
    $partreply = TicketPostReply::where('ticket_id', $ticket_id)->orderBy('id', 'ASC')->get();
    $pendingminutes = $part35->pendingtime_min;
    $totalpendingdaytime =  $this->arrangetheminutes($pendingminutes);
    /*Access Request Time calculate here */
    $accessRequestdata =  TicketUpdates::where('ticket_id',$ticket_id)->orderBy('ticket_id','ASC')->get();
    /*echo "<pre>";
    print_r($accessRequestdata);die;*/
    ////////////////
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
         $escreq = Carbon::parse($vs->escort_request_time);
         $escgra = Carbon::parse($vs->escort_granted_time);
         $mindif = $this->getthedifference($escgra,$escreq); 
         $escdif = $escdif+$mindif;  
      }
      else
      {
        
      }
    }
    // echo "this is escort report".$escdif;die;
        $ttlesc = $this->arrangetheminutes($escdif);  
        
        $pendingtickettime = CloseTicket::where('ticket_id',$ticket_id)->first()->pendingtime_min;
        $mintoberemove = $accdif+$escdif+$pendingtickettime; 
          //here pending time also to be removed so get it from close ticket 
        



        if(!empty($part35)){
        $cret = Carbon::parse($part1->reporting_time);//created_at);
        $rest = Carbon::parse($part35->resolution_time);   
        $mindf = $this->getthedifference($rest,$cret);
        $sltt = $mindf - $mintoberemove;
        $accurateslt = $this->arrangetheminutes($sltt);
     }   
     else
      {$accurateslt =0;}
    /////////////////
    
    $hourdiff ='0';
    $accessRequestTime = '0';   
    if(!empty($accessRequestdata)){
    foreach($accessRequestdata as $key=>$values){      
        if(!empty($values['acc_granted_time'])){
            $hourdiff = round((strtotime($values['acc_granted_time']) - strtotime($values['acc_request_time']))/3600, 2);                         
        $dataPointsAll[] = array("hour" => $hourdiff);       
              $hourdiff='0'; 
      }       
      }

      if(!empty($dataPointsAll)){ 
          $result = array();
          foreach($dataPointsAll as $k => $v){
               $result[] =$v['hour'];
          }   
          $dataPoints = array();
          foreach($result as $value){
            $dataPoints[] = $value;
          }
             $accessRequestTimess = array_sum($dataPoints);    
           /* if ($accessRequestTimess < 1) {
              return;
            }*/
              $hours = floor($accessRequestTimess / 60);
              $minutes = ($accessRequestTimess % 60);
              $accessRequestTime= sprintf('%02d hours %02d minutes', $hours, $minutes);
        }

    }
 /*Access Request Time calculate end here */

 /*Escort Request Time calculate here */
    $escortRequestdata =  TicketUpdates::where('ticket_id',$ticket_id)->orderBy('ticket_id','ASC')->get();
    $hourdiff ='0';
    $escortRequestTime = '0';
    if(!empty($escortRequestdata)){
    foreach($escortRequestdata as $key=>$values){       
          if(!empty($values['escort_granted_time'])){
            $hourdiff = round((strtotime($values['escort_granted_time']) - strtotime($values['escort_request_time']))/3600, 2);                         
        $dataPointsAll2[] = array("hour" => $hourdiff);       
              $hourdiff='0'; 
      }       
      } 

      if(!empty($dataPointsAll2)){
    $result = array();
    foreach($dataPointsAll2 as $k => $v){
         $result[] =$v['hour'];
    }   
    $dataPoints2 = array();
    foreach($result as $value){
      $dataPoints2[] = $value;
    }
       $escortRequestTimess = array_sum($dataPoints2); 
         /* if ($escortRequestTimess < 1) {
        return;
      }*/
        $hours = floor($escortRequestTimess / 60);
        $minutes = ($escortRequestTimess % 60);
        $escortRequestTime= sprintf('%02d hours %02d minutes', $hours, $minutes);
      }
    }
 /*Escort Request Time calculate end here */

  return view('pages.ticketReportGenerated', compact('reportdata','part1','part2','part35','accessRequestTime','escortRequestTime','partreply','totalpendingdaytime','ttlacc','ttlesc','accurateslt'));
   }

 
public function ticketReportFEchart(Request $request){


   /* $from = date('2018-11-23 10:56:26');
    $to = date('2018-11-27 15:46:38');*/
  $dataPoints = array();
  $dataPointsTotalCount = array();
  $dataPointsAll =array();
    $from = $request->fromdate;
    $to = $request->todate; 
    if($from!='' || $to!=''){

    $chartdata =  TicketUpdates::whereBetween('created_at', [$from, $to])->orderBy('id','DESC')->get();

    $hourdiff ='0';
    if(!empty($chartdata)){
    foreach($chartdata as $key=>$values){
    $aj = User::where('id',$values['employee_id'])->first();    

    $checkcloseticket = CloseTicket::where('ticket_id',$values['ticket_id'])->where('status','2')->first(); 

      if((!empty($values['closing_time'])) && $checkcloseticket['status']=="2" ){

            $hourdiff = round((strtotime($values['opening_time']) - strtotime($values['closing_time']))/3600, 1);  

            $createtime1 =Carbon::parse($values['opening_time']);
            $closingtime1 = Carbon::parse($values['closing_time']);
            $abcdate = $this->getthedifference($closingtime1, $createtime1);
            $concatacc = $this->arrangetheminutes($abcdate);
            $fullname = $aj['name'].' '.$aj['lastName'];
        $dataPointsAll[] = array("y" => $abcdate, "label" => $fullname);       
              $hourdiff='0'; 
      }    
      else{
         $fullname = $aj['name'].' '.$aj['lastName'];
        $dataPointsAll[] = array("y" => 0, "label" => $fullname );       
              $hourdiff='0'; 
      }
      } 


if(!empty($dataPointsAll)){
    $result = array();
    foreach($dataPointsAll as $k => $v){
        $id = $v['label'];
        $result[$id][] =$v['y'];
    }
    $dataPoints = array();
      $jq = array();
      $ct=0;
    foreach($result as $key => $value){     
       for($ii=0;$ii<count($value);$ii++)
        { if($value[$ii]>0)
          { $ct++;            
          }
          else{}
        }
      $jq[] = $ct;    
       $singleperson =count($value); 
       $arraysum = array_sum($value); 
       if( $ct==0){
          $finalsum= 0;
       }else{
         $finalsum= $arraysum /$ct;
       }   
       $concatacc = $finalsum/60;
       $dataPointsTotalCount[] = array('y' => $ct, 'label' => $key);
       $dataPoints[] = array('y' => $concatacc, 'label' => $key);
       $ct=0; 
    }   
}
  }else{      
     return \Redirect()->back()->with('error', 'Data not found from this Date Between...');
  }
    }
      $data = TicketGenerated::orderBy('ticket_id', 'DESC')->get();
        return view('pages.ticketReportChart', compact('data','dataPoints','dataPointsTotalCount'));
      }        
  

// ashwin fault report

       //fault report functions
    public function faultReportGenerated()
   {
      $data = TicketGenerated::orderBy('ticket_id', 'DESC')->get();
        $clientlist = Client::all();
       $regionlist = Region::all();
       //$attrlst = TicketUpdates::first();
      // $attributesnames = array_keys($attrlst->getAttributes());
        //return view('pages.faultReportGenerated', compact('data'));//,'attributesnames
       return view('pages.generateFaultReport',compact('clientlist','regionlist'));

   }

   public function fault_ticket_page($id)
   {
          $ticketid = $id;
         // $attrlst = TicketUpdates::select('id','priority','link_affected','acc_request_time','acc_granted_time','site_address',
         //  'escort_request_time','escort_granted_time','comments','created_at','updated_at')->get();
        // dd($attrlst);
       $attrlst = TicketUpdates::first();
       $attributesnames = array_keys($attrlst->getAttributes());
       return view('pages.generateFaultReport',compact('ticketid','attributesnames'));

   }
    public function showfaultreportlist(Request $request)
   {
        $clientid = $request->clientid;
        $regionname = $request->regionname;
      $tick = TicketGenerated::where('client_id',$clientid)->first();
      $ticketid = $tick['ticket_id'];

      //////////////////////////
$accessRequestdata =  TicketUpdates::where('ticket_id',$ticketid)->orderBy('ticket_id','ASC')->get();
// echo '<pre>';
// print_r($accessRequestdata);die;
      $escdif = 0;$accdif =0;
    foreach($accessRequestdata as $vs)
    {  if($vs->escort_granted_time !=0)
      {
         $escreq = Carbon::parse($vs->escort_request_time);
         $escgra = Carbon::parse($vs->escort_granted_time);
         $mindif = $this->getthedifference($escgra,$escreq); 
         $escdif = $escdif+$mindif;  
      }
      if($vs->acc_granted_time !=0)
      {
         $accreq = Carbon::parse($vs->acc_request_time);
         $accgra = Carbon::parse($vs->acc_granted_time);
         $mindif = $this->getthedifference($accgra,$accreq); 
         $accdif = $accdif+$mindif;  
      }
      else
      {
        
      }
    }
    
  //  $pendingtickettime = CloseTicket::where('ticket_id',$ticketid)->first()->pendingtime_min;
    //echo "<br>";
//    $ttlesc = $this->arrangetheminutes($escdif);  
    //echo "<br>";
    //echo $ttlacc = $this->arrangetheminutes($accdif); 
    //die; 

    //echo $ttlesc;die;
      //////////////////////////
      $atriblst = $request->third;

      $atriblst2 = explode(',',$atriblst);

       $alist  = array();
       for($i =1;$i<sizeof($atriblst2)-1;$i++)
       {         $alist[] = $atriblst2[$i];       }
     
      
      $from = date('Y-m-d',strtotime($request->startdate));
      $to = date('Y-m-d',strtotime($request->enddate));
      $empdata = User::where('userType','3')->selectRaw('id, CONCAT(name," ",lastName) as name')->pluck('name', 'id');
      //$empdata = User::where('userType','3')->pluck('name', 'id')->all();
      $clientdata = Client::pluck('name', 'id')->all();
        //print_r($clientdata[1]);
        //die;
      /*$fulldata = DB::table('ticket_updates')
                ->select($alist)
                ->where('ticket_id',$ticketid)
                ->whereBetween('opening_time',[$from,$to])
                ->get();*/
                //print_r($clientdata[1]);die;

     

////this is the new code 
     if($clientid != 'allclients' && $clientid !='0' && $regionname != 'allregions')
      {
        //one region one client
      $ticketidnew = TicketGenerated::where('client_id',$clientid)
                                        ->where('region',$regionname)
                                      ->first();

      
      $fulldata = TicketUpdates::join('ticket_generateds','ticket_updates.ticket_id','=','ticket_generateds.ticket_id')
          ->join('close_tickets','ticket_updates.ticket_id','=','close_tickets.ticket_id')
          ->join('clients','ticket_updates.client_id','=','clients.id')
          ->join('users as m','close_tickets.closing_noc_engineer','=','m.id')
          ->join('users','ticket_updates.noc_operator','=','users.id')
          ->where('ticket_updates.ticket_id','ticket_generateds.ticket_id')//$ticketidnew['ticket_id'])
          ->where('close_tickets.ticket_id','ticket_generateds.ticket_id')//$ticketidnew['ticket_id'])
          ->where('ticket_updates.client_id',$clientid)
          ->whereBetween('ticket_updates.opening_time',[$from,$to])
          ->select('ticket_updates.*','ticket_generateds.region','ticket_generateds.link_affected','ticket_generateds.clientticketno','close_tickets.resolution_time','close_tickets.closing_noc_engineer','close_tickets.cause_of_fault','close_tickets.resolution_remark',
            'clients.name as clientname',
            'users.name as openingnoc','users.lastName as openingnocsurname',
            'm.name as closingnoc','m.lastName as closingnocsurname','close_tickets.pendingtime_min')
          ->get();
             

      }
      elseif($clientid == 'allclients' && $regionname == 'allregions')
      {
         echo "all client all region";die;

        // echo "all client alll region";
        // $fulldata = DB::table('ticket_updates')
        //         ->select($alist)
        //        // ->where('ticket_id',$ticketidnew['ticket_id'])
        //        // ->where('client_id',$clientid)
        //         ->whereBetween('opening_time',[$from,$to])
        //         ->get();

     $fulldata = TicketUpdates::join('ticket_generateds','ticket_updates.ticket_id','=','ticket_generateds.ticket_id')
          ->join('close_tickets','ticket_updates.ticket_id','=','close_tickets.ticket_id')
          ->join('clients','ticket_updates.client_id','=','clients.id')
          ->join('users as m','close_tickets.closing_noc_engineer','=','m.id')
          ->join('users','ticket_updates.noc_operator','=','users.id')
          //->where('ticket_updates.ticket_id',$ticketidnew['ticket_id'])
          //->where('close_tickets.ticket_id',$ticketidnew['ticket_id'])
          //->where('ticket_updates.client_id',$clientid)
          ->whereBetween('ticket_updates.opening_time',[$from,$to])
          ->select('ticket_updates.*','ticket_generateds.region','ticket_generateds.link_affected','ticket_generateds.clientticketno','close_tickets.resolution_time','close_tickets.closing_noc_engineer','close_tickets.cause_of_fault','close_tickets.resolution_remark','clients.name as clientname',
            'users.name as openingnoc','users.lastName as openingnocsurname',
            'm.name as closingnoc','m.lastName as closingnocsurname','close_tickets.pendingtime_min') 
            
          ->get();

           //those ticket which are not closed will not be seen 





      }
       elseif($clientid != 'allclients' && $clientid !='0' && $regionname == 'allregions')
      {
        echo "client 1 and all regions"; die;

         // echo "one client all regions";
      // $fulldata = DB::table('ticket_updates')
      //           ->select($alist)
      //           //->where('ticket_id',$ticketidnew['ticket_id'])
      //           ->where('client_id',$clientid)
      //           ->whereBetween('opening_time',[$from,$to])
      //           ->get();
                
       
        $fulldata = TicketUpdates::join('ticket_generateds','ticket_updates.ticket_id','=','ticket_generateds.ticket_id')
          ->join('close_tickets','ticket_updates.ticket_id','=','close_tickets.ticket_id')
          ->join('clients','ticket_updates.client_id','=','clients.id')
          ->join('users as m','close_tickets.closing_noc_engineer','=','m.id')
          ->join('users','ticket_updates.noc_operator','=','users.id')
          //->where('ticket_updates.ticket_id',$ticketidnew['ticket_id'])
          //->where('close_tickets.ticket_id',$ticketidnew['ticket_id'])
          ->where('ticket_updates.client_id',$clientid)
          ->whereBetween('ticket_updates.opening_time',[$from,$to])
          ->select('ticket_updates.*','ticket_generateds.region','ticket_generateds.link_affected','ticket_generateds.clientticketno','close_tickets.resolution_time','close_tickets.closing_noc_engineer','close_tickets.cause_of_fault','close_tickets.resolution_remark','clients.name as clientname',
            'users.name as openingnoc','users.lastName as openingnocsurname',
            'm.name as closingnoc','m.lastName as closingnocsurname','close_tickets.pendingtime_min')
          ->get();
        //echo "<pre>";
        //print_r($fulldata);die;   
      }
      else {
            echo "all client one region";die;
           // $fulldata = DB::table('ticket_updates')
           //      ->select($alist)
           //     // ->where('ticket_id',$ticketidnew['ticket_id'])
           //     // ->where('client_id',$clientid)
           //      ->whereBetween('opening_time',[$from,$to])
           //      ->get();

          $fulldata = TicketUpdates::join('ticket_generateds','ticket_updates.ticket_id','=','ticket_generateds.ticket_id')
          ->join('close_tickets','ticket_updates.ticket_id','=','close_tickets.ticket_id')
          ->join('clients','ticket_updates.client_id','=','clients.id')
          ->join('users as m','close_tickets.closing_noc_engineer','=','m.id')
          ->join('users','ticket_updates.noc_operator','=','users.id')
          //->where('ticket_updates.ticket_id',$ticketidnew['ticket_id'])
          //->where('close_tickets.ticket_id',$ticketidnew['ticket_id'])
          //->where('ticket_updates.client_id',$clientid)
          //->whereBetween('ticket_updates.opening_time',[$from,$to])
          ->select('ticket_updates.*','ticket_generateds.region','ticket_generateds.link_affected','ticket_generateds.clientticketno','close_tickets.resolution_time','close_tickets.closing_noc_engineer','close_tickets.cause_of_fault','close_tickets.resolution_remark','clients.name as clientname',
            'users.name as openingnoc','users.lastName as openingnocsurname',
            'm.name as closingnoc','m.lastName as closingnocsurname','close_tickets.pendingtime_min')
          ->get();
         }   
        //echo "<pre>";
       //print_r($fulldata);die;
       return view('pages.displayFaultReportList',compact('ticketid','alist','empdata','clientdata','fulldata','ttlesc'));

   }
   public function getregiononchoice(Request $request)
   {
    $clientid = $request->clientid;
    if($clientid !='0')
    {
    $regionlst = TicketGenerated::where('client_id',$clientid)->select('region')->groupBy('region')->get();
    // return $regionlst;
   
     
        ?>
          <select name="regionname" id="regionname" class="form-control">
            <option value="allregions">All Region</option>
            <?php foreach($regionlst as $row)
            {
            ?>
            <option value="<?php echo $row->region; ?>" ><?php echo $row->region ?></option>
            @endforeach
          <?php } ?>
          </select>
        <?php
      }
      else
      {
        ?>Select Client<?php
      }

   }

   public function ticketReportEscort(){
    $updating = TicketGenerated::get();
    return view('pages.ticketReportEscort',compact('updating'));
   }
   public function ticketReportEscortView(){         
        $regions =Region::pluck('region_name','region_name')->all();
        $allclients = Client::pluck('name','id')->all();
        return view('pages.ticketReportEscortView',compact('regions','allclients'));
   }

   public function ticketReportEscortEdit(Request $request){
      $clientid = $request->client_id;
      $region = $request->region_id;
      $from = $request->fromdate;
      $to = $request->todate; 
       //die;
      if($from!='' || $to!='' ){
        if($region == 'all'){
          if($clientid == '0'){
            //echo "BNO";die;

            $chartdata = TicketUpdates::join('ticket_generateds', 'ticket_updates.ticket_id', '=', 'ticket_generateds.ticket_id')
                ->select('ticket_updates.*', 'ticket_generateds.region as region','ticket_generateds.link_affected as link_affected','ticket_generateds.clientticketno as clientticketno')
                ->whereBetween('ticket_updates.escort_request_time', [$from, $to])->get(); 





              /*$chartdata = TicketUpdates::join('ticket_generateds', 'ticket_updates.client_id', '=', 'ticket_generateds.client_id')
                ->select('ticket_updates.*', 'ticket_generateds.region as region','ticket_generateds.link_affected as link_affected','ticket_generateds.clientticketno as clientticketno')
                ->whereBetween('ticket_updates.escort_request_time', [$from, $to])->get(); */
           }else{
                /*$chartdata = TicketUpdates::join('ticket_generateds', 'ticket_updates.client_id', '=', 'ticket_generateds.client_id')
                ->select('ticket_updates.*', 'ticket_generateds.region as region','ticket_generateds.link_affected as link_affected','ticket_generateds.clientticketno as clientticketno')
                ->whereBetween('ticket_updates.escort_request_time', [$from, $to])->where('ticket_updates.client_id',$clientid)->get();*/ 
                $chartdata = TicketUpdates::join('ticket_generateds', 'ticket_updates.ticket_id', '=', 'ticket_generateds.ticket_id')
                ->select('ticket_updates.escort_request_time','ticket_updates.escort_granted_time','ticket_generateds.region','ticket_generateds.link_affected','ticket_updates.ticket_id','ticket_generateds.clientticketno')
                   ->whereBetween('ticket_updates.escort_request_time', [$from, $to])->where('ticket_updates.client_id',$clientid)->get();
            

          }
             
        }else{
           if($clientid == '0'){
        $chartdata = TicketUpdates::join('ticket_generateds', 'ticket_updates.ticket_id', '=', 'ticket_generateds.ticket_id')
                ->where('ticket_generateds.region',$region)
                 ->select('ticket_updates.*', 'ticket_generateds.region as region','ticket_generateds.link_affected as link_affected','ticket_generateds.clientticketno as clientticketno')
                ->whereBetween('ticket_updates.escort_request_time', [$from, $to])->get();
              }else{
      /*$chartdata = TicketUpdates::join('ticket_generateds', 'ticket_updates.client_id', '=', 'ticket_generateds.client_id')
                ->where('ticket_generateds.region',$region)
                 ->select('ticket_updates.*', 'ticket_generateds.region as region','ticket_generateds.link_affected as link_affected','ticket_generateds.clientticketno as clientticketno')
                ->whereBetween('ticket_updates.escort_request_time', [$from, $to])->where('ticket_updates.client_id',$clientid)->get();*/
                $chartdata = TicketUpdates::join('ticket_generateds', 'ticket_updates.ticket_id', '=', 'ticket_generateds.ticket_id')
                ->select('ticket_updates.escort_request_time','ticket_updates.escort_granted_time','ticket_generateds.region','ticket_generateds.link_affected','ticket_updates.ticket_id','ticket_generateds.clientticketno')
                ->where('ticket_generateds.region',$region)
                ->whereBetween('ticket_updates.escort_request_time', [$from, $to])->where('ticket_updates.client_id',$clientid)->get();
              }
        }       
      }else{
        return \Redirect()->back()->with('error', 'From date and To date not found');
      }
      /*echo "<pre>";
      print_r($chartdata);
      die;*/
      $allclients = Client::pluck('name','id')->all();
      $regions =Region::pluck('region_name','region_name')->all();
        return view('pages.ticketReportEscortView', compact('chartdata','regions','allclients'));
  }



   public function ticketReportRequestAccess(){
    $updating = TicketGenerated::get();
    return view('pages.ticketReportRequestAccess',compact('updating'));
   }
   public function ticketReportRequestAccessView(){
      $allclients = Client::pluck('name','id')->all();
      $regions =Region::pluck('region_name','region_name')->all();
      return view('pages.ticketReportRequestView',compact('regions','allclients'));
   }
   public function ticketReportRequestAccessEdit(Request $request){
       $clientid = $request->client_id;
       $region = $request->region_id;
       $from = $request->fromdate;
       $to = $request->todate; 
        
      if($from!='' || $to!='' ){
        if($region == 'all'){
            if($clientid == '0'){
              //echo "HNO1";
                 
              $chartdata = TicketUpdates::join('ticket_generateds', 'ticket_updates.ticket_id', '=', 'ticket_generateds.ticket_id')
                ->select('ticket_updates.*', 'ticket_generateds.region as region','ticket_generateds.link_affected as link_affected','ticket_generateds.clientticketno as clientticketno')
                ->whereBetween('ticket_updates.acc_request_time', [$from, $to])->get();       
                /*echo "<pre>";
                print_r($chartdata);
                die;
          /*$chartdata = TicketUpdates::join('ticket_generateds', 'ticket_updates.client_id', '=', 'ticket_generateds.client_id')
                ->select('ticket_updates.*', 'ticket_generateds.region as region','ticket_generateds.link_affected as link_affected','ticket_generateds.clientticketno as clientticketno')
                ->whereBetween('ticket_updates.acc_request_time', [$from, $to])->get();       */
                //echo "<pre>";
               // print_r($chartdata);
               // die;



       }
       else{
       // echo "HNO";die;
        /*$chartdata = TicketUpdates::join('ticket_generateds', 'ticket_updates.client_id', '=', 'ticket_generateds.client_id')
                ->select('ticket_updates.*', 'ticket_generateds.region as region','ticket_generateds.link_affected as link_affected','ticket_generateds.clientticketno as clientticketno')
                ->whereBetween('ticket_updates.acc_request_time', [$from, $to])->where('ticket_updates.client_id',$clientid)->get();  it was on 20 feb*/
               
                /*$chartdata = TicketUpdates::join('ticket_generateds', 'ticket_updates.client_id', '=', 'ticket_generateds.client_id')
                ->select('ticket_updates.escort_request_time','ticket_updates.escort_granted_time','ticket_generateds.region','ticket_generateds.link_affected','ticket_updates.ticket_id','ticket_generateds.clientticketno')
                   ->whereBetween('ticket_updates.escort_request_time', [$from, $to])->where('ticket_updates.client_id',$clientid)->get();*/

                $chartdata = TicketUpdates::join('ticket_generateds', 'ticket_updates.ticket_id', '=', 'ticket_generateds.ticket_id')
                ->select('ticket_updates.escort_request_time','ticket_updates.escort_granted_time','ticket_generateds.region','ticket_generateds.link_affected','ticket_updates.ticket_id','ticket_generateds.clientticketno')
                   ->whereBetween('ticket_updates.escort_request_time', [$from, $to])->where('ticket_updates.client_id',$clientid)->get();

                   /*echo "<pre>";
                   print_r($chartdata);die;*/

       }

        }else{
         // echo "HNO";die;
            if($clientid == '0'){
        $chartdata = TicketUpdates::join('ticket_generateds', 'ticket_updates.ticket_id', '=', 'ticket_generateds.ticket_id')
                ->where('ticket_generateds.region',$region)
                 ->select('ticket_updates.*', 'ticket_generateds.region as region','ticket_generateds.link_affected as link_affected','ticket_generateds.clientticketno as clientticketno')
                ->whereBetween('ticket_updates.acc_request_time', [$from, $to])->get();
              }
          else{
         /* $chartdata = TicketUpdates::join('ticket_generateds', 'ticket_updates.client_id', '=', 'ticket_generateds.client_id')
                ->where('ticket_generateds.region',$region)
                 ->select('ticket_updates.*', 'ticket_generateds.region as region','ticket_generateds.link_affected as link_affected','ticket_generateds.clientticketno as clientticketno')
                ->whereBetween('ticket_updates.acc_request_time', [$from, $to])->where('ticket_updates.client_id',$clientid)->get(); it was on 20feb*/

    $chartdata = TicketUpdates::join('ticket_generateds', 'ticket_updates.ticket_id', '=', 'ticket_generateds.ticket_id')
                ->select('ticket_updates.escort_request_time','ticket_updates.escort_granted_time','ticket_generateds.region','ticket_generateds.link_affected','ticket_updates.ticket_id','ticket_generateds.clientticketno')
                 ->where('ticket_generateds.region',$region)
                   ->whereBetween('ticket_updates.escort_request_time', [$from, $to])->where('ticket_updates.client_id',$clientid)->get();

              }
        }       
      }else{
        return \Redirect()->back()->with('error', 'From date and To date not found');
      }
       $allclients = Client::pluck('name','id')->all();
       $regions =Region::pluck('region_name','region_name')->all();
       
        return view('pages.ticketReportRequestView', compact('chartdata','regions','allclients'));
   }

  public function ticketReportFaultAnalysis(){
        $allclients = Client::pluck('name','id')->all();
        $regions =Region::pluck('region_name','region_name')->all();
    return view('pages.ticketSlaAnalysisSelect', compact('regions','allclients'));
  }


  public function ticketReportFaultAnalysisView(Request $request){ 
      $clientid = $request->client_id;
      $region = $request->region_id;
      $from = $request->fromdate;
      $to = $request->todate;


     $natureofFault = Nature_of_Fault::get();
     $faultAnalysisdata   = array();

     if($clientid == 0 || $region == 'all'){
        if($region == 'all' && $clientid != 0){
          foreach($natureofFault as $key=>$values){
            $closeticket = CloseTicket::join('ticket_generateds','ticket_generateds.ticket_id','close_tickets.ticket_id')->where('close_tickets.cause_of_fault',$values['name'])->where('close_tickets.client_id',$clientid)->where('ticket_generateds.created_at','>',$from)->where('close_tickets.resolution_time','<',$to)->count('close_tickets.cause_of_fault');
      $faultAnalysisdata[] = array("label" => $values['name'], "y" => $closeticket);
             }
        } 
        elseif($clientid == 0 && $region != 'all'){
          foreach($natureofFault as $key=>$values){
          $closeticket = CloseTicket::join('ticket_generateds','ticket_generateds.ticket_id','close_tickets.ticket_id')->where('close_tickets.cause_of_fault',$values['name'])->where('ticket_generateds.region',$region)->where('ticket_generateds.created_at','>',$from)->where('close_tickets.resolution_time','<',$to)->count('close_tickets.cause_of_fault');
      $faultAnalysisdata[] = array("label" => $values['name'], "y" => $closeticket);
            }
        }
        else{
              foreach($natureofFault as $key=>$values){
          $closeticket = CloseTicket::join('ticket_generateds','ticket_generateds.ticket_id','close_tickets.ticket_id')->where('close_tickets.cause_of_fault',$values['name'])->where('ticket_generateds.created_at','>',$from)->where('close_tickets.resolution_time','<',$to)->count('close_tickets.cause_of_fault');
      $faultAnalysisdata[] = array("label" => $values['name'], "y" => $closeticket );
              }
        }

     }else{
       foreach($natureofFault as $key=>$values){
      $closeticket = CloseTicket::join('ticket_generateds','ticket_generateds.ticket_id','close_tickets.ticket_id')->where('close_tickets.cause_of_fault',$values['name'])->where('close_tickets.client_id',$clientid)->where('ticket_generateds.region',$region)->where('ticket_generateds.created_at','>',$from)->where('close_tickets.resolution_time','<',$to)->count('close_tickets.cause_of_fault');
      $faultAnalysisdata[] = array("label" => $values['name'], "y" => $closeticket);  
     }
    }
    
/*
     $natureofFault = Nature_of_Fault::get();
     $faultAnalysisdata   = array();
     foreach($natureofFault as $key=>$values){
      $closeticket = CloseTicket::where('cause_of_fault',$values['name'])->count('cause_of_fault');
      $faultAnalysisdata[] = array("label" => $values['name'], "y" => $closeticket );  
     } 
*/

     $slaAnalysisdata = array();
     $lastSLAandWithSLA = array();
    // $closeticketData = CloseTicket::where('resolution_time','<>','')->get();
 
   if($clientid == 0 || $region == 'all'){
       if($region == 'all' && $clientid != 0){
             $closeticketData = CloseTicket::join('ticket_generateds','close_tickets.ticket_id','ticket_generateds.ticket_id')->where('close_tickets.client_id',$clientid)->where('ticket_generateds.created_at','>',$from)->where('close_tickets.resolution_time','<',$to)->where('resolution_time','<>','')->get();
       }
       elseif($clientid == 0 && $region != 'all'){
             $closeticketData = CloseTicket::join('ticket_generateds','close_tickets.ticket_id','ticket_generateds.ticket_id')->where('ticket_generateds.region',$region)->where('ticket_generateds.created_at','>',$from)->where('close_tickets.resolution_time','<',$to)->where('resolution_time','<>','')->get();
       }else{
          $closeticketData = CloseTicket::join('ticket_generateds','close_tickets.ticket_id','ticket_generateds.ticket_id')->where('ticket_generateds.created_at','>',$from)->where('close_tickets.resolution_time','<',$to)->where('resolution_time','<>','')->get();
       }
      }
      else{
         $closeticketData = CloseTicket::join('ticket_generateds','close_tickets.ticket_id','ticket_generateds.ticket_id')->where('close_tickets.client_id',$clientid)->where('ticket_generateds.region',$region)->where('ticket_generateds.created_at','>',$from)->where('close_tickets.resolution_time','<',$to)->where('resolution_time','<>','')->get();
      }

      foreach ($closeticketData as $key => $value){
        $TicketGeneratedData = TicketGenerated::where('ticket_id',$value['ticket_id'])->first();

        if($TicketGeneratedData){ 
                $ts1 = strtotime($TicketGeneratedData['created_at']);
                $ts2 = strtotime($value['resolution_time']);     
                $seconds_diff = $ts2 - $ts1;                            
                $time = ($seconds_diff/3600);
        $slaAnalysisdata[] = array('label'=>$value['cause_of_fault'], 'y'=> $time); 
      }
     }
    
    $result = array();   
   foreach($slaAnalysisdata as $k => $v){
        if($v['y'] < 5){
            $id = '0-4 hrs';
            $result[$id][] =$v['y'];
        }       
        elseif ($v['y'] < 9){
            $id = '4-8 hrs';
            $result[$id][] =$v['y'];                
        }      
        elseif($v['y'] < 13){
            $id ='8-12 hrs';
            $result[$id][] =$v['y'];
        }
        else{
            $id = 'Above 12 hrs';
            $result[$id][] =$v['y'];
        }
    }
   $totalcombine = array(); 
    foreach($result as $key => $value){
        $arraycount = count($value); 
         if($key == '0-4 hrs'){
            $totalcombine[] = array('y' => $arraycount, 'label' => '0-4 hrs');
         }
         if($key == '4-8 hrs'){
            $totalcombine[] = array('y' => $arraycount, 'label' => '4-8 hrs');
         }
         if($key == '8-12 hrs'){
              $totalcombine[] = array('y' => $arraycount, 'label' => '8-12 hrs');
         }
           if($key == 'Above 12 hrs'){
                 $totalcombine[] = array('y' => $arraycount, 'label' => 'Above 12 hrs');
         }
    }
     if(empty($totalcombine)){
       $totalcombine[] = array('y' => '0', 'label' => '0-4 hrs');
       $totalcombine[] = array('y' => '0', 'label' => '4-8 hrs');
       $totalcombine[] = array('y' => '0', 'label' => '8-12 hrs');
       $totalcombine[] = array('y' => '0', 'label' => 'Above 12 hrs');
    }

    // Last SLA and Without SLA chart code here 
    $lastSLAandWithSLA= $slaAnalysisdata;  
    $slaWithoutSLA= array();
   foreach($lastSLAandWithSLA as $k => $v){    
          if($v['y'] < 5){
              $id = 'Within SLA';
              $slaWithoutSLA[$id][] =$v['y'];
          }       
          else{
              $id = 'Past SLA';
              $slaWithoutSLA[$id][] =$v['y'];                
          } 
    }
   
    $finalSLAwithoutSLA = array();
    foreach($slaWithoutSLA as $key => $value){
        $arraycountSLA = count($value); 
         if($key == 'Within SLA'){
            if($arraycountSLA == 0){
                $finalSLAwithoutSLA[] = array('y' => '0', 'label' => 'Within SLA');
            }
            else{
                $finalSLAwithoutSLA[] = array('y' => $arraycountSLA, 'label' => 'Within SLA');
            }
         }
          elseif($key == 'Past SLA'){
          if($arraycountSLA == 0){
               $finalSLAwithoutSLA[] = array('y' => '0', 'label' => 'Past SLA');
          }else{
              $finalSLAwithoutSLA[] = array('y' => $arraycountSLA, 'label' => 'Past SLA');
          }
        }         
      }
      
   $regions =Region::pluck('region_name','region_name')->all();
    return view('pages.ticketSlaAnalysis', compact('regions','faultAnalysisdata','totalcombine','finalSLAwithoutSLA'));
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



}
