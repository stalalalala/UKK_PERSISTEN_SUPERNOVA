<?php

namespace App\Http\Controllers;

use App\Models\IntruksiKuis;
use App\Models\Kuis;
use Illuminate\Http\Request;

class IntruksiKuisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
{
    // Cari data kuis berdasarkan ID
    $kuis = Kuis::findOrFail($id);
    
    // Kirim data kuis ke blade intruksi
    return view('peserta.kuis.intruksi', compact('kuis'));
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
    public function show(IntruksiKuis $intruksiKuis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IntruksiKuis $intruksiKuis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IntruksiKuis $intruksiKuis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IntruksiKuis $intruksiKuis)
    {
        //
    }
}
