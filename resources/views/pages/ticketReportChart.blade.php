
@extends('layouts.masters')
@section('content')

<div class="content-body">
    <!-- Content Section Strat-->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                        <h2><strong>MTTR for FEs </strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>                      
                <div class="body">

                    <div class="row clearfix">                        
                      <div class="col-md-12">
                        {!! Form::open(array('route' => 'ticket-report-FEchart', 'method'=>'get','class'=> 'form form-horizontal','enctype'=>'multipart/form-data', 'files'=>true)) !!}
                        {!! Form::token() !!}

                        <div class="col-md-6">
                            <label for="fromdate"> From Date</label>
                            {!! Form::text('fromdate','',array('id'=>'fromdate','class'=>'form-control from_date_datapicker', 'placeholder'=>'From Time', 'autocomplete'=>'off','required')) !!}
                        </div>
                         <div class="col-md-6">
                            <label for="todate"> To Date</label>
                            {!! Form::text('todate','',array('id'=>'todate','class'=>'form-control to_date_datapicker', 'placeholder'=>'To Date', 'autocomplete'=>'off','required')) !!}
                        </div>

                        <div class="col-md-12 ">
                            <hr>
                            {!! Form::submit('Submit', array('class'=>'btn btn-primary')) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>

                    </div>                     
                    @if($dataPoints)
                    <div class="row clearfix">  
                         <div class="col-lg-12 col-md-12">
                            <div  id="chartContainer" style="height: 370px; width: 100%;"></div>
                         </div>            
                    </div>
                    
                    @endif

                       @if($dataPointsTotalCount)
                        <div class="row clearfix">  
                           <div class="col-lg-12 col-md-12">
                              <div  id="chartContainer2" style="height: 370px; width: 100%;"></div>
                           </div>            
                        </div>
                         
                        @endif
                </div>
                </div>
          
        </div>
    </div>
</div>
    <!-- Content Section End-->
</div>
    <!-- second Coloum chart code  -->    
    <script type="text/javascript">
    $(".from_date_datapicker").datetimepicker({
        format: "yyyy-mm-dd hh:ii"
    });
    $(".to_date_datapicker").datetimepicker({
        format: "yyyy-mm-dd hh:ii"
    });
   </script> 
     <script type="text/javascript">
            window.onload = function() {                                 
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2",
                exportEnabled: true,
                interactivityEnabled: false,
                title:{
                    text: "AVERAGE MTTR FOR FIELD ENGINEERS"
                },
                axisY: {
                    title: "Hours",
                    intervalType: "hour"
                },
                data: [{
                    indexLabel: "{y}",
                    indexLabelPlacement: "outside",
                    indexLabelOrientation: "horizontal",
                    indexLabelFontColor: "#2c2c2c",
                    indexLabelFontSize: 15,
                    type: "column",
                    yValueFormatString: "#,##0.00## Hr.Min",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

            var chart2 = new CanvasJS.Chart("chartContainer2", {
                animationEnabled: true,
                theme: "light2",
                exportEnabled: true,
                title:{
                    text: "FAULT COUNT FOR FIELD ENGINEERS"
                },
                axisY: {
                    title: ""
                },
                data: [{
                    indexLabel: "{y}",
                    indexLabelPlacement: "outside",
                    indexLabelOrientation: "horizontal",
                    indexLabelFontColor: "#2c2c2c",
                    indexLabelFontSize: 15,
                    type: "column",
                    yValueFormatString: "#,##0.##",
                    dataPoints: <?php echo json_encode($dataPointsTotalCount, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart2.render();
               
            }

            </script>


@endsection
@section('extrajs')

@endsection
