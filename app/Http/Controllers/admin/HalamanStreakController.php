<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\halaman_streak;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HalamanStreakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin/streak.index');
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
    public function show(halaman_streak $halaman_streak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(halaman_streak $halaman_streak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, halaman_streak $halaman_streak)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(halaman_streak $halaman_streak)
    {
        //
    }
}
