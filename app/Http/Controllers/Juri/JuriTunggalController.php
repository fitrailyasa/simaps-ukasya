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
        return view("juri.tunggal.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Juri $juri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Juri $juri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Juri $juri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Juri $juri)
    {
        //
    }
}
