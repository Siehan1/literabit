<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;

class adminController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.admin', compact('users'));
    }
    public function upload(){
        $bukus = Buku::all();
        return view('admin.uploadbuku', compact('bukus'));
    }
}
