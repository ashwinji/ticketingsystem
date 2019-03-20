@extends('layouts.masters')
@section('content')

<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
    height: 25px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: 4px;
  bottom: 3px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #22252b;
}

input:focus + .slider {
  box-shadow: 0 0 1px #22252b;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
.sms_option{
  display: table;
}
.sms_option .sms_innerOption{
   padding-bottom: 15px;
   display: flex;
}
.sms_option .sms_innerOption h6{
   padding-left: 10px;
}
   
</style>

<div class="content-body">
    <!-- Content Section Strat-->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                        <h2><strong>Sms options</strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>
                                     
                                   
                                </ul>
                            </li>
                        </ul>
                    </div>
<body> 
<h4 class="sms-heading" >SMS Settings</h4>
<div class="sms_option" >
@for($i =0; $i<sizeof($smssettinglist);$i++)
  <div class="sms_innerOption">
<label class="switch" style="display:inline-block;">
  <input value='' id='checkvalue_{{$i}}'   type="checkbox" name={{$smssettinglist[$i]->stage}}
@if($smssettinglist[$i]->decision == 'Yes')
  checked
@else
@endif
   onchange="changeit('<?= $i ?>','<?= $smssettinglist[$i]->id ?>')" >
  <span class="slider round"></span>
  </label><h6>{{$smssettinglist[$i]->stage}}</h6>
</div>
@endfor
</div>
</body>
    </div>
    </div>
    <!-- Content Section End-->
</div>

@endsection
@section('extrajs')

@endsection