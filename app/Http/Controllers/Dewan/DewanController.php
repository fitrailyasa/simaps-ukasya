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
}
