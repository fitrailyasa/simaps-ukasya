<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalTanding;
use App\Models\PengundianTanding;
use App\Models\Gelanggang;
use Illuminate\Http\Request;

class AdminKontrolTandingController extends Controller
{
    public function index()
    {
        $gelanggangs = Gelanggang::all();
        $pengundiantandings = PengundianTanding::latest('id')->get();
        $jadwaltandings = JadwalTanding::latest('id')->get();
        return view('admin.kontrol-tanding.index', compact('jadwaltandings', 'gelanggangs', 'pengundiantandings'));
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

        $jadwaltanding = JadwalTanding::findOrFail($id);
        $jadwaltanding->update($request->all());

        if (auth()->user()->roles_id == 1) {
            return back()->with('sukses', 'Berhasil Edit Data Jadwal!');
        } else if (auth()->user()->roles_id == 2) {
            return back()->with('sukses', 'Berhasil Edit Data Jadwal!');
        }
    }
}
