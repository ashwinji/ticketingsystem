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
                            Nature Of Fault
                        </strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>

                                    @can('natureoffault-create')
                                    <li><a href="{{ route('natureoffault-create') }}">Create Nature Of Fault</a></li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </div>

            @if(Request::segment(2)==='create' || Request::segment(2)==='edit')
                @if(Request::segment(2)==='create')
                    <?php
                    $id             = '';
                    $name           = '';
                    ?>
                @else
                    <?php
                    $id             = $data->id;
                    $name           = $data->name;
                    ?>
                @endif
                <div class="body">
                    {!! Form::open(array('route' => 'natureoffault-store', 'class'=> 'form form-horizontal')) !!}
                    {!! Form::token() !!}
                    {!! Form::hidden('id',$id,array('class'=>'form-control')) !!}

                        <div class="row clearfix"> 
                        <div class="col-md-12">
                            <label for="name">Nature Of Fault Name</label>
                            {!! Form::text('name',$name,array('id'=>'name','class'=>'form-control', 'placeholder'=>'Nature Of Fault Name', 'autocomplete'=>'off','required')) !!}
                        </div>
                        
                        <div class="col-md-12 text-center">
                            <hr>
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
                                    <th>Name</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $value)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                            @can('natureoffault-edit')
                                            <a href="{{ route('natureoffault-edit',$value->id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                            @endcan
                                            &nbsp;
                                            @can('natureoffault-delete')
                                                <a href="{{ route('natureoffault-delete',$value->id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="Edit"><i class="fa fa-trash"></i></a>
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
