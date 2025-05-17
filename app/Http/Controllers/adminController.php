<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;

class adminController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.dashboard.admin', compact('users'));
    }
    public function showBuku(){
        $bukus = Buku::all();
        return view('admin.buku.tableBuku', compact('bukus'));
    }
    public function upload(){
        $bukus = Buku::all();
        return view('admin.buku.uploadbuku', compact('bukus'));
    }
}
