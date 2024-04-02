<?php

namespace App\Http\Controllers\Juri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JuriReguController extends Controller
{
       public function index()
    {
        $user = Auth::user();
        return view('juri.regu.index', compact('user'));
    }
}
