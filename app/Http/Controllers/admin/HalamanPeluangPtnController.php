<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\halaman_peluangPtn;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HalamanPeluangPtnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin/peluangPtn.index');
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
    public function show(halaman_peluangPtn $halaman_peluangPtn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(halaman_peluangPtn $halaman_peluangPtn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, halaman_peluangPtn $halaman_peluangPtn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(halaman_peluangPtn $halaman_peluangPtn)
    {
        //
    }
}
