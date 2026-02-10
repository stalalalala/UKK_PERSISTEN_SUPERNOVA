<?php

namespace App\Http\Controllers;

use App\Models\MinatBakat;
use Illuminate\Http\Request;

class MinatBakatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('minat_bakat.soal');
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
    public function show(MinatBakat $minatBakat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MinatBakat $minatBakat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MinatBakat $minatBakat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MinatBakat $minatBakat)
    {
        //
    }
}
