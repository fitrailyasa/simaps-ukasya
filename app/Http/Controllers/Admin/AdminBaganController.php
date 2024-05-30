<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengundianTanding;
use App\Models\PengundianTGR;
use App\Models\Tanding;
use App\Models\TGR;
use Illuminate\Http\Request;

class AdminBaganController extends Controller
{
    public function tanding()
    {
        $pengundiantanding = PengundianTanding::all();
        return view('admin.bagan.tanding', compact('pengundiantanding'));
    }

    public function tgr()
    {
        $pengundiantgr = PengundianTGR::all();
        return view('admin.bagan.tgr', compact('pengundiantgr'));
    }

    public function generateTanding(Request $request)
    {
        $request->validate([
            'golongan' => 'required',
            'jenis_kelamin' => 'required',
            'kelas' => 'required',
        ]);

        $teams = Tanding::where('golongan', $request->golongan)
            ->where('jenis_kelamin', $request->jenis_kelamin)
            ->where('kelas', $request->kelas)
            ->get();

        if ($teams->isEmpty()) {
            return redirect()->back()->with('alert', 'Data Kosong!');
        }

        $teamNames = [];
        $seed = 1;
        foreach ($teams as $team) {
            $teamNames[] = [
                'name' => $team->nama,
                'seed' => $seed,
            ];
            $seed++;
        }

        $teamNamesJson = json_encode($teamNames);

        $script = "<script>
            $(document).ready(function() {
                $('#bracket2').bracket({
                    teams: " . count($teamNames) . ", // Dynamically set the number of teams
                    topOffset: 50,
                    scale: 0.45,
                    horizontal: 0,
                    height: '1000px',
                    icons: true,
                    teamNames: {$teamNamesJson}
                });
            });
        </script>";

        return view('admin.bagan.tanding', compact('script'));
    }

    public function generateTGR(Request $request)
    {
        $request->validate([
            'golongan' => 'required',
            'jenis_kelamin' => 'required',
            'kategori' => 'required',
        ]);

        $teams = TGR::where('golongan', $request->golongan)
            ->where('jenis_kelamin', $request->jenis_kelamin)
            ->where('kategori', $request->kategori)
            ->get();

        if ($teams->isEmpty()) {
            return redirect()->back()->with('alert', 'Data Kosong!');
        }

        $teamNames = [];
        $seed = 1;
        foreach ($teams as $team) {
            $teamNames[] = [
                'name' => $team->nama,
                'seed' => $seed,
            ];
            $seed++;
        }

        $teamNamesJson = json_encode($teamNames);

        $script = "<script>
            $(document).ready(function() {
                $('#bracket2').bracket({
                    teams: " . count($teamNames) . ", // Dynamically set the number of teams
                    topOffset: 50,
                    scale: 0.45,
                    horizontal: 0,
                    height: '1000px',
                    icons: true,
                    teamNames: {$teamNamesJson}
                });
            });
        </script>";

        return view('admin.bagan.tgr', compact('script'));
    }
}
