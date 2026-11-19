<?php

namespace App\Http\Controllers;

use App\Models\FoodPackage;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class ReservationController extends Controller
{
    // Memproses reservasi paket makanan
    public function store(Request $request)
    {
        // Memastikan pengguna adalah mahasiswa
        abort_unless(
            $request->user()->role === 'student',
            403,
            'Reservasi hanya dapat dilakukan oleh mahasiswa.'
        );

        // Memvalidasi data reservasi
        $validated = $request->validate([
            'food_package_id' => [
                'required',
                'integer',
                'exists:food_packages,id'
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1'
            ],
        ]);

        $user = $request->user();

        // Memproses reservasi dalam transaksi database
        $reservation = DB::transaction(function () use ($validated, $user) {

            // Mengambil data paket dan mengunci baris selama transaksi
            $package = FoodPackage::whereKey(
                $validated['food_package_id']
            )->lockForUpdate()->firstOrFail();

            $quantity = $validated['quantity'];

            // Memeriksa batas waktu pengambilan
            $deadline = Carbon::parse(
                $package->pickup_deadline,
                'Asia/Jakarta'
            );

            if ($deadline->lessThanOrEqualTo(now('Asia/Jakarta'))) {
                throw ValidationException::withMessages([
                    'food_package_id' => 'Batas waktu pengambilan paket sudah lewat.',
                ]);
            }

            // Memeriksa ketersediaan stok
            if ($package->stock < $quantity) {
                throw ValidationException::withMessages([
                    'quantity' => 'Stok paket makanan tidak mencukupi.',
                ]);
            }

            // Membuat kode pengambilan yang unik
            do {
                $pickupCode = strtoupper(Str::random(8));
            } while (
                Reservation::where('pickup_code', $pickupCode)->exists()
            );

            // Menghitung total harga
            $totalPrice = $package->offer_price * $quantity;

            // Menyimpan data reservasi
            $reservation = $user->reservations()->create([
                'food_package_id' => $package->id,
                'quantity' => $quantity,
                'total_price' => $totalPrice,
                'pickup_code' => $pickupCode,
            ]);

            // Mengurangi stok sesuai jumlah pesanan
            $package->decrement('stock', $quantity);

            return $reservation;
        });

        // Mengembalikan pengguna ke katalog paket
        return redirect()
            ->route('student.food-packages.index')
            ->with('success', 'Reservasi berhasil dibuat.')
            ->with('pickup_code', $reservation->pickup_code);
    }
    // Menampilkan riwayat reservasi mahasiswa
    public function index()
    {
        // Memastikan pengguna adalah mahasiswa
        abort_unless(
            auth()->user()->role === 'student',
            403,
            'Akses hanya untuk mahasiswa.'
        );

        // Mengambil reservasi milik mahasiswa yang sedang login
        $reservations = auth()->user()
            ->reservations()
            ->with('foodPackage.canteenPartner')
            ->latest()
            ->get();

        return view(
            'student.reservations.index',
            compact('reservations')
        );
    }
}