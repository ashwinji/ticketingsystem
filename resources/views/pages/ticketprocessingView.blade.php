@extends('layouts.masters')
@section('content')


<div class="content-body">
    <!-- Content Section Strat-->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                        <h2><strong>
                        Open Tickets  
                            
                        </strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                 <ul class="dropdown-menu slideUp">
                                    <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>
                                  @can('open-ticket-edit')
                                    <li><a data-toggle="modal" data-target="#insertaccessmodal" id="insertaccessmodalid" data-id="{!!$generating[0]->ticket_id!!}" href="javascript:;" title='{!!$generating[0]->ticket_id!!}'><i class="material-icons"></i> For site access</a></li>             
                                    <li><a data-toggle="modal" data-target="#insertescortrequestmodal" id="insertescortrequestmodalid" data-id="{!!$generating[0]->ticket_id!!}" href="javascript:;" title='{!!$generating[0]->ticket_id!!}'><i class="material-icons"></i> For Escort Request</a></li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </div>
        
               
<!--  tabbig  section start here -->

<div class="container ticketSectionTab">

   <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab"  href="#openticket" class="active show">Open Ticket</a></li>
    <li ><a data-toggle="tab"  href="#reassign">Re-assign FE</a></li>
    <li ><a data-toggle="tab"  href="#requestaccess">Request Access</a></li>
    <li ><a data-toggle="tab"  href="#requestsecurityescort">Request Security Escort</a></li>
    <li ><a data-toggle="tab"  href="#closeticket">Close Tikcet</a></li>
  </ul>
  
  <div class="tab-content">
      
    <div id="openticket" class="tab-pane fade in active show">
          @if(Request::segment(2)==='view')
        <div class="open_Ticket_section" style="padding-top: 25px;">
                 @foreach ($generating as $showdata)
            <div class="row">
                <div class="col-md-12">
                    <p class="m-b-0"> <strong>Ticket </strong>{{ $showdata->ticket_id }} </p>
                </div>
                <div class="col-md-6">
                  <p class="m-b-0"> <strong>Status : </strong>  {{ $showdata->Statusinfo->name }} </p>
                </div>
                <div class="col-md-6">
                 <p class="m-b-0"> <strong> Client Name : </strong>  {{ $showdata->ClientData->name }}</p>
                </div>
                 <div class="col-md-6">
                 <p class="m-b-0"> <strong> Priorty : </strong> {{ $showdata->priority}} </p>
                 </div>
                 <div class="col-md-6">
                 <p class="m-b-0"> <strong> Client Contact Number : </strong> {{ $showdata->ClientData->phone }} </p>
                 </div>
                 <div class="col-md-6">
                  <p class="m-b-0"> <strong> Department : </strong>{{ $showdata->Departmentsinfo->name }} </p>
                 </div>
                 <div class="col-md-6">
                      <p class="m-b-0"> <strong> Link Affected : </strong>  {{ $showdata->link_affected}}</p>
                 </div>
                 <div class="col-md-6">
                  <p class="m-b-0"> <strong>FE Phone Number :</strong>  {{ $showdata->AssignEngginfo->phone }}</p>
                 </div>
                 <div class="col-md-6">
                  <p class="m-b-0"> <strong> Service Affected :</strong> {{ $showdata->Serviceaffected->name }} </p>
                 </div>
                 <div class="col-md-6">
                    <p class="m-b-0"> <strong> Created Time :</strong>  {{ $showdata->created_at }} </p>
                 </div>
                 {{$rt = $showdata->reporting_time}}
                 <div class="col-md-6">
                     <p class="m-b-0"> <strong> Last Response : </strong>  
                      @foreach($updating as $respo)
                      <?php $a =$respo->updated_at;  ?>
                      @endforeach
                      {{ $a }}
                      
                    </p>
                 </div>
                 <div class="col-md-6">
                    <p class="m-b-0"> <strong> Field Enginer Assigned : </strong>   {{ $showdata->AssignEngginfo->name }}&nbsp;&nbsp;{{$showdata->AssignEngginfo->lastName}}  </p>
                 </div>

            </div>
                @endforeach
        </div>
<input type='hidden' id="rt" value="{{$rt}}">
        <hr>

                  <!--   Ticket thread section section start here  --> 
                 <?php $timespent = 0; ?>
                    <div class="ticket-thread" style="padding-top: 25px;">
                        <h6>Ticket Thread</h6>
                        <table class="table">
                        <tbody>     
                        <!-- @foreach ($updating as $value)
                        <?php //$ngg = $value->NocEngginfo->name.'&nbsp;&nbsp;'.$value->NocEngginfo->lastName; ?>
                           <tr>
                                <td>{{ $value->opening_time }}</td>                         
                                <td class="text-right">{{ $value->NocEngginfo->name }} {{ $value->NocEngginfo->lastName }}</td>
                            </tr>
                            <tr>
                                <td style="border-top: none;">{{ $value->comments }}</td>
                            </tr>                     
                         
                         @endforeach -->
                        </tbody>
                        </table>
                    </div>
                  <!--   Ticket thread section section end here  --> 
                   @if(!empty($postReplyMsg))
                    <div class="post_reply_msg" style="padding-top: 25px;" >
                      <h6><!--  Post Reply Message --></h6>
                    <div class="col-md-12 text-left">                   
                          @foreach ($postReplyMsg as $msg)
                          <div class="col-md-12">@if(!empty($msg->attachment))<img src="{{url('/')}}/assets/images/uploads//{{$msg->attachment}}" alt="{{$msg->attachment}}" width="65px"> @endif</div>
                          <div class="col-md-12">{{ $msg->message }}</div>                     
                          <div class="col-md-12"> {{ $msg->created_at }}</div>
                          <div class="col-md-12 text-right"> {{ $msg->NocEngginfo->name }} {{ $msg->NocEngginfo->lastName }}</div>
                            <hr>
                          @endforeach
                        
                       
                      </div>
                  </div>
                   @endif
                   
                    @else

                    @endif

                    <?php
 
                      $ticket_id        = $radiobuttonValue->ticket_id;
                      $client_id        = $radiobuttonValue->client_id;
                      $attachment       = $radiobuttonValue->attachment;
                      $message          = '';

                     ?>

                  <div class="post-reply" style="padding-top: 25px;">
                        {!! Form::open(array('route' => 'ticket-post-reply', 'class'=> 'form form-horizontal','enctype'=>'multipart/form-data', 'files'=>true)) !!}
                    {!! Form::token() !!}
                       {!! Form::hidden('ticket_id',$ticket_id,array('class'=>'form-control')) !!}
                       {!! Form::hidden('client_id',$client_id,array('class'=>'form-control')) !!}
                       <div class="row clearfix" >    
                         <h6>Post Reply</h6>
                      
                            <div class="col-md-12" style="padding-bottom: 20px;">
                                 <textarea name="message" cols="30" rows="5" placeholder="message" class="form-control no-resize"></textarea>
                            </div>  
                                                       
                            <div class="col-md-12">
                                <label for="attachment">Image</label>
                                      {!! Form::file('attachment',array('id'=>'attachment','data-icon'=>'false', 'accept'=>'image/*')) !!}                  
                             </div>                             
                           
                            <div class="col-md-12 text-center" style="padding-top:20px;">
                                <input type="submit" name="submit" value="Post Reply" class="btn btn-primary" >
                            </div> 
                        </div>
                          {!! Form::close() !!}
                    </div>
</div>



    <div id="reassign" class="tab-pane fade">
        @if(Request::segment(2)==='view')
     
  <div class="table-responsive">
        <table class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Field Engg Name</th>
                                    <th>Opening Time</th>
                                    <th>Closing Time</th>
                                    <th>Total Time Taken</th>
                                    <!-- <th>Comment</th>  -->                                       
                                    <th>Action</th>                                        
                                </tr>
                            </thead>
                            <tbody>
                               
                                @foreach ($updating as $value)
                                <?php
                                    $strStart2 = $value->opening_time; 
                                    $strEnd2   = $value->closing_time; 
                                    $dteStart2 = new DateTime($strStart2); 
                                    $dteEnd2   = new DateTime($strEnd2);
                                    $dteDiffs2  = $dteStart2->diff($dteEnd2); 
                                ?>
                                @if($value->nonassignedengg=='NO')
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $value->Userinfo->name }}&nbsp;&nbsp;&nbsp;{{ $value->Userinfo->lastName }}  </td>
                                    <td>{{ $value->opening_time }}</td>
                                    <td>{{ $value->closing_time }}</td>
                                    <td><?php print $dteDiffs2->format("%a days %H hrs %i min");  ?></td>
                                    <!-- <td>{{ $value->comments }}</td> -->                                             
                                    <td>
                                        @can('open-ticket-edit')
                                       <a data-toggle="modal" data-target="#editfe" id="editfeid" data-id="{!!$value->id!!}" href="javascript:;" title='{!!$generating[0]->ticket_id!!}' class="btn btn-sm btn-orange btn-icon-primary tooltips"><i class="fa fa-pencil"></i></a>
                                        @endcan
                                        @can('open-ticket-delete')
                                    <a  href="{!! route('delfedata',$value->id) !!}" class="btn btn-sm btn-orange btn-icon-primary tooltips" title='Delete{!!$value->id!!}'><i class="fa fa-close"></i></a>
                                        @endcan
                                    </td>                                               
                                </tr>  
                                @else
                                @endif                            
                                @endforeach
                            </tbody>
             </table>
         </div>
                    <?php
                        $ticket_id             = $generateAlldata->ticket_id;
                        $client_id             = $generateAlldata->client_id;                    
                        $department_id         = $generateAlldata->department_id;
                        $status                = $generateAlldata->status;                                
                        $service_affected      = $generateAlldata->service_affected;
                        $opening_time          = '';
                        $employee_id           = '';
                        $comments              = '';
                     ?>
                                  
              <div class="body">
                    {!! Form::open(array('route' => 'ticket-generated-store2', 'class'=> 'form form-horizontal','enctype'=>'multipart/form-data', 'files'=>true)) !!}
                    {!! Form::token() !!}
                    {!! Form::hidden('ticket_id',$ticket_id,array('class'=>'form-control')) !!}
                    {!! Form::hidden('noc_operator', $logged_in_person->id, array('class'=>'form-control')) !!}
                    {!! Form::hidden('status',$status,array('class'=>'form-control')) !!}
                    {!! Form::hidden('client_id',$client_id,array('class'=>'form-control')) !!}
                    {!! Form::hidden('service_affected',$service_affected,array('class'=>'form-control')) !!}
                    {!! Form::hidden('department_id',$department_id,array('class'=>'form-control')) !!}

    
                      <div class="row clearfix">                   
                          <div class="col-md-12">
                            <label for="roles"> Select The Field Enginer   </label>
                            {!! Form::select('employee_id', $empdata, $employee_id, array('class' => 'form-control show-tick','required')) !!}
                        </div>                                                                                    
                        <div class="col-md-12">
                            <!-- <label for="comments">Enter reasons for the assignment or instructions for the Field Enginer </label> -->
                                <textarea name="comments" cols="20" rows="5" placeholder="comments" class="form-control no-resize" style='display:none'>abcd</textarea>
                        </div>
                        <div class="col-md-12 text-center">
                            <hr>
                            {!! Form::submit('Submit', array('class'=>'btn btn-primary')) !!}
                        </div>
                    {!! Form::close() !!}
                </div>    
           
        </div>

   @else

           
         @endif
    </div><!-- This is the end of reass -->
 <div id="requestaccess" class="tab-pane fade">
       
      @if(Request::segment(2)==='view' )

      <div class="table-responsive">
        <table class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Assigned Field Engg</th>
                                    <th>Site Accessed</th>
                                    <th>Requested Time</th>
                                    <th>Access Granted Time</th>
                                    <th>Total time Taken</th>
                                    <!-- <th>Comment</th> -->
                                    <th>Action</th>
                                   
                                                                       
                                </tr>
                            </thead>
                            <tbody>
                               <?php $index2=0; ?>
                                @foreach($updating as $valuezz)

                                <?php

                                    $strStart = $valuezz->acc_request_time; 
                                    $strEnd   = $valuezz->acc_granted_time;

                                    $dteStart = new DateTime($strStart); 
                                    $dteEnd   = new DateTime($strEnd); 
                                    $dteDiffs  = $dteStart->diff($dteEnd); 
                                    $timeday = $dteDiffs->format("%d");
                                    if($timeday > 0)
                                    {
                                        $timespent = $timespent+($timeday*24);
                                        $timespent = $timespent+$dteDiffs->format("%h");
                                    }
                                    else
                                    {
                                    $timespent = $timespent+$dteDiffs->format("%h");
                                    }  
                                    //echo $timespent;                                 
                                    ?>
                               @if($valuezz->acc_request_time !='' && ($valuezz->nonassignedengg=='YESACCESS' || $valuezz->nonassignedengg=='NO'))                          
                                <tr>
                                    <td>{{ ++$index2 }}</td>
                                    <td> {{ $valuezz->empassigned }}&nbsp;&nbsp;&nbsp;{{ $valuezz->empassigned2 }}  </td>
                                    <td> {{ $valuezz->site_address }} </td>
                                    <td> {{ $valuezz->acc_request_time }} </td>
                                    <td> {{ $valuezz->acc_granted_time }} </td>
                                    <td><?php print $dteDiffs->format("%a days %H hrs %i min");  ?></td>
                                    <!-- <td> {{ $valuezz->comments }} </td> -->        
                                  
                                    <td class="btn-group btn-group-xs">
                                            @can('open-ticket-edit')
                                      <a data-toggle="modal" data-target="#getitemtotenderdetail" id="getitemtotenderdetailid" data-id="{!!$valuezz->id!!}" href="javascript:;" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="View Detail"><i class="fa fa-pencil"></i></a> 
                                       @endcan
                                    </td>
                                </tr>
                                @else
                                
                              @endif
                                @endforeach
                            
                            </tbody>

             </table>

         </div>           
        
        @endif        
   
  </div>

  <div id="requestsecurityescort" class="tab-pane fade">

@if(Request::segment(2)==='view')
  <div class="table-responsive">
        <table class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Assigned Field Engg</th>
                                    <th>Link Affected</th>
                                    <th>Requested Time</th>
                                    <th>Access Granted Time</th>
                                    <th>Total time Taken</th>
                                    <!-- <th>Comment</th> --> 
                                    <th>Action</th>                 
                                </tr>
                            </thead>
                            <tbody>
                               <?php $index3 =0; ?>
                                @foreach ($updating as $value)
                                <?php
                                    $strStart2 = $value->escort_request_time; 
                                    $strEnd2   = $value->escort_granted_time; 
                                    $dteStart2 = new DateTime($strStart2); 
                                    $dteEnd2   = new DateTime($strEnd2); 
                                    $dteDiffs2  = $dteStart2->diff($dteEnd2); 
                                ?>
                                @if($value->escort_request_time !='' && ($value->nonassignedengg=='YESSECURITY' || $value->nonassignedengg=='NO'))      
                                <tr>
                                    <td>{{ ++$index3 }}</td>
                                    <td> {{ $value->empassigned}}&nbsp;&nbsp;&nbsp;{{ $valuezz->empassigned2 }}  </td>
                                    <td> {{ $value->link_affected}} </td>
                                    <td>{{ $value->escort_request_time }}</td>
                                    <td>{{ $value->escort_granted_time }}</td>
                                    <td><?php print $dteDiffs2->format("%a days %H hrs %i min");  ?></td>
                                    <!-- <td>{{ $value->comments }}</td> --> 
                                     <td class="btn-group btn-group-xs">
                                      @can('open-ticket-edit')
                                     <a data-toggle="modal" data-target="#securityescortmodal" id="securityescortmodalid" data-id="{!!$value->id!!}" data-ticket-id="{!! $generating[0]->ticket_id !!}" href="javascript:;" class="tooltips btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="View Detail"><i class="fa fa-pencil"></i></a>
                                      @endcan
                                    </td>                     
                                </tr>
                                @else
                                @endif
                                @endforeach
                            </tbody>
             </table>
         </div>
@endif
                    

  </div>
        <div id="closeticket" class="tab-pane fade">

        @if(Request::segment(2)==='view')
                      <?php
                        $ticket_id             = '';
                        $client_id             = '';
                        $employee_id           = '';
                        $closing_time          = '';
                        $noc_engg_id           = '';
                        $status                = '';
                        $noc_engg_id           = '';                       
                        $service_affected      = '';
                        $opening_time          = '';
                        $cause_of_fault        = '';
                    ?>


              <div class="body">
                    {!! Form::open(array('route' => 'closetheticket', 'class'=> 'form form-horizontal','enctype'=>'multipart/form-data', 'files'=>true)) !!}
                    {!! Form::token() !!}
                    {!! Form::hidden('client_id',$generating[0]->client_id,array('class'=>'form-control')) !!}
                    {!! Form::hidden('ticket_id',$generating[0]->ticket_id,array('class'=>'form-control')) !!}
                                  
                        <div class="row clearfix"> 
                        <div class="col-md-12">
                            <label for="roles">Resolution Time </label>
                            {!! Form::text('resolution_time', '', array('class' => 'form-control closingd_time_datapicker ')) !!}
                        </div>
                        <div class="col-md-12">
                            <label for="closingnocenginner">Closing NOC Engineer </label>
                            {!! Form::text('closing_noc_engg_id', Auth::user()->name, array('class' => 'form-control','readonly')) !!}
                        </div>

                        <div class="col-md-12">
                            <label for="clearanceofficer"> Clearance Officer On Client Side </label>
                            {!! Form::text('clearence_officer_onclient_side', '', array('class' => 'form-control show-tick')) !!}
                        </div>
                        <div class="col-md-12">
                            <label for="userType"> Cause Of Fault</label>
                         {!! Form::select('cause_of_fault', $allCauseoffalut, $cause_of_fault, array('class' => 'form-control show-tick','required')) !!}
                        </div>
                        <div class="col-md-12">
                           <label for="status">Resgion of closing</label> 
                          <select name="status" class="form-control show-tick">
                             <option value="2">Closed</option>
                              <option value="3">Pending</option>
                              <option value="4">Cancelled</option>
                          </select>

                        </div>
                  
                        <div class="col-md-12">
                            <label for="resolutionremarks">Resolution Remarks </label>
                                <textarea name="resolution_remark" cols="30" rows="5" placeholder="Resolution Remarks" class="form-control no-resize" required></textarea>
                        </div>
                   
                        <div class="col-md-12 text-center">
                            <hr>
                            {!! Form::submit('Close Ticket', array('class'=>'btn btn-primary')) !!}
                        </div>
                    {!! Form::close() !!}
                </div>       
           
        </div>
         @endif
    </div> 


</div>

<!-- tabbing section end here -->

                </div>


        </div>

    </div>


<script type="text/javascript">
$(document).ready(function(){
     var rts = $('#rt').val();
   //alert(rts);

$(".closingd_time_datapicker").datetimepicker({
         
        format: "yyyy-mm-dd hh:ii",
        autoclose: true,
        todayBtn: true,
        startDate: rts,
        minuteStep: 10
    });
  });
var d = new Date($.now());
    var desiredformats = d.getFullYear()+"-"+(d.getMonth() + 1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes();
     $(".opening_time_datapicker").datetimepicker({
        format: "yyyy-mm-dd hh:ii",
        autoclose: true,
        todayBtn: true,
        startDate: desiredformats,
        minuteStep: 10

    });
 $(".closing_time_datapicker").datetimepicker({
        format: "yyyy-mm-dd hh:ii",
        autoclose: true,
        todayBtn: true,
        startDate: desiredformats,
        minuteStep: 10

    });

  
</script>  

@endsection
<div class="modal fade" id="getitemtotenderdetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" 
data-keyboard="true" >
<div class="modal-dialog modal-lg">
    <!-- <div class="text-center loading"> <img src="{{url('/')}}/assets/img/ajax-loader.gif"></div> -->
    <div class="modal-content" id="showDetails"></div>
</div>
</div>




@section('extrajs')

@endsection

<div class="modal fade" id="securityescortmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" 
data-keyboard="true" >
<div class="modal-dialog modal-lg">
    <!-- <div class="text-center loading"> <img src="{{url('/')}}/assets/img/ajax-loader.gif"></div> -->
    <div class="modal-content" id="showDetailssecurity"></div>
</div>
</div>


<div class="modal fade" id="insertaccessmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" 
data-keyboard="true" >
<div class="modal-dialog modal-lg">
    <!-- <div class="text-center loading"> <img src="{{url('/')}}/assets/img/ajax-loader.gif"></div> -->
    <div class="modal-content" id="fillDetailsaccess"></div>
</div>
</div>


<div class="modal fade" id="insertescortrequestmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" 
data-keyboard="true" >
<div class="modal-dialog modal-lg">
    <!-- <div class="text-center loading"> <img src="{{url('/')}}/assets/img/ajax-loader.gif"></div> -->
    <div class="modal-content" id="fillDetailsescort"></div>
</div>
</div>


<div class="modal fade" id="editfe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" 
data-keyboard="true" >
<div class="modal-dialog modal-lg">
    <!-- <div class="text-center loading"> <img src="{{url('/')}}/assets/img/ajax-loader.gif"></div> -->
    <div class="modal-content" id="filleditfe"></div>
</div>
</div>






