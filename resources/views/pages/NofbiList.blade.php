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
                            Client Contact
                        </strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>

                                     @can('kb-maintenance-create')
                                    <li><a href="{{ route('knowledge-base-nofbisCreate') }}">Enter New details</a></li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </div>

            @if(Request::segment(2)==='create' || Request::segment(2)==='edit')
                @if(Request::segment(2)==='create')
                    <?php
                    $id             = '';
                    $client_id      = '';
                    $network        = '';
                    $section        = '';
                    $length         ='';
                    $region_id      = '';
                    $sla            = '';
                    $duration       = '';
                    ?>
                @else
                    <?php
                    $id            = $data->id;
                    $client_id     = $data->client_id;
                    $network       = $data->network;
                    $section       = $data->section;  
                    $length        = $data->length; 
                    $region_id     = $data->region_id;     
                    $sla           = $data->sla;
                    $duration      = $data->duration;           
                    ?>
                @endif
                <div class="body">
                    {!! Form::open(array('route' => 'knowledge-base-nofbisStore', 'class'=> 'form form-horizontal')) !!}
                    {!! Form::token() !!}
                    {!! Form::hidden('id',$id,array('class'=>'form-control')) !!}

                        <div class="row clearfix"> 
                        <div class="col-md-6">
                            <label for="clientName">Client Name </label>
                            {!! Form::select('client_id', $clientdata, $client_id, array('class' => 'form-control show-tick')) !!}
                        </div>

                        <div class="col-md-6">
                            <label for="network">Network</label>
                            {!! Form::text('network',$network,array('id'=>'network','class'=>'form-control', 'placeholder'=>'Network Name', 'autocomplete'=>'off')) !!}
                        </div>

                        <div class="col-md-6">
                            <label for="section">Section </label>
                            {!! Form::text('section',$section,array('id'=>'section','class'=>'form-control', 'placeholder'=>'section', 'autocomplete'=>'off')) !!}
                        </div>
                  
                        <div class="col-md-6">
                            <label for="length">Length (Km) </label>
                            {!! Form::text('length',$length,array('id'=>'length','class'=>'form-control', 'placeholder'=>'section', 'autocomplete'=>'off')) !!}
                        </div>

                        <div class="col-md-6">
                            <label for="regionName">Region  Name </label>
                            {!! Form::select('region_id', $regions, $region_id, array('class' => 'form-control show-tick')) !!}
                        </div>

                        <div class="col-md-6">
                            <label for="sla">SLA </label>
                            {!! Form::text('sla',$sla,array('id'=>'sla','class'=>'form-control', 'placeholder'=>'section', 'autocomplete'=>'off')) !!}
                        </div>

                        <div class="col-md-6">
                            <label for="duration">Duration </label>
                            {!! Form::text('duration',$duration,array('id'=>'duration','class'=>'form-control', 'placeholder'=>'section', 'autocomplete'=>'off')) !!}
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
                                    <th>Client Name</th>
                                    <th>Network</th>
                                    <th>Section</th>
                                    <th>Length(Km)</th>
                                    <th>Region</th>
                                    <th>SLA</th>
                                    <th>Duration</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $value)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $value->Clientinfo->name }}</td>
                                    <td>{{ $value->network }}</td>
                                    <td>{{ $value->section }}</td>
                                    <td>{{ $value->length }}</td>
                                    <td>{{ $value->RegionData->region_name }}</td>
                                    <td>{{ $value->sla }}</td>
                                    <td>{{ $value->duration }}</td>
                                    <td>
                                         <div class="btn-group btn-group-xs">
                                     @can('kb-maintenance-edit')
                                          <a href="{{ route('knowledge-base-nofbisEdit',$value->id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                          <br>
                                     @endcan 
                                     @can('kb-maintenance-delete')  
                                          <a onclick="return ConfirmDelete()" href="{!! route('knowledge-base-nofbisDelete',$value->id) !!}" class="btn btn-sm btn-orange btn-icon-primary tooltips" title='Delete{!!$value->id!!}'><i class="fa fa-close"></i></a>
                                     @endcan                                     
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
