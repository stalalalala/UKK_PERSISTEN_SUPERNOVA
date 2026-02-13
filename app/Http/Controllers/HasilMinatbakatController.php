<?php

namespace App\Http\Controllers;

use App\Models\HasilMinatbakat;
use Illuminate\Http\Request;

class HasilMinatbakatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('minatbakat.hasil');
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
    public function show(HasilMinatbakat $hasilMinatbakat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HasilMinatbakat $hasilMinatbakat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HasilMinatbakat $hasilMinatbakat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HasilMinatbakat $hasilMinatbakat)
    {
        //
    }
}
