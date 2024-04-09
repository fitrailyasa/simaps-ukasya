<?php

namespace App\Http\Controllers\Penonton;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KetuaPertandinganController extends Controller
{
    public function index()
    {
        return view('client.ketua.index');
    }
    public function tanding()
    {
        $match = "1";
        $arena = "A";
        $biru_region = "Singapore";
        $biru_nama ="SHEIK ALAUDIN";
        $merah_region = "Indonesia";
        $merah_nama = "BENNY G. SUMARSONO";
        return view('client.ketua.tanding.index',compact('match','arena','biru_region','biru_nama','merah_region','merah_nama'));
    }

    public function tunggal()
    {
        $match = "1";
        $arena = "A";
        $region = "Singapore";
        $nama ="SHEIK ALAUDIN";
        return view('client.ketua.tunggal.index',compact('match','arena','region','nama'));
    }
    public function regu()
    {
        $match = "1";
        $arena = "A";
        $region = "Singapore";
        $nama =["SHEIK ALAUDIN","SHEIK ALADIN"];
        return view('client.ketua.regu.index',compact('match','arena','region','nama'));
    }
    public function ganda()
    {
        $match = "1";
        $arena = "A";
        $region = "Singapore";
        $nama ="SHEIK ALAUDIN";
        return view('client.ketua.ganda.index',compact('match','arena','region','nama'));
    }
    public function solo()
    {
        $match = "1";
        $arena = "A";
        $region = "Singapore";
        $nama ="SHEIK ALAUDIN";
        return view('client.ketua.solo.index',compact('match','arena','region','nama'));
    }
}
