@extends('layouts.masters')
@section('content')

<div class="content-body">
    <!-- Content Section Strat-->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Manage Permission</strong></h2>
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
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Name</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $key => $permission)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <div class="btn-group btn-group-xs">
                                           
                                            <a href="{{ route('permissions.show',$permission->id) }}" class="btn btn-sm btn-primary btn-icon-primary tooltips" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
                                               @can('permission-edit')
                                           
                                                <a href="{{ route('permissions.edit',$permission->id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                           
                                            @endcan
                                            @can('permission-delete')
                                                <a href="{{ route('permission-delete',$permission->id) }}" class="btn btn-sm btn-danger btn-icon-primary tooltips" data-placement="top" title="Delete" onClick="return confirm('Are you sure you want to delete this?');"><i class="fa fa-times"></i>
                                                </a>
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