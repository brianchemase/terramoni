<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Role as ContractsRole;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleBasedAccessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllRoles(){

        $roles = Role::all();

        return view('admin.roles-index', ['Roles'=>$roles]);
    }

    public function createRole(Request $request){

        try {
            $role = Role::create(['name' => $request->role_name, 'guard' => 'web']);
            return redirect()->back()->with('success', "The role has been created successfully.");   
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Failed to create role. Reason: ".$th->getMessage());       
        }
       
    }

    public function getAllPermissions(){

        $permissions = Permission::all();

        return view('admin.permissions-index', ['Permissions'=>$permissions]);
    }

    public function createPermission(Request $request){

        try {
            $permission = Permission::create(['name' => $request->permission_name, 'guard' => 'web']);
            return redirect()->back()->with('success', "The permission has been created successfully.");   
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Failed to create permission. Reason: ".$th->getMessage());       
        }
       
    }

}
