<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Illuminate\Queue\RedisQueue;
use Illuminate\Support\Facades\DB;

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
    public function createUser(Request $request)
    {
        $username = $request['register-username'];
        $email = $request['register-email'];
        $password = $request['register-password'];
        $createUser = [
            'name' => $username,
            'email' => $username,
            'email_verified_at' => date_create(now('Asia/Jakarta')),
            'password' => $password,
            'created_at' => date_create(now('Asia/Jakarta')),
        ];
        if (!User::create($createUser)) {
            return back()->with(['username' => $username, 'email' => $email, 'message' => 'Gagal melakukan registrasi user']);
        };
        return redirect('/');
    }
    public function authentication(Request $request)
    {
        $username = $request['login-username'];
        $password = $request['login-password'];
        $userData = DB::table('users')->where('name', $username)->where('password', $password)->get('name');
        if (count($userData) === 1) {
            return redirect('/menus');
        }
        return redirect('/');
    }
}
