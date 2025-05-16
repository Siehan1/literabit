<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showlogin(){
        return view('login.login');
    }
    
    public function login(request $request){
        $credentials = $request -> validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/beranda');
        }
        return back()->withErrors([
            'email'=> 'email atau password salah',
        ]);
    }
    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/ogin');
    }
}
