<?php

namespace App\Modules\Editor\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getPermissions()
    {
        return response()->json(Permission::all());
    }

    public function postPermission($permission_id)
    {
        request()->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required'
        ]);

        Permission::findOrFail($permission_id)->update(request()->only(['name', 'slug', 'description']));

        return response()->json('success');
    }

    public function putPermission()
    {
        request()->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required'
        ]);

        Permission::create(request()->only(['name', 'slug', 'description']));

        return response()->json('success');
    }

    public function deletePermission($permission_id)
    {
        Permission::findOrFail($permission_id)->forceDelete();
    }
}