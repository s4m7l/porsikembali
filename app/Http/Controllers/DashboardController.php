<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;

        if ($role === 'student') {
            return view('dashboard.student');
        }

        if ($role === 'partner') {
            return view('dashboard.partner');
        }

        if ($role === 'admin') {
            return view('dashboard.admin');
        }

        abort(403, 'Role pengguna tidak dikenali.');
    }
}