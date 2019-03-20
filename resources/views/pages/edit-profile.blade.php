@extends('layouts.masters')
@section('content')

<div class="content-body">
    <!-- Content Section Strat-->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Change Password </strong></h2>
                </div>
                <div class="body">
                    {!! Form::open(array('route' => 'profileupdate', 'class'=> 'form-horizontal','enctype'=>'multipart/form-data', 'files'=>true)) !!}
                    {!! Form::token() !!}
                    {!! Form::hidden('for','password',array('class'=>'form-control')) !!}
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <div class="input-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}">
                                    {!! Form::password('oldpassword',array('id'=>'oldpassword','class'=>'form-control', 'placeholder'=>'Old Password', 'autocomplete'=>'off', 'required')) !!}
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    {!! Form::password('password',array('id'=>'password','class'=>'form-control', 'placeholder'=>'New Password', 'autocomplete'=>'off', 'required')) !!}
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    {!! Form::password('password_confirmation',array('id'=>'password_confirmation','class'=>'form-control', 'placeholder'=>'Confirm Password', 'autocomplete'=>'off', 'required')) !!}
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr>
                            <div class="text-center">
                            {!! Form::submit('Update', array('class'=>'btn btn-raised btn-primary btn-round waves-effect m-l-20')) !!}      
                            </div>   
                        </div>
                    </div>


                    
                    {!! Form::close() !!} 
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Update Profile </strong></h2>
                </div>
                <div class="body">
                    {!! Form::open(array('route' => 'profileupdate', 'class'=> 'form-horizontal','enctype'=>'multipart/form-data', 'files'=>true)) !!}
                    {!! Form::token() !!}
                    {!! Form::hidden('for','profile',array('class'=>'form-control')) !!}
                    {!! Form::hidden('oldavatar', $user->avatar,array('id'=>'lastName','class'=>'form-control',)) !!}
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="name">First Name</label>
                            <div class="form-group">
                                {!! Form::text('name', $user->name,array('id'=>'name','class'=>'form-control', 'placeholder'=>'First Name', 'autocomplete'=>'off', 'required')) !!}
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="lastName">Last Name</label>
                            <div class="form-group">
                                {!! Form::text('lastName', $user->lastName,array('id'=>'lastName','class'=>'form-control', 'placeholder'=>'Last Name', 'autocomplete'=>'off', 'required')) !!}
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="address">Address</label>
                            <div class="form-group">
                                {!! Form::text('address', $user->address,array('id'=>'address','class'=>'form-control', 'placeholder'=>'Address', 'autocomplete'=>'off', 'required')) !!}
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="city">City</label>
                            <div class="form-group">
                                {!! Form::text('city', $user->city,array('id'=>'city','class'=>'form-control', 'placeholder'=>'City', 'autocomplete'=>'off', 'required')) !!}
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="zipcode">Zipcode</label>
                            <div class="form-group">
                                {!! Form::number('zipcode', $user->zipcode,array('id'=>'zipcode','class'=>'form-control', 'placeholder'=>'Zipcode', 'autocomplete'=>'off', 'required')) !!}
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="phone">Mobile Number</label>
                            <div class="form-group">
                                {!! Form::number('phone', $user->phone,array('id'=>'phone','class'=>'form-control', 'placeholder'=>'Mobile Number', 'autocomplete'=>'off', 'required')) !!}
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="avatar">Upload Image</label>
                            <div class="form-group">
                                {!! Form::file('avatar',array('id'=>'avatar','class'=>'form-control', 'accept'=>'image/*')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                        <hr>
                        {!! Form::submit('Update', array('class'=>'btn btn-raised btn-primary btn-round waves-effect m-l-20')) !!}    
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
