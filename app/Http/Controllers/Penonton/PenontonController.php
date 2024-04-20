<?php

namespace App\Http\Controllers\Penonton;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenontonController extends Controller
{
    public function index()
    {
        return view('client.penonton.index');
    }
    public function tanding()
    {
        $arena = "A";
        $tahap ='hasil';
        $class = 'A';
        $sudut = [['nama'=>'Seikh Alauin','perguruan'=>'Tapak Suci'],['nama'=>'Mustavid','perguruan'=>'PSHT']];
        return view('client.penonton.tanding.index',compact('arena','tahap','class','pesilat'));
    }public function tgr()
    {
        $arena = "A";
        $tahap ='tampil';
        $class = 'A';
        $sudut = [['nama'=>'Seikh Alauin','perguruan'=>'Tapak Suci'],['nama'=>'Mustavid','perguruan'=>'PSHT']];
        return view('client.penonton.tgr.index',compact('arena','tahap','class','pesilat'));
    }
}
