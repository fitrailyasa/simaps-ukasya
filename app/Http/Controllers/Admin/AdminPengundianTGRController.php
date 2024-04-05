<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengundianTGR;
use App\Models\TGR;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PengundianTGRImport;

class AdminPengundianTGRController extends Controller
{
    public function index()
    {
        $tgrs = TGR::all();
        $pengundiantgrs = PengundianTGR::with('tgr')->latest('id')->get();
        return view('admin.pengundian-tgr.index', compact('pengundiantgrs', 'tgrs'));
    }
    
    public function table()
    {
        $tgrs = TGR::all();
        $pengundiantgrs = PengundianTGR::with('tgr')->latest('id')->get();
        return view('admin.pengundian-tgr.table', compact('pengundiantgrs', 'tgrs'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new PengundianTGRImport, $file);

        if(auth()->user()->roles_id == 1){
            return redirect()->route('admin.pengundian-tgr.index')->with('sukses', 'Berhasil Import Data Undian!');
        }
        else if(auth()->user()->roles_id == 2){
            return redirect()->route('op.pengundian-tgr.index')->with('sukses', 'Berhasil Import Data Undian!');
        }
    }

    public function store(Request $request)
    {
        $tgrs = TGR::all();        
        $existingAtletIds = PengundianTGR::pluck('atlet_id')->toArray();
        $totalPeserta = $tgrs->count();        

        $shuffledAtletIds = $tgrs->pluck('id')->shuffle()->toArray();

        foreach ($shuffledAtletIds as $index => $atletId) {
            if (in_array($atletId, $existingAtletIds)) {
                continue;
            }

            $pengundiantgr = new PengundianTGR();
            $pengundiantgr->atlet_id = $atletId;
            $pengundiantgr->no_undian = $index + 1;
            $pengundiantgr->save();

            $existingAtletIds[] = $atletId;
        }

        if(auth()->user()->roles_id == 1){
            return redirect()->route('admin.pengundian-tgr.index')->with('sukses', 'Berhasil Tambah Data Undian!');
        }
        else if(auth()->user()->roles_id == 2){
            return redirect()->route('op.pengundian-tgr.index')->with('sukses', 'Berhasil Tambah Data Undian!');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'atlet_id' => 'required|max:255',
            'no_undian' => 'required|max:255',
        ]);

        $pengundiantgr = PengundianTGR::findOrFail($id);
        $pengundiantgr->update($request->all());

        if(auth()->user()->roles_id == 1){
            return redirect()->route('admin.pengundian-tgr.index')->with('sukses', 'Berhasil Edit Data Undian!');
        }
        else if(auth()->user()->roles_id == 2){
            return redirect()->route('op.pengundian-tgr.index')->with('sukses', 'Berhasil Edit Data Undian!');
        }
    }

    public function destroy($id)
    {
        $pengundiantgr = PengundianTGR::findOrFail($id);
        $pengundiantgr->delete();

        if(auth()->user()->roles_id == 1){
            return redirect()->route('admin.pengundian-tgr.index')->with('sukses', 'Berhasil Hapus Data Undian!');
        }
        else if(auth()->user()->roles_id == 2){
            return redirect()->route('op.pengundian-tgr.index')->with('sukses', 'Berhasil Hapus Data Undian!');
        }
    }

    public function destroyAll()
    {
        PengundianTGR::truncate();

        if(auth()->user()->roles_id == 1){
            return redirect()->route('admin.pengundian-tgr.index')->with('sukses', 'Berhasil Hapus Semua Data Undian!');
        }
        else if(auth()->user()->roles_id == 2){
            return redirect()->route('op.pengundian-tgr.index')->with('sukses', 'Berhasil Hapus Semua Data Undian!');
        }
    }
}
