<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;
use App\Department;
use App\TicketGenerated;
use App\TicketStatus;
use App\Service;
use App\Client;
use App\TicketUpdates;
use App\Region;
use App\KbSiteInfo;
use App\clientContactList;
use App\EnggDriver;
use App\Nofbi;

class KnowledgeBaseController extends Controller
{
   function __construct()
    {  
        $this->middleware('permission:kb-site-list');
        $this->middleware('permission:kb-site-create', ['only' => ['knowledge-base-store']]);
        $this->middleware('permission:kb-site-edit', ['only' => ['siteInfoStore']]);
        $this->middleware('permission:kb-site-delete', ['only' => ['knowledge-base-delete']]);
           
        $this->middleware('permission:kb-client-list');
        $this->middleware('permission:kb-site-create', ['only' => ['knowledge-base-contactStore']]);
        $this->middleware('permission:kb-site-edit', ['only' => ['knowledge-base-contactStore']]);
        $this->middleware('permission:kb-site-delete', ['only' => ['knowledge-base-contactDelete']]);

        $this->middleware('permission:kb-soliton-list');
        $this->middleware('permission:kb-site-create', ['only' => ['knowledge-base-enggDriverStore']]);
        $this->middleware('permission:kb-site-edit', ['only' => ['knowledge-base-enggDriverStore']]);
        $this->middleware('permission:kb-site-delete', ['only' => ['knowledge-base-enggDriverDelete']]);

        $this->middleware('permission:kb-maintenance-list');
        $this->middleware('permission:kb-site-create', ['only' => ['knowledge-base-nofbisStore']]);
        $this->middleware('permission:kb-site-edit', ['only' => ['knowledge-base-nofbisStore']]);
        $this->middleware('permission:kb-site-delete', ['only' => ['knowledge-base-nofbisDelete']]);
   }

    public function siteInfo(){    	
    	$data = KbSiteInfo::orderBy('id', 'ASC')->get();
        return view('pages.kbSiteInfo', compact('data'));
    }
    public function siteInfoAdd(){
    	return view('pages.kbSiteInfo');
    }

    public function siteInfoEdit($id)
    {	
        if(count(KbSiteInfo::where('id', $id)->first())<1)
        {
            return \Redirect()->back()->with('error', 'Data not found...');
        }
        $data = KbSiteInfo::where('id', $id)->first();
        return view('pages.kbSiteInfo', compact('data'));
    }
    public function siteInfoDelete($id){
        KbSiteInfo::where('id',$id)->delete();
        return redirect()->back()->with('success','Successfully  deleted Your client data'); 
   }

    public function siteInfoStore(Request $request){

		$this->validate($request, [
            'old_site_id'		=> 'required|string',
            'site_name'			=> 'required|string',          
        ]);
        if(!empty($request->id))
        {
            $data = KbSiteInfo::find($request->id);
            $data->old_site_id 	= $request->old_site_id;
            $data->new_site_id 	= $request->new_site_id;
            $data->site_name 	= $request->site_name;
            $data->save();
            return redirect()->back()
                        ->with('success','Site Info successfully updated.');
        }
        else
        {
        	$data = new KbSiteInfo;
            $data->old_site_id 	= $request->old_site_id;
            $data->new_site_id 	= $request->new_site_id;
            $data->site_name 	= $request->site_name;
            $data->save();
            return redirect()->back()
                        ->with('success','Site Info successfully created.');
        }
        return redirect()->back()
            ->with('error','Something went wrong, Please try again.');

    	return view('pages.kbSiteInfo');
    }

    public function contactList(){
    	$data = clientContactList::orderBy('id', 'ASC')->get();
        return view('pages.kbConactList', compact('data'));
    }

    public function contactListAdd(){
    	$clientdata = Client::pluck('name', 'id')->all();
    	return view('pages.kbConactList', compact('clientdata'));
    }

	public function contactEdit($id){
		if(count(clientContactList::where('id', $id)->first())<1)
        {
            return \Redirect()->back()->with('error', 'Data not found...');
        }
        $clientdata = Client::pluck('name', 'id')->all();
        $data = clientContactList::where('id', $id)->first();
    	   return view('pages.kbConactList', compact('data','clientdata'));
    }
    public function contactDelete($id){
        clientContactList::where('id',$id)->delete();
        return redirect()->back()->with('success','Successfully  deleted Your client data');
   }

    public function contactListStore(Request $request){

		$this->validate($request, [
			'client_id'			=> 'required',
            'employee_name'		=> 'required',
            'contact_no'		=> 'required',          
        ]);
        if(!empty($request->id))
        {
            $data = clientContactList::find($request->id);
            $data->client_id 	= $request->client_id;
            $data->employee_name 	= $request->employee_name;
            $data->contact_no 	= $request->contact_no;
            $data->save();
            return redirect()->back()
                        ->with('success','Site Info successfully updated.');
        }
        else
        {
        	$data = new clientContactList;
            $data->client_id 	= $request->client_id;
            $data->employee_name 	= $request->employee_name;
            $data->contact_no 	= $request->contact_no;
            $data->save();
            return redirect()->back()
                        ->with('success','Site Info successfully created.');
        }
        return redirect()->back()
            ->with('error','Something went wrong, Please try again.');

    	return view('pages.kbSiteInfo');
    }

    public function enggDriver(){    	
    	$data = EnggDriver::orderBy('id', 'ASC')->get();
        return view('pages.enggDriverList', compact('data'));
    }
    public function enggDriverAdd(){
    	$regions =Region::pluck('region_name','id')->all();
    	return view('pages.enggDriverList', compact('regions'));
    }
    public function enggDriverEdit($id){
		if(count(EnggDriver::where('id', $id)->first())<1)
        {
            return \Redirect()->back()->with('error', 'Data not found...');
        }
        $data = EnggDriver::where('id', $id)->first();
    	$regions =Region::pluck('region_name','id')->all();    	
    	return view('pages.enggDriverList', compact('data','regions'));
    }
    public function enggDriverDelete($id){
        EnggDriver::where('id',$id)->delete();
        return redirect()->back()->with('success','Successfully  deleted Your client data');
   }
    public function enggDriverStore(Request $request){
		$this->validate($request, [
			'region_id'			=> 'required',
            'designation'		=> 'required',
            'desName'			=> 'required|string',
            'desId'				=> 'required',
            'desContactno_one'	=> 'required',
            'driverAssginName'	=> 'required',
            'driver_no'			=> 'required',
        ]);
        if(!empty($request->id))
        {
            $data = EnggDriver::find($request->id);
            $data->region_id 			= $request->region_id;
            $data->designation 			= $request->designation;
            $data->desName 				= $request->desName;
            $data->desId 				= $request->desId;
            $data->desContactno_one 	= $request->desContactno_one;
            $data->desContact_two 		= $request->desContact_two;
            $data->desContact_three 	= $request->desContact_three;
            $data->driverAssginName 	= $request->driverAssginName;
            $data->driver_no 			= $request->driver_no;
            $data->car_no 				= $request->car_no;
            $data->save();
            return redirect()->back()
                        ->with('success','Site Info successfully updated.');
        }
        else
        {
        	$data = new EnggDriver;
            $data->region_id 			= $request->region_id;
            $data->designation 			= $request->designation;
            $data->desName 				= $request->desName;
            $data->desId 				= $request->desId;
            $data->desContactno_one 	= $request->desContactno_one;
            $data->desContact_two 		= $request->desContact_two;
            $data->desContact_three 	= $request->desContact_three;
            $data->driverAssginName		= $request->driverAssginName;
            $data->driver_no 			= $request->driver_no;
            $data->car_no 				= $request->car_no;
            $data->save();
            return redirect()->back()
                        ->with('success','Site Info successfully created.');
        }
        return redirect()->back()
            ->with('error','Something went wrong, Please try again.');
    }

    public function nofbisList(){
    	$data = Nofbi::orderBy('id', 'ASC')->get();
        return view('pages.NofbiList', compact('data'));
    }
    public function nofbisAdd(){
		$clientdata = Client::pluck('name', 'id')->all();
		$regions =Region::pluck('region_name','id')->all(); 
    	return view('pages.NofbiList', compact('clientdata','regions'));
    }

    public function nofbisEdit($id){
    	if(count(Nofbi::where('id', $id)->first())<1)
        {
            return \Redirect()->back()->with('error', 'Data not found...');
        }
        $data = Nofbi::where('id', $id)->first();
    	$regions =Region::pluck('region_name','id')->all(); 
    	$clientdata = Client::pluck('name', 'id')->all();
    	return view('pages.NofbiList', compact('data','regions','clientdata'));    	
    }
    public function nofbisDelete($id){
        EnggDriver::where('id',$id)->delete();
        return redirect()->back()->with('success','Successfully  deleted Your client data');
   }
    
    public function nofbisStore(Request $request){
    	$this->validate($request, [
			'client_id'			=> 'required',
            'network'			=> 'required',
            'section'			=> 'required',
            'length'			=> 'required',
            'region_id'			=> 'required',
            'sla'				=> 'required',
            'duration'			=> 'required',
        ]);
        if(!empty($request->id))
        {
            $data = Nofbi::find($request->id);
            $data->client_id 	= $request->client_id;
            $data->network  	= $request->network;
            $data->section 		= $request->section;
            $data->length 		= $request->length;
            $data->region_id 	= $request->region_id;
            $data->sla 		    = $request->sla;
            $data->duration 	= $request->duration;
            $data->save();
            return redirect()->back()
                        ->with('success','Site Info successfully updated.');
        }
        else
        {
        	$data = new Nofbi;
   			$data->client_id 	= $request->client_id;
            $data->network 		= $request->network;
            $data->section 		= $request->section;
            $data->length 		= $request->length;
            $data->region_id 	= $request->region_id;
            $data->sla 			= $request->sla;
            $data->duration 	= $request->duration;
            $data->save();
            return redirect()->back()
                        ->with('success','Site Info successfully created.');
        }
        return redirect()->back()
            ->with('error','Something went wrong, Please try again.');

    }
    
   /* public function uploadsiteids(Request $request)
    {
        
       $arr = array();
if($request->hasFile('ex_file')){
        $path = $request->file('ex_file')->getRealPath();
        $data = \Excel::load($path)->get();
        if($data->count()){
            // print_r($data);die;
            foreach ($data as $key => $value) {
                echo $value;//die;
                $arr[] = ['old_site_id' => "joy1",'new_site_id' => "joy3",'site_name'=>"joy4"];
            }
            if(!empty($arr)){
                \DB::table('kb_site_infos')->insert($arr);
                dd('Insert Record successfully.');
            }
        }
    }
    dd('Request data does not have any files to import.');  




    }*/
    
    public function uploadsiteids(Request $request){
 

        $uploadedfilename = $_FILES["ex_file"]["name"];
        $filenamearry = explode('.',$uploadedfilename);
        $extension = $filenamearry[1];

        if($extension!='csv')
        {
          return redirect()->back()
                        ->with('error','Invalid File Extension use only CSV File.');
        }
        else
        {
        

        $a=$_FILES["ex_file"]["tmp_name"];
        $csv_file = $a;
        if(($getfile = fopen($csv_file,"r"))!==FALSE)
        {
            $data=fgetcsv($getfile,1000,",");
            while(($data = fgetcsv($getfile,1000,",")) !==FALSE)
            {
                $newdata = new KbSiteInfo;
                $result = $data;
                $str = implode(",",$result);
                $slice = explode(",",$str);
                $newdata->old_site_id = $slice[0];
                $newdata->new_site_id = $slice[1];
                $newdata->site_name = $slice[2];
                //$col4 = $slice[3];
                $newdata->save();
            }
         return redirect()->back()
                        ->with('message','Import Successful.');   
        }
        else
        {
            return redirect()->back()
                        ->with('error','Invalid File Extension use only CSV File.');
        }
    }

       
  }
  

    
    
}
