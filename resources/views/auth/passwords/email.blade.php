@extends('layouts.default')

@section('content')
<div class="container">
    <div class="col-md-12 content-center">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="company_detail">
                    <h4 class="logo"><img src="{{url('/')}}/assets/images/{{$webSetting->website_logo}}" alt="{{$webSetting->website_name}}"> 
                        {{$webSetting->website_name}}
                    </h4>
                    <h3>What is Lorem Ipsum</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p> 
                </div>                    
            </div>
            <div class="col-lg-5 col-md-12 offset-lg-1">
                <div class="card-plain">
                    <div class="header">
                        <h5>Forgot Password</h5>
                        <span>Enter your e-mail address below to reset your password.</span>
                    </div>
                    <form class="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="User Name">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="footer">
                            <button type="submit" class="btn btn-primary btn-round btn-block">Send Password Reset Link</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
