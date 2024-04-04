<?php

namespace App\Http\Controllers\Juri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JuriReguController extends Controller
{
       public function index()
    {
        $flow_score = 0;
        $accuracy_total_score = 0;
        $total_score = number_format(9.9, 2) + $flow_score + $accuracy_total_score;
        return view("juri.regu.index", ["total_score"=> $total_score,'accuracy_score'=>$accuracy_total_score,'flow_score'=> $flow_score]);;
    }
}
