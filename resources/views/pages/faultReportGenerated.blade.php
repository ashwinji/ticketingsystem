@extends('layouts.masters')
@section('content')

<div class="content-body">
    <!-- Content Section Strat-->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                        <h2><strong>
                           
                        </strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>
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
                                    <th></th>
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
                               
                                  @foreach($data as $row)              
                                <tr>
                                    <td></td>
                                    <td>{{ $row->ticket_id }}</td>
                                    <td>{{ $row->ClientData->name }}</td>
                                    <td>{{ $row->clientticketno }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                        <a href="{{ route('fault_ticket_page',$row->ticket_id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="View{{ $row->ticket_id}}"><i class="fa fa-eye"></i></a>    
                                        </div>
                                    </td> 
                                </tr>
                                @endforeach
                               
                              
                            </tbody>
                        </table>
                          <input type="submit" name="submit" value="Ticket Stages" class="btn btn-primary"/>
                            {!! Form::close() !!}
                     
                    </div>
                </div>
         

    </div>
    <!-- Content Section End-->
</div>
  

@endsection
@section('extrajs')

@endsection
