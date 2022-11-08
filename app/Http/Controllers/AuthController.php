<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth\registerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('Auth.auth', ['appTitle' => 'Ra Rewel Lord']);
    }
    public function registration()
    {
        return view('Auth.register', ['appTitle' => 'Ra Rewel Lord']);
    }
    public function createUser(registerRequest $request)
    {
        // $username = $request['name'];
        // $email = $request['email'];
        // $password = $request['password'];
        // $request->validate(['name' => 'required', 'email' => 'required|unique:users|email', 'password' => 'required']);
        // $createUser = [
        //     'name' => $username,
        //     'email' => $username,
        //     'password' => bcrypt($password),
        // ];
        if (!User::create($request->getUser())) {
            return back()->withErrors($request);
        };
        return redirect('/');
    }
    public function authentication(Request $request)
    {
        $attributes = $request->validate(['name' => 'required', 'password' => 'required']);
        if (Auth::attempt($attributes)) {
            return redirect('/menus');
        }
        return redirect('/');
    }
}
