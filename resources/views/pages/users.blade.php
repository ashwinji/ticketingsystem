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
                            Users
                        </strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>

                                    @can('users-create')
                                    <li><a href="{{ route('users-create') }}">Create Users</a></li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </div>

            @if(Request::segment(2)==='create' || Request::segment(2)==='edit')
                @if(Request::segment(2)==='create')
                    <?php
                    $id         = '';
                    $userType   = '';
                    $name       = '';
                    $lastName   = '';
                    $email      = '';
                    $password   = '';
                    $avatar     = '';
                    $address    = '';
                    $city       = '';
                    $zipcode    = '';
                    $phone      = '';
                    $roless   = '';

                  
                    ?>
                @else
                    <?php
                    $id         = $data->id;
                    $userType   = $data->userType;
                    $name       = $data->name;
                    $lastName   = $data->lastName;
                    $email      = $data->email;
                    $password   = $data->password;
                    $avatar     = $data->avatar;
                    $address    = $data->address;
                    $city       = $data->city;
                    $zipcode    = $data->zipcode;
                    $phone      = $data->phone;
                    $roless      = $data->userRole;
                  
                    ?>
                @endif
                <div class="body">
                    {!! Form::open(array('route' => 'users-store', 'class'=> 'form form-horizontal','enctype'=>'multipart/form-data', 'files'=>true)) !!}
                    {!! Form::token() !!}
                    {!! Form::hidden('id',$id,array('class'=>'form-control')) !!}
                    {!! Form::hidden('oldavatar',$avatar,array('class'=>'form-control')) !!}

                        <div class="row clearfix"> 
                        <div class="col-md-6">
                            <label for="userType"> User Department</label>
                            {!! Form::select('userType', $dept, $userType, array('class' => 'form-control show-tick')) !!}
                        </div>

                        <div class="col-md-6">
                            <label for="roles"> User Role</label>
                            {!! Form::select('roles', $roles, $roless, array('class' => 'form-control show-tick')) !!}
                        </div>

                        <div class="col-md-6">
                            <label for="name">First Name</label>
                            {!! Form::text('name',$name,array('id'=>'name','class'=>'form-control', 'placeholder'=>'First Name', 'autocomplete'=>'off','required')) !!}
                        </div>

                        <div class="col-md-6">
                            <label for="lastName">Last Name</label>
                            {!! Form::text('lastName',$lastName,array('id'=>'lastName','class'=>'form-control', 'placeholder'=>'Last Name', 'autocomplete'=>'off','required')) !!}
                        </div>
                        <div class="col-md-6">
                            <label for="email">Email</label>
                            {!! Form::email('email',$email,array('id'=>'email','class'=>'form-control', 'placeholder'=>'Email', 'autocomplete'=>'off','required')) !!}
                        </div>

                        <div class="col-md-6">
                            <label for="phone">Phone</label>
                            {!! Form::number('phone',$phone,array('id'=>'phone','class'=>'form-control', 'placeholder'=>'Phone', 'autocomplete'=>'off','required')) !!}
                        </div>

                          @if(Request::segment(2)==='create')
                        <div class="col-md-6">
                            <label for="password">Password</label>
                            {!! Form::password('password',array('id'=>'password','class'=>'form-control', 'placeholder'=>'Password', 'autocomplete'=>'off','required')) !!}
                        </div>
                        @elseif(Request::segment(2)==='edit')
                       {!! Form::hidden('password',$password,array('class'=>'form-control')) !!}
                        @endif

                        <div class="col-md-6">
                            <label for="address">Address</label>
                            {!! Form::text('address',$address,array('id'=>'address','class'=>'form-control', 'placeholder'=>'Address', 'autocomplete'=>'off','required')) !!}
                        </div>

                        <div class="col-md-6">
                            <label for="city">City</label>
                            {!! Form::text('city',$city,array('id'=>'city','class'=>'form-control', 'placeholder'=>'City', 'autocomplete'=>'off','required')) !!}
                        </div>

                        <div class="col-md-6">
                            <label for="zipcode">Zipcode</label>
                            {!! Form::number('zipcode',$zipcode,array('id'=>'zipcode','class'=>'form-control', 'placeholder'=>'Zipcode', 'autocomplete'=>'off','required')) !!}
                        </div>

                        <div class="col-md-6">
                            <label for="image">Avatar</label>
                            @if(!empty($avatar))
                                        <img src="{{url('/')}}/assets/images/uploads/avatar/{{$avatar}}" alt="{{$avatar}}" width="45px">
                                @endif
                            {!! Form::file('avatar',array('id'=>'avatar','class'=>'form-control')) !!}
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
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Zipcode</th>
                                    <th>Avatar</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($data as $value)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $value->name }} {{ $value->lastName }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->phone }}</td>
                                    <td>{{ $value->address }}</td>
                                    <td>{{ $value->city }}</td>
                                    <td>{{ $value->zipcode }}</td>
                                    <td>
                                        @if(!empty($value->avatar))
                                        <img src="{{url('/')}}/assets/images/uploads/avatar/{{$value->avatar}}" alt="{{$value->name}}" width="45px">
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                            @can('users-edit')
                                            <a href="{{ route('users-edit',$value->id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                            &nbsp;
                                            @if($value->id==1)
                                            @else
                                            <a href="{{ route('users-del',$value->id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                            @endif
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
