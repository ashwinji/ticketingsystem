<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Websitesetting;
use Input;
use Auth;
use Session;
use DB;
use Lang;
use App\Sms;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class WebsiteController extends Controller
{
  function __construct()
  {
    $this->middleware('permission:app-setting');
  }
  
  public function websitesetting()
  {
    $websitesetting = Websitesetting::first();
    return View('pages.websitesetting',compact('websitesetting'));
  }

  public function websitesettingupdate(Request $request)
  {
    $data  = \Input::all();
    $fileName = str_slug($request->website_name);
    if(!empty($data['website_logo']))
    {
      $destinationPath    = 'assets/images/';
      if($request->old_logo!='')
      {
          if(file_exists($destinationPath.$request->old_logo)){ 
              unlink($destinationPath.$request->old_logo);
          }
      }
      $image_file         = \Input::file('website_logo');
      $image_name         = $image_file->getClientOriginalName();
      $image              = value(function() use ($image_file, $fileName)
      {
        $filename = $fileName. '.' . $image_file->getClientOriginalExtension();
        return strtolower($filename);
      });
      \Input::file('website_logo')  ->move($destinationPath, $image);
      $logoname = $image;
    }
    else
    {
      $logoname = $data['old_logo'];
    }

    $datavalue = array(
      'website_name'      => $data['website_name'],
      'email'             => $data['email'],
      'locktimeout'       => $data['locktimeout'],
      'address'           => $data['address'],
      'mobilenum'         => $data['mobilenum'],
      'website_logo'      => $logoname,
      'openingTime'       => $data['openingTime'],
      'fb_link'           => $data['fb_link'],
      'tw_link'           => $data['tw_link'],
      'li_link'           => $data['li_link'],
      'yt_link'           => $data['yt_link'],
      'in_link'           => $data['in_link'],
      'gp_link'           => $data['gp_link'],
      'ga'                => $data['ga'],
      'sms_username'      => $data['sms_username'],
      'sms_senderid'      => $data['sms_senderid'],
      'sms_passwrd'       => $data['sms_passwrd'],
      'sms_message'       => $data['sms_message'],
      'sms_after_four_hr' => $data['sms_after_four_hr'],
      'sms_after_resolution' => $data['sms_after_resolution'],
      'sla_escalation_3hrs_sms' => $data['sms_after_everyhour'],

    );
    $check = 0;
    $check = Websitesetting::where('id','1')->update($datavalue);
    if($check>0)
    {
      \Session::flash('message','Action Successfully Completed...');
      return redirect()->route('websitesetting');
    }
    else
    {
      \Session::flash('message', 'Action Failed...Please Try Again 123654!!!');
      return \Redirect::back()
      ->withInput()
      ->withErrors($validator)
      ->with('message', 'Action Failed...Please Try Again 1234!!!');
    }
  }

}
