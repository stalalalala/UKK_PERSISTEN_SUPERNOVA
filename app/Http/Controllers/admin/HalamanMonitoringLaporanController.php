<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\halaman_monitoring_laporan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HalamanMonitoringLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin/monitoring_laporan.index');
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
    public function show(halaman_monitoring_laporan $halaman_monitoring_laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(halaman_monitoring_laporan $halaman_monitoring_laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, halaman_monitoring_laporan $halaman_monitoring_laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(halaman_monitoring_laporan $halaman_monitoring_laporan)
    {
        //
    }
}
