<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengundianTanding;
use App\Models\Tanding;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PengundianTandingImport;

class AdminPengundianTandingController extends Controller
{
    public function index()
    {
        $tandings = Tanding::all();
        $pengundiantandings = PengundianTanding::with('tanding')->latest('id')->get();
        return view('admin.pengundian-tanding.index', compact('pengundiantandings', 'tandings'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new PengundianTandingImport, $file);

        return redirect()->route('admin.pengundian-tanding.index')->with('sukses', 'Berhasil Import Data Undian!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'atlet_id' => 'required|max:255', 
            'no_undian' => 'required|max:255',
        ]);

        PengundianTanding::create($request->all());

        return redirect()->route('admin.pengundian-tanding.index')->with('sukses', 'Berhasil Tambah Undian!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'atlet_id' => 'required|max:255',
            'no_undian' => 'required|max:255',
        ]);

        $pengundiantanding = PengundianTanding::findOrFail($id);
        $pengundiantanding->update($request->all());

        return redirect()->route('admin.pengundian-tanding.index')->with('sukses', 'Berhasil Edit Undian!');
    }

    public function destroy($id)
    {
        $pengundiantanding = PengundianTanding::findOrFail($id);
        $pengundiantanding->delete();

        return redirect()->route('admin.pengundian-tanding.index')->with('sukses', 'Berhasil Hapus Undian!');
    }

    public function destroyAll()
    {
        PengundianTanding::truncate();

        return redirect()->route('admin.pengundian-tanding.index')->with('sukses', 'Berhasil Hapus Semua Data Undian!');
    }
}
