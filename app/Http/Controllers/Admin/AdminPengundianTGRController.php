<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengundianTGR;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PengundianTGRImport;

class AdminPengundianTGRController extends Controller
{
    public function index()
    {
        $pengundianTGRs = PengundianTGR::latest('id')->get();
        return view('admin.pengundianTGR.index', compact('pengundianTGRs'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new PengundianTGRImport, $file);

        return redirect()->route('admin.pengundianTGR.index')->with('sukses', 'Berhasil Import Data Undian!');
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

        PengundianTGR::create($request->all());

        return redirect()->route('admin.pengundianTGR.index')->with('sukses', 'Berhasil Tambah Undian!');
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

        $pengundianTGR = PengundianTGR::findOrFail($id);
        $pengundianTGR->update($request->all());

        return redirect()->route('admin.pengundianTGR.index')->with('sukses', 'Berhasil Edit Undian!');
    }

    public function destroy($id)
    {
        $pengundianTGR = PengundianTGR::findOrFail($id);
        $pengundianTGR->delete();

        return redirect()->route('admin.pengundianTGR.index')->with('sukses', 'Berhasil Hapus Undian!');
    }

    public function destroyAll()
    {
        PengundianTGR::truncate();

        return redirect()->route('admin.pengundianTGR.index')->with('sukses', 'Berhasil Hapus Semua Data Undian!');
    }
}
