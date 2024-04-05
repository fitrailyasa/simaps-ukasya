<?php

namespace App\Http\Controllers\Penonton;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KetuaPertandinganController extends Controller
{
    public function index()
    {
        return view('client.penonton.ketua.index');
    }
    public function tanding()
    {
        $match = "1";
        $arena = "A";
        $biru_region = "Singapore";
        $biru_nama ="SHEIK ALAUDIN";
        $merah_region = "Indonesia";
        $merah_nama = "BENNY G. SUMARSONO";
        return view('client.penonton.ketua.tanding.index',compact('match','arena','biru_region','biru_nama','merah_region','merah_nama'));
    }

    public function tunggal()
    {
        $match = "1";
        $arena = "A";
        $region = "Singapore";
        $nama ="SHEIK ALAUDIN";
        return view('client.penonton.ketua.tunggal.index',compact('match','arena','region','nama'));
    }
}
