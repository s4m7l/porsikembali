<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Mitra Kantin - PorsiKembali</title>

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
            --amber: #f59e0b;
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
        button { cursor: pointer; }
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
        .page-head {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 25px;
            margin-bottom: 27px;
        }
        .eyebrow {
            display: block;
            margin-bottom: 8px;
            color: var(--green);
            font-size: 10px;
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
        .btn {
            display: inline-flex;
            min-height: 44px;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 18px;
            color: white;
            border: 1px solid transparent;
            border-radius: 13px;
            background: linear-gradient(135deg, var(--green), var(--green-light));
            box-shadow: 0 8px 18px rgba(47, 125, 79, .14);
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
            transition: .2s ease;
        }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 10px 22px rgba(47, 125, 79, .2); }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 20px;
        }
        .stat-card {
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
        .stat-icon {
            display: grid;
            width: 45px;
            height: 45px;
            flex: 0 0 45px;
            place-items: center;
            color: var(--green);
            border-radius: 14px;
            background: var(--green-soft);
        }
        .stat-icon.amber { color: #d78708; background: #fff1d3; }
        .stat-card small, .stat-card strong { display: block; }
        .stat-card small { color: var(--muted); font-size: 12px; line-height: 1.4; }
        .stat-card strong { margin: 4px 0 2px; font-size: 25px; line-height: 1.15; }
        .stat-card p { margin: 0; color: var(--muted); font-size: 11px; line-height: 1.5; }

        .partner-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.3fr) minmax(260px, .7fr);
            gap: 15px;
        }
        .panel {
            min-width: 0;
            padding: 22px;
            border: 1px solid var(--line);
            border-radius: 19px;
            background: var(--surface);
        }
        .section-title h2 { margin: 0; font-size: 18px; letter-spacing: -.3px; }
        .section-title p { margin: 5px 0 0; color: var(--muted); font-size: 12px; line-height: 1.6; }
        .partner-links {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
            margin-top: 18px;
        }
        .partner-link {
            display: flex;
            min-height: 91px;
            align-items: center;
            gap: 10px;
            padding: 14px;
            color: var(--ink);
            border: 1px solid var(--line);
            border-radius: 14px;
            background: var(--surface);
            text-align: left;
            text-decoration: none;
            transition: .2s ease;
        }
        .partner-link:hover { transform: translateY(-2px); border-color: #bcd9c5; box-shadow: var(--shadow); }
        .partner-link-icon {
            display: grid;
            width: 40px;
            height: 40px;
            flex: 0 0 40px;
            place-items: center;
            color: var(--green);
            border-radius: 12px;
            background: var(--green-soft);
        }
        .partner-link-copy { flex: 1; min-width: 0; }
        .partner-link strong, .partner-link small { display: block; }
        .partner-link strong { font-size: 13px; line-height: 1.45; }
        .partner-link small { margin-top: 4px; color: var(--muted); font-size: 11px; line-height: 1.5; }
        .partner-link-arrow { flex: 0 0 auto; color: #8c9a91; }

        .dark-panel {
            position: relative;
            overflow: hidden;
            color: white;
            border: 0;
            background: linear-gradient(145deg, #153b26, #246641);
        }
        .dark-panel::after {
            position: absolute;
            right: -45px;
            top: -55px;
            width: 150px;
            height: 150px;
            border: 28px solid rgba(255, 255, 255, .055);
            border-radius: 50%;
            content: '';
            pointer-events: none;
        }
        .dark-panel > small { color: #b6d9c1; font-size: 10px; font-weight: 800; letter-spacing: 1px; }
        .dark-panel h2 { margin: 13px 0 5px; font-size: 25px; letter-spacing: -.6px; }
        .dark-panel p { margin: 0; color: #d0e5d6; font-size: 12px; line-height: 1.7; }
        .impact-note {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            margin-top: 22px;
            padding-top: 16px;
            color: #d0e5d6;
            border-top: 1px solid rgba(255, 255, 255, .16);
            font-size: 11px;
            line-height: 1.6;
        }
        .impact-note svg { flex: 0 0 auto; color: #9be0b0; }
        .data-note {
            margin-top: 13px;
            padding: 11px 13px;
            color: #66766c;
            border: 1px dashed #cbd9ce;
            border-radius: 12px;
            background: rgba(255, 255, 255, .55);
            font-size: 11px;
            line-height: 1.6;
        }

        @media (max-width: 1050px) {
            .sidebar { width: 210px; }
            .app-main { margin-left: 210px; }
            .content { padding: 32px 25px 50px; }
            .topbar { padding: 0 25px; }
            .partner-grid { grid-template-columns: 1fr; }
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
            .page-head { align-items: flex-start; flex-direction: column; gap: 14px; margin-bottom: 22px; }
            .page-head h1 { font-size: 25px; }
            .stats-grid { grid-template-columns: 1fr; gap: 11px; }
            .stat-card { padding: 16px; }
            .stat-card strong { font-size: 23px; }
            .partner-links { grid-template-columns: 1fr; }
            .panel { padding: 19px; }
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
                min-width: 88px;
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
            .page-head .btn { width: 100%; }
            .stat-card { gap: 12px; }
            .stat-card small { font-size: 11px; }
            .stat-card p { font-size: 10px; }
            .partner-link { padding: 13px; }
            .dark-panel h2 { font-size: 23px; }
        }
    </style>
</head>
<body>
    @php
        $partnerName = auth()->user()->name;
        $partnerInitials = strtoupper(substr($partnerName, 0, 2));

        // Nilai statistik ditampilkan hanya jika controller mengirimkannya.
        // Dengan begitu, angka contoh dari desain Figma tidak dianggap sebagai data nyata.
        $activePackageCount = $activePackageCount ?? null;
        $pendingReservationCount = $pendingReservationCount ?? null;
        $rescuedPortionCount = $rescuedPortionCount ?? null;
    @endphp

    <div class="app-shell">
        <aside class="sidebar">
            <a href="{{ url('/dashboard') }}" class="logo">
                <span class="logo-mark">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
                </span>
                <span class="logo-name">Porsi<span>Kembali</span></span>
            </a>

            <div class="sidebar-role">MENU MITRA KANTIN</div>
            <nav class="sidebar-nav" aria-label="Navigasi mitra kantin">
                <a href="{{ url('/dashboard') }}" class="active">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="2"/><rect x="14" y="3" width="7" height="7" rx="2"/><rect x="3" y="14" width="7" height="7" rx="2"/><rect x="14" y="14" width="7" height="7" rx="2"/></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('partner.food-packages.index') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m21 8-9 5-9-5 9-5 9 5Z"/><path d="m3 8 9 5 9-5v9l-9 5-9-5Z"/><path d="M12 13v9"/></svg>
                    <span>Paket Makanan</span>
                </a>
                <a href="{{ route('partner.reservations.index') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 8h12l-1 13H7L6 8Z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/></svg>
                    <span>Reservasi Masuk</span>
                </a>
            </nav>

            <div class="sidebar-impact">
                <span class="sidebar-impact-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
                </span>
                <strong>Bagikan manfaat lebih</strong>
                <p>Tawarkan makanan surplus agar lebih banyak porsi terselamatkan dan dinikmati mahasiswa.</p>
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
                    <span>Portal Mitra Kantin</span>
                    <small>Satu porsi terselamatkan, satu langkah berarti.</small>
                </div>

                <div class="topbar-actions">
                    <div class="user-pill">
                        <span class="user-avatar">{{ $partnerInitials }}</span>
                        <div class="user-details">
                            <strong>{{ $partnerName }}</strong>
                            <small>Mitra Kantin</small>
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
                    <div>
                        <span class="eyebrow">RINGKASAN HARI INI</span>
                        <h1>Selamat datang, {{ $partnerName }}!</h1>
                        <p>Kelola paket surplus dan pantau reservasi mahasiswa.</p>
                    </div>
                    <a href="{{ route('partner.food-packages.create') }}" class="btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
                        Tambah paket
                    </a>
                </section>

                <section class="stats-grid" aria-label="Ringkasan aktivitas mitra">
                    <article class="stat-card">
                        <span class="stat-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m21 8-9 5-9-5 9-5 9 5Z"/><path d="m3 8 9 5 9-5v9l-9 5-9-5Z"/><path d="M12 13v9"/></svg>
                        </span>
                        <div>
                            <small>Paket aktif</small>
                            <strong>{{ $activePackageCount !== null ? number_format($activePackageCount, 0, ',', '.') : '—' }}</strong>
                            <p>{{ $activePackageCount !== null ? 'Paket dengan stok tersedia' : 'Menunggu data dari dashboard' }}</p>
                        </div>
                    </article>

                    <article class="stat-card">
                        <span class="stat-icon amber">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 8h12l-1 13H7L6 8Z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/></svg>
                        </span>
                        <div>
                            <small>Reservasi menunggu</small>
                            <strong>{{ $pendingReservationCount !== null ? number_format($pendingReservationCount, 0, ',', '.') : '—' }}</strong>
                            <p>{{ $pendingReservationCount !== null ? 'Perlu dikonfirmasi di kantin' : 'Menunggu data dari dashboard' }}</p>
                        </div>
                    </article>

                    <article class="stat-card">
                        <span class="stat-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
                        </span>
                        <div>
                            <small>Porsi terselamatkan</small>
                            <strong>{{ $rescuedPortionCount !== null ? number_format($rescuedPortionCount, 0, ',', '.') : '—' }}</strong>
                            <p>{{ $rescuedPortionCount !== null ? 'Dari reservasi yang selesai' : 'Menunggu data dari dashboard' }}</p>
                        </div>
                    </article>
                </section>

                <div class="partner-grid">
                    <section class="panel">
                        <div class="section-title">
                            <h2>Akses cepat</h2>
                            <p>Kelola operasional kantinmu.</p>
                        </div>
                        <div class="partner-links">
                            <a href="{{ route('partner.food-packages.index') }}" class="partner-link">
                                <span class="partner-link-icon">
                                    <svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m21 8-9 5-9-5 9-5 9 5Z"/><path d="m3 8 9 5 9-5v9l-9 5-9-5Z"/><path d="M12 13v9"/></svg>
                                </span>
                                <span class="partner-link-copy">
                                    <strong>Daftar Paket Makanan</strong>
                                    <small>Kelola stok dan harga paket</small>
                                </span>
                                <svg class="partner-link-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
                            </a>

                            <a href="{{ route('partner.reservations.index') }}" class="partner-link">
                                <span class="partner-link-icon">
                                    <svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 8h12l-1 13H7L6 8Z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/></svg>
                                </span>
                                <span class="partner-link-copy">
                                    <strong>Reservasi Masuk</strong>
                                    <small>Lihat dan konfirmasi pesanan mahasiswa</small>
                                </span>
                                <svg class="partner-link-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
                            </a>
                        </div>
                    </section>

                    <section class="panel dark-panel">
                        <small>DAMPAK KANTINMU</small>
                        <h2>{{ $rescuedPortionCount !== null ? number_format($rescuedPortionCount, 0, ',', '.') . ' porsi' : 'Satu porsi berarti' }}</h2>
                        <p>{{ $rescuedPortionCount !== null ? 'makanan terselamatkan dari reservasi yang selesai.' : 'Setiap paket surplus yang berhasil diambil membantu mengurangi makanan terbuang.' }}</p>
                        <div class="impact-note">
                            <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
                            <span>Terus tawarkan paket makanan yang masih layak konsumsi dan perbarui stok secara berkala.</span>
                        </div>
                    </section>
                </div>

                @if ($activePackageCount === null || $pendingReservationCount === null || $rescuedPortionCount === null)
                    <p class="data-note">
                        Catatan: angka statistik belum dihubungkan ke controller. Dashboard ini tidak menggunakan angka contoh dari Figma agar informasi yang tampil tidak keliru. Menu pengelolaan paket dan reservasi tetap dapat digunakan.
                    </p>
                @endif
            </main>

            <nav class="mobile-nav" aria-label="Navigasi bawah mitra kantin">
                <a href="{{ url('/dashboard') }}" class="active">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="2"/><rect x="14" y="3" width="7" height="7" rx="2"/><rect x="3" y="14" width="7" height="7" rx="2"/><rect x="14" y="14" width="7" height="7" rx="2"/></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('partner.food-packages.index') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m21 8-9 5-9-5 9-5 9 5Z"/><path d="m3 8 9 5 9-5v9l-9 5-9-5Z"/><path d="M12 13v9"/></svg>
                    <span>Paket</span>
                </a>
                <a href="{{ route('partner.reservations.index') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 8h12l-1 13H7L6 8Z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/></svg>
                    <span>Reservasi</span>
                </a>
            </nav>
        </div>
    </div>
</body>
</html>