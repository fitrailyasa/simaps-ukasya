<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengundianTanding;
use App\Models\PengundianTGR;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminBaganController extends Controller
{
    public function index()
    {
        $pengundianTanding = PengundianTanding::all();
        return view('admin.bagan.index', compact('pengundianTanding'));
    }

}
