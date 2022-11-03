<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Users_privilege;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddMenusController extends Controller
{
    public function index()
    {
        $menus = Menu::where('isParent', '=', 1)->orderBy('ordered', 'asc')->get();
        $dataMenus = [];
        $ordered = Menu::orderBy('id', 'desc')->first('ordered');
        $icon = DB::table('font_aweasome')->orderBy('created_at', 'asc')->get();
        foreach ($menus as $key) {
            $childMenus = Menu::where('parentId', '=', $key->id)->get('*');
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
        return view('Menus.index', ['title' => "List Menus", 'appTitle' => "Rarewel Lord", 'navbar' => $dataMenus, 'lastMenuOrdered' => $ordered->ordered + 1, 'icons' => json_encode($icon)]);
    }

    public function create()
    {
        $menus = Menu::where('isParent', '=', 1)->orderBy('ordered', 'asc')->get();
        $dataMenus = [];
        $ordered = Menu::orderBy('id', 'desc')->first('ordered');
        $icon = DB::table('font_aweasome')->orderBy('created_at', 'asc')->get();
        foreach ($menus as $key) {
            $childMenus = Menu::where('parentId', '=', $key->id)->get('*');
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

    public function store(Request $request)
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
            'created_at' => now('Asia/Jakarta'),
        ];
        if (Menu::insert($dataMenu)) {
            $data = DB::getPdo()->lastInsertId();
            $UserPrivileges = [
                'idUser' => 1,
                'idMenus' => $data,
                'canAccess' => 1,
                'canChange' => 1,
                'created_at' => now('Asia/Jakarta'),
            ];
            if (Users_privilege::insert($UserPrivileges)) {
                $response = [
                    'status' => 'success',
                    'message' => "Success Saving Menu"
                ];
                return response($response, 200);
            }
        }
    }

    public function show($id)
    {
        $menus = Menu::where('isParent', '=', 1)->orderBy('ordered', 'asc')->get();
        $dataMenus = [];
        $ordered = Menu::where('id', '=', $id)->first('ordered');
        $icon = DB::table('font_aweasome')->orderBy('created_at', 'asc')->get();
        foreach ($menus as $key) {
            $childMenus = Menu::where('parentId', '=', $key->id)->get('*');
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
        $menu = Menu::find($id);
        if (empty($menu)) {
            return redirect('/all-menus');
        }
        return view('Menus.edit', ['title' => "Edit Menus", 'appTitle' => "Rarewel Lord", 'navbar' => $dataMenus, 'menu' => $menu, 'lastMenuOrdered' => $ordered->ordered, 'icons' => json_encode($icon)]);
    }
    public function update(Request $request, $id)
    {
        $dataMenus = [
            'name' => $request['menu-name'],
            'route' => $request['menu-route'],
            'parentId' => ($request['parent-menu']) ?? 0,
            'description' => $request['desc-menu'],
            'updated_at' => date_create(now("Asia/Jakarta")),
        ];
        if ($request['parent-menu'] == '0') {
            $dataMenus['isParent'] = true;
        }
        $UserPrivileges = [
            'idUser' => 1,
            'idMenus' => $id,
            'canAccess' => true,
            'canChange' => true,
            'created_at' => date_create(now('Asia/Jakarta')),
        ];
        $data = Users_privilege::where('idMenus', '=', $id)->get();
        if (Menu::find($id)->update($dataMenus)) {
            if (json_decode(json_encode($data)) == null) {
                Users_privilege::insert($UserPrivileges);
            }
            return redirect('/menus', 302);
        }
    }
    public function destroy($id)
    {
        $menu = Menu::where('parentId', '=', $id)->get();
        if ($menu->isEmpty()) {
            if (Menu::find($id)->delete()) {
                return redirect('/menus', 302);
            }
        } else {
            return redirect('/menus', 302)->with(['error' => true, 'message' => 'Tidak Dapat Menghapus Parent Menu Yang Masih memiliki Child Menu']);
        }
    }
}
