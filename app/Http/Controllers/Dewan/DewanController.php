<?php

namespace App\Http\Controllers\Dewan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DewanController extends Controller
{
    public function tanding()
    {
        return view('dewan.tanding.index');
    }
    public function tunggal()
    {
        return view('dewan.tunggal.index');
    }
    public function ganda()
    {
        return view('dewan.ganda.index');
    }
    public function regu()
    {
        return view('dewan.regu.index');
    }
    public function solo()
    {
        return view('dewan.regu.index');
    }
}
