<?php

namespace App\Http\Controllers;

use App\Models\FoodPackage;

class StudentFoodPackageController extends Controller
{
    // Menampilkan daftar paket makanan yang tersedia
    public function index()
    {
        // Memastikan pengguna adalah mahasiswa
        abort_unless(
            auth()->user()->role === 'student',
            403,
            'Akses hanya untuk mahasiswa.'
        );

        // Mengambil paket yang masih tersedia
        $foodPackages = FoodPackage::with('canteenPartner')
            ->where('stock', '>', 0)
            ->where('pickup_deadline', '>=', now('Asia/Jakarta'))
            ->orderBy('pickup_deadline')
            ->get();

        return view(
            'student.food-packages.index',
            compact('foodPackages')
        );
    }
}