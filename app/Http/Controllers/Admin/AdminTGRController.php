<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TGR;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TGRImport;

class AdminTGRController extends Controller
{
    public function index()
    {
        $tgrs = TGR::latest('id')->get();
        return view('admin.tgr.index', compact('tgrs'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new TGRImport, $file);

        return redirect()->route('admin.tgr.index')->with('sukses', 'Berhasil Import Data Atlet!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'kontingen' => 'required|max:255',
            'kategori' => 'required|max:255', 
            'golongan' => 'required|max:255'
        ]);

        $tgr = TGR::create([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kontingen' => $request->kontingen,
            'kategori' => $request->kategori,
            'golongan' => $request->golongan,
        ]);

        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $file_name = time() . '_' . $tgr->nama . '.' . $img->getClientOriginalExtension();
            $tgr->img = $file_name;
            $tgr->save();
            $img->move('../public/assets/img/', $file_name);
        }

        return redirect()->route('admin.tgr.index')->with('sukses', 'Berhasil Tambah Atlet!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'kontingen' => 'required|max:255',
            'kategori' => 'required|max:255', 
            'golongan' => 'required|max:255'
        ]);

        $tgr = TGR::findOrFail($id);
        $tgr->update([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kontingen' => $request->kontingen,
            'kategori' => $request->kategori,
            'golongan' => $request->golongan,
        ]);

        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $file_name = time() . '_' . $tgr->nama . '.' . $img->getClientOriginalExtension();
            $tgr->img = $file_name;
            $tgr->save();
            $img->move('../public/assets/img/', $file_name);
        }

        return redirect()->route('admin.tgr.index')->with('sukses', 'Berhasil Edit Atlet!');
    }

    public function destroy($id)
    {
        $tgr = TGR::findOrFail($id);
        $tgr->delete();

        return redirect()->route('admin.tgr.index')->with('sukses', 'Berhasil Hapus Atlet!');
    }

    public function destroyAll()
    {
        TGR::truncate();

        return redirect()->route('admin.tgr.index')->with('sukses', 'Berhasil Hapus Semua Data Atlet!');
    }
}
