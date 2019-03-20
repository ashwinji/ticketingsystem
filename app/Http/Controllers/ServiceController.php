<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Service;
use App\Auth;

class ServiceController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:service-list');
         $this->middleware('permission:service-create', ['only' => ['service-create','service-store']]);
         $this->middleware('permission:service-edit', ['only' => ['service-edit','service-store']]);
    }

    public function servicelist()
    {
        $data = Service::orderBy('name', 'ASC')->get();
        return view('pages.service', compact('data'));
    }

    public function servicecreate()
    {
        return view('pages.service');
    }

    public function serviceedit($id)
    {
        if(count(Service::where('id', $id)->first())<1)
        {
            return \Redirect()->back()->with('error', 'Data not found...');
        }
        $data = Service::where('id', $id)->first();
        return view('pages.service', compact('data'));
    }

    public function servicestore(Request $request)
    {
    	$this->validate($request, [
            'name'	=> 'required|string',
        ]);
        if(!empty($request->id))
        {
            $data = Service::find($request->id);
            $data->name = $request->name;
            $data->save();
            return redirect()->back()
                        ->with('success','Service successfully updated.');
        }
        else
        {
        	$data = new Service;
            $data->name = $request->name;
            $data->save();
            return redirect()->back()
                        ->with('success','Service successfully created.');
        }
        return redirect()->back()
            ->with('error','Something went wrong, Please try again.');
    }
}
