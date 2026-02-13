<?php

namespace App\Http\Controllers;

use App\Models\SoalTryout;
use Illuminate\Http\Request;

class SoalTryoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tryout.soal');
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
    public function show(SoalTryout $soalTryout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SoalTryout $soalTryout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SoalTryout $soalTryout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SoalTryout $soalTryout)
    {
        //
    }
}
