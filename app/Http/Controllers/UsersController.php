<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\User;
use App\Roles;
use App\UserRoles;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::where('id','!=',1)->paginate();
        return view('dashboard.users.index',compact('users'));
    }

    public function create()
    {
        $roles = Roles::where('id','!=',1)->get();
        return view('dashboard.users.mange',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password'=> 'required'
            ]);
        $new_user =array(
            'name'=>$request->name,
            'email'=> $request->email,
            'password'=>Hash::make($request->password),
        );
        $user = User::create($new_user);
        $new_Role =array(
           'user_id'=>$user->id,'role_id'=>(int)$request->role
                 );
        UserRoles::create($new_Role);
        return redirect('dashboard/users')->with('message','created Successfully');
    }

    public function show($id)
    {
        $id = (int) $id;

        $user = User::select('id','name','email')->where('id',$id)->first();

        if(is_null($user))
        {
            return redirect('users')->with('message_err','No User with this Id');
        }else
        {
            $roles = Roles::where('id','!=',1)->get();
            return view('dashboard.users.mange',compact('user','roles'));
        }

    }


    public function update(Request $request, $id)
    {

        $id = (int)$id;
        $this->validate($request, [
            'name' => 'required',
            ]);

             $new_user =array(
                'name'=>$request->name
            );
            if(isset($request->password))
            {
                $new_user['password'] = Hash::make($request->password);
            }
            User::where('id',$id)->update($new_user);
            $new_Role =array(
               'role_id'=>(int)$request->role
                     );
            UserRoles::where('user_id',$id)->update($new_Role);

        return redirect('dashboard/users')->with('message','Updated Successfully');
    }

    public function destroy($id)
    {
        $id = (int)$id;
        UserRoles::where('user_id',$id)->delete();
        User::where('id',$id)->delete();

        return redirect('dashboard/users')->with('message','Deleted Successfully');
    }
}
