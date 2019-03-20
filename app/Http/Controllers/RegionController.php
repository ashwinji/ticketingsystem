<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;

class RegionController extends Controller
{
    public function showregionlist()
    {
    	 $regiondata = Region::get();
    	 return view('pages.regionlist',compact('regiondata'));
    }

    public function showregioncreate()
    {
    	return view('pages.regionAdd');
    }

    public function insertnewregion(Request $request)
    {
    	$this->validate($request, [
            'region_name'     => 'required',    
        ]);
        $regionname = new Region;
        $regionname->region_name = $request->region_name;
        $regionname->save();
        return redirect('region-list')->with('success','Region successfully Added.');
    }

     public function regionedit($id,Request $request)
     {
     	$regionrow = Region::where('id',$id)->first();
     	return view('pages.regionAdd',compact('regionrow'));
     }

     public function updateregion(Request $request)
     {
     	 $id = $request->id;
     	 $region_name = $request->region_name;
         $data1 = Region::find($request->id);
             $data1->region_name  = $request->region_name;                     
             $data1->save(); 
         return redirect('region-list')->with('success','Region updated successfully.');
     }
     public function deleteregion($id)
     {
        Region::where('id',$id)->delete();
        return redirect('region-list')->with('success','Region deleted successfully.');
     }

}
