<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalTanding;
use App\Models\Gelanggang;
use Illuminate\Http\Request;

class AdminTimbangUlangController extends Controller
{
    public function index()
    {
        $gelanggangs = Gelanggang::all();
        $jadwaltandings = JadwalTanding::orderBy('partai')->get();
        $timbangulangs = JadwalTanding::orderBy('partai')->get();
        return view('admin.timbang-ulang.index', compact('jadwaltandings', 'gelanggangs', 'timbangulangs'));
    }

    public function update(Request $request, $id)
    {
        $TimbangUlang = JadwalTanding::findOrFail($id);
        $request->validate([
            'berat_biru' => 'required|max:255',
            'status_biru' => 'required|max:255',
            'berat_merah' => 'required|max:255',
            'status_merah' => 'required|max:255',
        ]);

        // dd($request->all());

        $TimbangUlang->update([
            'berat_biru' => $request->berat_biru,
            'status_biru' => $request->status_biru,
            'berat_merah' => $request->berat_merah,
            'status_merah' => $request->status_merah,
        ]);

        return back()->with('sukses', 'Berhasil Edit Data!');
    }

    public function destroy($id)
    {
        $TimbangUlang = JadwalTanding::findOrFail($id);
        $TimbangUlang->delete();

        return back()->with('sukses', 'Berhasil Hapus Data!');
    }
}
