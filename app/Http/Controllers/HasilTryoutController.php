<?php

namespace App\Http\Controllers;

use App\Models\HasilTryout;
use Illuminate\Http\Request;

class HasilTryoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tryout.hasil');
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
    public function show(HasilTryout $hasilTryout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HasilTryout $hasilTryout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HasilTryout $hasilTryout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HasilTryout $hasilTryout)
    {
        //
    }
}
