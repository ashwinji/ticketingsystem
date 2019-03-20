<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Nature_of_Fault;
use App\Auth;

class NatureOfFaultController extends Controller
{
   function __construct()
    {
         $this->middleware('permission:natureoffault-list');
         $this->middleware('permission:natureoffault-create', ['only' => ['natureoffault-create','natureoffault-store']]);
         $this->middleware('permission:natureoffault-edit', ['only' => ['natureoffault-edit','natureoffault-store']]);
         $this->middleware('permission:natureoffault-delete', ['only' => ['natureoffaultdelete']]);
    }

    public function natureoffaultlist()
    {
        $data = Nature_of_Fault::orderBy('name', 'ASC')->get();
        return view('pages.natureoffault', compact('data'));
    }

    public function natureoffaultcreate()
    {
        return view('pages.natureoffault');
    }

    public function natureoffaultedit($id)
    {
        if(count(Nature_of_Fault::where('id', $id)->first())<1)
        {
            return \Redirect()->back()->with('error', 'Data not found...');
        }
        $data = Nature_of_Fault::where('id', $id)->first();
        return view('pages.natureoffault', compact('data'));
    }

    public function natureoffaultstore(Request $request)
    {
    	$this->validate($request, [
            'name'	=> 'required|string',
        ]);
        if(!empty($request->id))
        {
            $data = Nature_of_Fault::find($request->id);
            $data->name = $request->name;
            $data->save();
            return redirect()->back()
                        ->with('success','Nature Of Fault successfully updated.');
        }
        else
        {
        	$data = new Nature_of_Fault;
            $data->name = $request->name;
            $data->save();
            return redirect()->back()
                        ->with('success','Nature Of Fault successfully created.');
        }
        return redirect()->back()
            ->with('error','Something went wrong, Please try again.');
    }

		public function natureoffaultdelete($id){
      	  	Nature_of_Fault::where('id',$id)->delete();
     	    return redirect()->back()->with('success','Nature Of Fault deleted successfully.');
    	}

}
