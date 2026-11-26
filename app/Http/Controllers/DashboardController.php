<?php

namespace App\Http\Controllers;

use App\Models\CanteenPartner;
use App\Models\Reservation;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'student') {
            return view('dashboard.student');
        }

        if ($user->role === 'partner') {
            // Mengambil data mitra berdasarkan akun yang login.
            $partner = CanteenPartner::where('user_id', $user->id)
                ->firstOrFail();

            // Paket yang masih memiliki stok dan belum melewati batas pengambilan.
            $activePackageCount = $partner->foodPackages()
                ->where('stock', '>', 0)
                ->where('pickup_deadline', '>=', now())
                ->count();

            // Reservasi yang masih menunggu pengambilan pada mitra ini.
            $pendingReservationCount = Reservation::whereHas(
                'foodPackage',
                function ($query) use ($partner) {
                    $query->where('canteen_partner_id', $partner->id);
                }
            )
                ->where('status', 'menunggu_pengambilan')
                ->count();

            // Total kuantitas reservasi selesai pada mitra ini.
            $rescuedPortionCount = Reservation::whereHas(
                'foodPackage',
                function ($query) use ($partner) {
                    $query->where('canteen_partner_id', $partner->id);
                }
            )
                ->where('status', 'selesai')
                ->sum('quantity');

            return view('dashboard.partner', compact(
                'activePackageCount',
                'pendingReservationCount',
                'rescuedPortionCount'
            ));
        }

        if ($user->role === 'admin') {
            // Statistik keseluruhan aplikasi untuk dashboard admin.
            $studentCount = User::where('role', 'student')->count();
            $partnerCount = CanteenPartner::count();
            $rescuedPortionCount = Reservation::where('status', 'selesai')
                ->sum('quantity');

            return view('dashboard.admin', compact(
                'studentCount',
                'partnerCount',
                'rescuedPortionCount'
            ));
        }

        abort(403, 'Role pengguna tidak dikenali.');
    }
}