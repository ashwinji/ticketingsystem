<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Websitesetting;
use infobip\api\client\SendSingleTextualSms;
use infobip\api\configuration\BasicAuthConfiguration;
use infobip\api\model\sms\mt\send\textual\SMSTextualRequest;
use DateTime;
use Carbon\Carbon;
use App\Http\HttpRequests;
use Illuminate\Routing\Controller;
use anlutro\cURL\cURL; 

class BalanceController extends Controller
{
    public function getbalance(Request $request)
    {

$getSMSInfo = Websitesetting::select('sms_username','sms_passwrd')->first();
$username = $getSMSInfo->sms_username;
$password = $getSMSInfo->sms_passwrd;
$header = "Basic " . base64_encode($username . ":" . $password);
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://d4wl8.api.infobip.com/account/1/balance");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

$headers = array();
$headers[] = "Accept: application/json";
$headers[] = "Authorization: ".$header;
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);

$balancedetails = json_decode($result, true);
   
 	return view('pages.smsbalance',compact('balancedetails'));
    }
}
