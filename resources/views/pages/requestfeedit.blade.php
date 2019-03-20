
<div class="modal-header" id="getitemtotenderdetail">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="ti-close"></span></button>
    <h4 class="modal-title" id="myModalLabel">Update Field Enginer
       
    </h4>

</div>
<div class="modal-body" id="print_data">      
                      <div class="row">
                       <div class="col-md-12">                   
                  {!! Form::open(array('route' => 'updatefedata', 'class'=> 'form form-horizontal','enctype'=>'multipart/form-data', 'files'=>true)) !!}
                    {!! Form::token() !!}
                        {!! Form::hidden('id',$fedata->id,array('class'=>'form-control', 'placeholder'=>'Granted Time', 'autocomplete'=>'off')) !!}
                        <br>
                        <label>Opening Time</label>
                        {!! Form::text('opening_time', $fedata->opening_time ,array('class'=>'form-control closingd_time_datapicker ', 'placeholder'=>'id', )) !!}
                        <label>Site Engineer</label><br>
                         <select class="form-control" name="employee_id" class="form_control">
                          @foreach($userlist as $list)
                          <option value="{!! $list->id !!}">{!! $list->name !!}</option>
                          @endforeach
                         </select>
                        <br>
                       <label>Closing Time</label>
                       {!! Form::text('closing_time',$fedata->closing_time,array('class'=>'form-control closingd_time_datapicker', 'placeholder'=>'Request Time', 'autocomplete'=>'off')) !!}
                       <br>
                        <br>
                        <!-- <label>Comment</label> -->    
                    <input type='text' name="comments" id="comments" value="abcd" class="form-control" placeholder="Comment" autocomplete="off" style="display:none" >
                     <input class="btn btn-danger"  type="submit" value="Update">
                      {!! Form::close() !!}
                      <?php $report_time = $reportingtime->reporting_time; ?>
                      <input type='hidden' id="rts7" value="{{$report_time}}"/>
                    </div>
                    
                    </div> 
        
    </div>

    <div class="modal-footer">
<!--         <button type="button" class="btn btn-primary mar-right" onclick="printDiv()">Print <i class="fa fa-print printIcon"></i></button> -->
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>

    <script type="text/javascript">

$(document).ready(function(){
     var rts = $('#rts7').val();
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