<?php

namespace App\Http\Controllers;

use App\Models\IntruksiTryout;
use Illuminate\Http\Request;

class IntruksiTryoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tryout.intruksi');
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
    public function show(IntruksiTryout $intruksiTryout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IntruksiTryout $intruksiTryout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IntruksiTryout $intruksiTryout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IntruksiTryout $intruksiTryout)
    {
        //
    }
}
