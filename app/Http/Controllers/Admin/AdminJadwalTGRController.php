<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalTGR;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\JadwaltgrImport;

class AdminJadwalTGRController extends Controller
{
    public function index()
    {
        $jadwaltgrs = JadwalTGR::latest('id')->get();
        return view('admin.jadwal-tgr.index', compact('jadwaltgrs'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new JadwalTGRImport, $file);

        return redirect()->route('admin.jadwal-tgr.index')->with('sukses', 'Berhasil Import Data Atlet!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'partai' => 'required|max:255',
            'tanggal' => 'required|max:255',
            'gelanggang' => 'required|max:255',
            'babak' => 'required|max:255',
            'kelompok' => 'required|max:255',
            'pemain_biru' => 'required|max:255',
            'partai_biru' => 'required|max:255',
            'pemain_merah' => 'required|max:255',
            'partai_merah' => 'required|max:255',
            'status' => 'max:255',
            'pemenang' => 'max:255',
            'aktif' => 'max:255'
        ]);

        JadwalTGR::create($request->all());

        return redirect()->route('admin.jadwal-tgr.index')->with('sukses', 'Berhasil Tambah Atlet!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'partai' => 'required|max:255',
            'tanggal' => 'required|max:255',
            'gelanggang' => 'required|max:255',
            'babak' => 'required|max:255',
            'kelompok' => 'required|max:255',
            'pemain_biru' => 'required|max:255',
            'partai_biru' => 'required|max:255',
            'pemain_merah' => 'required|max:255',
            'partai_merah' => 'required|max:255',
            'status' => 'max:255',
            'pemenang' => 'max:255',
            'aktif' => 'max:255'
        ]);

        $jadwaltgr = JadwalTGR::findOrFail($id);
        $jadwaltgr->update($request->all());

        return redirect()->route('admin.jadwal-tgr.index')->with('sukses', 'Berhasil Edit Atlet!');
    }

    public function destroy($id)
    {
        $jadwaltgr = JadwalTGR::findOrFail($id);
        $jadwaltgr->delete();

        return redirect()->route('admin.jadwal-tgr.index')->with('sukses', 'Berhasil Hapus Atlet!');
    }

    public function destroyAll()
    {
        JadwalTGR::truncate();

        return redirect()->route('admin.jadwal-tgr.index')->with('sukses', 'Berhasil Hapus Semua Data Atlet!');
    }
}
