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
    
    public function table()
    {
        $tandings = Tanding::all();
        $pengundiantandings = PengundianTanding::with('tanding')->latest('id')->get();
        return view('admin.pengundian-tanding.table', compact('pengundiantandings', 'tandings'));
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
        $tandings = Tanding::all();        
        $existingAtletIds = PengundianTanding::pluck('atlet_id')->toArray();
        $totalPeserta = $tandings->count();        

        $shuffledAtletIds = $tandings->pluck('id')->shuffle()->toArray();

        foreach ($shuffledAtletIds as $index => $atletId) {
            if (in_array($atletId, $existingAtletIds)) {
                continue;
            }

            $pengundianTanding = new PengundianTanding();
            $pengundianTanding->atlet_id = $atletId;
            $pengundianTanding->no_undian = $index + 1;
            $pengundianTanding->save();

            $existingAtletIds[] = $atletId;
        }

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
