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
                            Ticket
                        </strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>

                                    @can('open-ticket-create')
                                    <li><a href="{{ route('ticket-generated-create') }}">Open Ticket</a></li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </div>        
                <div class="body">                   
                    <div class="table-responsive">
                          {!! Form::open(array('route' => 'ticket-updates-Radio', 'class'=> 'form form-horizontal','method'=>'get','enctype'=>'multipart/form-data', 'files'=>true)) !!}
                          {!! Form::token() !!} 
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                   <!--  <th></th> -->
                                    <th>Ticket No</th>
                                    <th>Client Name</th>
                                    <th>Client Ticket no</th>
                                    <th>Link Affected</th>
                                    <th>Reported Date</th>
                                    <th>FE Assigned </th>
                                    <th>Ticket Age</th>
                                   <th width="5%">Action</th>
                                </tr>                              
                            </thead>
                            <tbody>
                               
                                @foreach ($data as $value)                          
                                <tr>
                                    <?php
                                    $strStart2 = $value->reporting_time;//$value->created_at; 
                                    $strEnd2   = date('Y-m-d H:i:s'); 
                                    $dteStart2 = new DateTime($strStart2); 
                                    $dteEnd2   = new DateTime($strEnd2); 
                                    $dteDiffs2  = $dteStart2->diff($dteEnd2); 
                                    ?>
              <!--                       <td title="{{ $value->ticket_id }}"><input type="radio" id="id" name="id" value="{{ $value->ticket_id }}"> </td> -->
                                    <td>{{ $value->ticket_id }} </td>
                                    <td>{{ $value->ClientData->name }}</td>
                                    <td>{{ $value->clientticketno }}</td>
                                    <td>{{ $value->link_affected }}</td>
                                    <td>{{ $value->reporting_time }}</td>
                                    <td>{{ $value->AssignEngginfo->name}}&nbsp;&nbsp;&nbsp;{{ $value->Userinfo->lastName }}</td>
                                    <td><?php print $dteDiffs2->format("%a days %H hrs %i min"); ?></td>
                                    <td>
                                       <div class="btn-group btn-group-xs">
                                           
                                                @if($value->status == 1 || $value->status == 3)
                                                 @can('open-ticket-edit')
                                                    <a href="{{ route('ticket-updates-view',$value->ticket_id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
                                             &nbsp;
                                               <a href="{{ route('ticket-generated-edit',$value->ticket_id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                                   
                                               @endcan
                                                    &nbsp;
                                                     @can('open-ticket-delete')
                                                    <a onclick="return ConfirmDelete()" href="{{ route('ticket-processing-delete',$value->ticket_id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                                     @endcan
                                                @endif                                         
                                           
                                        </div>
                                    </td> 
                                </tr>
                                @endforeach
                              
                            </tbody>
                        </table>
                      <!--     <input type="submit" name="submit" value="Ticket Stages" class="btn btn-primary"/> -->
                            {!! Form::close() !!}
                     
                    </div>
                </div>
         

    </div>
    <!-- Content Section End-->
</div>
  

@endsection
@section('extrajs')

@endsection
