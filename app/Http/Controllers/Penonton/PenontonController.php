<?php

namespace App\Http\Controllers\Penonton;

use App\Http\Controllers\Controller;
use App\Models\Gelanggang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenontonController extends Controller
{
    public function index()
    {
        return view('client.penonton.index');
    }

    public function auth($gelanggang_id){
        $gelanggang = Gelanggang::find($gelanggang_id);
        switch ($gelanggang->jenis) {
            case 'Tanding':
                return redirect('/tanding');
                break;
            case 'Tunggal':
                return redirect('/tunggal');
                break;
            case 'Regu':
                return redirect('/regu');
                break;
            case 'Ganda':
                return redirect('/ganda');
                break;
            case 'Solo_Kreatif':
                return redirect('/solo');
                break;
        }
    }
}
