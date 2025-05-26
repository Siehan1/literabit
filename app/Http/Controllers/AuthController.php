<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\levelTreshold;

class AuthController extends Controller
{
    public function showRegist(){
        return view('register.register');
    }

    public function register(Request $request){
        $validate = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:5|unique:users|alpha_num',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        $validate['password'] = Hash::make($validate['password']);
        User::create($validate);
        return redirect('/login');
    }

    public function showlogin(){
        return view('login.login');
    }
    
    public function login(Request $request){
        $request -> validate([
            'user' => 'required|string',
            'password' => 'required|string'
        ]);
        $loginType = filter_var($request->user, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $request->user,
            'password' => $request->password,
        ];

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            if (Auth::user()->is_admin == 1) {
                return redirect()->intended('/admin');
            }
            return redirect()->intended('/beranda');
        }
        return back()->withErrors('Email/Username atau Password Salah!');
    }
    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }


}
