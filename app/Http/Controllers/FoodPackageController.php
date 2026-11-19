<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodPackageController extends Controller
{
    // Memastikan pengguna adalah mitra kantin
    private function getPartner()
    {
        $user = auth()->user();

        abort_unless(
            $user && $user->role === 'partner',
            403,
            'Akses hanya untuk mitra kantin.'
        );

        $partner = $user->canteenPartner;

        abort_if(
            !$partner,
            403,
            'Data mitra kantin belum tersedia.'
        );

        return $partner;
    }

    // Menampilkan daftar paket makanan
    public function index()
    {
        $partner = $this->getPartner();

        $foodPackages = $partner->foodPackages()
            ->latest()
            ->get();

        return view(
            'partner.food-packages.index',
            compact('foodPackages')
        );
    }

    // Menampilkan formulir tambah paket
    public function create()
    {
        $this->getPartner();

        return view('partner.food-packages.create');
    }

    // Menyimpan paket makanan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'normal_price' => ['required', 'numeric', 'min:0'],
            'offer_price' => [
                'required',
                'numeric',
                'min:0',
                'lt:normal_price'
            ],
            'stock' => ['required', 'integer', 'min:1'],
            'pickup_deadline' => ['required', 'date'],
        ]);

        $partner = $this->getPartner();

        $partner->foodPackages()->create($validated);

        return redirect()
            ->route('partner.food-packages.index')
            ->with('success', 'Paket makanan berhasil ditambahkan.');
    }

    // Menampilkan formulir edit paket
    public function edit($id)
    {
        $partner = $this->getPartner();

        $foodPackage = $partner->foodPackages()
            ->findOrFail($id);

        return view(
            'partner.food-packages.edit',
            compact('foodPackage')
        );
    }

    // Memperbarui data paket makanan
    public function update(Request $request, $id)
    {
        $partner = $this->getPartner();

        $foodPackage = $partner->foodPackages()
            ->findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'normal_price' => ['required', 'numeric', 'min:0'],
            'offer_price' => [
                'required',
                'numeric',
                'min:0',
                'lt:normal_price'
            ],
            'stock' => ['required', 'integer', 'min:0'],
            'pickup_deadline' => ['required', 'date'],
        ]);

        $foodPackage->update($validated);

        return redirect()
            ->route('partner.food-packages.index')
            ->with('success', 'Paket makanan berhasil diperbarui.');
    }

    // Menghapus paket makanan
    public function destroy($id)
    {
        $partner = $this->getPartner();

        $foodPackage = $partner->foodPackages()
            ->findOrFail($id);

        $foodPackage->delete();

        return redirect()
            ->route('partner.food-packages.index')
            ->with('success', 'Paket makanan berhasil dihapus.');
    }
}