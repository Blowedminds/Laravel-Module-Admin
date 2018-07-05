<?php

namespace App\Modules\Editor\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getRoles()
    {
        return response()->json(Role::all());
    }

    public function getRole($id)
    {
        return Role::findOrFail($id);
    }

    public function postRole($id)
    {
        request()->validate([

        ]);

        $role = Role::findOrFail($id);
    }

    public function putRole()
    {

    }

    public function deleteRole()
    {

    }
}