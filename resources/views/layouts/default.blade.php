<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/images/favicon.ico') }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/images/favicon.ico') }}">

<title>{{$webSetting->website_name}}</title>
<meta name="_token" content="{{ csrf_token() }}">
{!! Html::style('assets/plugins/bootstrap/css/bootstrap.min.css') !!}
{!! Html::style('assets/css/main.css') !!}
{!! Html::style('assets/css/color_skins.css') !!}
{!! Html::style('assets/css/custom.css') !!}
</head>
<body class="theme-black">
<div class="authentication">
    @yield('content')
</div>
<!-- Jquery Core Js -->
{!! Html::script('assets/bundles/libscripts.bundle.js') !!}
{!! Html::script('assets/bundles/vendorscripts.bundle.js') !!}
<!-- Lib Scripts Plugin Js -->
@yield('extrajs')
</body>
</html>