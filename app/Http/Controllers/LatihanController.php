<?php

namespace App\Http\Controllers;

use App\Models\Latihan;
use Illuminate\Http\Request;

class LatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('latihan.index');
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
    public function show(Latihan $latihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Latihan $latihan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Latihan $latihan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Latihan $latihan)
    {
        //
    }
}
