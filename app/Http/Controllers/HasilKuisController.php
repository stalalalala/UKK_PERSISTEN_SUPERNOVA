<?php

namespace App\Http\Controllers;

use App\Models\HasilKuis;
use Illuminate\Http\Request;

class HasilKuisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kuis.hasil');
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
    public function show(HasilKuis $hasilKuis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HasilKuis $hasilKuis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HasilKuis $hasilKuis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HasilKuis $hasilKuis)
    {
        //
    }
}
