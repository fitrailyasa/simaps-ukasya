<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalTGR;
use App\Models\PengundianTGR;
use App\Models\Gelanggang;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\JadwaltgrImport;

class AdminJadwalTGRController extends Controller
{
    public function index()
    {
        $gelanggangs = Gelanggang::all();
        $pengundiantgrs = PengundianTGR::latest('id')->get();
        $jadwaltgrs = JadwalTGR::orderBy('partai')->get();
        return view('admin.jadwal-tgr.index', compact('jadwaltgrs', 'gelanggangs', 'pengundiantgrs'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $teams = PengundianTGR::with('TGR')
            ->whereHas('TGR', function ($query) use ($request) {
                $query->where('golongan', $request->golongan)
                    ->where('jenis_kelamin', $request->jenis_kelamin)
                    ->where('kategori', $request->kategori);
            })
            ->get();

        $file = $request->file('file');

        Excel::import(new JadwalTGRImport($teams), $file);

        return back()->with('sukses', 'Berhasil Import Data Jadwal!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'partai' => 'required|max:255',
            'gelanggang' => 'required|max:255',
            'babak' => 'required|max:255',
            'sudut_biru' => 'required|max:255',
            'sudut_merah' => 'required|max:255',
            'next_sudut' => 'required|max:255',
            'next_partai' => 'required|max:255',
        ]);

        JadwalTGR::create($request->all());

        return back()->with('sukses', 'Berhasil Tambah Data Jadwal!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'partai' => 'required|max:255',
            'gelanggang' => 'required|max:255',
            'babak' => 'required|max:255',
            'sudut_biru' => 'required|max:255',
            'sudut_merah' => 'required|max:255',
            'next_sudut' => 'required|max:255',
            'next_partai' => 'required|max:255',
        ]);

        $jadwaltgr = JadwalTGR::findOrFail($id);
        $jadwaltgr->update($request->all());

        return back()->with('sukses', 'Berhasil Edit Data Jadwal!');
    }

    public function destroy($id)
    {
        $jadwaltgr = JadwalTGR::findOrFail($id);
        $jadwaltgr->delete();

        return back()->with('sukses', 'Berhasil Hapus Data Jadwal!');
    }

    public function destroyAll()
    {
        JadwalTGR::truncate();

        return back()->with('sukses', 'Berhasil Hapus Semua Data Jadwal!');
    }
}
