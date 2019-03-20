<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Department;
use App\Auth;

class DepartmentController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:department-list');
         $this->middleware('permission:department-create', ['only' => ['department-create','department-store']]);
         $this->middleware('permission:department-edit', ['only' => ['department-edit','department-store']]);
    }

    public function departmentlist()
    {
        $data = Department::orderBy('name', 'ASC')->get();
        return view('pages.department', compact('data'));
    }

    public function departmentcreate()
    {
        return view('pages.department');
    }

    public function departmentedit($id)
    {
        if(count(Department::where('id', $id)->first())<1)
        {
            return \Redirect()->back()->with('error', 'Data not found...');
        }
        $data = Department::where('id', $id)->first();
        return view('pages.department', compact('data'));
    }

    public function departmentstore(Request $request)
    {
    	$this->validate($request, [
            'name'          => 'required|string',
            'description'	=> 'required|string',
        ]);
        if(!empty($request->id))
        {
            $data = Department::find($request->id);
            $data->name         = $request->name;
            $data->description  = $request->description;
            $data->save();
            return redirect()->back()
                        ->with('success','Department successfully updated.');
        }
        else
        {
        	$data = new Department;
            $data->name         = $request->name;
            $data->description  = $request->description;
            $data->save();
            return redirect()->back()
                        ->with('success','Department successfully created.');
        }
        return redirect()->back()
            ->with('error','Something went wrong, Please try again.');
    }
}

