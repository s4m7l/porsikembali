<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CanteenPartner;
use App\Models\FoodPackage;
use App\Models\Reservation;

class AdminReportController extends Controller
{
    // Memastikan pengguna yang mengakses adalah admin
    private function checkAdmin()
    {
        abort_unless(
            auth()->user()->role === 'admin',
            403,
            'Akses hanya untuk admin.'
        );
    }

    // Menampilkan laporan aktivitas aplikasi
    public function index()
    {
        $this->checkAdmin();

        $reports = [
            'total_students' => User::where('role', 'student')->count(),

            'total_partners' => CanteenPartner::count(),

            'total_packages' => FoodPackage::count(),

            'total_reservations' => Reservation::count(),

            'pending_reservations' => Reservation::where(
                'status',
                'menunggu_pengambilan'
            )->count(),

            'completed_reservations' => Reservation::where(
                'status',
                'selesai'
            )->count(),

            'completed_revenue' => Reservation::where(
                'status',
                'selesai'
            )->sum('total_price'),
        ];

        return view('admin.reports.index', compact('reports'));
    }
}