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
                            Site Info
                        </strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>

                                      @can('kb-site-create')
                                    <li><a href="{{ route('knowledge-base-create') }}">Enter New site info</a></li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </div>
                <div class="col-md-12">
                     <form class="form-upload" method="POST" action="{{route('uploadsiteids')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                          <div class="col-md-10 text-right">
                         <div class="form-group">
                            <label for="file">Excel upload</label>
                            <input type="file" id="file" name="ex_file">
                            <p class="help-block"></p>
                         </div>
                     </div>
                     <div class="col-md-2 text-left">
                         <button type="submit" name="submit" class="btn btn-primary" id="upload_f">submit</button>
                     </div>
                 </div>
                          </form>
                 </div>
                    
                    

            @if(Request::segment(2)==='create' || Request::segment(2)==='edit')
                @if(Request::segment(2)==='create')
                    <?php
                    $id             = '';
                    $old_site_id    = '';
                    $new_site_id    = '';
                    $site_name      = '';
                    ?>
                @else
                    <?php
                    $id             = $data->id;
                    $old_site_id    = $data->old_site_id;
                    $new_site_id    = $data->new_site_id;
                    $site_name      = $data->site_name;                   
                    ?>
                @endif
                <div class="body">
                    {!! Form::open(array('route' => 'knowledge-base-store', 'class'=> 'form form-horizontal')) !!}
                    {!! Form::token() !!}
                    {!! Form::hidden('id',$id,array('class'=>'form-control')) !!}

                        <div class="row clearfix"> 
                        <div class="col-md-12">
                            <label for="oldSiteId">Old Site Id</label>
                            {!! Form::text('old_site_id',$old_site_id,array('id'=>'old_site_id','class'=>'form-control', 'placeholder'=>'Old Site Id', 'autocomplete'=>'off','required')) !!}
                        </div>

                        <div class="col-md-12">
                            <label for="newSiteId">New Site Id</label>
                            {!! Form::text('new_site_id',$new_site_id,array('id'=>'new_site_id','class'=>'form-control', 'placeholder'=>'New Site Id', 'autocomplete'=>'off')) !!}
                        </div>

                        <div class="col-md-12">
                            <label for="siteName">Site Name</label>
                            {!! Form::text('site_name',$site_name,array('id'=>'site_name','class'=>'form-control', 'placeholder'=>'Site Name', 'autocomplete'=>'off','required')) !!}
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
                                    <th>Old Site ID</th>
                                    <th>New Site ID</th>
                                    <th>Site Name</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $value)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $value->old_site_id }}</td>
                                    <td>{{ $value->new_site_id }}</td>
                                    <td>{{ $value->site_name }}</td>
                                    <td>
                                       <div class="btn-group btn-group-xs">
                                            @can('kb-site-edit')
                                          <a href="{{ route('knowledge-base-edit',$value->id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a><br>
                                            @endcan
                                            @can('kb-site-delete')
                                          <a onclick="return ConfirmDelete()" href="{!! route('knowledge-base-delete',$value->id) !!}" class="btn btn-sm btn-orange btn-icon-primary tooltips" title='Delete{!!$value->id!!}'><i class="fa fa-close"></i></a>
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
