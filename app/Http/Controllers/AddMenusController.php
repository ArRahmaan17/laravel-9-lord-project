<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddMenusController extends Controller
{
    public function index()
    {
        $menus = DB::table('menus')->orderBy('urutan', 'asc')->get();
        return view('Menus.index', ['appTitle' => "Add Menus", 'navbar' => $menus]);
    }

    public function insertMenu(Request $request)
    {
        $dataMenu = [
            'nama' => $request['menu-name'],
            'link' => $request['menu-route'],
            'id_menu' => $request['parent-menu'] != 0 ?? 0,
            'parentMenu' => ($request['parent-menu'] != 0 ?? 1),
            'tampil' => 1,
            'urutan' => 0,
            'icon' => 'fas fa-envelope',
            'keterangan' => $request['keterangan'],
        ];

        if (DB::table('menus')->insert($dataMenu)) {
            return back();
        }
    }

    public function editMenu($id)
    {
        $menus = DB::table('menus')->orderBy('urutan', 'asc')->get();
        $menu = DB::table('menus')->where('id', $id)->first();

        if (empty($menu)) {
            return redirect('/add-menus');
        }

        return view('Menus.edit', ['appTitle' => "Edit Menus", 'navbar' => $menus, 'menu' => $menu]);
    }
    public function updateMenu(Request $request, $id)
    {
        // dd($request);
        $data = [
            'nama' => $request['menu-name'],
            'link' => $request['menu-route'],
            'parentMenu' => $request['parent-menu'],
            'keterangan' => $request['desc-menu'],
        ];
        // dd($data);
        if (DB::table('menus')->where('id', $id)->update($data)) {
            return redirect('/add-menus');
        }
    }
}
