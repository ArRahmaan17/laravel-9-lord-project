<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Users_privilege;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPrivileges extends Controller
{
    public function index()
    {
        $menus = Menu::where('isParent', '=', 1)->orderBy('ordered', 'asc')->get();
        $dataMenus = [];
        foreach ($menus as $key) {
            $childMenus = Menu::where('parentId', '=', $key->id)->get('*');
            $hasAccess = Users_privilege::where('idMenus', '=', $key->id)->value('canAccess');
            $hasChange = Users_privilege::where('idMenus', '=', $key->id)->value('canChange');
            $dataMenus[] = [
                'menuId' => $key->id,
                'menuName' => $key->name,
                'menuUrl' => $key->route,
                'menuIcon' => $key->icon,
                'menuStatus' => $key->currentStatus,
                'menuDesc' => $key->description,
                'menuAccess' => (json_encode($hasAccess)) ?? false,
                'menuChange' => (json_encode($hasChange)) ?? false,
                'menuChild' => (json_encode($childMenus)) ?? null,
            ];
        }
        return view('UserPrivileges.index', ['title' => "User Privileges", 'userPrivilege' => 1, 'appTitle' => "Rarewel Lord", 'navbar' => $dataMenus]);
    }

    public function setUserCanAccess($id)
    {
        $hasil = Users_privilege::where('idMenus', '=', $id)->value('canAccess');
        if (!$hasil) {
            $data = [
                'idUser' => 1,
                'idMenus' => $id,
                'canAccess' => true,
                'updated_at' => date_create(now('Asia/Jakarta'))
            ];
            Users_privilege::where('idMenus', '=', $id)->update($data);
        } else {
            $data = [
                'idUser' => 1,
                'idMenus' => $id,
                'canAccess' => false,
                'updated_at' => date_create(now('Asia/Jakarta'))
            ];
            Users_privilege::where('idMenus', '=', $id)->update($data);
        }
        return redirect('/all-user-privileges');
    }

    public function setUserCanChange($id)
    {
        $hasil = Users_privilege::where('idMenus', '=', $id)->value('canChange');
        if (!$hasil) {
            $data = [
                'idUser' => 1,
                'idMenus' => $id,
                'canChange' => true,
                'updated_at' => date_create(now('Asia/Jakarta'))
            ];
            Users_privilege::where('idMenus', '=', $id)->update($data);
        } else {
            $data = [
                'idUser' => 1,
                'idMenus' => $id,
                'canChange' => false,
                'updated_at' => date_create(now('Asia/Jakarta'))
            ];
            Users_privilege::where('idMenus', '=', $id)->update($data);
        }
        return redirect('/all-user-privileges');
    }

    public function changeStatus($id)
    {
        $hasil = Menu::where('id', '=', $id)->value('currentStatus');
        if ($hasil) {
            $data = [
                'currentStatus' => false,
                'updated_at' => date_create(now('Asia/Jakarta'))
            ];
            Menu::find($id)->update($data);
        } else {
            $data = [
                'currentStatus' => true,
                'updated_at' => date_create(now('Asia/Jakarta'))
            ];
            Menu::find($id)->update($data);
        }
        return back();
    }
}
