<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalTanding;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\JadwalTandingImport;

class AdminJadwalTandingController extends Controller
{
    public function index()
    {
        $jadwaltandings = JadwalTanding::latest('id')->get();
        return view('admin.jadwal-tanding.index', compact('jadwaltandings'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new JadwalTandingImport, $file);

        return redirect()->route('admin.jadwal-tanding.index')->with('sukses', 'Berhasil Import Data Atlet!');
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

        JadwalTanding::create($request->all());

        return redirect()->route('admin.jadwal-tanding.index')->with('sukses', 'Berhasil Tambah Atlet!');
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

        $jadwaltanding = JadwalTanding::findOrFail($id);
        $jadwaltanding->update($request->all());

        return redirect()->route('admin.jadwal-tanding.index')->with('sukses', 'Berhasil Edit Atlet!');
    }

    public function destroy($id)
    {
        $jadwaltanding = JadwalTanding::findOrFail($id);
        $jadwaltanding->delete();

        return redirect()->route('admin.jadwal-tanding.index')->with('sukses', 'Berhasil Hapus Atlet!');
    }

    public function destroyAll()
    {
        JadwalTanding::truncate();

        return redirect()->route('admin.jadwal-tanding.index')->with('sukses', 'Berhasil Hapus Semua Data Atlet!');
    }
}
