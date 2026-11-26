<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Pengguna - PorsiKembali</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --green: #2f7d4f;
            --green-light: #4caf7a;
            --green-soft: #e7f4eb;
            --ink: #14211a;
            --muted: #64736a;
            --line: #dfe8e1;
            --surface: #ffffff;
            --bg: #f0f5f0;
            --amber: #a86100;
            --amber-soft: #fff2ce;
            --danger: #c43d3d;
        }

        * { box-sizing: border-box; }
        html { min-width: 320px; }
        body {
            margin: 0;
            min-width: 320px;
            min-height: 100vh;
            color: var(--ink);
            background: var(--bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        button, input, a { font: inherit; }
        a { color: inherit; }
        button:focus-visible, a:focus-visible, input:focus-visible {
            outline: 3px solid rgba(47, 125, 79, .25);
            outline-offset: 3px;
        }

        .app-shell { min-height: 100vh; }
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 30;
            display: flex;
            width: 248px;
            flex-direction: column;
            padding: 30px 20px 22px;
            background: rgba(255, 255, 255, .96);
            border-right: 1px solid var(--line);
        }
        .logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--ink);
            text-decoration: none;
            font-size: 19px;
            font-weight: 800;
            letter-spacing: -.8px;
            white-space: nowrap;
        }
        .logo-mark {
            display: grid;
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            place-items: center;
            color: #fff;
            border-radius: 13px;
            background: linear-gradient(135deg, var(--green), var(--green-light));
            box-shadow: 0 8px 18px rgba(47, 125, 79, .24);
        }
        .logo-name span { color: var(--green); }
        .sidebar-role {
            margin: 46px 12px 12px;
            color: #8b9a90;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }
        .sidebar-nav { display: flex; flex-direction: column; gap: 6px; }
        .sidebar-nav a {
            display: flex;
            min-height: 46px;
            align-items: center;
            gap: 12px;
            padding: 0 13px;
            color: var(--muted);
            border-radius: 13px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: .2s ease;
        }
        .sidebar-nav a:hover { color: var(--green); background: var(--green-soft); }
        .sidebar-nav a.active {
            color: #fff;
            background: var(--green);
            box-shadow: 0 9px 20px rgba(47, 125, 79, .2);
        }
        .sidebar-impact {
            margin-top: auto;
            padding: 16px;
            color: #1b462b;
            border: 1px solid #d4eadb;
            border-radius: 17px;
            background: linear-gradient(145deg, #e7f4eb, #f4faf5);
        }
        .sidebar-impact-icon {
            display: grid;
            width: 31px;
            height: 31px;
            margin-bottom: 10px;
            place-items: center;
            color: var(--green);
            border-radius: 10px;
            background: #fff;
        }
        .sidebar-impact strong { display: block; font-size: 13px; }
        .sidebar-impact p { margin: 5px 0 0; color: #5c7564; font-size: 11px; line-height: 1.65; }
        .sidebar-foot { margin-top: 16px; color: #a0aba4; text-align: center; font-size: 10px; }

        .app-main { min-height: 100vh; margin-left: 248px; }
        .topbar {
            position: sticky;
            top: 0;
            z-index: 20;
            display: flex;
            height: 77px;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            border-bottom: 1px solid var(--line);
            background: rgba(240, 245, 240, .92);
            backdrop-filter: blur(16px);
        }
        .mobile-brand { display: none; }
        .topbar-title span { display: block; font-size: 14px; font-weight: 700; }
        .topbar-title small { color: var(--muted); font-size: 11px; }
        .topbar-actions { display: flex; align-items: center; gap: 12px; }
        .user-pill { display: flex; align-items: center; gap: 10px; padding: 5px 8px; }
        .user-avatar {
            display: grid;
            width: 38px;
            height: 38px;
            place-items: center;
            color: var(--green);
            border-radius: 12px;
            background: var(--green-soft);
            font-size: 12px;
            font-weight: 800;
        }
        .user-details strong, .user-details small { display: block; }
        .user-details strong { font-size: 12px; }
        .user-details small { margin-top: 2px; color: var(--muted); font-size: 10px; }
        .logout-form { margin: 0; }
        .logout-btn {
            display: inline-flex;
            height: 41px;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 12px;
            color: #dc3e3e;
            border: 1px solid #f1d6d6;
            border-radius: 12px;
            background: #fff8f8;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .content {
            width: 100%;
            max-width: 1500px;
            min-height: calc(100vh - 77px);
            margin: 0 auto;
            padding: 38px 40px 60px;
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 0 0 19px;
            padding: 0;
            color: var(--green);
            text-decoration: none;
            font-size: 13px;
            font-weight: 800;
        }
        .back-link:hover { color: #1f6039; }
        .page-head { margin-bottom: 25px; }
        .eyebrow {
            display: block;
            margin-bottom: 8px;
            color: var(--green);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.7px;
        }
        .page-head h1 {
            margin: 0;
            font-size: 29px;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -1px;
        }
        .page-head p { margin: 8px 0 0; color: var(--muted); font-size: 14px; line-height: 1.6; }

        .flash-success, .flash-error {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            margin: 0 0 18px;
            padding: 14px 16px;
            border-radius: 13px;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.55;
        }
        .flash-success { color: #27633c; border: 1px solid #cfe9d6; background: #e8f6ec; }
        .flash-error { color: #a52e2e; border: 1px solid #f3d0d0; background: #fff0f0; }
        .flash-success svg, .flash-error svg { flex: 0 0 auto; margin-top: 1px; }
        .flash-error ul { margin: 0; padding-left: 18px; }

        .edit-form {
            width: 100%;
            max-width: 760px;
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 20px;
            background: var(--surface);
            box-shadow: 0 8px 24px rgba(30, 64, 42, .04);
        }
        .form-section { padding: 24px; }
        .form-section h2 {
            margin: 0 0 19px;
            color: var(--ink);
            font-size: 15px;
            font-weight: 800;
        }
        .edit-profile {
            display: flex;
            align-items: center;
            gap: 13px;
            padding-bottom: 20px;
            margin-bottom: 21px;
            border-bottom: 1px solid var(--line);
        }
        .profile-mark {
            display: grid;
            width: 56px;
            height: 56px;
            flex: 0 0 56px;
            place-items: center;
            color: var(--green);
            border: 1px solid #d7eadc;
            border-radius: 17px;
            background: linear-gradient(145deg, #e7f4eb, #f4faf5);
            font-size: 17px;
            font-weight: 800;
        }
        .edit-profile h2 { margin: 0 0 7px; font-size: 16px; font-weight: 800; }
        .role-badge {
            display: inline-flex;
            min-height: 25px;
            align-items: center;
            padding: 4px 10px;
            color: var(--green);
            border-radius: 999px;
            background: var(--green-soft);
            font-size: 11px;
            font-weight: 800;
        }
        .role-badge.partner { color: var(--amber); background: var(--amber-soft); }
        .role-badge.admin { color: #5b4bb7; background: #eeeaff; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 17px 16px; }
        .field { display: block; min-width: 0; }
        .field.full { grid-column: 1 / -1; }
        .field-label {
            display: block;
            margin-bottom: 8px;
            color: #33443a;
            font-size: 12px;
            font-weight: 800;
        }
        .field input {
            width: 100%;
            height: 46px;
            padding: 0 14px;
            color: var(--ink);
            border: 1px solid var(--line);
            border-radius: 12px;
            outline: 0;
            background: #fff;
            font-size: 13px;
            transition: border-color .2s ease, box-shadow .2s ease;
        }
        .field input::placeholder { color: #a1aca5; }
        .field input:focus { border-color: var(--green-light); box-shadow: 0 0 0 3px rgba(47, 125, 79, .09); }
        .field input[readonly] { color: #78877e; border-color: #e5ebe6; background: #f3f6f3; cursor: not-allowed; }
        .field-hint { display: block; margin-top: 6px; color: #839087; font-size: 11px; line-height: 1.5; }
        .field-error { display: block; margin-top: 6px; color: var(--danger); font-size: 11px; font-weight: 600; }
        .form-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            padding: 17px 24px;
            border-top: 1px solid var(--line);
            background: #f8faf8;
        }
        .btn {
            display: inline-flex;
            min-height: 43px;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 17px;
            border: 1px solid transparent;
            border-radius: 11px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s ease;
        }
        .btn-secondary { color: #536258; border-color: var(--line); background: #fff; }
        .btn-secondary:hover { color: var(--green); border-color: #c4ddcb; background: #f8fcf9; }
        .btn-primary { color: #fff; background: var(--green); box-shadow: 0 7px 16px rgba(47, 125, 79, .17); }
        .btn-primary:hover { background: #256b43; transform: translateY(-1px); }
        .mobile-nav { display: none; }

        @media (max-width: 1050px) {
            .sidebar { width: 210px; padding-right: 16px; padding-left: 16px; }
            .app-main { margin-left: 210px; }
            .content { padding: 32px 25px 50px; }
            .topbar { padding: 0 25px; }
        }
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .app-main { margin-left: 0; }
            .topbar { height: 67px; padding: 0 16px; }
            .mobile-brand { display: inline-flex; align-items: center; text-decoration: none; }
            .mobile-brand .logo-name { display: none; }
            .topbar-title { display: none; }
            .topbar-actions { gap: 9px; }
            .user-details { display: none; }
            .user-avatar { width: 36px; height: 36px; }
            .logout-btn { width: 40px; height: 40px; padding: 0; }
            .logout-btn span { display: none; }
            .content { min-height: calc(100vh - 67px); padding: 25px 16px 100px; }
            .page-head { margin-bottom: 21px; }
            .page-head h1 { font-size: 25px; }
            .edit-form { max-width: none; }
            .form-section { padding: 20px 18px; }
            .form-actions { padding: 15px 18px; }
            .mobile-nav {
                position: fixed;
                right: 0;
                bottom: 0;
                left: 0;
                z-index: 40;
                display: flex;
                justify-content: space-around;
                padding: 8px 10px max(12px, env(safe-area-inset-bottom));
                border-top: 1px solid var(--line);
                background: rgba(255, 255, 255, .96);
                backdrop-filter: blur(15px);
            }
            .mobile-nav a {
                display: flex;
                min-width: 65px;
                min-height: 48px;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 3px;
                color: #78877e;
                text-decoration: none;
                font-size: 10px;
            }
            .mobile-nav a.active { color: var(--green); font-weight: 800; }
        }
        @media (max-width: 520px) {
            .page-head h1 { font-size: 23px; }
            .form-grid { grid-template-columns: 1fr; gap: 15px; }
            .field.full { grid-column: auto; }
            .form-actions { flex-direction: column-reverse; }
            .form-actions .btn { width: 100%; }
        }
    </style>
</head>
<body>
    @php
        $adminName = auth()->user()->name;
        $adminInitials = strtoupper(substr($adminName, 0, 2));
        $userName = $user->name ?? 'Pengguna';
        $userInitials = strtoupper(substr(preg_replace('/\s+/', '', $userName), 0, 2));
        $roleLabels = [
            'student' => 'Mahasiswa',
            'partner' => 'Mitra Kantin',
            'admin' => 'Admin',
        ];
        $userRoleLabel = $roleLabels[$user->role] ?? ucfirst($user->role);
        $roleClass = $user->role === 'partner' ? 'partner' : ($user->role === 'admin' ? 'admin' : '');
    @endphp

    <div class="app-shell">
        <aside class="sidebar">
            <a href="{{ url('/dashboard') }}" class="logo">
                <span class="logo-mark">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
                </span>
                <span class="logo-name">Porsi<span>Kembali</span></span>
            </a>

            <div class="sidebar-role">MENU ADMIN</div>
            <nav class="sidebar-nav" aria-label="Navigasi admin">
                <a href="{{ url('/dashboard') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="2"/><rect x="14" y="3" width="7" height="7" rx="2"/><rect x="3" y="14" width="7" height="7" rx="2"/><rect x="14" y="14" width="7" height="7" rx="2"/></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.reports.index') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3v18h18"/><path d="m7 16 4-5 4 3 5-7"/></svg>
                    <span>Laporan Aktivitas</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="active" aria-current="page">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.9M16 3.1a4 4 0 0 1 0 7.8"/></svg>
                    <span>Daftar Pengguna</span>
                </a>
                <a href="{{ route('admin.partners.index') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 11 9-8 9 8"/><path d="M5 10v11h14V10M9 21v-7h6v7"/></svg>
                    <span>Mitra Kantin</span>
                </a>
            </nav>

            <div class="sidebar-impact">
                <span class="sidebar-impact-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
                </span>
                <strong>Kelola dengan bijak</strong>
                <p>Pantau aktivitas pengguna dan mitra untuk menjaga layanan PorsiKembali tetap berjalan dengan baik.</p>
            </div>
            <small class="sidebar-foot">PorsiKembali v1.0</small>
        </aside>

        <div class="app-main">
            <header class="topbar">
                <a href="{{ url('/dashboard') }}" class="mobile-brand logo" aria-label="PorsiKembali beranda">
                    <span class="logo-mark">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
                    </span>
                    <span class="logo-name">Porsi<span>Kembali</span></span>
                </a>

                <div class="topbar-title">
                    <span>Portal Admin</span>
                    <small>Satu porsi terselamatkan, satu langkah berarti.</small>
                </div>

                <div class="topbar-actions">
                    <div class="user-pill">
                        <span class="user-avatar">{{ $adminInitials }}</span>
                        <div class="user-details">
                            <strong>{{ $adminName }}</strong>
                            <small>Administrator</small>
                        </div>
                    </div>
                    <form action="/logout" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m10 17 5-5-5-5M15 12H3"/><path d="M15 3h5a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1h-5"/></svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </header>

            <main class="content">
                <a href="{{ route('admin.users.index') }}" class="back-link">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m15 18-6-6 6-6"/><path d="M9 12h12"/></svg>
                    Kembali ke daftar pengguna
                </a>

                <section class="page-head">
                    <span class="eyebrow">EDIT DATA</span>
                    <h1>Edit Pengguna</h1>
                    <p>Perbarui informasi akun pengguna agar data tetap akurat dan terkini.</p>
                </section>

                @if (session('success'))
                    <div class="flash-success" role="status">
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="flash-error" role="alert">
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 8v5M12 16h.01"/></svg>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="edit-form">
                    @csrf
                    @method('PUT')

                    <section class="form-section">
                        <div class="edit-profile">
                            <span class="profile-mark">{{ $userInitials }}</span>
                            <div>
                                <h2>{{ $userName }}</h2>
                                <span class="role-badge {{ $roleClass }}">{{ $userRoleLabel }}</span>
                            </div>
                        </div>

                        <h2>Informasi Pengguna</h2>
                        <div class="form-grid">
                            <label class="field full">
                                <span class="field-label">Jenis Pengguna</span>
                                <input type="text" value="{{ $userRoleLabel }}" readonly aria-readonly="true">
                                <small class="field-hint">Jenis pengguna ditentukan berdasarkan peran akun dan tidak diubah melalui formulir ini.</small>
                            </label>

                            <label class="field full">
                                <span class="field-label" for="name">Nama Pengguna</span>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    placeholder="Masukkan nama pengguna"
                                    autocomplete="name"
                                    required
                                    aria-describedby="name-error"
                                >
                                @error('name')
                                    <small class="field-error" id="name-error">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="field full">
                                <span class="field-label" for="email">Email</span>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email', $user->email) }}"
                                    placeholder="Masukkan alamat email"
                                    autocomplete="email"
                                    required
                                    aria-describedby="email-error"
                                >
                                @error('email')
                                    <small class="field-error" id="email-error">{{ $message }}</small>
                                @enderror
                            </label>
                        </div>
                    </section>

                    <div class="form-actions">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z"/><path d="M17 21v-8H7v8M7 3v5h8"/></svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </main>

            <nav class="mobile-nav" aria-label="Navigasi admin mobile">
                <a href="{{ url('/dashboard') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="2"/><rect x="14" y="3" width="7" height="7" rx="2"/><rect x="3" y="14" width="7" height="7" rx="2"/><rect x="14" y="14" width="7" height="7" rx="2"/></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.reports.index') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3v18h18"/><path d="m7 16 4-5 4 3 5-7"/></svg>
                    <span>Laporan</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="active" aria-current="page">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.9M16 3.1a4 4 0 0 0 0 7.8"/></svg>
                    <span>Pengguna</span>
                </a>
                <a href="{{ route('admin.partners.index') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 11 9-8 9 8"/><path d="M5 10v11h14V10M9 21v-7h6v7"/></svg>
                    <span>Mitra</span>
                </a>
            </nav>
        </div>
    </div>
</body>
</html>