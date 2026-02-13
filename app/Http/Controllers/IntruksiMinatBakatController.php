<?php

namespace App\Http\Controllers;

use App\Models\IntruksiMinatBakat;
use Illuminate\Http\Request;

class IntruksiMinatBakatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('minatbakat.intruksi');
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
    public function show(IntruksiMinatBakat $intruksiMinatBakat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IntruksiMinatBakat $intruksiMinatBakat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IntruksiMinatBakat $intruksiMinatBakat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IntruksiMinatBakat $intruksiMinatBakat)
    {
        //
    }
}
