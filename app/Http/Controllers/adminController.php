<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;
use App\Models\Buku;
use App\Models\Genre;
use Illuminate\Support\Str;

class adminController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.dashboard.admin', compact('users'))->with('i',(request()->input('page',1)-1)*5);
    }
    public function showUpload(){
        $genres = Genre::all();
        return view('admin.buku.uploadbuku', compact('genres'));
    }
    
}
