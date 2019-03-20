<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Client;
use App\Auth;

class ClientController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:client-list');
         $this->middleware('permission:client-create', ['only' => ['client-create','client-store']]);
         $this->middleware('permission:client-edit', ['only' => ['client-edit','client-store']]);
    }

    public function clientlist()
    {
        $data = Client::orderBy('name', 'ASC')->get();
        return view('pages.client', compact('data'));
    }

    public function clientcreate()
    {
        return view('pages.client');
    }

    public function clientedit($id)
    {
        if(count(Client::where('id', $id)->first())<1)
        {
            return \Redirect()->back()->with('error', 'Data not found...');
        }
        $data = Client::where('id', $id)->first();
        return view('pages.client', compact('data'));
    }

    public function clientstore(Request $request)
    {
    	$this->validate($request, [
            'name'		=> 'required|string',
            'email'		=> 'required|email',
            'phone'		=> 'required|numeric',
            'location'	=> 'required|string',
        ]);
        if(!empty($request->id))
        {
            $data = Client::find($request->id);
            $data->name 	= $request->name;
            $data->email 	= $request->email;
            $data->phone 	= $request->phone;
            $data->location = $request->location;
            $data->save();
            return redirect()->back()
                        ->with('success','Client successfully updated.');
        }
        else
        {
        	$data = new Client;
            $data->name 	= $request->name;
            $data->email 	= $request->email;
            $data->phone 	= $request->phone;
            $data->location = $request->location;
            $data->save();
            return redirect()->back()
                        ->with('success','Client successfully created.');
        }
        return redirect()->back()
            ->with('error','Something went wrong, Please try again.');
    }
}

