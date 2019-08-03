<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Menu;
use App\Modules\Core\MenuRole;
use App\Modules\Core\Traits\MenuTrait;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    use MenuTrait;

    public function __construct()
    {
        $this->middleware(['auth:api', 'permission:ownership.menu']);
    }

    public function getMenus()
    {
        $menus = Menu::with(['menuRoles'])
            ->orderBy('weight', 'DESC')
            ->get()->map(function ($menu) {
                return [
                    'id' => $menu->id,
                    'name' => $menu->name,
                    'parent' => $menu->parent,
                    'tooltip' => $menu->tooltip,
                    'url' => $menu->url,
                    'weight' => $menu->weight,
                    'roles' => $menu->menuRoles,
                    'children' => []
                ];
            })->toArray();

        $menus = $this->putChildrenIntoParents($menus);

        return response()->json($menus);
    }

    public function postMenu(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
            'tooltip' => 'required',
            'weight' => 'required',
            'parent' => 'required'
        ]);

        $menu = Menu::create(
            request()->only(['name', 'url', 'tooltip', 'weight', 'parent']));

        if ($request->has('roles'))
            foreach ($request->input('roles') as $key => $value) {
                MenuRole::create([
                    'menu_id' => $menu->id,
                    'role_id' => $value
                ]);
            }

        return response()->json([]);
    }

    public function putMenu($menu_id)
    {
        request()->validate([
            'name' => 'required',
            'url' => 'required',
            'tooltip' => 'required',
            'weight' => 'required',
            'parent' => 'required',
            'roles' => 'array'
        ]);

        $menu = Menu::findOrFail($menu_id);

        $menu->update(request()->only(['name', 'url', 'tooltip', 'weight', 'parent']));

        MenuRole::where('menu_id', request()->input('id'))->forceDelete();

        foreach (request()->input('roles') as $key => $value) {
            MenuRole::create([
                'menu_id' => $menu->id,
                'role_id' => (int)$value
            ]);
        }

        return response()->json();
    }

    public function deleteMenu($id)
    {
        Menu::findOrFail($id)->forceDelete();

        return response()->json([]);
    }
}
