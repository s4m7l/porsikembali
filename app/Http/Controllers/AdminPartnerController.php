<?php

namespace App\Http\Controllers;

use App\Models\CanteenPartner;
use Illuminate\Http\Request;

class AdminPartnerController extends Controller
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

    // Menampilkan daftar mitra kantin
    public function index()
    {
        $this->checkAdmin();

        $partners = CanteenPartner::with('user')
            ->latest()
            ->get();

        return view('admin.partners.index', compact('partners'));
    }

    // Menampilkan formulir edit mitra
    public function edit($id)
    {
        $this->checkAdmin();

        $partner = CanteenPartner::with('user')->findOrFail($id);

        return view('admin.partners.edit', compact('partner'));
    }

    // Memperbarui data mitra kantin
    public function update(Request $request, $id)
    {
        $this->checkAdmin();

        $partner = CanteenPartner::findOrFail($id);

        $validated = $request->validate([
            'canteen_name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        $partner->update($validated);

        return redirect()
            ->route('admin.partners.index')
            ->with('success', 'Data mitra kantin berhasil diperbarui.');
    }
}