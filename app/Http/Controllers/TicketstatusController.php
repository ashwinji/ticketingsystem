<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\TicketStatus;
use App\Auth;

class TicketstatusController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ticket-status-list');
         $this->middleware('permission:ticket-status-create', ['only' => ['ticket-status-create','ticket-status-store']]);
         $this->middleware('permission:ticket-status-edit', ['only' => ['ticket-status-edit','ticket-status-store']]);
    }

    public function ticketstatuslist()
    {
        $data = TicketStatus::orderBy('name', 'ASC')->get();
        return view('pages.ticket-status', compact('data'));
    }

    public function ticketstatuscreate()
    {
        return view('pages.ticket-status');
    }

    public function ticketstatusedit($id)
    {
        if(count(TicketStatus::where('id', $id)->first())<1)
        {
            return \Redirect()->back()->with('error', 'Data not found...');
        }
        $data = TicketStatus::where('id', $id)->first();
        return view('pages.ticket-status', compact('data'));
    }

    public function ticketstatusstore(Request $request)
    {
    	$this->validate($request, [
            'name'	=> 'required|string',
        ]);
        if(!empty($request->id))
        {
            $data = TicketStatus::find($request->id);
            $data->name = $request->name;
            $data->save();
            return redirect()->back()
                        ->with('success','Ticket status successfully updated.');
        }
        else
        {
        	$data = new TicketStatus;
            $data->name = $request->name;
            $data->save();
            return redirect()->back()
                        ->with('success','Ticket status successfully created.');
        }
        return redirect()->back()
            ->with('error','Something went wrong, Please try again.');
    }
}
