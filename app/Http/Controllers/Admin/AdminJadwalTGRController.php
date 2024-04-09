<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalTGR;
use App\Models\PengundianTGR;
use App\Models\Gelanggang;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\JadwaltgrImport;

class AdminJadwalTGRController extends Controller
{
    public function index()
    {
        $gelanggangs = Gelanggang::all();
        $pengundiantgrs = PengundianTGR::latest('id')->get();
        $jadwaltgrs = JadwalTGR::latest('id')->get();
        return view('admin.jadwal-tgr.index', compact('jadwaltgrs', 'gelanggangs', 'pengundiantgrs'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new JadwalTGRImport($request->kelompok), $file);

        if(auth()->user()->roles_id == 1){
            return redirect()->route('admin.jadwal-tgr.index')->with('sukses', 'Berhasil Import Data Jadwal!');
        }
        else if(auth()->user()->roles_id == 2){
            return redirect()->route('op.jadwal-tgr.index')->with('sukses', 'Berhasil Import Data Jadwal!');
        }
    }

    public function store(Request $request)
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

        JadwalTGR::create($request->all());

        if(auth()->user()->roles_id == 1){
            return redirect()->route('admin.jadwal-tgr.index')->with('sukses', 'Berhasil Tambah Data Jadwal!');
        }
        else if(auth()->user()->roles_id == 2){
            return redirect()->route('op.jadwal-tgr.index')->with('sukses', 'Berhasil Tambah Data Jadwal!');
        }
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

        if(auth()->user()->roles_id == 1){
            return redirect()->route('admin.jadwal-tgr.index')->with('sukses', 'Berhasil Edit Data Jadwal!');
        }
        else if(auth()->user()->roles_id == 2){
            return redirect()->route('op.jadwal-tgr.index')->with('sukses', 'Berhasil Edit Data Jadwal!');
        }
    }

    public function destroy($id)
    {
        $jadwaltgr = JadwalTGR::findOrFail($id);
        $jadwaltgr->delete();

        if(auth()->user()->roles_id == 1){
            return redirect()->route('admin.jadwal-tgr.index')->with('sukses', 'Berhasil Hapus Data Jadwal!');
        }
        else if(auth()->user()->roles_id == 2){
            return redirect()->route('op.jadwal-tgr.index')->with('sukses', 'Berhasil Hapus Data Jadwal!');
        }
    }

    public function destroyAll()
    {
        JadwalTGR::truncate();

        if(auth()->user()->roles_id == 1){
            return redirect()->route('admin.jadwal-tgr.index')->with('sukses', 'Berhasil Hapus Semua Data Jadwal!');
        }
        else if(auth()->user()->roles_id == 2){
            return redirect()->route('op.jadwal-tgr.index')->with('sukses', 'Berhasil Hapus Semua Data Jadwal!');
        }
    }
}
