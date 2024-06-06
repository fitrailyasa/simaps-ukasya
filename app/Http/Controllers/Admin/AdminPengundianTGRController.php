<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengundianTGR;
use App\Models\TGR;
use Illuminate\Http\Request;

class AdminPengundianTGRController extends Controller
{
    public function index()
    {
        $kelompok = PengundianTGR::max('kelompok') ?? 0;
        $tgrs = TGR::all();
        $pengundiantgrs = PengundianTGR::with('tgr')->latest('id')->get();
        return view('admin.pengundian-tgr.index', compact('pengundiantgrs', 'tgrs', 'kelompok'));
    }

    public function table(Request $request, $kelompok)
    {
        $tgrs = TGR::all();
        $pengundiantgrs = PengundianTGR::with('tgr')
            ->where('kelompok', $kelompok) // Filter by kelompok value
            ->orderBy('partai')
            ->get();

        return view('admin.pengundian-tgr.table', compact('pengundiantgrs', 'tgrs'));
    }

    public function store(Request $request)
    {
        $golongan = $request->golongan;
        $jenis_kelamin = $request->jenis_kelamin;
        $kategori = $request->kategori;

        // Filter data atlet sesuai dengan golongan, jenis kelamin, dan kategori
        $tgrs = TGR::where('golongan', $golongan)
            ->where('jenis_kelamin', $jenis_kelamin)
            ->where('kategori', $kategori)
            ->get();

        if ($tgrs->isEmpty()) {
            return redirect()->back()->with('alert', 'Data Kosong!');
        }

        // Lakukan pengacakan dan penyimpanan
        $existingAtletIds = PengundianTGR::pluck('atlet_id')->toArray();
        $totalPeserta = $tgrs->count();

        $shuffledAtletIds = $tgrs->pluck('id')->shuffle()->toArray();

        $kelompok = PengundianTGR::max('kelompok') ?? 0; // Get the maximum kelompok value from the database

        $kelompok++; // Increment kelompok for each new entry

        foreach ($shuffledAtletIds as $index => $atletId) {
            if (in_array($atletId, $existingAtletIds)) {
                continue;
            }

            $pengundiantgr = new PengundianTGR();
            $pengundiantgr->atlet_id = $atletId;
            $pengundiantgr->no_undian = $index + 1;
            $pengundiantgr->kelompok = $kelompok; // Assign kelompok value
            $pengundiantgr->save();

            $existingAtletIds[] = $atletId;
        }

        return back()->with('sukses', 'Berhasil Tambah Data Undian!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'atlet_id' => 'required|max:255',
            'no_undian' => 'required|max:255',
        ]);

        $pengundiantgr = PengundianTGR::findOrFail($id);
        $pengundiantgr->update($request->all());

        return back()->with('sukses', 'Berhasil Edit Data Undian!');
    }

    public function destroy($id)
    {
        $pengundiantgr = PengundianTGR::findOrFail($id);
        $pengundiantgr->delete();

        return back()->with('sukses', 'Berhasil Hapus Data Undian!');
    }

    public function destroyAll()
    {
        PengundianTGR::truncate();

        return back()->with('sukses', 'Berhasil Hapus Semua Data Undian!');
    }
}
