<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Role;
use App\Modules\Core\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'permission:ownership.user']);
    }

    public function getUsers()
    {
        return User::all();
    }

    public function getUser($user_id)
    {
        $user = User::where('user_id', $user_id)->with('roles')->firstOrFail()->toArray();

        $user['role'] = $user['roles'][0];

        unset($user['roles']);

        return response()->json($user);
    }

    public function postUser()
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required'
        ]);

        return response()->json();
    }

    public function putUser($user_id)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required'
        ]);

        $user = User::findOrFail($user_id);

        $user->update(request()->only(['name', 'email']));

        $role = Role::findOrFail(request()->input('role_id'))->id;

        $user->userData->update(['role_id' => $role]);

        return response()->json();
    }

    public function deleteUser($user_id)
    {
        User::where('user_id', $user_id)->firstOrFail()->delete();

        return response()->json();
    }
}
