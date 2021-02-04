<?php

namespace App\Http\Controllers;

use App\Roles;
use Illuminate\Http\Request;
use  ZeinaDev\Services\Interfaces\RoleServiceInterface;

class RolesController extends Controller
{
    private $role;

    public function __construct(RoleServiceInterface $roleService)
    {
      $this->role = $roleService;
    }

    public function index()
    {
        $roles = $this->role->getAllpaginate();
        return view('dashboard.roles.index',compact('roles'));
    }


    public function create()
    {
        return view('dashboard.roles.mange');
    }


    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:roles,name',]);

        $new_role =array(
            'name'=>$request->name
        );

        $this->role->create($new_role);

        return redirect('dashboard/roles')->with('message','created Successfully');
    }


    public function show($id)
    {
        $id = (int) $id;

        $role = $this->role->getById($id);

        if(is_null($role))
        {
            return redirect('dashboard/roles')->with('message_err','No Role with this Id');
        }else
            {
                return view('dashboard.roles.mange',compact('role'));
            }

    }


    public function update(Request $request, $id)
    {

        $id = (int)$id;
        $this->validate($request, ['name' => 'required',]);

        $new_role =array(
            'name'=>$request->name
        );

        $this->role->updateByKey('id',$id,$new_role);

        return redirect('dashboard/roles')->with('message','Updated Successfully');
    }

    public function destroy($id)
    {
        $id = (int)$id;
        $this->role->deleteByKey('id',$id);
        return redirect('dashboard/roles')->with('message','Deleted Successfully');
    }
}
