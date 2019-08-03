<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Role;
use App\Modules\Core\RolePermission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'permission:ownership.role']);
    }

    public function getRoles()
    {
        return Role::with('permissions')->get();
    }

    public function getRole($role_id)
    {
        return Role::findOrFail($role_id);
    }

    public function postRole()
    {
        request()->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'permissions' => 'array'
        ]);

        $role = Role::create(request()->only(['name', 'slug', 'description']));

        foreach (request()->input('permissions') as $permission) {
            RolePermission::create([
                'role_id' => $role->id,
                'permission_id' => $permission
            ]);
        }
        return response()->json();
    }

    public function putRole($role_id)
    {
        request()->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'permissions' => 'array'
        ]);

        $role = Role::findOrFail($role_id);

        RolePermission::where('role_id', $role->id)->forceDelete();

        foreach (request()->get('permissions') as $key => $value) {
            RolePermission::create([
                'role_id' => $role->id,
                'permission_id' => $value
            ]);
        }

        $role->update(request()->only(['name', 'slug', 'description']));

        return response()->json();
    }

    public function deleteRole($role_id)
    {
        $role = Role::findOrFail($role_id);

        RolePermission::where('role_id', $role->id)->delete();

        $role->delete();

        return response()->json();
    }
}
