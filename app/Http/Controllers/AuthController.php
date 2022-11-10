<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth\loginRequest;
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
        if (!User::create($request->createUser())) {
            return response(json_encode($request), 401);
        };
        return redirect('/');
    }
    public function authentication(loginRequest $request)
    {
        if (!Auth::attempt($request->userAccount())) {
            $response = [
                'status' => false,
                'message' => 'username and password are incorrect',
            ];
            return response(json_encode($response), 401);
        }
        $response = [
            'status' => true,
            'message' => 'your successfully login on this website'
        ];
        return response(json_encode($response), 200);
    }
}
