<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Mail\sendtopassword;
use Mail;
use App\User;
use App\Auth;
use App\Department;
use DB;

class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:users-list');
         $this->middleware('permission:users-create', ['only' => ['users-create','users-store']]);
         $this->middleware('permission:users-edit', ['only' => ['users-edit','users-store']]);
    }

    public function userslist()
    {
        $data = User::orderBy('name', 'ASC')->get();
        return view('pages.users', compact('data'));
    }

    public function userscreate()
    {
        $dept = Department::pluck('name','id')->all();
        $roles = Role::pluck('name','name')->all();
        return view('pages.users', compact('dept', 'roles'));
    }

    public function usersedit($id)
    {
        if(count(User::where('id', $id)->first())<1)
        {
            return \Redirect()->back()->with('error', 'Data not found...');
        }
        $data = User::where('id', $id)->first();
        $dept = Department::pluck('name','id')->all();
        $roles = Role::pluck('name','name')->all();
        $user = User::find($id);
        $userRole = $user->roles->pluck('name','name')->all();
        return view('pages.users', compact('data', 'dept', 'roles', 'userRole'));
    }

public function deleteuserbyid($id)
    {
        User::where('id',$id)->delete();
        return redirect()->back()->with('success','User successfully deleted.');

    }

    public function usersstore(Request $request)
    { 

  /*       $toEmail   = 'ankit.baghel09@gmail.com'; //'receiver Email';
             /////////// Mail
              $content = [
                'token'=>'54564fhdghHGHJ54G'
            ];

           Mail::to($toEmail)->send(new sendtopassword($content));
            echo "abc testing";
            die();*/


        $this->validate($request, [
            'name'     => 'required|string',
            'email'    => 'required|email',
            'password' => 'required',
            'city'     => 'required',
            'zipcode'  => 'required',
            'phone'    => 'required',
            'roles'    => 'required',         
        ]);


          if($request->hasFile('avatar'))
            {
                $destinationPath  = 'assets/images/uploads/';
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

        if(!empty($request->id))
        {
            $data = User::find($request->id);
            $data->userType = $request->userType;
            $data->name = $request->name;
            $data->lastName = $request->lastName;
            $data->email = $request->email;
            $data->password = $request->password;
            $data->avatar = $fileName;
            $data->address =  $request->address;
            $data->city = $request->city;
            $data->zipcode = $request->zipcode;
            $data->phone = $request->phone;
            $data->userRole = $request->roles;
            $data->save();

            DB::table('model_has_roles')->where('model_id',$request->id)->delete();
            
            $data->assignRole($request->roles);
            return redirect()->back()
                        ->with('success','User successfully updated.');
        }
        else
        {
            
            $data = new User;
            $access_token = str_random(60);
            $data->password = $request->password;
            $data->userType = $request->userType;
            $data->name = $request->name;
            $data->lastName = $request->lastName;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->avatar = $fileName;
            $data->access_token   = $access_token;
            $data->address =  $request->address;
            $data->city = $request->city;
            $data->zipcode = $request->zipcode;
            $data->phone = $request->phone;
            $data->userRole = $request->roles;
            $data->save();
            $data->assignRole($request->roles);
            
          /*  $toEmail      = $request->email; //'receiver Email';
             /////////// Mail
              $content = [
                'token'=>$access_token
            ];
            Mail::to($toEmail)->send(new sendtopassword($content));*/

            return redirect()->back()
                        ->with('success','User successfully created.');
        }
        return redirect()->back()
            ->with('error','Something went wrong, Please try again.');
    }
}

