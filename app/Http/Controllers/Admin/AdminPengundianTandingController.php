<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengundianTanding;
use App\Models\Tanding;
use Illuminate\Http\Request;

class AdminPengundianTandingController extends Controller
{
    public function index()
    {
        $kelompok = PengundianTanding::max('kelompok') ?? 0;
        $tandings = Tanding::all();
        $pengundiantandings = PengundianTanding::with('tanding')->latest('id')->get();
        return view('admin.pengundian-tanding.index', compact('pengundiantandings', 'tandings', 'kelompok'));
    }

    public function table(Request $request, $kelompok)
    {
        $tandings = Tanding::all();
        $pengundiantandings = PengundianTanding::with('tanding')
            ->where('kelompok', $kelompok) // Filter by kelompok value
            ->first('partai')
            ->get();

        return view('admin.pengundian-tanding.table', compact('pengundiantandings', 'tandings'));
    }

    public function store(Request $request)
    {
        $golongan = $request->golongan;
        $jenis_kelamin = $request->jenis_kelamin;
        $kelas = $request->kelas;

        // Filter data atlet sesuai dengan golongan, jenis kelamin, dan kelas
        $tandings = Tanding::where('golongan', $golongan)
            ->where('jenis_kelamin', $jenis_kelamin)
            ->where('kelas', $kelas)
            ->get();

        if ($tandings->isEmpty()) {
            return redirect()->back()->with('alert', 'Data Kosong!');
        }

        // Lakukan pengacakan dan penyimpanan
        $existingAtletIds = PengundianTanding::pluck('atlet_id')->toArray();
        $totalPeserta = $tandings->count();

        $shuffledAtletIds = $tandings->pluck('id')->shuffle()->toArray();

        $kelompok = PengundianTanding::max('kelompok') ?? 0; // Get the maximum kelompok value from the database

        $kelompok++; // Increment kelompok for each new entry

        foreach ($shuffledAtletIds as $index => $atletId) {
            if (in_array($atletId, $existingAtletIds)) {
                continue;
            }

            $pengundiantanding = new PengundianTanding();
            $pengundiantanding->atlet_id = $atletId;
            $pengundiantanding->no_undian = $index + 1;
            $pengundiantanding->kelompok = $kelompok; // Assign kelompok value
            $pengundiantanding->save();

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

        $pengundiantanding = PengundianTanding::findOrFail($id);
        $pengundiantanding->update($request->all());

        return back()->with('sukses', 'Berhasil Edit Data Undian!');
    }

    public function destroy($id)
    {
        $pengundiantanding = PengundianTanding::findOrFail($id);
        $pengundiantanding->delete();

        return back()->with('sukses', 'Berhasil Hapus Data Undian!');
    }

    public function destroyAll()
    {
        PengundianTanding::truncate();

        return back()->with('sukses', 'Berhasil Hapus Semua Data Undian!');
    }
}
