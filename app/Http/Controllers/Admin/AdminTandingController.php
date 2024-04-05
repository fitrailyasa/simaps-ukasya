<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tanding;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TandingImport;

class AdminTandingController extends Controller
{
    public function index()
    {
        $tandings = Tanding::latest('id')->get();
        return view('admin.tanding.index', compact('tandings'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new TandingImport, $file);

        if(auth()->user()->roles_id == 1){
            return redirect()->route('admin.tanding.index')->with('sukses', 'Berhasil Import Data Atlet!');
        }
        else if(auth()->user()->roles_id == 2){
            return redirect()->route('op.tanding.index')->with('sukses', 'Berhasil Import Data Atlet!');
        }
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

        $tanding = Tanding::create([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'kontingen' => $request->kontingen,
            'kelas' => $request->kelas,
            'golongan' => $request->golongan,
        ]);

        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $file_name = time() . '_' . $tanding->nama . '.' . $img->getClientOriginalExtension();
            $tanding->img = $file_name;
            $tanding->update();
            $img->move('../public/assets/img/', $file_name);
        }

        if(auth()->user()->roles_id == 1){
            return redirect()->route('admin.tanding.index')->with('sukses', 'Berhasil Tambah Data Atlet!');
        }
        else if(auth()->user()->roles_id == 2){
            return redirect()->route('op.tanding.index')->with('sukses', 'Berhasil Tambah Data Atlet!');
        }
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
        $tanding->update([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'kontingen' => $request->kontingen,
            'kelas' => $request->kelas,
            'golongan' => $request->golongan,
        ]);

        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $file_name = time() . '_' . $tanding->nama . '.' . $img->getClientOriginalExtension();
            $tanding->img = $file_name;
            $tanding->update();
            $img->move('../public/assets/img/', $file_name);
        }

        if(auth()->user()->roles_id == 1){
            return redirect()->route('admin.tanding.index')->with('sukses', 'Berhasil Edit Data Atlet!');
        }
        else if(auth()->user()->roles_id == 2){
            return redirect()->route('op.tanding.index')->with('sukses', 'Berhasil Edit Data Atlet!');
        }
    }

    public function destroy($id)
    {
        $tanding = Tanding::findOrFail($id);
        $tanding->delete();

        if(auth()->user()->roles_id == 1){
            return redirect()->route('admin.tanding.index')->with('sukses', 'Berhasil Hapus Data Atlet!');
        }
        else if(auth()->user()->roles_id == 2){
            return redirect()->route('op.tanding.index')->with('sukses', 'Berhasil Hapus Data Atlet!');
        }
    }

    public function destroyAll()
    {
        Tanding::truncate();

        if(auth()->user()->roles_id == 1){
            return redirect()->route('admin.tanding.index')->with('sukses', 'Berhasil Hapus Semua Data Atlet!');
        }
        else if(auth()->user()->roles_id == 2){
            return redirect()->route('op.tanding.index')->with('sukses', 'Berhasil Hapus Semua Data Atlet!');
        }
    }
}
