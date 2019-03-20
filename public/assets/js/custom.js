$(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-Token': $('meta[name="_token"]').attr('content')
    }
  });
});


$(document).ready(function() {
  $('[data-toggle="tooltip"]').tooltip({
      trigger : 'hover'
  })  
  
	$("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
		e.preventDefault();
		$(this).siblings('a.active').removeClass("active");
		$(this).addClass("active");
		var index = $(this).index();
		$("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
		$("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
	});
});


function setCookiesTheme(getClass)
{
	var name = getClass;
    $.ajax({
      url: appurl+"setCookiesTheme",
      type: 'POST',
      data: "name="+name,  
      success:function(info){
        console.log('Set Color');
      }
    });
}

   $(document).on("click", "#getitemtotenderdetailid", function () { 
  $('#showDetails').hide();
  $('.loading').show();
  var id = $(this).data('id');
  $.ajax({
    url: appurl+"getmodeldata",
    type: 'POST',
    data: "id="+id,  
    success:function(info){
      $('#showDetails').html(info);
      $('.loading').hide();
      $('#showDetails').show();
    }
  });
}); 


 $(document).on("click", "#securityescortmodalid", function () {

  
  $('#showDetailssecurity').hide();
  $('.loading').show();
  var id = $(this).data('id');
  var ticketid = $(this).data('ticket-id')

  $.ajax({
    url: appurl+"getsecurityescortmodeldata",
    type: 'POST',
    data:"id="+id+"_"+ticketid,
    //data:"ticketid="+ticketid,  
    success:function(info){
      $('#showDetailssecurity').html(info);
      $('.loading').hide();
      $('#showDetailssecurity').show();
    }
  });
});


 $(document).on("click", "#insertaccessmodalid", function () {
  $('#fillDetailsaccess').hide();
  $('.loading').show();
  var id = $(this).data('id');
  //alert(id);
  $.ajax({
    url: appurl+"getaccessinsertmodaldata",
    type: 'POST',
    data:"id="+id,
    success:function(info){
      $('#fillDetailsaccess').html(info);
      $('.loading').hide();
      $('#fillDetailsaccess').show();
    }
  });
});



 $(document).on("click", "#insertescortrequestmodalid", function () {
  $('#fillDetailsescort').hide();
  $('.loading').show();
  var id = $(this).data('id');
  // alert(id);
  $.ajax({
    url: appurl+"getescortinsertmodaldata",
    type: 'POST',
    data:"id="+id,
    success:function(info){
      $('#fillDetailsescort').html(info);
      $('.loading').hide();
      $('#fillDetailsescort').show();
    }
  });
});


 $(document).on("click", "#editfeid", function () {

  $('#filleditfe').hide();
  $('.loading').show();
  var id = $(this).data('id');
  //alert(id);
  $.ajax({
    url: appurl+"geteditfedata", 
    type: 'POST',
    data:"id="+id,
    success:function(info){
      $('#filleditfe').html(info);
      $('.loading').hide();
      $('#filleditfe').show();
    }
  });
});


/* Now here the below code is for fault report generate */

function rightside()
  {
    var txt = $("#first option:selected").text();
    var vals = $("#first option:selected").val();
        var option = document.createElement('option');
        option.value = vals;
        option.text = txt;        
      $("#second").append(option);
      var pr = $('#third').val();
      $('#third').val(pr+vals+",");
  }
function leftside()
  {
    var valss = $("#second option:selected").val();
    var originalstring = $('#third').val();
    var updatedString = originalstring.replace(valss+',',"");
    $('#third').val(updatedString);
        $('#second option:selected').remove();
        
        
  }
 function addall()
  {
      var $options = $("#first > option").clone();
      $('#second').append($options);
      var values = $.map($('#first option'), function(e) { return e.value; });
      values = ','+values+',';
      $('#third').val(values);
         
  }
  function removeall()
  {
    $('#second').find('option').remove().end();
        $('#third').val(',');

  }


  $('#clientid').on('change', function(e){
    var clientid = e.target.value;
    $.ajax({
      url: appurl+"fault-report",
      type: "POST",
      data: "clientid="+clientid,  
      success:function(info){
        $('#regionselect').html(info);
      }
    });
  });
  function moveup()
    {
      $('input[type="button"]').click(function(){
            var $op = $('#second option:selected'),
               $this = $(this);
             if($op.length){
                 ($this.val() == 'Up') ? 
                    $op.first().prev().before($op) : 
                    $op.last().next().after($op);
                  }
            });
    }

 

   function changeit(arg,stg)
{
       
       var stag = stg;
   if ($('#checkvalue_'+arg).is(":checked"))
    {  var checkedvl = 'Yes';   }
 else
   {   var checkedvl = 'No'; }
   
      $.ajax({
        url:appurl+"modifysmssetting",
        type: 'POST',
         data: { checkedvl:checkedvl,
                 stag:stag
               }, 
        success:function(info){
           
        }
      });
}

    //script for fault report generation overs here


    function ConfirmDelete()
  {
    
  var x = confirm("Are you sure you want to delete?");
  if (x)
    return true;
  else
    return false;
  }