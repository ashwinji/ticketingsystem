@extends('layouts.masters')
@section('content')

<div class="content-body">
    <!-- Content Section Strat-->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Create Permission</strong></h2>
                    <ul class="header-dropdown">
                        <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                            <ul class="dropdown-menu slideUp">
                                <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>

                                @can('permission-create')
                                <li><a href="{{ route('permissions.create') }}"> Create Permissions</a></li>
                                @endcan

                                @can('role-list')
                                <li><a href="{{ route('roles.index') }}">Manage Roles</a></li>
                                @endcan
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    {!! Form::open(array('route' => 'permissions.store','method'=>'POST')) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'required')) !!}
                            </div>
                        </div>
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
