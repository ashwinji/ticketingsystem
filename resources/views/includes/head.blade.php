<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> <!--320-->
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/images/favicon.ico') }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/images/favicon.ico') }}">

<title>{{$webSetting->website_name}}</title>
<meta name="_token" content="{{ csrf_token() }}">
{!! Html::script('assets/js/jquery.min.js') !!}
{!! Html::style('assets/plugins/bootstrap/css/bootstrap.min.css') !!}
{!! Html::style('assets/plugins/morrisjs/morris.css') !!}
{!! Html::style('assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css') !!}
{!! Html::style('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') !!}
{!! Html::style('assets/css/main.css') !!}
{!! Html::style('assets/css/color_skins.css') !!}
{!! Html::style('assets/css/custom.css') !!}
{!! Html::style('assets/fonts/font-awesome/css/font-awesome.min.css') !!}
{!! Html::style('assets/plugins/bootstrap-select/css/bootstrap-select.css') !!}
{!! Html::script('assets/bundles/libscripts.bundle.js') !!}

{!! Html::style('css/bootstrap-datetimepicker.min.css') !!}
{!! Html::script('js/bootstrap-datetimepicker.min.js') !!}



<style type="text/css">
  .datetimepicker{
    width: 230px;
  }

</style>

  <script>
    setIdleTimeout(<?= 1000*60*($webSetting->locktimeout); ?>, function() {
    window.location.href = '<?= URL::to('/screenlock'); ?>/<?= time();?>/<?= $email = Auth::user()->id; ?>/<?= MD5(str_random(10)) ?>';
    }, function() {});
    
    function setIdleTimeout(millis, onIdle, onUnidle) {
        var timeout = 0;
        $(startTimer);

    function startTimer() {
        timeout = setTimeout(onExpires, millis);
        $(document).on("mousemove keypress", onActivity);
    }
    
    function onExpires() {
        timeout = 0;
        onIdle();
    }

    function onActivity() {
        if (timeout) clearTimeout(timeout);
        else onUnidle();
        $(document).off("mousemove keypress", onActivity);
        setTimeout(startTimer, 1000);
    }
}

function checkAll(source) {
    checkboxes = document.getElementsByName('boxchecked[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
    }
  }
  function delrec(typ)
  {
    if(typ!="")
    {
      var prod;
      prod=false;
      prod=window.confirm("Are you sure you want to "+ typ +" selected Records?")
      if (prod==true)
      {
        var checkedCount = $("input[type=checkbox][name^=boxchecked]:checked").length;
        if (checkedCount == 0) {
          alert ("You must check atleast one checkbox!");
          return false;
        }
        return true;
        submitbutton('remove')
      }
      else
      {
        return false;
      }
    }
    else
    {
      return false; 
    }
  }

</script>
<script>   
// this function for print full page record.    
function printRecord(el){
var restorepage = $('body').html();
var printcontent = $('#' + el).clone();
$('body').empty().html(printcontent);
window.print();
window.location.reload();
//$('body').html(restorepage);
}
</script> 




