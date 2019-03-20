
@extends('layouts.masters')
@section('content')

<style type="text/css"> 
    a.canvasjs-chart-credit{
        display: none;
    }
    .table-heading{
        background-color: #2c3644;
        color: #ffffff;
    }
    .table-heading-sub{
        background-color: lightgray; width: 50%;
    }
    .table-heading-data{
        width: 50%;
    }
    .content-space{
        padding-top:20px;
        padding-bottom: 20px;
    }
  
    
</style>
<div class="content-body">
    <!-- Content Section Strat-->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                        <h2><strong>Fault Analysis </strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i> Go To Back</a></li>

                                </ul>
                            </li>
                        </ul>
                    </div>                      
               <div class="body" id="bodyprinting">
                <div class="col-md-12">
                     <div class="table-responsive" id="fault-print-button">
                        <table class="table table-bordered table-striped">
                           <style type="text/css"> 
                    @media print {
                        .table-heading{
                        box-shadow:  inset 0 0 0 1000px #2c3644 !important;
                        color: #ffffff;
                           -webkit-print-color-adjust: exact; 
                        }
                    }
                    @media print {
                        .table-heading-sub{
                         box-shadow:  inset 0 0 0 1000px lightgray !important;
                         width: 50%;
                        }
                    }                                                 
                </style>
                            <tbody>
                               <tr>                                           
                                    <td colspan="8" class="text-center table-heading"><strong>FAULT BY CAUSE</strong></td>                
                                </tr>
                                <tr>
                                    <td colspan="4" class="table-heading-sub">Nature of Faults</td>
                                    <td colspan="4" class="table-heading-sub">Number of Faults</td>
                                </tr>

                                @foreach($faultAnalysisdata as $chartfirst)
                                <tr>
                                    <td colspan="4" class="table-heading-data">{{ $chartfirst['label'] }}</td>
                                    <td colspan="4" class="table-heading-data">{{ $chartfirst['y'] }}</td>
                                </tr>
                             @endforeach                                     
                                </tbody>
                        </table>
                   </div>
                    <button onclick="printRecord('fault-print-button')" class="btn btn-primary"><i class="fa fa-print"></i> PDF </button>
                     <button onclick="Export2Doc('fault-print-button');" class="btn btn-primary">  Export to Doc</button>
               </div>
               <div class="content-space"></div>
                    <div class="col-md-12">
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    </div>
                    <div class="content-space"></div>
                    
                    <hr>
                    <div class="col-md-12">
                        <div id="chartLine2" style="height: 370px; width: 100%;"></div>
                    </div>
                    <div class="content-space"></div>
                   
                    <hr>
                    <div class="col-md-12">
                      <div class="table-responsive " id="sla-print-button">
                         <table class="table table-bordered table-striped">
                           <style type="text/css"> 
                    @media print {
                        .table-heading{
                        box-shadow:  inset 0 0 0 1000px #2c3644 !important;
                        color: #ffffff;
                           -webkit-print-color-adjust: exact; 
                        }
                    }
                    @media print {
                        .table-heading-sub{
                         box-shadow:  inset 0 0 0 1000px lightgray !important;
                         width: 50%;
                        }
                    }                                                 
                </style>
                            <tbody>
                               <tr>                                           
                                    <td colspan="8" class="text-center table-heading" ><strong>SLA ANALYSIS
                                    </strong></td>                
                                </tr>
                                <tr>
                                    <td colspan="4" class="table-heading-sub">Time of Resolution</td>
                                    <td colspan="4" class="table-heading-sub">Number of Faults</td>
                                </tr>
                               
                                @foreach($totalcombine as $chartsecond)
                                    <tr>
                                        <td colspan="4" class="table-heading-data">{{ $chartsecond['label'] }}</td>
                                        <td colspan="4" class="table-heading-data">{{ $chartsecond['y'] }}</td>
                                    </tr>
                                @endforeach 
                               
                            </tbody>
                        </table>
                    </div>
                     <button onclick="printRecord('sla-print-button')" class="btn btn-primary"><i class="fa fa-print"></i> PDF </button>
                      <button onclick="Export2Doc('sla-print-button');" class="btn btn-primary">  Export to Doc</button>
                    </div>
                    <div class="content-space"></div>
                    <div class="col-md-12">
                        <div id="charCircleSLAanalysis" style="height: 370px; width: 100%;"></div>
                    </div>
                    <div class="content-space"></div>
                   
                    <hr>
                    <div class="col-md-12">
                         <div id="chartLineSLAanalysis" style="height: 370px; width: 100%;"></div>
                    </div>
                    <div class="content-space"></div>
                  
                    <hr>
                    <div class="col-md-12">
                        <div class="table-responsive" id="num-fault-print-button">
                         <table class="table table-bordered table-striped">
                           <style type="text/css"> 
                    @media print {
                        .table-heading{
                        box-shadow:  inset 0 0 0 1000px #2c3644 !important;
                        color: #ffffff;
                           -webkit-print-color-adjust: exact; 
                        }
                    }
                    @media print {
                        .table-heading-sub{
                         box-shadow:  inset 0 0 0 1000px lightgray !important;
                         width: 50%;
                        }
                    }                                                 
                </style>
                            <tbody>
                               <tr>                                           
                                    <td colspan="8" class="text-center table-heading" ><strong>SLA ANALYSIS
                                    </strong></td>                
                                </tr>
                                <tr>
                                    <td colspan="4" class="table-heading-sub">SLA</td>
                                    <td colspan="4" class="table-heading-sub">Number of Faults</td>
                                </tr>
                                 @foreach($finalSLAwithoutSLA as $chartthird)
                                    <tr>
                                        <td colspan="4" class="table-heading-data">{{ $chartthird['label'] }}</td>
                                        <td colspan="4" class="table-heading-data">{{ $chartthird['y'] }}</td>
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                    <button onclick="printRecord('num-fault-print-button')" class="btn btn-primary"><i class="fa fa-print"></i> PDF </button>
                     <button onclick="Export2Doc('num-fault-print-button');" class="btn btn-primary">  Export to Doc</button>
                    </div>
                    <div class="content-space"></div>
                   
                    <hr>
                    <div class="col-md-12">
                          <div id="chartLineSLANumber" style="height: 370px; width: 100%;"></div>   
                    </div>
                    <div class="content-space"></div>   
                                
                </div>
           <button onclick="Export2Doc()" class="btn btn-primary">Export to Doc</button>
        </div> 
    </div>
</div>
    <!-- Content Section End-->
</div>
  

<script>
     
window.onload = function() {
 
var chart1 = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    exportEnabled: true,
    title: {
        text: "NUMBER OF FAULTS"
    },
    subtitles: [{
        text: ""
    }],
    data: [{
        type: "pie",
        yValueFormatString: "#,##0\"\"",
        indexLabel: "{label} ({y})",
        dataPoints: <?php echo json_encode($faultAnalysisdata, JSON_NUMERIC_CHECK); ?>
    }]
});
chart1.render();


var chart2 = new CanvasJS.Chart("chartLine2", {
    animationEnabled: true,
    theme: "light2",
    exportEnabled: true,
    title:{
        text: "NATURE OF FAULTS"
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
        yValueFormatString: "#,##0.## Faults",
        dataPoints: <?php echo json_encode($faultAnalysisdata, JSON_NUMERIC_CHECK); ?>
    }]
});
chart2.render();


var chart3 = new CanvasJS.Chart("charCircleSLAanalysis", {
    animationEnabled: true,
    exportEnabled: true,
    title: {
        text: "SLA ANALYSIS"
    },
    subtitles: [{
        text: ""
    }],
    data: [{
        type: "pie",
        yValueFormatString: "#,##0\"\"",
        indexLabel: "{label} ({y})",
        dataPoints: <?php echo json_encode($totalcombine, JSON_NUMERIC_CHECK); ?>
    }]
});
chart3.render();

var chart4 = new CanvasJS.Chart("chartLineSLAanalysis", {
    animationEnabled: true,
    theme: "light2",
    exportEnabled: true,
    title:{
        text: "SLA ANALYSIS"
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
        yValueFormatString: "#,##0.## ",
        dataPoints: <?php echo json_encode($totalcombine, JSON_NUMERIC_CHECK); ?>
    }]
});
chart4.render();

 var chart5 = new CanvasJS.Chart("chartLineSLANumber", {
    animationEnabled: true,
    theme: "light2",
    exportEnabled: true,
    title:{
        text: "SLA ANALYSIS Number of Faults"
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
        yValueFormatString: "#,##0.## ",
        dataPoints: <?php echo json_encode($finalSLAwithoutSLA, JSON_NUMERIC_CHECK); ?>
    }]
});
chart5.render();
      
}


 function Export2Doc($divname){
                var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
                var postHtml = "</body></html>";
                var html = preHtml+document.getElementById($divname).innerHTML+postHtml;
                var blob = new Blob(['\ufeff', html], {
                    type: 'application/msword'
                });
                
                // Specify link url
                var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
                
                // Specify file name
                filename ='FAULT_Analysis_Report.doc';
                
                // Create download link element
                var downloadLink = document.createElement("a");

                document.body.appendChild(downloadLink);
                
                if(navigator.msSaveOrOpenBlob ){
                    navigator.msSaveOrOpenBlob(blob, filename);
                }else{
                    // Create a link to the file
                    downloadLink.href = url;
                    
                    // Setting the file name
                    downloadLink.download = filename;
                    
                    //triggering the function
                    downloadLink.click();
                }                
                document.body.removeChild(downloadLink);
            }

</script>
<script>
    function Export2Doc(filename = ''){
                var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
                var postHtml = "</body></html>";
                var html = preHtml+document.getElementById('bodyprinting').innerHTML+postHtml;
                //var tktid = document.getElementById('docprinttktid').value;
                var blob = new Blob(['\ufeff', html], {
                    type: 'application/msword'
                });
                
                // Specify link url
                var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
                
                // Specify file name
                filename = 'Fault_Analysis_Report.doc';
                
                // Create download link element
                var downloadLink = document.createElement("a");

                document.body.appendChild(downloadLink);
                
                if(navigator.msSaveOrOpenBlob ){
                    navigator.msSaveOrOpenBlob(blob, filename);
                }else{
                    // Create a link to the file
                    downloadLink.href = url;
                    
                    // Setting the file name
                    downloadLink.download = filename;
                    
                    //triggering the function
                    downloadLink.click();
                }
                
                document.body.removeChild(downloadLink);
            }
</script>

@endsection
@section('extrajs')

@endsection
