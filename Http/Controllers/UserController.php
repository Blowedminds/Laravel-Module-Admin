<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Role;
use App\Modules\Core\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getUsers()
    {
        return response()->json(User::all());
    }

    public function getUser($user_id)
    {
        $user = User::where('user_id', $user_id)->with('roles')->firstOrFail()->toArray();

        $user['role'] = $user['roles'][0];

        unset($user['roles']);

        return response()->json($user);
    }

    public function postUser($user_id)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required'
        ]);

        $user = User::findOrFail($user_id);

        $user->name = request()->input('name');

        $user->email = request()->input('email');

        $user->userData->role_id = Role::findOrFail(request()->input('role_id'))->id;

        $user->userData->save();
        $user->save();

        return response()->json([]);
    }

    public function putUser()
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
    }

    public function deleteUser($user_id)
    {
        User::where('user_id', $user_id)->firstOrFail()->delete();

        return response()->json('success');
    }
}
