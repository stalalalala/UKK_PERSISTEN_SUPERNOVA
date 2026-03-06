<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\admin\AdminTryout;
use App\Models\Latihan;
use App\Models\admin\AdminVideo;
use App\Models\Kuis;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $totalUsers = User::where('role', 'peserta')->count(); 
    $totalAdmins = User::where('role', 'admin')->count(); 

    $totalTryout  = AdminTryout::count();
    $totalLatihan = Latihan::count();
    $totalVideo   = AdminVideo::count();
    $totalKuis    = Kuis::count();


    $usersPerMonth = User::where('role', 'peserta') 
        ->select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Format supaya semua bulan ada (meski 0)
    $months = [];
    for ($i = 1; $i <= 12; $i++) {
        $months[$i] = 0;
    }

    foreach ($usersPerMonth as $data) {
        $months[$data->month] = $data->total;
    }

    return view('admin.dashboard', compact('months', 'totalUsers','totalAdmins','totalTryout','totalLatihan','totalVideo','totalKuis'));
}
}
