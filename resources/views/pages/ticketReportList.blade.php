@extends('layouts.masters')
@section('content')

<div class="content-body">
    <!-- Content Section Strat-->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                        <h2><strong>RFO reports </strong></h2>
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
                                    <th>Subject Link</th>
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
                                    <td>{{ $value->AssignEngginfo->name }} {{ $value->AssignEngginfo->lastName }}</td>                                
                                    <td>{{ $value->Departmentsinfo->name }}</td>
                                    <td>{{ $value->region }}</td>
                                    <td>{{ $value->link_affected }}</td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>{{ $value->Statusinfo->name }}</td>
                                    <td>
                                    <div class="btn-group btn-group-xs">
                                            @can('report-rfo')                                        
                                                    <a href="{{ route('ticket-report-view',$value->ticket_id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="Update"><i class="fa fa-print"></i></a>    
                                            @endcan
                                    </div>
                                    </td> 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
          
        </div>
    </div>
</div>
    <!-- Content Section End-->
</div>
  
@endsection
@section('extrajs')

@endsection
