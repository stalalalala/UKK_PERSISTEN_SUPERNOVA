<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\AdminTryout;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminTryoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tryout.index');
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
    public function show(AdminTryout $adminTryout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminTryout $adminTryout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminTryout $adminTryout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminTryout $adminTryout)
    {
        //
    }
}
