@extends('layouts.masters')
@section('content')

<div class="content-body">
    <!-- Content Section Strat-->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                        <h2><strong>
                            @if(Request::segment(2)==='create')
                                Open
                            @elseif(Request::segment(2)==='edit')
                                Edit
                            @else
                                Manage
                            @endif 
                            Tickets
           
                        </strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>

                                  @can('open-ticket-create')
                                    <li><a href="{{ route('ticket-generated-create') }}">Create Ticket</a></li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </div>
                       

            @if(Request::segment(2)==='create' || Request::segment(2)==='edit')
                @if(Request::segment(2)==='create')
                    <?php
                         $ticketno             = '';
                        $employee_id           = '';
                        $department_id         = '';
                        $region                = '';
                        $status                = '';
                        $noc_engg_id           = '';
                        $client_id             = '';
                        $service_affected      = '';
                        $description      = '';
                        $linkaffected = '';
                        $fault_reported_by  ='';      
                        $fault_reported_by = '';     
                        $clientticketno = '';    
                        $reporting_time = ''; 
                        //$lastid = '';           
                     
                    ?>
                @else
                    <?php
                          // print_r($ticketrow);
                        $ticketno        = $ticketrow->ticket_id;
                        $employee_id      = $ticketrow->employee_id;
                        $department_id    = $ticketrow->department_id;
                        $region           = $ticketrow->region;
                        $status           = $ticketrow->status;
                        $noc_engg_id      = $ticketrow->noc_engg_id;
                        $client_id        = $ticketrow->client_id;
                        $service_affected = $ticketrow->service_affected;
                        $description      = $ticketrow->description;
                        $linkaffected      = $ticketrow->link_affected;
                        $fault_reported_by = $ticketrow->fault_reported_by;
                        
                        $reporting_time = $ticketrow->reporting_time;
                        $clientticketno = $ticketrow->clientticketno;
                        //$lastid = $lastid;
                    ?>
                @endif
                <div class="body">
                    {!! Form::open(array('route' => 'ticket-generated-store', 'class'=> 'form form-horizontal','enctype'=>'multipart/form-data', 'files'=>true)) !!}
                    {!! Form::token() !!}
                    {!! Form::hidden('ticket_id',$ticketno,array('class'=>'form-control')) !!}
                                  

                        <div class="row clearfix"> 
                             <div class="col-md-6">
                            <label for="roles"> Ticket Number </label>
                            @if($ticketno == '')
                            <?php  $t = 'SLT-'.rand(1,90000).$lastid;  ?>
                            <input class='form-control' type="text"  value= <?= $t ?> name='ticketno' readonly required>
                            @else
                            <input class='form-control' type="text"  value= <?= $ticketno ?> name='ticketno' readonly required>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="roles"> NOC Employee Name </label>
                            
                            <input class='form-control' type="text"
                             value="{{ $logged_in_person['name'] }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="roles">Client Name </label>
                            {!! Form::select('client_id', $clientdata, $client_id, array('class' => 'form-control show-tick')) !!}
                        </div>

                        <div class="col-md-6">
                            <label for="roles"> Field Engineer Assigned </label>
                            {!! Form::select('employee_id', $empdata, $employee_id, array('class' => 'form-control show-tick')) !!}
                        </div>

                        <div class="col-md-6">
                            <label for="userType"> User Department</label>
                            {!! Form::select('department_id', $dept, $department_id, array('class' => 'form-control show-tick')) !!}
                        </div>

                        <div class="col-md-6">
                            <label for="name"> Region</label>
                            
                            <select class="form-control" name='region' required>
                                 <option value="0">--Select Region--</option>
                                @foreach($regions as $rr)
                                @if($region == $rr->region_name) 
                                <option value="{{ $rr->region_name }}" selected>{{ $rr->region_name }}</option>
                                @else
                                <option value="{{ $rr->region_name }}" >{{ $rr->region_name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>

                         <div class="col-md-6">
                            <label for="userType"> Service Affected </label>
                            {!! Form::select('service_affected', $servicedata, $service_affected, array('class' => 'form-control show-tick')) !!}
                        </div> 


                        <div class="col-md-6">
                            <label for="userType"> Status</label>
                            <!-- {!! Form::select('status', $Allstatus, $status, array('class' => 'form-control show-tick')) !!}  -->
                            <input type="text" name="status" value="Open" class="form-control" readonly>

                        </div>
                        <div class="col-md-6">
                            <label for="linkaffected"> Link Affected</label>
                            <input class="form-control" type='text' name="linkaffected" value="{{ $linkaffected }}">
                        </div>
                            <div class="col-md-6">
                            <label for="priority"> Priority</label>                            
                            <select name="priority" id="priority" class="form-control show-tick">
                                <option value="Critical">Critical</option>
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>
                    

                          <div class="col-md-6">
                            <label for="reporting_time"> Reporting time</label>
                            {!! Form::text('reporting_time',$reporting_time,array('id'=>'closing_time','class'=>'form-control closing_time_datapicker', 'placeholder'=>'Repoted Time', 'autocomplete'=>'off')) !!}
                        </div>
                        
                        <div class="col-md-6">
                            <label for="clientticketno"> Client Ticket Number</label>
                            <input class="form-control" type='text' name="clientticketno" value="{{ $clientticketno }}" placeholder="will be given by client" required>
                        </div>
                        <div class="col-md-12">   
                        <label for="clientticketno">Fault Reported By</label>                         
                             {!! Form::text('fault_reported_by',$fault_reported_by,array('id'=>'fault_reported_by','class'=>'form-control', 'placeholder'=>'Fault Reported Name', 'autocomplete'=>'off')) !!}
                        </div>   
                        <div class="col-md-12">
                            <label for="description"> Comment/Description</label>
                            <textarea class="form-control" cols="20" rows="10"  name="description" >{{ $description }}</textarea>
                        </div>


                        <div class="col-md-12 text-center">
                            <hr>
                            {!! Form::submit('Submit', array('class'=>'btn btn-primary')) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            @else
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Ticket ID</th>
                                    <th>NOC Employee Name</th>
                                    <th>Client Name</th>
                                    <th>Assgin Engg Name</th>                                    
                                    <th>Department Name</th>
                                    <th>Region</th>
                                    <th>Ticket Genrate Date</th>
                                    <th>Status</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $value)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $value->ticket_id }}</td>
                                    <td>{{ $value->NOCUserinfo->name }} </td>
                                    <td>{{ $value->ClientData->name }}</td>
                                    <td>{{ $value->AssignEngginfo->name }}</td>                                
                                    <td>{{ $value->Departmentsinfo->name }}</td>
                                    <td>{{ $value->region }}</td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>{{ $value->Statusinfo->name }}</td>
                                    <td>
                                   <div class="btn-group btn-group-xs">
                                           
                                                @if($value->status == 1 || $value->status == 3)
                                                 @can('open-ticket-edit')
                    <a href="{{ route('ticket-processing-edit',$value->ticket_id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="Update"><i class="fa fa-pencil"></i></a>&nbsp;
                       @endcan
                     @can('open-ticket-delete')
                    <a href="{{ route('ticket-processing-delete',$value->ticket_id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                       @endcan
                                                @endif
                                         
                                         
                                        </div>
                                    </td> 
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- Content Section End-->
</div>
<script type="text/javascript">
    $(".closing_time_datapicker").datetimepicker({
        format: "yyyy-mm-dd hh:ii"
    });

</script>    
@endsection
@section('extrajs')

@endsection
