@extends('layouts.masters')
@section('content')

<div class="content-body">
    <!-- Content Section Strat-->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                        <h2><strong>
                            @if(Request::segment(1)==='region-create')
                                Create
                            @elseif(Request::segment(1)==='region-edit')
                                Edit
                            @else
                                Manage
                            @endif
                            Regions
                        </strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>

                                    @can('client-create')
                                    <li><a href="{{ route('knowledge-base-contactcreate') }}">Create New Site</a></li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </div>

            @if(Request::segment(1)==='region-edit')  <!-- || Request::segment(1)==='region-edit')-->
                @if(Request::segment(2)==='region-create')
                    <?php
                    $id             = '';
                    $region_name      = '';
                    
                    ?>
                @else
                    <?php
                    $id             = $regionrow->id;
                    $region_name    = $regionrow->region_name;
                    ?>
                @endif
                <div class="body">
                    {!! Form::open(array('route' => 'updateregion','method'=>'POST', 'class'=> 'form form-horizontal')) !!}
                    {!! Form::token() !!}
                    {!! Form::hidden('id',$id,array('class'=>'form-control')) !!}

                        <div class="row clearfix"> 

                        
                        <div class="col-md-12">
                            <label for="region_name">Region Name</label>
                            {!! Form::hidden('id',$id,array('id'=>$id,'class'=>'form-control', 'placeholder'=>'region name', 'autocomplete'=>'off','required')) !!}
                            {!! Form::text('region_name',$region_name,array('id'=>'region_name','class'=>'form-control', 'placeholder'=>'region name', 'autocomplete'=>'off','required')) !!}
                        </div>
                  
                        
                        <div class="col-md-12 text-center">
                           
                            {!! Form::submit('Update', array('class'=>'btn btn-primary')) !!}
                        </div>
                    {!! Form::close() !!} 
                </div>
            @else
                <div class="body">
                    {!! Form::open(array('route' => 'newregioninsert', 'class'=> 'form form-horizontal','enctype'=>'multipart/form-data', 'files'=>true)) !!}
                    {!! Form::token() !!}
                        <input type="hidden" class="form-control"  name="id" value="" >
                        <label>Insert Region Name</label>
                       {!! Form::text('region_name','',array('class'=>'form-control', 'placeholder'=>'Region Name', 'autocomplete'=>'off')) !!}
                       <br>
                        
                     <input class="btn btn-danger"  type="submit" value="Insert">
                      {!! Form::close() !!}
                </div>
            @endif
        </div>
    </div>
    <!-- Content Section End-->
</div>

@endsection
@section('extrajs')

@endsection
