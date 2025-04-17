<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\Matkul;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function dashboard()
    {
        $post_count = Post::count();
        $dosen_count = User::where('type', '=', 'dosen')->count();
        $matkul_count = Matkul::count();
        $lab_count = Lab::count();
        return view('dashboard', compact('post_count', 'dosen_count', 'matkul_count', 'lab_count'));
    }
}
