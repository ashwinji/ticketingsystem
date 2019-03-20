
@extends('layouts.masters')
@section('content')
		
	<style type="text/css">
		.dynamic-csv{
			margin-top: 30px;
		}
		.dynamic-csv .function_button{
			float:left; clear: both;  padding-top: 70px;
		}
		.dynamic-csv .function_button input{
			cursor:pointer; width:70%;  margin: 10px 0px;
		}
		.dynamic-csv .csv_field{
			float:left; clear: both;
		}
		.dynamic-csv .csv_field label{
			width: 70%;
		}
		.dynamic-csv .csv_field select#second.form-group{
			min-width:70%;
		}
		.dynamic-csv .csv_field ul{
			float: right; list-style-type: none; padding-top: 110px;
		}
		.dynamic-csv .csv_field ul li input{
			cursor:pointer; width: 100%; margin: 10px 0px;
		}	
		.dynamic-csv .allCsvfields label{
		    width: 100%;
		    background-color: #313740;
		    color: white;
		    padding: 5px;
		    margin-bottom: 0px;
		}
		.dynamic-csv .csv_field label{
		    width: 65%;
		    background-color: #313740;
		    color: white;
		    padding: 5px;
		    margin-bottom: 0px;
		}
		
		select.secondSelectoption{
			opacity: 1 !important;
			width: 100% !important;
			height: auto !important;
			left: 0px!important;
			position: relative!important;
		}
		.dynamic-csv .secondSelectoption .btn.dropdown-toggle{
			display: none;
		}
		.dynamic-csv .bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
    width: 65%;
}

	</style>

<div class="content-body">
    <!-- Content Section Strat-->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                        <h2><strong>Fault Reports</strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div> 
	
<div class="container dynamic-csv">
	<div class="row">
		
	<div class="col-md-12">
 {!! Form::open(array('route' => 'showfaultreportlist','method'=>'post', 'class'=> 'form form-horizontal','enctype'=>'multipart/form-data', 'files'=>true)) !!}
        {!! Form::token() !!}          
  

<div class="col-md-12" style="clear: both;">
	Clients <br>
	<select name="clientid" id="clientid"  >
		<option value="0">--Select--</option>
		<option value="allclients">All Clients</option>
		@foreach($clientlist as $row)
		<option value="{!! $row->id !!}">{!! $row->name !!}</option>
		@endforeach
	</select><br>
	Region <br>
	<div id="regionselect" class="dynamic-csv">
    </div>
	<br>

<label>Date Greater Than : </label>
{!! Form::text('startdate','2018-11-22',array('class'=>'form-control from_date_datapicker', 'placeholder'=>'Request Time', 'autocomplete'=>'off','required')) !!}
<br>
<label>Date Less than : </label>
{!! Form::text('enddate','2018-11-26 14:01:04',array('class'=>'form-control to_date_datapicker', 'placeholder'=>'Request Time', 'autocomplete'=>'off','required')) !!}


<div class="col-md-12 text-center">
	<input class="btn btn-primary"   type="submit" value="Submit">
</div>

 {!! Form::close() !!}

</div>
</div>
</div>
	
<script type="text/javascript">

    $(".from_date_datapicker").datetimepicker({
        format: "yyyy-mm-dd hh:ii"
    });
     $(".to_date_datapicker").datetimepicker({
        format: "yyyy-mm-dd hh:ii"
    });


	</script>	

	
	
@endsection
 @section('extrajs') 

@endsection