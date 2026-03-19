<?php

namespace App\Http\Controllers;

use App\Models\Beranda;
use Illuminate\Http\Request;
use App\Models\Setting;

class BerandaController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $snbtDate = $setting->snbt_date ?? null;

        return view('beranda', compact('setting','snbtDate'));
    }
}