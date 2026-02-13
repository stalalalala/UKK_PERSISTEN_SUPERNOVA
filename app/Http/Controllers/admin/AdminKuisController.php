<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\AdminKuis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminKuisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.kuis.index');
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
    public function show(AdminKuis $adminKuis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminKuis $adminKuis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminKuis $adminKuis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminKuis $adminKuis)
    {
        //
    }
}
