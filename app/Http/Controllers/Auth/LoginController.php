<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ApiFormatter;

class LoginController extends Controller
{
    public function index(){
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(LoginRequest $request){
        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        auth::attempt($data, true); // add parameter true to prevent logout when refresh

        if (Auth::check()) {
            return ApiFormatter::success(200, 'You have successfully logged in!');
        } else {
            return ApiFormatter::error(300, 'Username atau Password salah silahkan coba lagi');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
