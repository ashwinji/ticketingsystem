
<div class="modal-header" id="getitemtotenderdetail">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="ti-close"></span></button>
    <h4 class="modal-title" id="myModalLabel">Update Security Time
       
    </h4>

</div>
<div class="modal-body" id="print_data">
            <div class="row">
                <div class="col-md-12">
                  
               {!! Form::open(array('route' => 'savesecurityescortmodeldata', 'class'=> 'form form-horizontal','enctype'=>'multipart/form-data', 'files'=>true)) !!}
                    {!! Form::token() !!}             
                <input type="hidden" class="form-control"  name="id" value="{{ $data->id }}" >
                <input type="hidden" class="form-control"  name="ticket_id" value="{{ $data->ticket_id }}" >
                <label>Link Affected</label>
                <input type="text" class="form-control"  name="link_affected" value='{{ $data2->link_affected }}' autocomplete="off" readonly>
                <br>
               <label>Security Request Time</label>
               {!! Form::text('escort_request_time',$data->escort_request_time,array('class'=>'form-control closingd_time_datapicker', 'placeholder'=>'Request Time', 'autocomplete'=>'off')) !!}
               <br>
                <label>Security Granted Time</label>
                {!! Form::text('escort_granted_time',$data->escort_granted_time,array('class'=>'form-control closingd_time_datapicker', 'placeholder'=>'Granted Time', 'autocomplete'=>'off')) !!}
                <br>
                <!-- <label>Comment</label> -->
                <input type="text" class="form-control"  name="comments" value="Escort Time" style="display:none;" >                      
            <input class="btn btn-danger"   type="submit" value="Update">
           {!! Form::close() !!}
           <?php $report_time = $data2->reporting_time; ?>
                      <input type='hidden' id="rts3" value="{{$report_time}}"/>
           
            </div>                    
            </div>       
    </div>
    <div class="modal-footer">
       <!--  <button type="button" class="btn btn-primary mar-right" onclick="printDiv()">Print <i class="fa fa-print printIcon"></i></button> -->
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
     var rts = $('#rts3').val();
 $(".closingd_time_datapicker").datetimepicker({
         
        format: "yyyy-mm-dd hh:ii",
        autoclose: true,
        todayBtn: true,
        startDate: rts,  
        minuteStep: 10
    });
  });




    var d = new Date($.now());
    var desiredformats = d.getFullYear()+"-"+(d.getMonth() + 1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes();
    $(".closing_time_datapicker").datetimepicker({
        format: "yyyy-mm-dd hh:ii",
        autoclose: true,
        todayBtn: true,
        startDate: desiredformats,
        minuteStep: 10
    });

</script>    