<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Tanding;
use App\Models\TGR;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = User::all()->count();   
        $tanding = Tanding::all()->count();
        $tgr = TGR::all()->count();
        $jadwal = 10;
        return view('admin.dashboard', compact('user', 'tanding', 'tgr', 'jadwal'));
    }
}
