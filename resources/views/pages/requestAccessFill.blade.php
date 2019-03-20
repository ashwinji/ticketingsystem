
<div class="modal-header" id="getitemtotenderdetailsss">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="ti-close"></span></button>
    <h4 class="modal-title" id="myModalLabel">Enter Site Access Request
       
    </h4>

</div>
<div class="modal-body" id="print_data">      
                      <div class="row">
                       <div class="col-md-12">                   
                  {!! Form::open(array('route' => 'savenewaccessrequest', 'class'=> 'form form-horizontal','enctype'=>'multipart/form-data', 'files'=>true)) !!}
                    {!! Form::token() !!}
                      <input type="hidden" class="form-control"  name="client_id" value= {{ $generats->client_id}} readonly>
                        <input type="hidden" class="form-control"  name="ticket_id" value= {!! $ticketnumber !!} readonly>
                        <label>Site Accessed</label>
                        <input type="text" class="form-control"  name="site_address" value="" autocomplete="off" required>
                        <br>
                       <label>Access Request Time</label>
                       {!! Form::text('acc_request_time','',array('class'=>'form-control closingd_time_datapicker', 'placeholder'=>'Request Time', 'autocomplete'=>'off','required')) !!}
                       <br>

                        <label>FE Attending</label>
                                 <select class="form-control" name="employee_id">
                                   @foreach($userlist as $row)
                                   <option value={!! $row->id !!}>{!! $row->name !!}</option>

                                   @endforeach
                                 </select><br>
                         <!-- <label>Description</label> -->
                            <input type="text" class="form-control"  name="comments" value="Access Time" style='display:none;'  >       
                    
                     <input class="btn btn-danger"  type="submit" value="submit">
                      {!! Form::close() !!}
                      <?php $report_time = $generats->reporting_time; ?>
                      <input type='hidden' id="rts4" value="{{$report_time}}"/>
                    </div>
                    
                    </div> 
        
    </div>

    <div class="modal-footer">
<!--         <button type="button" class="btn btn-primary mar-right" onclick="printDiv()">Print <i class="fa fa-print printIcon"></i></button> -->
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>

    <script type="text/javascript">
      $(document).ready(function(){
     var rts = $('#rts4').val();
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