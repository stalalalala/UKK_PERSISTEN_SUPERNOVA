<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\AdminLatihan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.latihan_soal.index');
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
    public function show(AdminLatihan $adminLatihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminLatihan $adminLatihan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminLatihan $adminLatihan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminLatihan $adminLatihan)
    {
        //
    }
}
