<?php

namespace App\Http\Controllers\Juri;

use App\Http\Controllers\Controller;
use App\Models\Tanding;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TandingImport;

class JuriTandingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('juri.tanding.index', compact('user'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new TandingImport, $file);

        return redirect()->route('admin.tanding.index')->with('sukses', 'Berhasil Import Data Atlet!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'tinggi_badan' => 'required|max:255',
            'berat_badan' => 'required|max:255',
            'kontingen' => 'required|max:255',
            'kelas' => 'required|max:255', 
            'golongan' => 'required|max:255'
        ]);

        Tanding::create($request->all());

        return redirect()->route('admin.tanding.index')->with('sukses', 'Berhasil Tambah Atlet!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'tinggi_badan' => 'required|max:255',
            'berat_badan' => 'required|max:255',
            'kontingen' => 'required|max:255',
            'kelas' => 'required|max:255', 
            'golongan' => 'required|max:255'
        ]);

        $tanding = Tanding::findOrFail($id);
        $tanding->update($request->all());

        return redirect()->route('admin.tanding.index')->with('sukses', 'Berhasil Edit Atlet!');
    }

    public function destroy($id)
    {
        $tanding = Tanding::findOrFail($id);
        $tanding->delete();

        return redirect()->route('admin.tanding.index')->with('sukses', 'Berhasil Hapus Atlet!');
    }

    public function destroyAll()
    {
        Tanding::truncate();

        return redirect()->route('admin.tanding.index')->with('sukses', 'Berhasil Hapus Semua Data Atlet!');
    }
}
