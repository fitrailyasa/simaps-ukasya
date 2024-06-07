<?php

namespace App\Http\Controllers\Admin;

use App\Events\Tunggal\GantiTahap;
use App\Http\Controllers\Controller;
use App\Models\JadwalTGR;
use App\Models\PengundianTGR;
use App\Models\Gelanggang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminKontrolTGRController extends Controller
{
    public function index()
    {
        $gelanggangs = Gelanggang::all();
        $gelanggang_operator = Gelanggang::find(auth()->user()->gelanggang) ?? null;
        $pengundiantgrs = PengundianTGR::latest('id')->get();
        $jadwaltgrs = JadwalTGR::orderBy('partai')->get();
        return view('admin.kontrol-tgr.index', compact('jadwaltgrs', 'gelanggangs', 'pengundiantgrs', 'gelanggang_operator'));
    }

    public function ubahtahap(Request $request, $jadwal_tunggal_id)
    {
        $jadwaltgr = JadwalTGR::find($jadwal_tunggal_id);
        $gelanggang = $jadwaltgr->Gelanggang;
        if ($jadwaltgr) {
            $gelanggang->jadwal = $jadwaltgr->id;
            $jadwaltgr->tahap = 'persiapan';
            $gelanggang->save();
            $jadwaltgr->save();
            GantiTahap::dispatch('persiapan', $jadwaltgr->tampil, $jadwaltgr->TampilTGR);
            return back()->with('sukses', 'Berhasil Mengganti Jadwal!');
        } else {
            return back()->withErrors(['error' => 'Gagal mengubah tahap jadwal.']);
        }
    }

    public function stop_pertandingan(Request $request, $jadwal_tunggal_id)
    {
        $jadwaltgr = JadwalTGR::find($jadwal_tunggal_id);
        if ($jadwaltgr) {
            $jadwaltgr->tahap = "keputusan";
            $jadwaltgr->save();
            return back()->with('sukses', 'Berhasil Menghentikan Pertandingan!');
        } else {
            return back()->withErrors(['error' => 'Gagal mengubah tahap jadwal.']);
        }
    }
}
