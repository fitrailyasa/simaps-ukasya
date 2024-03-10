<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengundianTanding;
use App\Models\PengundianTGR;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminBaganController extends Controller
{
    public function tanding()
    {
        $pengundiantanding = PengundianTanding::all();
        return view('admin.bagan.tanding', compact('pengundiantanding'));
    }

    public function tgr()
    {
        $pengundiantgr = PengundianTGR::all();
        return view('admin.bagan.tgr', compact('pengundiantgr'));
    }

}
