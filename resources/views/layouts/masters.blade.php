@inject('service', 'App\library\InjectService')
<!doctype html>
<html class="no-js " lang="en">
<head>
  @include('includes.head')
  <script type="text/javascript">
    var appurl = '{{url("/")}}/';
  </script>
</head>
<body class="{{$service->getThemeClass()}}">
  <!-- Page Loader -->
  <div class="page-loader-wrapper">
  <div class="loader">
   <!--  <div class="m-t-30"><img src="{{url('/')}}/assets/images/{{$webSetting->website_logo}}" alt="{{$webSetting->website_name}}" width="48" height="48"></div>-->  
          <p>Please wait...</p>       
  </div>
</div> 

  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>


  <!-- Left Sidebar -->
  @include('includes.leftbar')

  <!-- Main Content -->
  <section class="content home">
    <div class="container-fluid">
      <!-- Header-->
      @include('includes.header')
      @include('includes.message')
      <div class="content-body">
        <!-- Content Section Strat-->
        @yield('content')
        <!-- Content Section End-->
      </div>
    </div>
  </section>

  <!-- Right Sidebar -->
  <!-- @include('includes.rightbar') -->
  @include('includes.footer')
  @yield('extrajs')
</body>
</html>