<?php

namespace App\Http\Controllers\Penonton;

use App\Http\Controllers\Controller;
use App\Models\Gelanggang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KetuaPertandinganController extends Controller
{
    public function index()
    {
        $gelanggangs = Gelanggang::all();
        return view('client.ketua.index', compact('gelanggangs'));
    }
    public function auth($gelanggang_id)
    {
        $gelanggang = Gelanggang::find($gelanggang_id);
        switch ($gelanggang->jenis) {
            case 'Tanding':
                return redirect('/ketuapertandingan/tanding/' . $gelanggang_id);
            case 'Tunggal':
                return redirect('/ketuapertandingan/tunggal/' . $gelanggang_id);

            case 'Regu':
                return redirect('/ketuapertandingan/regu/' . $gelanggang_id);

            case 'Ganda':
                return redirect('/ketuapertandingan/ganda/' . $gelanggang_id);

            case 'Solo Kreatif':
                return redirect('/ketuapertandingan/solo/' . $gelanggang_id);

        }
    }
}
