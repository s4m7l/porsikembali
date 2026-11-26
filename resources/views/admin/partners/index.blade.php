<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Mitra Kantin - PorsiKembali</title>

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
            --purple: #7656b5;
            --shadow: 0 12px 35px rgba(25, 64, 40, .08);
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
        .page-head { margin-bottom: 27px; }
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

        .flash-success {
            display: flex;
            align-items: center;
            gap: 11px;
            margin: 0 0 19px;
            padding: 14px 16px;
            color: #27633c;
            border: 1px solid #cfe9d6;
            border-radius: 13px;
            background: #e8f6ec;
            font-size: 13px;
            font-weight: 600;
        }
        .flash-success svg { flex: 0 0 auto; }

        .data-panel {
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 19px;
            background: var(--surface);
            box-shadow: 0 8px 24px rgba(30, 64, 42, .04);
        }
        .data-panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 18px 20px;
            border-bottom: 1px solid var(--line);
        }
        .panel-heading { display: flex; align-items: center; gap: 10px; }
        .panel-heading h2 { margin: 0; font-size: 14px; font-weight: 800; }
        .count-badge {
            display: inline-flex;
            align-items: center;
            min-height: 25px;
            padding: 3px 9px;
            color: #627068;
            border-radius: 999px;
            background: #edf1ee;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }
        .table-search {
            display: flex;
            width: min(260px, 42%);
            height: 40px;
            align-items: center;
            gap: 9px;
            padding: 0 12px;
            color: #849188;
            border: 1px solid var(--line);
            border-radius: 11px;
            background: #fff;
        }
        .table-search input {
            width: 100%;
            min-width: 0;
            padding: 0;
            color: var(--ink);
            border: 0;
            outline: 0;
            background: transparent;
            font-size: 12px;
        }
        .table-search input::placeholder { color: #9aa69e; }
        .table-wrap { width: 100%; overflow-x: auto; }
        table { width: 100%; min-width: 900px; border-collapse: collapse; }
        thead th {
            padding: 14px 17px;
            color: #708078;
            background: #f6f8f6;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .65px;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }
        tbody td {
            padding: 15px 17px;
            color: var(--muted);
            border-top: 1px solid #edf1ee;
            font-size: 13px;
            vertical-align: middle;
        }
        tbody tr { transition: background .18s ease; }
        tbody tr:hover { background: #fbfdfb; }
        .user-name { color: var(--ink); font-size: 13px; font-weight: 800; }
        .email-cell { color: #5e7065; }
        .location-cell {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #62736a;
            white-space: nowrap;
        }
        .location-cell svg { color: var(--green); flex: 0 0 auto; }
        .phone-cell { white-space: nowrap; }
        .role-badge {
            display: inline-flex;
            align-items: center;
            min-height: 27px;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }
        .role-student { color: #16803d; background: #dcfce7; }
        .role-partner { color: #a86100; background: #fff2ce; }
        .role-admin { color: #6842bd; background: #eee8ff; }
        .edit-link {
            display: inline-flex;
            min-height: 34px;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 11px;
            color: var(--green);
            border: 0;
            border-radius: 9px;
            background: var(--green-soft);
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
            transition: .2s ease;
        }
        .edit-link:hover { background: #d8eddf; transform: translateY(-1px); }
        .empty-state {
            padding: 40px 20px;
            color: #7b8980;
            font-size: 13px;
            text-align: center;
        }
        .empty-state strong { display: block; margin-bottom: 5px; color: var(--ink); font-size: 14px; }
        .table-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 13px 18px;
            color: #7b8980;
            border-top: 1px solid var(--line);
            font-size: 11px;
        }
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
            .page-head { margin-bottom: 22px; }
            .page-head h1 { font-size: 25px; }
            .data-panel { margin-right: -16px; margin-left: -16px; border-right: 0; border-left: 0; border-radius: 0; }
            .data-panel-head { align-items: flex-start; flex-direction: column; padding: 15px 16px; }
            .table-search { width: 100%; }
            .table-footer { padding-right: 16px; padding-left: 16px; }
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
        @media (max-width: 420px) {
            .page-head h1 { font-size: 23px; }
            .panel-heading { flex-wrap: wrap; }
            .count-badge { font-size: 10px; }
            .table-footer { align-items: flex-start; flex-direction: column; }
        }
    </style>
</head>
<body>
    @php
        $adminName = auth()->user()->name;
        $adminInitials = strtoupper(substr($adminName, 0, 2));
        $roleLabels = [
            'student' => 'Mahasiswa',
            'partner' => 'Mitra Kantin',
            'admin' => 'Admin',
        ];
        $partnerCount = $partners->count();
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
                <a href="{{ route('admin.users.index') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.9M16 3.1a4 4 0 0 1 0 7.8"/></svg>
                    <span>Daftar Pengguna</span>
                </a>
                <a href="{{ route('admin.partners.index') }}" class="active" aria-current="page">
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
                <section class="page-head">
                    <span class="eyebrow">MITRA KAMPUS</span>
                    <h1>Daftar Mitra Kantin</h1>
                    <p>Kelola profil dan informasi lokasi mitra kantin.</p>
                </section>

                @if (session('success'))
                    <div class="flash-success" role="status">
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <section class="data-panel" aria-labelledby="partners-panel-title">
                    <div class="data-panel-head">
                        <div class="panel-heading">
                            <h2 id="partners-panel-title">Semua mitra</h2>
                            <span class="count-badge">{{ number_format($partnerCount, 0, ',', '.') }} mitra</span>
                        </div>
                        <label class="table-search" for="partner-search">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg>
                            <input type="search" id="partner-search" placeholder="Cari nama kantin, mitra, email, atau lokasi..." autocomplete="off">
                        </label>
                    </div>

                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nama Kantin</th>
                                    <th>Nama Mitra</th>
                                    <th>Email</th>
                                    <th>Lokasi</th>
                                    <th>Nomor Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="partners-table-body">
                                @forelse ($partners as $partner)
                                    <tr data-partner-row>
                                        <td><strong class="user-name">{{ $partner->canteen_name }}</strong></td>
                                        <td>{{ $partner->user->name }}</td>
                                        <td class="email-cell">{{ $partner->user->email }}</td>
                                        <td>
                                            <span class="location-cell">
                                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                                                {{ $partner->location }}
                                            </span>
                                        </td>
                                        <td class="phone-cell">{{ $partner->phone ?? '—' }}</td>
                                        <td>
                                            <a href="{{ route('admin.partners.edit', $partner->id) }}" class="edit-link">
                                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"/></svg>
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="empty-state">
                                            <strong>Belum ada mitra kantin</strong>
                                            Data mitra yang terdaftar akan ditampilkan di sini.
                                        </td>
                                    </tr>
                                @endforelse
                                <tr id="no-search-results" hidden>
                                    <td colspan="6" class="empty-state">
                                        <strong>Mitra tidak ditemukan</strong>
                                        Coba gunakan kata kunci nama kantin, nama mitra, email, atau lokasi.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-footer">
                        <span id="partner-result-count">Menampilkan {{ number_format($partnerCount, 0, ',', '.') }} mitra</span>
                        <span>Data mitra PorsiKembali</span>
                    </div>
                </section>
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
                <a href="{{ route('admin.users.index') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.9M16 3.1a4 4 0 0 0 0 7.8"/></svg>
                    <span>Pengguna</span>
                </a>
                <a href="{{ route('admin.partners.index') }}" class="active" aria-current="page">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 11 9-8 9 8"/><path d="M5 10v11h14V10M9 21v-7h6v7"/></svg>
                    <span>Mitra</span>
                </a>
            </nav>
        </div>
    </div>

    <script>
        (() => {
            const searchInput = document.getElementById('partner-search');
            const rows = Array.from(document.querySelectorAll('[data-partner-row]'));
            const noResults = document.getElementById('no-search-results');
            const resultCount = document.getElementById('partner-result-count');
            const total = rows.length;

            if (!searchInput) return;

            searchInput.addEventListener('input', () => {
                const keyword = searchInput.value.trim().toLocaleLowerCase('id');
                let visible = 0;

                rows.forEach((row) => {
                    const matches = row.textContent.toLocaleLowerCase('id').includes(keyword);
                    row.hidden = !matches;
                    if (matches) visible += 1;
                });

                if (noResults) noResults.hidden = visible !== 0 || total === 0;
                if (resultCount) {
                    resultCount.textContent = keyword
                        ? `Menampilkan ${visible} dari ${total} mitra`
                        : `Menampilkan ${total} mitra`;
                }
            });
        })();
    </script>
</body>
</html>