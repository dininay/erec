<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        //
        $user = Auth::user(); // Mengambil pengguna yang sedang login

        return view('dashboard', compact('user'));
    }
}
