<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\AdminMinatBakat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminMinatBakatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.minatbakat.index');
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
    public function show(AdminMinatBakat $adminMinatBakat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminMinatBakat $adminMinatBakat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminMinatBakat $adminMinatBakat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminMinatBakat $adminMinatBakat)
    {
        //
    }
}
