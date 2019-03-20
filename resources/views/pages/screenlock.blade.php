@inject('service', 'App\library\InjectService')
@extends('layouts.default')
<style type="text/css">
    #clockbox {
        color: #000;
        font-size: 40px;
    }
    #clockboxd {
        color: #000;
        font-size: 18px;
    }
</style>
@section('content')
<div class="container">
    <div class="col-md-12 content-center">
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
                        <div id="clockbox"></div>
                        <div id="clockboxd"></div>
                        <h5>{{ $service->getEmail($id)->name }} {{ $service->getEmail($id)->lastName }}</h5>
                    </div>
                    <form class="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <input id="email" type="hidden" class="form-control" name="email" value="{{ $service->getEmail($id)->email }}" required placeholder="Email">

                        <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}"">
                            <input id="password" type="password" class="form-control" name="password" required placeholder="Password" autofocus>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="footer">
                            <button type="submit" class="btn btn-primary btn-round btn-block">Unlock</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extrajs')
{!! Html::script('assets/js/lockscreen.js') !!}
@endsection