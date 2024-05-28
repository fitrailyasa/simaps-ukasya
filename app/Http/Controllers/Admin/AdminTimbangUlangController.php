<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalTanding;
use App\Models\TimbangUlang;
use App\Models\Gelanggang;
use Illuminate\Http\Request;

class AdminTimbangUlangController extends Controller
{
    public function index()
    {
        $gelanggangs = Gelanggang::all();
        $jadwaltandings = JadwalTanding::latest('id')->get();
        $timbangulangs = TimbangUlang::latest('id')->get();
        return view('admin.timbang-ulang.index', compact('jadwaltandings', 'gelanggangs', 'timbangulangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'partai' => 'required|max:255',
            'gelanggang' => 'required|max:255',
            'babak' => 'required|max:255',
            'kelas' => 'required|max:255',
            'sudut_biru' => 'required|max:255',
            'berat_biru' => 'required|max:255',
            'status_biru' => 'required|max:255',
            'sudut_merah' => 'required|max:255',
            'berat_merah' => 'required|max:255',
            'status_merah' => 'required|max:255',
        ]);

        $TimbangUlang = TimbangUlang::create([
            'partai' => $request->partai,
            'gelanggang' => $request->gelanggang,
            'babak' => $request->babak,
            'kelas' => $request->kelas,
            'sudut_biru' => $request->sudut_biru,
            'berat_biru' => $request->berat_biru,
            'status_biru' => $request->status_biru,
            'sudut_merah' => $request->sudut_merah,
            'berat_merah' => $request->berat_merah,
            'status_merah' => $request->status_merah,
        ]);

        return back()->with('sukses', 'Berhasil Tambah Data!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'partai' => 'required|max:255',
            'gelanggang' => 'required|max:255',
            'babak' => 'required|max:255',
            'kelas' => 'required|max:255',
            'sudut_biru' => 'required|max:255',
            'berat_biru' => 'required|max:255',
            'status_biru' => 'required|max:255',
            'sudut_merah' => 'required|max:255',
            'berat_merah' => 'required|max:255',
            'status_merah' => 'required|max:255',
        ]);

        $TimbangUlang = TimbangUlang::findOrFail($id);
        $TimbangUlang->update($request->all());

        return back()->with('sukses', 'Berhasil Edit Data!');
    }

    public function destroy($id)
    {
        $TimbangUlang = TimbangUlang::findOrFail($id);
        $TimbangUlang->delete();

        return back()->with('sukses', 'Berhasil Hapus Data!');
    }
}
