<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\AdminVideo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.video.index');
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
    public function show(AdminVideo $adminVideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminVideo $adminVideo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminVideo $adminVideo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminVideo $adminVideo)
    {
        //
    }
}
