 @extends('layouts.masters')
@section('content')

<div class="content-body">
    <!-- Content Section Strat-->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                 <div class="header">
                        <h2><strong>Access Reports</strong></h2>
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
                                    <th>Soliton TT</th>
                                    <th>Client's TT</th>
                                    <th>Client's Name</th>
                                    <th>Region</th>   
                                    <th>Link Affected</th>                                  
                                    <th>Action</th>                                              
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($updating as $value)
                                            
                                <tr>                                  
                                    <td> {{ $value->ticket_id }}</td>
                                    <td> {{ $value->clientticketno }} </td>
                                    <td> {{ $value->ClientData->name }} </td>
                                    <td> {{ $value->region }} </td>   
                                    <td> {{ $value->link_affected }} </td>                              
                                    <td>
                                         <div class="btn-group btn-group-xs">                               
                              <a href="{{ route('ticket-report-Request-AccessView',$value->client_id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="Update"><i class="fa fa-eye"></i></a>
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

         
@endsection
@section('extrajs')

@endsection