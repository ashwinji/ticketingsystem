@php 
    if(sizeof($service->getPageInfo(Request::segment(1)))>0)
    {
        $pi = $service->getPageInfo(Request::segment(1))->description;
    }
    else
    {
        $pi = Request::segment(1);
    }
@endphp
<div class="search-tab">
  <div class="block-header">
    <div class="row clearfix half-color">
        <div class="col-lg-5 col-md-5 col-sm-12 half-color-show">
            <div class="inner-box-color col-md-8">
          <!--  <h2>{{$pi}}</h2>-->
            <ul class="breadcrumb padding-0">
               <!-- <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i></a></li>
                <li class="breadcrumb-item active">{{$pi}}</li>-->
            </ul>
            </div>
        </div>            
        <div class="col-lg-7 col-md-7 col-sm-12">
            <div class="input-group mb-0">
                <input type="hidden" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                    <span class="input-group-text" style='visibility: hidden;'><i class="zmdi zmdi-search"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>  
</div>
