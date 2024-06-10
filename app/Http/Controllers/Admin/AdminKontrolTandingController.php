<?php

namespace App\Http\Controllers\Admin;

use App\Events\Tanding\MulaiPertandingan;
use App\Http\Controllers\Controller;
use App\Models\JadwalTanding;
use App\Models\TimbangUlang;
use App\Models\PengundianTanding;
use App\Models\Gelanggang;
use Illuminate\Http\Request;

class AdminKontrolTandingController extends Controller
{
    public function index()
    {
        $gelanggangs = Gelanggang::all();
        $gelanggang_operator = Gelanggang::find(auth()->user()->gelanggang) ?? null;
        $pengundiantandings = PengundianTanding::latest('id')->get();
        $jadwaltandings = JadwalTanding::latest('id')->get();
        if(auth()->user()->roles_id == 1){
            return view('admin.kontrol-tanding.index', compact('jadwaltandings', 'gelanggangs', 'pengundiantandings', 'gelanggang_operator'));
        }else if(auth()->user()->roles_id == 2){
            return view('operator.kontrol-tanding.index', compact('jadwaltandings', 'gelanggangs', 'pengundiantandings', 'gelanggang_operator'));
        }
    }

    public function ubahtahap(Request $request, $jadwal_tanding_id)
    {
        $jadwaltanding = JadwalTanding::find($jadwal_tanding_id);
        $gelanggang = $jadwaltanding->Gelanggang;
        if ($jadwaltanding) {
            $gelanggang->jenis = "Tanding";
            $gelanggang->jadwal = $jadwaltanding->id;
            $jadwaltanding->tahap = 'menunggu';
            $gelanggang->save();
            $jadwaltanding->save();
            MulaiPertandingan::dispatch('ganti jadwal gelanggang');
            return back()->with('sukses', 'Berhasil Mengganti Jadwal!');
        } else {
            return back()->withErrors(['error' => 'Gagal mengubah tahap jadwal.']);
        }
    }

    public function stop_pertandingan(Request $request, $jadwal_tanding_id)
    {
        $jadwaltanding = JadwalTanding::find($jadwal_tanding_id);
        if ($jadwaltanding) {
            $jadwaltanding->tahap = "hasil";
            $jadwaltanding->save();
            return back()->with('sukses', 'Berhasil Menghentikan Pertandingan!');
        } else {
            return back()->withErrors(['error' => 'Gagal mengubah tahap jadwal.']);
        }
    }
    public function reset(Request $request, $jadwal_tanding_id)
    {
        $jadwaltanding = JadwalTanding::find($jadwal_tanding_id);
        if ($jadwaltanding) {
            $jadwaltanding->tahap = "persiapan";
            $jadwaltanding->save();
            return back()->with('sukses', 'Berhasil Mengulang Pertandingan!');
        } else {
            return back()->withErrors(['error' => 'Gagal mengubah tahap jadwal.']);
        }
    }
}
