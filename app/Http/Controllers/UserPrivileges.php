<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPrivileges extends Controller
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
        return view('UserPrivileges.index', ['title' => "User Privileges", 'appTitle' => "Rarewel Lord", 'navbar' => $dataMenus]);
    }
}
