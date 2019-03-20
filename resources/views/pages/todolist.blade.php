
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
                        <h2><strong>To Do List</strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>
                                    <li><a href="{{ route('create-todo') }}">Create To Do</a></li>
                                    
                                </ul>
                            </li>
                        </ul>
                    </div> 
	
<div class="container dynamic-csv">
	<div class="row">
	

        
		@if(Request::segment(2)==='edit-todo'|| Request::segment(2)==='create-todo')
		 <?php
       if(isset($datarow))
		 
           {
            $request_id=$datarow['id'];
            $task_dtl = $datarow['task_dtl'];
            $scheduled_date = $datarow['scheduled_date'];
            
           }
           else
           {

            $request_id='';
            $task_dtl = '';
            $scheduled_date = '';
            
           }

          
            ?>

		
		
	<div class="col-md-12">


 {!! Form::open(array('route' => 'save-todo-list','method'=>'GET' ,'class'=> 'form form-horizontal','enctype'=>'multipart/form-data', 'files'=>true)) !!}
        {!! Form::token() !!}          
  
 {!! Form::hidden('request_id',$request_id,array('class'=>'form-control', 'placeholder'=>'To Do', 'autocomplete'=>'off')) !!}

 <div class="col-md-12" style="clear: both;">
	<label>To Do :</label>
                       {!! Form::textarea('task_dtl',$task_dtl,array('class'=>'form-control', 'placeholder'=>'To Do', 'autocomplete'=>'off','id'=>'task_dtl','required','rows'=>2)) !!}
                       <br>
<label>Scheduled Date :</label>
                      {!! Form::text('scheduled_dt',$scheduled_date,array('class'=>'form-control closingd_time_datepicker', 'placeholder'=>'Scheduled date','id'=>'scheduled_dt' ,'autocomplete'=>'off','required')) !!}
	



<div class="col-md-12 text-center">
	<input class="btn btn-primary"   type="submit" value="Submit">
</div>

 {!! Form::close() !!}

</div>
</div>


@else
<div class="table-responsive">
                         
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                   <!--  <th></th> -->
                                    <th>To Do</th>
                                    <th>Scheduled date</th>
                                    <th>Status</th>
							        <th width="5%">Action</th>
                                </tr>                              
                            </thead>
                            <tbody>
                            	@foreach($todolst as $row)
                                <tr>
                                	<td>{{$row->task_dtl}}</td>
                                	<td>{{$row->scheduled_date}}</td>
                                	<td>{{$row->status}}</td>
                                	<td>
                                		<div class="btn-group btn-group-xs">
                                        <a href="{{ route('edit-todo',$row->id) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="Update{{ $row->id}}"><i class="fa fa-pencil"></i></a>    
                                        &nbsp;&nbsp;
                                        <a onclick="return ConfirmDelete()" href="{{ route('delete-todo',array('id'=>$row->id)) }}" class="btn btn-sm btn-orange btn-icon-primary tooltips" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>    
                                        </div>


                                	</td>

                                </tr>
                               
                                @endforeach
                            </tbody>
                        </table>
                      
                     
                    </div>
                   
@endif

</div>
	
<script type="text/javascript">

     $(document).ready(function(){
     
 $(".closingd_time_datepicker").datetimepicker({
         
        format: "yyyy-mm-dd hh:ii",
        autoclose: true,
        todayBtn: true,
        minuteStep: 10
    });
  });

	</script>	

	
	
@endsection
 @section('extrajs') 

@endsection