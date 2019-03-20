<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\TicketGenerated;
use App\Todolist;
use App\Service;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

      $totalTicketGenrate = TicketGenerated::count();
      $totalPendingTicket = TicketGenerated::where('status','3')->count();
      $totalclosedTicket = TicketGenerated::where('status','2')->count();
      $totalemp = User::count();
      $todolist = Todolist::get(); 
      $servicelist = Service::orderBy('id','ASC')->get();
      //select service_affected, count(*) from ticket_generateds group by service_affected
      // $servicelist2 = TicketGenerated::groupBy('service_affected')->get();
      $servicelist2 = DB::table('ticket_generateds')
                 //->join('services','ticket_generateds.service_affected','=','services.id')
                 ->select('service_affected', DB::raw('count(*) as total'))
                 ->groupBy('service_affected')
                 ->get();
                 $servicename = array();
                 foreach($servicelist2 as $rr)
                 {
                  $servicename[] =  Service::where('id',$rr->service_affected)->first()->name;//$rr->service_affected;
                 }
      /*echo "<pre>";
      print_r($servicename);
      die;*/

      $pendingticketcount =  TicketGenerated::where('status','1')->count();   
return view('home',compact('totalTicketGenrate','totalPendingTicket','totalclosedTicket','totalemp','todolist','servicelist','servicelist2','servicename','pendingticketcount'));
    }

    public function logout() 
    {
        Auth::logout();
        return \Redirect::away('.');
    }

    public function screenlock($currtime, $id, $randnum)
    {
        Auth::logout();
        return View('pages.screenlock')->with('currtime', $currtime)->with('id', $id)->with('randnum',$randnum);
    }

    public function editprofile()
    {
        $user = Auth::User();
        return View('pages.edit-profile', compact('user'));
    }

    public function profileupdate(Request $request)
    {
        if($request->for=='password')
        {
            $this->validate($request, [
                'oldpassword'           => 'required',
                'password'              => 'required|min:6|confirmed',
                'password_confirmation' => 'required',
            ]);

            $oldpasswords   = $request->oldpassword;
            $matchpassword  = User::find(Auth::id())->password;
            if(\Hash::check($oldpasswords, $matchpassword))
            {
                $user = User::find(Auth::id());
                $user->update(['password' => bcrypt($request->password)]);
                $user->save();
                return redirect()->back()
                            ->with('success','Password successfully updated.');
            }
            return redirect()->back()
            ->with('error','Old password not matched, Please try again.');
        }
        else
        {
            $this->validate($request, [
                'name'          => 'required|string',
                'lastName'      => 'required|string',
                'address'       => 'required|string',
                'city'          => 'required|string',
                'zipcode'       => 'required|numeric',
                'phone'         => 'required|numeric'
            ]);

            if($request->hasFile('avatar'))
            {
                $destinationPath    = 'assets/images/uploads/';
                if($request->oldavatar!='')
                {
                    if(file_exists($destinationPath.$request->oldavatar)){ 
                        unlink($destinationPath.$request->oldavatar);
                        unlink($destinationPath.'avatar/'.$request->oldavatar);
                    }
                }
                $file       = $request->avatar;
                $fileName   = value(function() use ($file)
                {
                  $newName = str_random(10) . '.' . $file->getClientOriginalExtension();
                  return strtolower($newName);
                });
                $request->avatar->move($destinationPath, $fileName);
                $img = \Image::make($destinationPath.$fileName);
                $img->resize(250, 250);
                $img->save('assets/images/uploads/avatar/'.$fileName);
                unlink($destinationPath.$fileName);
            }
            else
            {
                $fileName = $request->oldavatar;
            }

            $user = User::find(Auth::id());
            $user->name     = $request->name;
            $user->lastName = $request->lastName;
            $user->address  = $request->address;
            $user->city     = $request->city;
            $user->zipcode  = $request->zipcode;
            $user->phone    = $request->phone;
            $user->avatar   = $fileName;
            $user->save();
            return redirect()->back()
                            ->with('success','Profile successfully updated.');
        }

        return redirect()->back()
            ->with('error','Something went wrong, Please try again.');
    }
}
