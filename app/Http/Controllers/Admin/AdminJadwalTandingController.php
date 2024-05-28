<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalTanding;
use App\Models\PengundianTanding; 
use App\Models\PenilaianTanding; 
use App\Models\PukulanEventSent; 
use App\Models\TendanganEventSent; 
use App\Models\Gelanggang;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\JadwalTandingImport;

class AdminJadwalTandingController extends Controller
{
    public function index()
    {
        $gelanggangs = Gelanggang::all();
        $pengundiantandings = PengundianTanding::latest('id')->get();
        $jadwaltandings = JadwalTanding::latest('id')->get();
        return view('admin.jadwal-tanding.index', compact('jadwaltandings', 'gelanggangs', 'pengundiantandings'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new JadwalTandingImport($request->kelompok), $file);

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
        $jadwal_tanding = JadwalTanding::create($request->all());

        for ($i=1; $i <=3 ; $i++) { 
            PenilaianTanding::create([
            'uuid'=>$jadwal_tanding->created_at->format('YmdHis').$request->sudut_biru.$jadwal_tanding->id.$i,
            'sudut'=>$request->sudut_biru,
            'babak'=>$i,
            'jadwal_tanding' => $jadwal_tanding->id
        ]);
        PenilaianTanding::create([
            'uuid'=>$jadwal_tanding->created_at->format('YmdHis').$request->sudut_merah.$jadwal_tanding->id.$i,
            'sudut'=>$request->sudut_merah,
            'babak'=>$i,
            'jadwal_tanding' => $jadwal_tanding->id
        ]);
        }

        TendanganEventSent::create([
            'uuid'=>$jadwal_tanding->created_at->format('YmdHis').$request->sudut_merah.$jadwal_tanding->id.$i,
            'sudut'=>$request->sudut_merah,
            'jadwal_tanding'=>$jadwal_tanding->id
        ]);
        TendanganEventSent::create([
            'uuid'=>$jadwal_tanding->created_at->format('YmdHis').$request->sudut_biru.$jadwal_tanding->id.$i,
            'sudut'=>$request->sudut_biru,
            'jadwal_tanding'=>$jadwal_tanding->id
        ]);
        PukulanEventSent::create([
            'sudut'=>$request->sudut_merah,
            'jadwal_tanding'=>$jadwal_tanding->id
        ]);
        PukulanEventSent::create([
            'sudut'=>$request->sudut_biru,
            'jadwal_tanding'=>$jadwal_tanding->id
        ]);

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

        $jadwaltanding = JadwalTanding::findOrFail($id);
        $jadwaltanding->update($request->all());

        if(auth()->user()->roles_id == 1){
            return redirect()->route('admin.jadwal-tanding.index')->with('sukses', 'Berhasil Edit Data Jadwal!');
        }
        else if(auth()->user()->roles_id == 2){
            return redirect()->route('op.jadwal-tanding.index')->with('sukses', 'Berhasil Edit Data Jadwal!');
        }
    }

    public function destroy($id)
    {
        $jadwaltanding = JadwalTanding::findOrFail($id);
        $jadwaltanding->delete();

        if(auth()->user()->roles_id == 1){
            return redirect()->route('admin.jadwal-tanding.index')->with('sukses', 'Berhasil Hapus Data Jadwal!');
        }
        else if(auth()->user()->roles_id == 2){
            return redirect()->route('op.jadwal-tanding.index')->with('sukses', 'Berhasil Hapus Data Jadwal!');
        }
    }

    public function destroyAll()
    {
        JadwalTanding::truncate();

        if(auth()->user()->roles_id == 1){
            return redirect()->route('admin.jadwal-tanding.index')->with('sukses', 'Berhasil Hapus Semua Data Jadwal!');
        }
        else if(auth()->user()->roles_id == 2){
            return redirect()->route('op.jadwal-tanding.index')->with('sukses', 'Berhasil Hapus Semua Data Jadwal!');
        }
    }
}
