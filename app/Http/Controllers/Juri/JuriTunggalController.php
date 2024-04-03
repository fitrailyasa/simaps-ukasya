<?php

namespace App\Http\Controllers\Juri;

use App\Http\Controllers\Controller;
use App\Models\Juri;
use Illuminate\Http\Request;

class JuriTunggalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total_score = number_format(9.9, 2);
        $flow_score = 0;
        $accuracy_total_score = 0;
        return view("juri.tunggal.index", ["total_score"=> $total_score,'accuracy_score'=>$accuracy_total_score,'flow_score'=> $flow_score]);
    }
}
