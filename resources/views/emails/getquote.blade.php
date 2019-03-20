
<?php  
  $getWebsiteInfo = App\Websitesetting::first();
?>

<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>{{$getWebsiteInfo->website_name}}</title>
<style type="text/css">
a:hover {
     text-decoration: underline !important;
}
</style>
</head>
<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f5511d;" bgcolor="#f5511d" leftmargin="0">
<!--100% body table-->
<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f5511d" style="padding-bottom: 30px;">
  <tr>
    <td><!--header-->
      <table style="background-color: #fffdf9; margin-top: 30px;" width="684" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top" width="2"></td>
                <td valign="middle" width="664"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="31"></td>
                    </tr>
                    <tr>
                      <td><h1 style="color: #333; margin-top: 0px; margin-bottom: 0px; font-weight: normal; font-size: 34px; font-family: Georgia, Times New Roman, Times, serif" align="center">Newrise Technosays Pvt.ltd</h1></td>
                    </tr>
                    <tr>
                      <td height="40"></td>
                    </tr>
                  </table>
                  <!--date-->
                  <table width="98%" border="0" cellpadding="0" cellspacing="0" style="margin-left:15px;">
                    <tr>
                      <td width="89" height="42" align="center" valign="top" bgcolor="#014689"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr>
                            <td height="5"><p style="font-size: 24px; font-family: Georgia, Times New Roman, Times, serif; color: #ffffff; margin-top: 5px; margin-bottom: 0px;" align="center">
                                <currentmonthname>
                                <?php echo date('d/m/Y') ?>
                                <currentyear>
                              </p></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                  <!--/date-->
                </td>
                <td width="18"></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <!--/header-->
      <!--email container-->
      <table bgcolor="#fffdf9" cellspacing="0" border="0" align="center" cellpadding="30" width="684">
        <tr>
          <td><!--email content-->
            <table cellspacing="0" border="0" id="email-content" cellpadding="0" width="624">
              <tr>
                <td><!--section 1-->
                  <table cellspacing="0" border="0" cellpadding="0" width="100%">
                    <tr>
                      <td valign="top" align="center"><!--line break-->
                        <table width="100%" border="0">
                          <tr>
                            <td width="15%"><h1 style="font-size: 14px; font-weight: normal; font-family: Georgia, Times New Roman, Times, serif; color: #333333; margin-top: 0px; text-align:left;"> Name</h1></td>
                            <td><h1 style="font-size: 14px; font-weight: normal; font-family: Georgia, Times New Roman, Times, serif; color: #333333; margin-top: 0px; text-align:left;">{{ $content['name']}}</h1></td>
                          </tr>
                          <tr>
                            <td width="15%"><h1 style="font-size: 14px; font-weight: normal; font-family: Georgia, Times New Roman, Times, serif; color: #333333; margin-top: 0px; text-align:left;">Mobile</h1></td>
                            <td><h1 style="font-size: 14px; font-weight: normal; font-family: Georgia, Times New Roman, Times, serif; color: #333333; margin-top: 0px; text-align:left;">{{$content['mobile']}}</h1></td>
                          </tr
                          <tr>
                            <td><h1 style="font-size: 14px; font-weight: normal; font-family: Georgia, Times New Roman, Times, serif; color: #333333; margin-top: 0px; text-align:left;">Email</h1></td>
                            <td><h1 style="font-size: 14px; font-weight: normal; font-family: Georgia, Times New Roman, Times, serif; color: #333333; margin-top: 0px; text-align:left;">{{ $content['email']}}</h1></td>
                          </tr>

                          
                          <tr>
                            <td><h1 style="font-size: 14px; font-weight: normal; font-family: Georgia, Times New Roman, Times, serif; color: #333333; margin-top: 0px; text-align:left;">Company Name</h1></td>
                            <td><h1 style="font-size: 14px; font-weight: normal; font-family: Georgia, Times New Roman, Times, serif; color: #333333; margin-top: 0px; text-align:left;">{{ $content['companyName']}}</h1></td>
                          </tr>
                          
                      
                               <tr>
                            <td><h1 style="font-size: 14px; font-weight: normal; font-family: Georgia, Times New Roman, Times, serif; color: #333333; margin-top: 0px; text-align:left;">Message</h1></td>
                            <td><h1 style="font-size: 14px; font-weight: normal; font-family: Georgia, Times New Roman, Times, serif; color: #333333; margin-top: 0px; text-align:left;">{{ $content['message']}}</h1></td>
                          </tr>
                         
                          
                        </table></td>
                    </tr>
                  </table>
                  <!--/section 1-->
                  <!--line break-->
                  <table cellspacing="0" border="0" cellpadding="0" width="100%">
                    <tr>
                      <td height="5"><br>
                        <div style="border-bottom:1px solid #000; padding-top:15px;"></div></td>
                    </tr>
                    <tr>
                      <td height="20"></td>
                    </tr>
                  </table>
                  <table cellspacing="0" border="0" cellpadding="0" width="100%">
                    <tr>
                      <td><!--line break-->
                        <table cellspacing="0" border="0" cellpadding="0" width="100%">
                          <tr>
                            <td valign="top" width="450"><h1 style="font-size: 24px; font-family: Georgia, Times New Roman, Times, serif; color: #333333; margin-top: 0px; margin-bottom: 12px;">{{$getWebsiteInfo->website_name}}
                            <h4 style="margin-top:0px; margin-bottom:0px;">
                            {{$getWebsiteInfo->address}}<br>
                                  
                            {{$getWebsiteInfo->mobilenum}}
                            </h4></h1>
                              <p style="font-size: 16px; line-height: 22px; font-family: Georgia, Times New Roman, Times, serif; color: #333; margin: 0px;"><a style="color: blue; text-decoration: none;" href="http://nrtsms.com/">http://nrtsms.com/</a><br>
                              </p></td>
                            <td valign="top" width="174"><img src="{{$getWebsiteInfo->website_logo}}"  height="150" width="150"/> </td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                  <!--/section 3-->
                </td>
              </tr>
            </table>
            <!--/email content-->
          </td>
        </tr>
      </table>
      <!--/email container-->
    </td>
  </tr>
</table>
</body>
</html>
