@extends('layouts.masters')
@section('content')

<div class="content-body">
    <!-- Content Section Strat-->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Create Role </strong></h2>
                    <ul class="header-dropdown">
                        <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                            <ul class="dropdown-menu slideUp">
                                <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>

                                @can('role-create')
                                <li><a href="{{ route('roles.create') }}">Create New Role</a></li>
                                @endcan

                                @can('permission-list')
                                <li><a href="{{ route('permissions.index') }}">Manage Permission</a></li>
                                @endcan
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'required')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Permission: </strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">    
                        @foreach($permission as $key => $value)
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="checkbox">
                            <input type="checkbox" id="checkbox{{$value->id}}" name="permission[]" value="{!!$value->id!!}" />
                            <label for="checkbox{{$value->id}}">
                                {{$value->name}}
                            </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <hr>
                    <div class="row">    
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- Content Section End-->
    </div>
<!-- Content Section End-->
</div>
    @endsection
    @section('extrajs')

    @endsection
