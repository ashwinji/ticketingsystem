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
                                Create
                            @elseif(Request::segment(2)==='edit')
                                Edit
                            @else
                                Manage
                            @endif
                            Regions list
                        </strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>

                                    @can('client-create')
                                    <li><a href="{{ route('region-create') }}">Insert New Region</a></li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </div>

            @if(Request::segment(2)==='create' || Request::segment(2)==='edit')
                @if(Request::segment(2)==='create')
                    <?php
                    $id             = '';
                    $client_id    = '';
                    $employee_name    = '';
                    $contact_no      = '';
                    ?>
                @else
                    <?php
                    $id             = $data->id;
                    $client_id    = $data->client_id;
                    $employee_name    = $data->employee_name;
                    $contact_no      = $data->contact_no;                   
                    ?>
                @endif
                <div class="body">
                    {!! Form::open(array('route' => 'knowledge-base-contactStore', 'class'=> 'form form-horizontal')) !!}
                    {!! Form::token() !!}
                    {!! Form::hidden('id',$id,array('class'=>'form-control')) !!}

                        <div class="row clearfix"> 
                        <div class="col-md-12">
                            <label for="clientName">Client Name </label>
                            {!! Form::select('client_id', $clientdata, $client_id, array('class' => 'form-control show-tick')) !!}
                        </div>

                        <div class="col-md-12">
                            <label for="employeeName">Employee Name</label>
                            {!! Form::text('employee_name',$employee_name,array('id'=>'employee_name','class'=>'form-control', 'placeholder'=>'Employee Name', 'autocomplete'=>'off')) !!}
                        </div>

                        <div class="col-md-12">
                            <label for="contactNo">Contact Number</label>
                            {!! Form::text('contact_no',$contact_no,array('id'=>'contact_no','class'=>'form-control', 'placeholder'=>'Contact Number', 'autocomplete'=>'off','required')) !!}
                        </div>
                  
                        
                        <div class="col-md-12 text-center">
                           
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
                                    <th>Region Name</th>
                                    
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($regiondata as $value)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $value->region_name }}</td>
                                    
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                          <a href="{{ route('region-edit',$value->id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                         &nbsp;
                                          <a href="{{ route('region-del',$value->id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="Edit"><i class="fa fa-trash"></i></a>
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

@endsection
@section('extrajs')

@endsection
