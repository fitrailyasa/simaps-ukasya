<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tanding;
use App\Models\TGR;
use App\Models\JadwalTanding;
use App\Models\JadwalTGR;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $tanding = Tanding::all()->count();
        $tgr = TGR::all()->count();
        $jadwaltanding = JadwalTanding::all()->count();
        $jadwaltgr = JadwalTGR::all()->count(); 
        return view('admin.dashboard', compact('tanding', 'tgr', 'jadwaltanding', 'jadwaltgr'));
    }
}
