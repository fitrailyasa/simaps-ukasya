<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\JadwalImport;

class AdminjadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::latest('id')->get();
        return view('admin.jadwal.index', compact('jadwals'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new JadwalImport, $file);

        return redirect()->route('admin.jadwal.index')->with('sukses', 'Berhasil Import Data Atlit!');
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

        Jadwal::create($request->all());

        return redirect()->route('admin.jadwal.index')->with('sukses', 'Berhasil Tambah Atlit!');
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

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal.index')->with('sukses', 'Berhasil Edit Atlit!');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('sukses', 'Berhasil Hapus Atlit!');
    }

    public function destroyAll()
    {
        Jadwal::truncate();

        return redirect()->route('admin.jadwal.index')->with('sukses', 'Berhasil Hapus Semua Data Atlit!');
    }
}
