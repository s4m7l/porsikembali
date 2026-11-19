<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
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

    // Menampilkan daftar pengguna
    public function index()
    {
        $this->checkAdmin();

        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    // Menampilkan formulir edit pengguna
    public function edit($id)
    {
        $this->checkAdmin();

        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    // Memperbarui data pengguna
    public function update(Request $request, $id)
    {
        $this->checkAdmin();

        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
        ]);

        $user->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }
}