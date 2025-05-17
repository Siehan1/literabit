<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class adminController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.admin', compact('users'));
    }
}
