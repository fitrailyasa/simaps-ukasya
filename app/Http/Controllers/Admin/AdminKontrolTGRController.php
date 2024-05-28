<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalTGR;
use App\Models\PengundianTGR;
use App\Models\Gelanggang;
use Illuminate\Http\Request;

class AdminKontrolTGRController extends Controller
{
    public function index()
    {
        $gelanggangs = Gelanggang::all();
        $pengundiantgrs = PengundianTGR::latest('id')->get();
        $jadwaltgrs = JadwalTGR::latest('id')->get();
        return view('admin.kontrol-tgr.index', compact('jadwaltgrs', 'gelanggangs', 'pengundiantgrs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'partai' => 'required|max:255',
            'gelanggang' => 'required|max:255',
            'babak' => 'required|max:255',
            'sudut_biru' => 'required|max:255',
            'sudut_merah' => 'required|max:255',
            'next_sudut' => 'required|max:255',
            'next_partai' => 'required|max:255',
        ]);

        $jadwaltgr = JadwalTGR::findOrFail($id);
        $jadwaltgr->update($request->all());

        if (auth()->user()->roles_id == 1) {
            return back()->with('sukses', 'Berhasil Edit Data Jadwal!');
        } else if (auth()->user()->roles_id == 2) {
            return back()->with('sukses', 'Berhasil Edit Data Jadwal!');
        }
    }
}
