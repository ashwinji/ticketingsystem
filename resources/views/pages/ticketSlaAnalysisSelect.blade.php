 @extends('layouts.masters')
@section('content')

<div class="content-body">
    <!-- Content Section Strat-->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                        <h2><strong> Fault Analysis </strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                  <div class="body">
          
                <?php $region_id=''; 
                      $client_id = '';
                ?>
                  <div class="row clearfix">                        
                      <div class="col-md-12">
                        {!! Form::open(array('route' => 'ticket-report-faultAnalysisView','class'=> 'form form-horizontal','enctype'=>'multipart/form-data', 'files'=>true)) !!}
                        {!! Form::token() !!}
                        <div class="col-md-6">
                        <label for="clientid"> Clients </label> 
                        {{ Form::select('client_id',array_merge(['0' => 'All Clients'], $allclients),
                            $client_id,array('class' => 'form-control','id' => 'client_id'
                            )) }}

                        </div>                        
                        <div class="col-md-6">
                        <label for="fromdate"> From Date</label>
                            {!! Form::text('fromdate','',array('id'=>'fromdate','class'=>'form-control from_date_datapicker', 'placeholder'=>'From Time', 'autocomplete'=>'off','required')) !!}
                        </div>
                        <div class="col-md-6">
                            <label for="todate"> To Date</label>
                            {!! Form::text('todate','',array('id'=>'todate','class'=>'form-control to_date_datapicker', 'placeholder'=>'To Date', 'autocomplete'=>'off','required')) !!}
                        </div>

                        <div class="col-md-12">
                            <label for="name"> Region</label> 
                         {{ Form::select('region_id',array_merge(['all' => 'All Region'], $regions),
                            $region_id,array('class' => 'form-control','id' => 'myselect'
                            )) }}
                        </div>

                        <div class="col-md-12 ">
                            <hr>
                            {!! Form::submit('Submit', array('class'=>'btn btn-primary')) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>

                    </div> 
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