@extends('layouts.masters')
@section('content')

<div class="content-body">
    <!-- Content Section Strat-->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                        <h2><strong>Ticket Closing List</strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>        
                    <div class="body">     
                    @if(Request::segment(2)==='closed')
                              
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ticket ID</th>                                    
                                    <th>Client Ticket No.</th>                                    
                                    <th>Subject Link</th>                                    
                                    <th>Field Engg</th>
                                    <th>Resolution Remark</th>
                                    <th>Opening time</th>
                                    <th>Resolution Time</th>
                                    <th>Cause Of Fault</th>  
                                    <th>SLA Time</th>  
                                    <th>Status</th>    
                                    <th>Action</th>                         
                                </tr>                              
                            </thead>
                            <tbody>                          
                                <?php $i = 0; ?>      
                                @foreach ($data as $value)                     
                                <tr>                                  
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $value->ticket_id }} </td>                                
                                    <td> {{ $value->clientticketno }}</td>                                
                                    <td>{{ $lstarray[$i] }}</td>                                
                                    <td>{{ $value->AssignEngginfo->name }} {{$value->AssignEngginfo->lastName }}</td>
                                    <td>{{ $value->resolution_remark }}</td>
                                    <td>{{ $value->reporting_time }}</td>
                                    <td>{{ $value->resolution_time }}</td>
                                    <td>{{ $value->cause_of_fault}}</td>  
                                    <td>{{ $sltarray[$i] }}</td>
                                    <td>{{ $value->Statusinfo->name}}</td>
                                    <td>
                                        @can('open-ticket-edit')
                                     <a href="{{ route('ticketListClosedEdit',$value->id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="View"><i class="fa fa-pencil"></i></a>
                                      <a href="{{ route('ticket-report-view',$value->ticket_id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="RFO Print"><i class="fa fa-print"></i> RFO print</a>
                                        @endcan
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                @endforeach                              
                            </tbody>
                        </table>
                        
                     
                    </div>
                     @endif
                        @if(Request::segment(2)==='closedEdit')
                   <?php 
                       $status = $dataedit->status; 
                       $ticket_id = $dataedit->ticket_id;                
                   ?>                            
                    {!! Form::open(array('route' => 'ticketListClosedEditStored', 'class'=> 'form form-horizontal','enctype'=>'multipart/form-data', 'files'=>true)) !!}
                    {!! Form::token() !!}  
                    {!! Form::hidden('ticket_id',$ticket_id,array('class'=>'form-control')) !!}             
                                  
                        <div class="row clearfix"> 
                          <div class="col-md-12">
                            <label for="userType "> Status </label>
                            {!! Form::select('status', $allStatus, $status, array('class' => 'form-control show-tick')) !!}
                        </div> 
                       
                        <div class="col-md-12 text-center">
                            <hr>
                            {!! Form::submit('Ticket Status Update', array('class'=>'btn btn-primary')) !!}
                        </div>
                    {!! Form::close() !!}
                    </div>
                      @endif
    </div>
    <!-- Content Section End-->
</div>
  

@endsection
@section('extrajs')

@endsection
