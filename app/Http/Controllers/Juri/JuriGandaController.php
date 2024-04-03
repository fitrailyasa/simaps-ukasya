<?php

namespace App\Http\Controllers\Juri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JuriGandaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('juri.ganda.index', compact('user'));
    }
}
