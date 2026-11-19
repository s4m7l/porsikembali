<?php

namespace App\Http\Controllers;

use App\Models\Reservation;

class PartnerReservationController extends Controller
{
    // Menampilkan reservasi yang masuk ke kantin mitra
    public function index()
    {
        abort_unless(
            auth()->user()->role === 'partner',
            403,
            'Akses hanya untuk mitra kantin.'
        );

        $partner = auth()->user()->canteenPartner;

        abort_if(
            !$partner,
            403,
            'Data mitra kantin belum tersedia.'
        );

        $reservations = Reservation::whereHas(
            'foodPackage',
            function ($query) use ($partner) {
                $query->where('canteen_partner_id', $partner->id);
            }
        )
            ->with(['user', 'foodPackage'])
            ->latest()
            ->get();

        return view(
            'partner.reservations.index',
            compact('reservations')
        );
    }

    // Mengubah status reservasi menjadi selesai
    public function updateStatus($id)
    {
        abort_unless(
            auth()->user()->role === 'partner',
            403,
            'Akses hanya untuk mitra kantin.'
        );

        $partner = auth()->user()->canteenPartner;

        abort_if(
            !$partner,
            403,
            'Data mitra kantin belum tersedia.'
        );

        // Memastikan reservasi berasal dari kantin milik mitra
        $reservation = Reservation::whereHas(
            'foodPackage',
            function ($query) use ($partner) {
                $query->where('canteen_partner_id', $partner->id);
            }
        )
            ->where('status', 'menunggu_pengambilan')
            ->findOrFail($id);

        $reservation->update([
            'status' => 'selesai',
        ]);

        return redirect()
            ->route('partner.reservations.index')
            ->with('success', 'Reservasi berhasil ditandai selesai.');
    }
}