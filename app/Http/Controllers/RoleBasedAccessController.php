<?php

namespace App\Http\Controllers;

use App\Models\Role as ModelsRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role as ContractsRole;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Role as Roles;
use Illuminate\Support\Str;

class RoleBasedAccessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllRoles()
    {

        $roles = Role::all();

        return view('admin.roles-index', ['Roles' => $roles]);
    }

    public function createRole(Request $request)
    {

        try {
            $role = Role::create(['name' => $request->role_name, 'guard' => 'web']);
            return redirect()->back()->with('success', "The role has been created successfully.");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Failed to create role. Reason: " . $th->getMessage());
        }
    }

    public function getAllPermissions()
    {

        $routes = Route::getRoutes();

        foreach ($routes as $route) {
            if ($route->getName()) {
                $route = Route::getRoutes()->getByName($route->getName());
                if ($route) {

                    $middleware = $route->middleware();

                    foreach ($middleware as $middlewareName) {
                        $startsWithHello = Str::startsWith($middlewareName, 'permission');
                        if ($startsWithHello) {
                            $string = $middlewareName;

                            $parts = explode(':', $string, 2); // Split the string into an array, maximum of 2 parts
                            $result = trim($parts[1]); // Get the first part and remove leading/trailing whitespace

                            //echo $result; // Output: "Some Text"


                            try {
                                $permission = Permission::findByName($result, 'web');
                            } catch (\Throwable $th) {
                                Permission::create(['name' => $result, 'guard_name' => 'web']);
                            }


                            //echo $middlewareName . '<br>';
                        }
                    }
                }
            }
        }

        $permissions = Permission::all();

        return view('admin.permissions-index', ['Permissions' => $permissions]);
    }

    public function createPermission(Request $request)
    {

        try {
            $permission = Permission::create(['name' => $request->permission_name, 'guard' => 'web']);
            return redirect()->back()->with('success', "The permission has been created successfully.");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Failed to create permission. Reason: " . $th->getMessage());
        }
    }

    public function getAssignableRole()
    {
    
        $roles = Role::all(); 

        return view('admin.select-roles', ['Roles' => $roles]);
    }

    public function getAssignablePermissions($id)
    {
        
        $role = Role::findByName($id);
        $selectedValues = $role->permissions()->get()->pluck('id')->toArray();
       
        $roles = Role::all(); 
        $permissions = Permission::all();

        return response()->json(['Permissions' => $permissions, 'Roles' => $roles, 'selectedValues' => $selectedValues]);
    }

    public function deleteRole($id)
    {       
        
        $role = Role::findOrFail($id); 
        $role->delete();       

        return response()->json(['success' => 'Role deteled successfully.']);
    }

    public function AssignPermissionsToRoles(Request $request){

        $role = Role::findByName($request->role_name);

        $role->syncPermissions();

        $role->givePermissionTo($request->permissions);

        try {
            $role = Role::findByName($request->role_name);

            $role->givePermissionTo($request->permissions);
            return redirect()->back()->with('success', "Permissions assigned successfully to role ".$request->role_name);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Failed to assign permissions. Reason: " . $th->getMessage());
        }

    }

    public function updateRole(Request $request)
    {
        $role = Roles::findOrFail($request->input('role_id'));

        $role->name = $request->input('name');

        $role->save();

        return redirect()->back()->with('success',  $request->input('name') .' edited successfully.');
    }
}
