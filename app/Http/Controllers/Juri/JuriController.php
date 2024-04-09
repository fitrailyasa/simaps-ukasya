<?php

namespace App\Http\Controllers\Juri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JuriController extends Controller
{
    public function tunggal()
    {
        $total_score = number_format(9.9, 2);
        $flow_score = 0;
        $accuracy_total_score = 0;
        return view("juri.tunggal.index", ["total_score"=> $total_score,'accuracy_score'=>$accuracy_total_score,'flow_score'=> $flow_score]);
    }
    public function tanding()
    {
        $user = Auth::user();
        return view('juri.tanding.index', compact('user'));
    }
    public function regu()
    {
        $flow_score = 0;
        $accuracy_total_score = 0;
        $total_score = number_format(9.9, 2) + $flow_score + $accuracy_total_score;
        return view("juri.regu.index", ["total_score"=> $total_score,'accuracy_score'=>$accuracy_total_score,'flow_score'=> $flow_score]);;
    }
    public function ganda()
    {
        $user = Auth::user();
        return view('juri.ganda.index', compact('user'));
    }
    public function solo()
    {
        $user = Auth::user();
        return view('juri.solo.index', compact('user'));
    }
}