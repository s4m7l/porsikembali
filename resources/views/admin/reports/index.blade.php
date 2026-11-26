<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laporan Aktivitas - PorsiKembali</title>

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
            --amber: #a66a08;
            --amber-soft: #fff5df;
            --blue: #456db5;
            --blue-soft: #edf3ff;
            --purple: #7656b5;
            --purple-soft: #f0eafb;
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
        button, a { font: inherit; }
        a { color: inherit; }
        button:focus-visible, a:focus-visible {
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
            background: rgba(255, 255, 255, .94);
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
        .logo-name span { color: var(--green); }
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
        .sidebar-nav svg { flex: 0 0 20px; }
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
            background: rgba(240, 245, 240, .9);
            backdrop-filter: blur(16px);
        }
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
        .mobile-brand, .mobile-nav { display: none; }

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
        .page-head p { margin: 8px 0 0; color: var(--muted); font-size: 14px; line-height: 1.7; }

        .report-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }
        .report-card {
            display: flex;
            min-width: 0;
            align-items: center;
            gap: 14px;
            padding: 20px;
            border: 1px solid var(--line);
            border-radius: 18px;
            background: var(--surface);
            box-shadow: 0 7px 18px rgba(20, 50, 30, .03);
        }
        .report-icon {
            display: grid;
            width: 45px;
            height: 45px;
            flex: 0 0 45px;
            place-items: center;
            color: var(--green);
            border-radius: 14px;
            background: var(--green-soft);
        }
        .report-icon.blue { color: var(--blue); background: var(--blue-soft); }
        .report-icon.purple { color: var(--purple); background: var(--purple-soft); }
        .report-icon.amber { color: var(--amber); background: var(--amber-soft); }
        .report-copy { min-width: 0; }
        .report-copy h2 {
            margin: 0 0 5px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
            line-height: 1.5;
        }
        .report-value {
            margin: 0;
            color: var(--ink);
            font-size: clamp(22px, 2.1vw, 28px);
            font-weight: 800;
            line-height: 1.2;
            overflow-wrap: anywhere;
            letter-spacing: -.8px;
        }
        .report-card.pending .report-value { color: var(--amber); }
        .report-card.completed .report-value { color: var(--green); }

        .report-bottom {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1.4fr);
            gap: 15px;
            margin-top: 16px;
        }
        .value-card {
            display: flex;
            min-height: 190px;
            align-items: flex-start;
            gap: 15px;
            padding: 25px;
            color: #fff;
            border-radius: 19px;
            background: linear-gradient(135deg, #1d6139, #3e9560);
            box-shadow: 0 12px 25px rgba(29, 97, 57, .14);
        }
        .value-icon {
            display: grid;
            width: 43px;
            height: 43px;
            flex: 0 0 43px;
            place-items: center;
            border: 1px solid rgba(255,255,255,.13);
            border-radius: 13px;
            background: rgba(255,255,255,.14);
        }
        .value-copy small {
            display: block;
            color: #c7e5d0;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1px;
            line-height: 1.5;
        }
        .value-copy h2 {
            margin: 9px 0 8px;
            font-size: clamp(24px, 2.5vw, 32px);
            font-weight: 800;
            letter-spacing: -1px;
            overflow-wrap: anywhere;
        }
        .value-copy p { margin: 0; color: #d5eadb; font-size: 12px; line-height: 1.7; }

        .summary-card {
            display: flex;
            min-height: 190px;
            flex-direction: column;
            justify-content: center;
            padding: 25px;
            border: 1px solid var(--line);
            border-radius: 19px;
            background: var(--surface);
        }
        .summary-card h2 { margin: 0; font-size: 17px; letter-spacing: -.3px; }
        .summary-card p { margin: 8px 0 0; color: var(--muted); font-size: 13px; line-height: 1.75; }
        .summary-points { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; margin-top: 17px; }
        .summary-point {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.55;
        }
        .summary-point svg { flex: 0 0 17px; margin-top: 1px; color: var(--green); }

        .mobile-brand, .mobile-nav { display: none; }

        @media (max-width: 1180px) {
            .sidebar { width: 220px; }
            .app-main { margin-left: 220px; }
            .content { padding: 32px 25px 50px; }
            .topbar { padding: 0 25px; }
            .report-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media (max-width: 760px) {
            .sidebar { display: none; }
            .app-main { margin-left: 0; }
            .topbar { height: 67px; padding: 0 16px; }
            .mobile-brand { display: inline-flex; }
            .mobile-brand .logo-name { display: none; }
            .topbar-title, .user-details, .logout-btn span { display: none; }
            .topbar-actions { gap: 8px; }
            .user-pill { padding: 0; }
            .logout-btn { width: 40px; padding: 0; }
            .content { min-height: calc(100vh - 67px); padding: 25px 16px 95px; }
            .page-head { margin-bottom: 20px; }
            .page-head h1 { font-size: 25px; }
            .page-head p { font-size: 13px; }
            .report-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
            .report-card { display: block; padding: 16px; border-radius: 16px; }
            .report-icon { width: 39px; height: 39px; margin-bottom: 12px; border-radius: 12px; }
            .report-copy h2 { min-height: 36px; font-size: 11px; }
            .report-value { font-size: 23px; }
            .report-bottom { grid-template-columns: 1fr; gap: 11px; margin-top: 11px; }
            .value-card, .summary-card { min-height: auto; padding: 20px; border-radius: 17px; }
            .summary-points { grid-template-columns: 1fr; gap: 9px; }
            .mobile-nav {
                position: fixed;
                right: 0;
                bottom: 0;
                left: 0;
                z-index: 40;
                display: flex;
                justify-content: space-around;
                padding: 8px 8px 12px;
                border-top: 1px solid var(--line);
                background: rgba(255,255,255,.95);
                backdrop-filter: blur(15px);
            }
            .mobile-nav a {
                display: flex;
                min-width: 66px;
                min-height: 48px;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 3px;
                color: #78877e;
                text-decoration: none;
                font-size: 10px;
                font-weight: 600;
            }
            .mobile-nav a.active { color: var(--green); font-weight: 800; }
        }
        @media (max-width: 380px) {
            .report-grid { grid-template-columns: 1fr; }
            .report-card { display: flex; align-items: center; }
            .report-icon { margin: 0; }
            .report-copy h2 { min-height: 0; }
            .summary-points { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    @php
        $adminName = auth()->user()->name ?? 'Admin';
        $adminInitials = strtoupper(collect(explode(' ', trim($adminName)))->filter()->take(2)->map(fn ($part) => substr($part, 0, 1))->implode(''));
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
                <a href="{{ route('admin.reports.index') }}" class="active" aria-current="page">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3v18h18"/><path d="m7 16 4-5 4 3 5-7"/></svg>
                    <span>Laporan Aktivitas</span>
                </a>
                <a href="{{ route('admin.users.index') }}">
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
                <section class="page-head">
                    <span class="eyebrow">DATA &amp; DAMPAK</span>
                    <h1>Laporan Aktivitas</h1>
                    <p>Ringkasan data pengguna, mitra kantin, paket makanan, dan aktivitas reservasi PorsiKembali.</p>
                </section>

                <section class="report-grid" aria-label="Ringkasan statistik aplikasi">
                    <article class="report-card">
                        <span class="report-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.9M16 3.1a4 4 0 0 1 0 7.8"/></svg>
                        </span>
                        <div class="report-copy">
                            <h2>Total Mahasiswa</h2>
                            <p class="report-value">{{ number_format($reports['total_students'], 0, ',', '.') }}</p>
                        </div>
                    </article>

                    <article class="report-card">
                        <span class="report-icon blue">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 11 9-8 9 8"/><path d="M5 10v11h14V10M9 21v-7h6v7"/></svg>
                        </span>
                        <div class="report-copy">
                            <h2>Total Mitra Kantin</h2>
                            <p class="report-value">{{ number_format($reports['total_partners'], 0, ',', '.') }}</p>
                        </div>
                    </article>

                    <article class="report-card">
                        <span class="report-icon purple">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 3h12l2 5-8 13L4 8l2-5Z"/><path d="M4 8h16M10 3l2 5 2-5M8 8l4 13 4-13"/></svg>
                        </span>
                        <div class="report-copy">
                            <h2>Total Paket Makanan</h2>
                            <p class="report-value">{{ number_format($reports['total_packages'], 0, ',', '.') }}</p>
                        </div>
                    </article>

                    <article class="report-card">
                        <span class="report-icon blue">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 7h14l1 14H4L5 7Z"/><path d="M9 7a3 3 0 0 1 6 0M8 11h8"/></svg>
                        </span>
                        <div class="report-copy">
                            <h2>Total Reservasi</h2>
                            <p class="report-value">{{ number_format($reports['total_reservations'], 0, ',', '.') }}</p>
                        </div>
                    </article>

                    <article class="report-card pending">
                        <span class="report-icon amber">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                        </span>
                        <div class="report-copy">
                            <h2>Menunggu Pengambilan</h2>
                            <p class="report-value">{{ number_format($reports['pending_reservations'], 0, ',', '.') }}</p>
                        </div>
                    </article>

                    <article class="report-card completed">
                        <span class="report-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 4 4L19 6"/><circle cx="12" cy="12" r="9"/></svg>
                        </span>
                        <div class="report-copy">
                            <h2>Reservasi Selesai</h2>
                            <p class="report-value">{{ number_format($reports['completed_reservations'], 0, ',', '.') }}</p>
                        </div>
                    </article>
                </section>

                <section class="report-bottom">
                    <article class="value-card">
                        <span class="value-icon">
                            <svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
                        </span>
                        <div class="value-copy">
                            <small>TOTAL NILAI RESERVASI SELESAI</small>
                            <h2>Rp {{ number_format($reports['completed_revenue'], 0, ',', '.') }}</h2>
                            <p>Akumulasi nilai dari reservasi yang telah selesai.</p>
                        </div>
                    </article>

                    <article class="summary-card">
                        <h2>Ringkasan Aktivitas</h2>
                        <p>Data ini merangkum aktivitas PorsiKembali berdasarkan informasi yang tersimpan di database.</p>
                        <div class="summary-points">
                            <div class="summary-point">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg>
                                <span>{{ number_format($reports['total_students'], 0, ',', '.') }} mahasiswa terdaftar</span>
                            </div>
                            <div class="summary-point">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg>
                                <span>{{ number_format($reports['total_partners'], 0, ',', '.') }} mitra kantin terdaftar</span>
                            </div>
                            <div class="summary-point">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg>
                                <span>{{ number_format($reports['total_reservations'], 0, ',', '.') }} reservasi tercatat</span>
                            </div>
                            <div class="summary-point">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg>
                                <span>{{ number_format($reports['completed_reservations'], 0, ',', '.') }} reservasi telah selesai</span>
                            </div>
                        </div>
                    </article>
                </section>
            </main>

            <nav class="mobile-nav" aria-label="Navigasi admin mobile">
                <a href="{{ url('/dashboard') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="2"/><rect x="14" y="3" width="7" height="7" rx="2"/><rect x="3" y="14" width="7" height="7" rx="2"/><rect x="14" y="14" width="7" height="7" rx="2"/></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.reports.index') }}" class="active" aria-current="page">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3v18h18"/><path d="m7 16 4-5 4 3 5-7"/></svg>
                    <span>Laporan</span>
                </a>
                <a href="{{ route('admin.users.index') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                    <span>Pengguna</span>
                </a>
                <a href="{{ route('admin.partners.index') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 11 9-8 9 8"/><path d="M5 10v11h14V10"/></svg>
                    <span>Mitra</span>
                </a>
            </nav>
        </div>
    </div>
</body>
</html>