@extends('layouts.masters')
@section('content')

<div class="content-body">
    <!-- Content Section Strat-->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Roles - <span class="badge badge-primary">{{ $role->name }}</span></strong></h2>
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
                    <ul class="list-group">
                        @if(!empty($rolePermissions))
                        
                        @foreach ($rolePermissions->chunk(3) as $chunk)
                        <div class="row">
                            
                            @foreach ($chunk as $v)
                            <div class="col-md-4">
                                <li class="list-group-item">
                                    <strong>{{++$index}}. </strong> {{ $v->name }}
                                </li>
                            </div>
                            @endforeach

                        </div>
                        @endforeach
                        @endif
                    </ul>   
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
