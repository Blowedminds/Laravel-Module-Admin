<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Role;
use App\Modules\Core\RolePermission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getRoles()
    {
        return response()->json(Role::with('permissions')->get());
    }

    public function getRole($id)
    {
        return Role::findOrFail($id);
    }

    public function postRole($id)
    {
        request()->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'permissions' => 'required|array'
        ]);

        $role = Role::findOrFail($id);

        RolePermission::where('role_id', $role->id)->forceDelete();

        foreach (request()->get('permissions') as $key => $value) {
            RolePermission::create([
                'role_id' => $role->id,
                'permission_id' => $value
            ]);
        }

        $role->fill(request()->only(['name', 'slug', 'description']));

        return response()->json([
            'header' => 'İşlem Başarılı',
            'message' => 'Rol güncellendi',
            'state' => 'success',
            'action' => 'Tamam'
        ]);
    }

    public function putRole()
    {

    }

    public function deleteRole()
    {

    }
}
