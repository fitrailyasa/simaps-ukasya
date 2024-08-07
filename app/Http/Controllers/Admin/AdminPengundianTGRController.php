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
        $tgrs = TGR::all();
        $pengundiantgrs = PengundianTGR::with('tgr')->latest('id')->get();
        return view('admin.pengundian-tgr.index', compact('pengundiantgrs', 'tgrs'));
    }

    public function table(Request $request, $golongan, $jenis_kelamin, $kategori)
    {
        $tgrs = TGR::all();
        $pengundiantgrs = PengundianTGR::with('TGR')
            ->whereHas('TGR', function ($query) use ($request) {
                $query->where('golongan', $request->golongan)
                    ->where('jenis_kelamin', $request->jenis_kelamin)
                    ->where('kategori', $request->kategori);
            })
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

        return back()->with('sukses', 'Berhasil Tambah Data Undian!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
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
