<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tanding;
use App\Models\TGR;
use Illuminate\Http\Request;

class AdminPengundianController extends Controller
{
    public function index()
    {
        $tandings = Tanding::all();
        $tgrs = TGR::all();
        return view('admin.pengundian.index', compact('tandings', 'tgrs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'jenis_kelamin' => 'max:255',
            'tinggi_badan' => 'max:255',
            'berat_badan' => 'required|max:255',
            'kontingen' => 'required|max:255',
            'kelas' => 'max:255', 
            'kategori' => 'max:255',   
            'golongan' => 'required|max:255'
        ]);

        Tanding::create($request->all());
        TGR::create($request->all());

        return redirect()->route('admin.pengundian.index')->with('sukses', 'Berhasil Tambah pengundian!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'tinggi_badan' => 'max:255',
            'berat_badan' => 'max:255',    
            'jenis_kelamin' => 'required|max:255',
            'kontingen' => 'required|max:255',
            'kelas' => 'max:255', 
            'kategori' => 'max:255',
            'golongan' => 'required|max:255'
        ]);

        $tanding = Tanding::findOrFail($id);
        $tanding->update($request->all());
        
        $tgr = TGR::findOrFail($id);
        $tgr->update($request->all());

        return redirect()->route('admin.pengundian.index')->with('sukses', 'Berhasil Edit pengundian!');
    }

    public function destroy($id)
    {
        $tanding = Tanding::findOrFail($id);
        $tanding->delete();
        
        $tgr = TGR::findOrFail($id);
        $tgr->delete();

        return redirect()->route('admin.pengundian.index')->with('sukses', 'Berhasil Hapus pengundian!');
    }
}
