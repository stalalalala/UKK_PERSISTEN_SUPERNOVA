<?php

namespace App\Http\Controllers;

use App\Models\Kuis;
use App\Models\SoalKuis;
use Illuminate\Http\Request;

class SoalKuisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index($id)
{
    // Ambil kuis dan soal-soal yang hanya milik kuis_id ini
    $kuis = Kuis::with(['questions'])->findOrFail($id);
    
    // questions_count digunakan untuk info di sidebar soal
    $totalSoal = $kuis->questions->count();

    return view('kuis.soal', compact('kuis', 'totalSoal'));
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
    public function show(SoalKuis $soalKuis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SoalKuis $soalKuis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SoalKuis $soalKuis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SoalKuis $soalKuis)
    {
        //
    }
}
