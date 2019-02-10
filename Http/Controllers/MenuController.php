<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Language;
use App\Modules\Core\Menu;
use App\Modules\Core\MenuRole;
use App\Modules\Core\Role;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getMenus()
    {
        $menus = Menu::with(['menuRoles'])
            ->orderBy('weight', 'DESC')
            ->get()->map(function ($menu) {

            return [
                'id' => $menu->id,
                'name' => $this->fillEmptyLocalizedMenu($menu->name ?? []),
                'parent' => $menu->parent,
                'tooltip' => $this->fillEmptyLocalizedMenu($menu->tooltip ?? []),
                'url' => $menu->url,
                'weight' => $menu->weight,
                'roles' => $menu->menuRoles,
                'children' => []
            ];
        })->toArray();

        for ($i = 0, $count = count($menus); $i < $count; $i++) {

            $menu = array_pop($menus);

            $placed = false;

            foreach ($menus as $key => $target) {
                if ($this->recurseMenus($menus[$key], $menu)) {
                    $placed = true;
                    break;
                }
            }

            if (!$placed) {
                array_unshift($menus, $menu);
            }
        }

        usort($menus, function ($a, $b) {
            return $a['weight'] - $b['weight'];
        });

        usort($menus, function ($a, $b) {
            return $a['weight'] - $b['weight'];
        });

        return response()->json($menus);
    }

    public function postMenu()
    {
        $menuUpdateKeys = [
            'name' => 'required',
            'url' => 'required',
            'tooltip' => 'required',
            'weight' => 'required',
            'parent' => 'required'
        ];

        request()->validate(array_merge([
            'id' => 'required',
            'roles' => 'required'
        ], $menuUpdateKeys));

        request()->merge(['name' => $this->fillEmptyLocalizedMenu(request()->input('name'))]);
        request()->merge(['tooltip' => $this->fillEmptyLocalizedMenu(request()->input('tooltip'))]);

        $menu = Menu::findOrFail(request()->input('id'));

        foreach ($menuUpdateKeys as $key => $value) {

            $menu->{$key} = request()->input($key);
        }

        MenuRole::where('menu_id', request()->input('id'))->forceDelete();

        foreach (request()->input('roles') as $key => $value) {

            $role = Role::findOrFail($value['id']);

            MenuRole::create([
                'menu_id' => $menu->id,
                'role_id' => $role->id
            ]);
        }

        $menu->save();

        return response()->json([]);
    }

    public function putMenu(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
            'tooltip' => 'required',
            'weight' => 'required',
            'parent' => 'required'
        ]);

        request()->merge(['name' => $this->fillEmptyLocalizedMenu(request()->input('name'))]);
        request()->merge(['tooltip' => $this->fillEmptyLocalizedMenu(request()->input('tooltip'))]);

        $menu = Menu::create([
            'name' => $request->input('name'),
            'url' => $request->input('url'),
            'tooltip' => $request->input('tooltip'),
            'weight' => $request->input('weight'),
            'parent' => $request->input('parent'),
        ]);

        if ($request->has('roles'))
            foreach ($request->input('roles') as $key => $value) {
                MenuRole::create([
                    'menu_id' => $menu->id,
                    'role_id' => $value['id']
                ]);
            }

        return response()->json([]);
    }

    public function deleteMenu($id)
    {
        Menu::findOrFail($id)->forceDelete();

        return response()->json(['TEBRIKLER']);
    }

    private function fillEmptyLocalizedMenu($localized_menu_name)
    {
        $filled_menus = [];

        foreach (Language::all() as $language) {
            if (!array_key_exists($language->slug, $localized_menu_name) || !$localized_menu_name[$language->slug])
                $filled_menus[$language->slug] = '';
            else
                $filled_menus[$language->slug] = $localized_menu_name[$language->slug];
        }

        return $filled_menus;
    }

    private function recurseMenus(&$target, &$menu)
    {
        if ($menu['parent'] === $target['id']) {
            $target['children'][] = $menu;
            return true;
        }

        foreach ($target['children'] as $key => $child) {
            if ($this->recurseMenus($target['children'][$key], $menu)) {
                return true;
            };
        }

        return false;
    }
}
