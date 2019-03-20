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
                            Engineer & Driver Contact
                        </strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>

                                     @can('kb-soliton-create')
                                    <li><a href="{{ route('knowledge-base-enggDriverCreate') }}">Enter New Engg Driver</a></li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </div>

            @if(Request::segment(2)==='create' || Request::segment(2)==='edit')
                @if(Request::segment(2)==='create')
                    <?php
                    $id             = '';
                    $region_id    = '';
                    $designation    = '';
                    $desName      = '';
                    $desId        = '';
                    $desContactno_one = '';
                    $desContact_two = '';
                    $desContact_three = '';
                    $driverAssginName  = '';
                    $driver_no  = '';
                    $car_no     = '';
      
                    ?>
                @else
                    <?php
                    $id             = $data->id;
                    $region_id    = $data->region_id;
                    $designation    = $data->designation;
                    $desName      = $data->desName; 
                    $desId    = $data->desId;
                    $desContactno_one    = $data->desContactno_one;
                    $desContact_two      = $data->desContact_two; 
                    $desContact_three    = $data->desContact_three;
                    $driverAssginName    = $data->driverAssginName;
                    $driver_no    = $data->driver_no;
                    $car_no      = $data->car_no;                   
                    ?>
                @endif
                <div class="body">
                    {!! Form::open(array('route' => 'knowledge-base-enggDriverStore', 'class'=> 'form form-horizontal')) !!}
                    {!! Form::token() !!}
                    {!! Form::hidden('id',$id,array('class'=>'form-control')) !!}

                        <div class="row clearfix"> 
                        <div class="col-md-6">
                            <label for="regionName">Region  Name </label>
                            {!! Form::select('region_id', $regions, $region_id, array('class' => 'form-control show-tick')) !!}
                        </div>

                        <div class="col-md-6">
                            <label for="Designation">Designation</label>
                            <select name="designation"  class="form-control" id="designation">
                                <option value="Team leader" <?php if($designation == 'Team leader'){ echo "selected";}  ?>>Team leader </option>
                                <option value="Field Engineer" <?php if($designation == 'Field Engineer'){ echo "selected";}  ?>>Field Engineer </option>
                                <option value="Driver" <?php if($designation == 'Driver'){ echo "selected";}  ?>>Driver </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="designationName">Designation Name</label>
                            {!! Form::text('desName',$desName,array('id'=>'desName','class'=>'form-control', 'placeholder'=>'Designation Name', 'autocomplete'=>'off','required')) !!}
                        </div>
                        <div class="col-md-6">
                            <label for="designationId">Designation ID</label>
                            {!! Form::text('desId',$desId,array('id'=>'desId','class'=>'form-control', 'placeholder'=>'Designation Id', 'autocomplete'=>'off','required')) !!}
                        </div>
                         <div class="col-md-6">
                            <label for="desContactnoOne">Designation Contact No</label>
                            {!! Form::text('desContactno_one',$desContactno_one,array('id'=>'desContactno_one','class'=>'form-control', 'placeholder'=>'Designation Contact No', 'autocomplete'=>'off','required')) !!}
                        </div>
                        <div class="col-md-6">
                            <label for="desContacttwo">Designation Contact No (optional)</label>
                            {!! Form::text('desContact_two',$desContact_two,array('id'=>'desContact_two','class'=>'form-control', 'placeholder'=>'Designation Contact No', 'autocomplete'=>'off')) !!}
                        </div>
                        <div class="col-md-6">
                            <label for="desContactthree">Designation Contact No (optional)</label>
                            {!! Form::text('desContact_three',$desContact_three,array('id'=>'desContact_three','class'=>'form-control', 'placeholder'=>'Designation Contact No', 'autocomplete'=>'off')) !!}
                        </div>

                         <div class="col-md-6">
                            <label for="driverAssginName">Driver assgin Name</label>
                            {!! Form::text('driverAssginName',$driverAssginName,array('id'=>'driverAssginName','class'=>'form-control', 'placeholder'=>'Driver Assgin Name', 'autocomplete'=>'off','required')) !!}
                        </div>

                         <div class="col-md-6">
                            <label for="driverNumber">Driver Mobile number</label>
                            {!! Form::text('driver_no',$driver_no,array('id'=>'driver_no','class'=>'form-control', 'placeholder'=>'Driver number', 'autocomplete'=>'off','required')) !!}
                        </div>
                         <div class="col-md-6">
                            <label for="carNo">Car Number</label>
                            {!! Form::text('car_no',$car_no,array('id'=>'car_no','class'=>'form-control', 'placeholder'=>'Designation Contact No', 'autocomplete'=>'off')) !!}
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
                                    <th>Region</th>
                                    <th>Designation</th>
                                    <th>Des Name</th>
                                    <th>Des Id</th>
                                    <th>Des Contact </th>
                                    <th>Des Contat 2</th>
                                    <th>Des Contat 3</th>
                                    <th>Driver Assgin Name</th>
                                    <th>Driver No</th>
                                    <th>Car No</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $value)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $value->RegionData->region_name }}</td>
                                    <td>{{ $value->designation }}</td>
                                    <td>{{ $value->desName }}</td>
                                    <td>{{ $value->desId }}</td>
                                    <td>{{ $value->desContactno_one }}</td>
                                    <td>{{ $value->desContact_two }}</td>
                                    <td>{{ $value->desContact_three }}</td>
                                    <td>{{ $value->driverAssginName }} </td>
                                    <td>{{ $value->driver_no }}</td>
                                    <td>{{ $value->car_no }} </td>
                                    <td>
                                       <div class="btn-group btn-group-xs">
                                             @can('kb-soliton-edit')
                                          <a href="{{ route('knowledge-base-enggDriverEdit',$value->id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                          <br>
                                            @endcan
                                            @can('kb-soliton-delete')
                                          <a onclick="return ConfirmDelete()"  href="{!! route('knowledge-base-enggDriverStore',$value->id) !!}" class="btn btn-sm btn-orange btn-icon-primary tooltips" title='Delete{!!$value->id!!}'><i class="fa fa-close"></i></a>
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
