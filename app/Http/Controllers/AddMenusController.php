<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddMenusController extends Controller
{
    public function index()
    {
        $menus = DB::table('menus')->where('isParent', '=', 1)->orderBy('ordered', 'asc')->get();
        $dataMenus = [];
        foreach ($menus as $key) {
            $childMenus = DB::table('menus')->where('parentId', '=', $key->id)->get('*');
            $dataMenus[] = [
                'menuId' => $key->id,
                'menuName' => $key->name,
                'menuUrl' => $key->route,
                'menuIcon' => $key->icon,
                'menuStatus' => $key->currentStatus,
                'menuDesc' => $key->description,
                'menuChild' => (json_encode($childMenus)) ?? null,
            ];
        }
        return view('Menus.index', ['title' => "List Menus", 'appTitle' => "Rarewel Lord", 'navbar' => $dataMenus]);
    }

    public function addMenu()
    {
        $menus = DB::table('menus')->where('isParent', '=', 1)->orderBy('ordered', 'asc')->get();
        $dataMenus = [];
        $ordered = DB::table('menus')->orderBy('id', 'desc')->first('ordered');
        $icon = DB::table('font_aweasome')->orderBy('created_at', 'asc')->get();
        foreach ($menus as $key) {
            $childMenus = DB::table('menus')->where('parentId', '=', $key->id)->get('*');
            $dataMenus[] = [
                'menuId' => $key->id,
                'menuName' => $key->name,
                'menuUrl' => $key->route,
                'menuIcon' => $key->icon,
                'menuStatus' => $key->currentStatus,
                'menuDesc' => $key->description,
                'menuChild' => (json_encode($childMenus)) ?? null,
            ];
        }
        return view('Menus.add', ['title' => "Add Menus", 'appTitle' => "Rarewel Lord", 'navbar' => $dataMenus, 'lastMenuOrdered' => $ordered->ordered + 1, 'icons' => json_encode($icon)]);
    }

    public function insertMenu(Request $request)
    {
        $dataMenu = [
            'name' => $request['menu-name'],
            'route' => $request['menu-route'],
            'parentId' => $request['parent-menu'] ?? 0,
            'isParent' => ($request['parent-menu']) ? 0 : 1,
            'ordered' => $request['menu-order'],
            'currentStatus' => 1,
            'icon' => 'fas fa-envelope',
            'description' => $request['desc-menu'],
            'created_at' => date_create(now()),
        ];
        if (DB::table('menus')->insert($dataMenu)) {
            return back();
        }
    }

    public function editMenu($id)
    {
        $menus = DB::table('menus')->where('isParent', '=', 1)->orderBy('ordered', 'asc')->get();
        $dataMenus = [];
        foreach ($menus as $key) {
            $childMenus = DB::table('menus')->where('parentId', '=', $key->id)->get('*');
            $dataMenus[] = [
                'menuId' => $key->id,
                'menuName' => $key->name,
                'menuUrl' => $key->route,
                'menuIcon' => $key->icon,
                'menuStatus' => $key->currentStatus,
                'menuDesc' => $key->description,
                'menuChild' => (json_encode($childMenus)) ?? null,
            ];
        }
        $menu = DB::table('menus')->where('id', $id)->first();
        if (empty($menu)) {
            return redirect('/all-menus');
        }

        return view('Menus.edit', ['title' => "Edit Menus", 'appTitle' => "Rarewel Lord", 'navbar' => $dataMenus, 'menu' => $menu]);
    }
    public function updateMenu(Request $request, $id)
    {
        $dataMenus = [
            'name' => $request['menu-name'],
            'route' => $request['menu-route'],
            'parentId' => ($request['parent-menu']) ?? 0,
            'description' => $request['desc-menu'],
            'updated_at' => date_create(now()),
        ];
        if ($request['parent-menu'] == 0) {
            $dataMenus['isParent'] = true;
        }
        if (DB::table('menus')->where('id', $id)->update($dataMenus)) {
            return redirect('/all-menus');
        }
    }
    public function destroyMenu($id)
    {
        $menu = DB::table('menus')->where('parentId', '=', $id)->first();
        if (!empty($menu)) {
            if (DB::table('menus')->where('parentId', '=', $id)->delete()) {
                return back();
            }
        } else {
            return back();
        }
    }
}
