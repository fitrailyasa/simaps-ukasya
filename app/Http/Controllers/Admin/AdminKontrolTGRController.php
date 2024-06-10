<?php

namespace App\Http\Controllers\Admin;

use App\Events\GantiGelanggang;
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
        if(auth()->user()->roles_id == 1){
            $jadwaltgrs = JadwalTGR::latest('id')->get();
        }else if(auth()->user()->roles_id == 2){
            $jadwaltgrs = JadwalTGR::latest('id')->where('jenis',$gelanggang_operator->jenis)->get();
        }
        if(auth()->user()->roles_id == 1){
            return view('admin.kontrol-tgr.index', compact('jadwaltgrs', 'gelanggangs', 'pengundiantgrs','gelanggang_operator'));
        }else if(auth()->user()->roles_id == 2){
            return view('operator.kontrol-tgr.index', compact('jadwaltgrs', 'gelanggangs', 'pengundiantgrs','gelanggang_operator'));
        }
    }

    public function ubahtahap(Request $request,$jadwal_tunggal_id,$jenis)
    {
        $jadwaltgr = JadwalTGR::find($jadwal_tunggal_id);
        $gelanggang = $jadwaltgr->Gelanggang;
        if ($jadwaltgr) {
            $gelanggang->jadwal = $jadwaltgr->id;
            $gelanggang->jenis = $jenis;
            $jadwaltgr->tahap = 'persiapan';
            $gelanggang->save();
            $jadwaltgr->save();
            GantiGelanggang::dispatch($jadwaltgr->Gelanggang);
            return back()->with('sukses', 'Berhasil Mengganti Jadwal!');
        } else {
            return back()->withErrors(['error' => 'Gagal mengubah tahap jadwal.']);
        }
    }

    public function stop_pertandingan(Request $request,$jadwal_tgr_id)
    {
        $jadwaltgr = JadwalTGR::find($jadwal_tgr_id);
        if ($jadwaltgr) {
            $jadwaltgr->tahap = "keputusan";
            $jadwaltgr->save();
            GantiGelanggang::dispatch($jadwaltgr->Gelanggang);
            return back()->with('sukses', 'Berhasil Menghentikan Pertandingan!');
        } else {
            return back()->withErrors(['error' => 'Gagal mengubah tahap jadwal.']);
        }
    }
    public function reset(Request $request,$jadwal_tgr_id)
    {
        $jadwaltgr = JadwalTGR::find($jadwal_tgr_id);
        if ($jadwaltgr) {
            $jadwaltgr->tahap = "menunggu";
            $jadwaltgr->save();
            GantiGelanggang::dispatch($jadwaltgr->Gelanggang);
            return back()->with('sukses', 'Berhasil Mengulang Pertandingan!');
        } else {
            return back()->withErrors(['error' => 'Gagal mengubah tahap jadwal.']);
        }
    }

}
