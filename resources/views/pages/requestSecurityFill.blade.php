
<div class="modal-header" id="getitemtotenderdetailsy">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="ti-close"></span></button>
    <h4 class="modal-title" id="myModalLabel">Fill Security Time
       
    </h4>

</div>
<div class="modal-body" id="print_data">
            <div class="row">
                <div class="col-md-12">
                  
               {!! Form::open(array('route' => 'savenewsecurityrequest', 'class'=> 'form form-horizontal','enctype'=>'multipart/form-data', 'files'=>true)) !!}
                    {!! Form::token() !!}   
                    <input type="hidden" class="form-control"  name="client_id" value= {{ $generats->client_id}} readonly>          
                <input type="hidden" class="form-control"  name="ticket_id" value={!! $ticketnumber !!} required>
                <label>Link Affected</label>
                <input type="text" class="form-control"  name="link_affected" value="{{ $linkaffected->link_affected }}" readonly="">
                <br>
               <label>Security Request Time</label>
               {!! Form::text('escort_request_time','',array('class'=>'form-control closingd_time_datapicker', 'placeholder'=>'Request Time', 'autocomplete'=>'off')) !!}
               <br>

               <label>FE Attending</label>
                                 <select class="form-control" name="employee_id">
                                   @foreach($userlist as $row)
                                   <option value={!! $row->id !!}>{!! $row->name !!}</option>

                                   @endforeach
                                 </select><br>
                <!-- <label>Description/Fault points/Findings </label>-->
                                      <input type="text" class="form-control"  name="comments" value="Escort time" style="display:none;" >                       
            <input class="btn btn-danger"   type="submit" value="Submit">
           {!! Form::close() !!}
           <?php $report_time = $generats->reporting_time; ?>
                      <input type='hidden' id="rts5" value="{{$report_time}}"/>
            </div>                    
            </div>       
    </div>
    <div class="modal-footer">
       <!--  <button type="button" class="btn btn-primary mar-right" onclick="printDiv()">Print <i class="fa fa-print printIcon"></i></button> -->
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>

    <script type="text/javascript">
       $(document).ready(function(){
     var rts = $('#rts5').val();
 $(".closingd_time_datapicker").datetimepicker({
         
        format: "yyyy-mm-dd hh:ii",
        autoclose: true,
        todayBtn: true,
        startDate: rts,  
        minuteStep: 10
    });
  });
    // var d = new Date($.now());
    // var desiredformats = d.getFullYear()+"-"+(d.getMonth() + 1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes();

    // $(".closing_time_datapicker").datetimepicker({
    //     format: "yyyy-mm-dd hh:ii",
    //     autoclose: true,
    //     todayBtn: true,
    //     startDate: desiredformats,
    //     minuteStep: 10
    // });

</script>    