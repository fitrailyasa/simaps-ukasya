<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gelanggang;
use App\Models\JadwalTanding;
use App\Models\JadwalTGR;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GelanggangImport;

class AdminGelanggangController extends Controller
{
    public function index()
    {
        $gelanggangs = Gelanggang::all();
        return view('admin.gelanggang.index', compact('gelanggangs'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new GelanggangImport, $file);

        return redirect()->route('admin.gelanggang.index')->with('sukses', 'Berhasil Import Data Undian!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'waktu' => 'required|max:255',
            'jenis' => 'required|max:255',
        ]);

        Gelanggang::create($request->all());

        return redirect()->route('admin.gelanggang.index')->with('sukses', 'Berhasil Tambah Undian!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'waktu' => 'required|max:255',
            'jenis' => 'required|max:255',
        ]);

        $gelanggang = Gelanggang::findOrFail($id);
        $gelanggang->update($request->all());

        return redirect()->route('admin.gelanggang.index')->with('sukses', 'Berhasil Edit Undian!');
    }

    public function destroy($id)
    {
        $gelanggang = Gelanggang::findOrFail($id);
        $gelanggang->delete();

        return redirect()->route('admin.gelanggang.index')->with('sukses', 'Berhasil Hapus Undian!');
    }

    public function destroyAll()
    {
        Gelanggang::truncate();

        return redirect()->route('admin.gelanggang.index')->with('sukses', 'Berhasil Hapus Semua Data Undian!');
    }
}
