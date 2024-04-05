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
}
