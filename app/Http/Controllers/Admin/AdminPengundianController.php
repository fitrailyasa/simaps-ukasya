<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengundian;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PengundianImport;

class AdminPengundianController extends Controller
{
    public function index()
    {
        $pengundians = Pengundian::latest('id')->get();
        return view('admin.pengundian.index', compact('pengundians'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new PengundianImport, $file);

        return redirect()->route('admin.pengundian.index')->with('sukses', 'Berhasil Import Data Undian!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'golongan' => 'required|max:255',
            'kelas_kategori' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'kontingen' => 'required|max:255',  
            'no_undian' => 'required|max:255',
        ]);

        Pengundian::create($request->all());

        return redirect()->route('admin.pengundian.index')->with('sukses', 'Berhasil Tambah Undian!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'golongan' => 'required|max:255',
            'kelas_kategori' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'kontingen' => 'required|max:255',
            'no_undian' => 'required|max:255',
        ]);

        $pengundian = Pengundian::findOrFail($id);
        $pengundian->update($request->all());

        return redirect()->route('admin.pengundian.index')->with('sukses', 'Berhasil Edit Undian!');
    }

    public function destroy($id)
    {
        $pengundian = Pengundian::findOrFail($id);
        $pengundian->delete();

        return redirect()->route('admin.pengundian.index')->with('sukses', 'Berhasil Hapus Undian!');
    }

    public function destroyAll()
    {
        Pengundian::truncate();

        return redirect()->route('admin.pengundian.index')->with('sukses', 'Berhasil Hapus Semua Data Undian!');
    }
}
