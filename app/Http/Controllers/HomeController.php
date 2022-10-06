<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __invoke()
    {
        $menus = DB::table('menus')->get();
        // dd($menus);
        // $menus = [
        //     ['name' => 'Home', 'url' => '/', 'icon' => 'fas fa-fire', 'child' => [
        //         ['name' => 'cobatest', 'url' => '/cobatest'],
        //         ['name' => 'cobalagi', 'url' => '/cobalagi'],
        //         ['name' => 'cobaterus', 'url' => '/cobaterus'],
        //         ['name' => 'cobacoba', 'url' => '/cobacoba'],
        //     ]],
        //     ['name' => 'Profile', 'url' => '/profile', 'icon' => 'far fa-user'],
        //     ['name' => 'About', 'url' => '/about', 'icon' => 'fas fa-ellipsis-h'],
        //     ['name' => 'Contact', 'url' => '/contact', 'icon' => 'fas fa-envelope'],
        // ];
        return view('index', ['appTitle' => 'Rarewel Lord', 'navbar' => $menus]);
    }
}
