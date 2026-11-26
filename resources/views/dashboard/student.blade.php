<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Mahasiswa - PorsiKembali</title>
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
            --shadow: 0 12px 35px rgba(25, 64, 40, .08);
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-width: 320px;
            min-height: 100vh;
            color: var(--ink);
            background: var(--bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        a { color: inherit; }
        button { font: inherit; }

        .app-shell { min-height: 100vh; }
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 20;
            display: flex;
            flex-direction: column;
            width: 248px;
            padding: 30px 20px 22px;
            background: rgba(255,255,255,.94);
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
            place-items: center;
            color: #fff;
            border-radius: 13px;
            background: linear-gradient(135deg, var(--green), var(--green-light));
            box-shadow: 0 8px 18px rgba(47,125,79,.24);
        }
        .sidebar-role {
            margin: 46px 12px 12px;
            color: #8b9a90;
            font-size: 10px;
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
            font-size: 13px;
            font-weight: 600;
            transition: .2s ease;
        }
        .sidebar-nav a:hover { color: var(--green); background: var(--green-soft); }
        .sidebar-nav a.active {
            color: #fff;
            background: var(--green);
            box-shadow: 0 9px 20px rgba(47,125,79,.2);
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
        .sidebar-impact strong { display: block; font-size: 12px; }
        .sidebar-impact p { margin: 5px 0 0; color: #5c7564; font-size: 10px; line-height: 1.6; }
        .sidebar-foot { margin-top: 16px; color: #a0aba4; text-align: center; font-size: 9px; }

        .app-main { min-height: 100vh; margin-left: 248px; }
        .topbar {
            position: sticky;
            top: 0;
            z-index: 10;
            display: flex;
            height: 77px;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            border-bottom: 1px solid var(--line);
            background: rgba(240,245,240,.9);
            backdrop-filter: blur(16px);
        }
        .topbar-title span { display: block; font-size: 13px; font-weight: 700; }
        .topbar-title small { color: var(--muted); font-size: 10px; }
        .topbar-actions { display: flex; align-items: center; gap: 12px; }
        .user-pill { display: flex; align-items: center; gap: 10px; }
        .user-avatar {
            display: grid;
            width: 38px;
            height: 38px;
            place-items: center;
            color: var(--green);
            border-radius: 12px;
            background: var(--green-soft);
            font-size: 11px;
            font-weight: 800;
        }
        .user-details strong, .user-details small { display: block; }
        .user-details strong { font-size: 11px; }
        .user-details small { margin-top: 2px; color: var(--muted); font-size: 9px; }
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
            font-size: 11px;
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
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.7px;
        }
        .page-head h1 {
            margin: 0;
            font-size: 27px;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -1px;
        }
        .page-head p { margin: 8px 0 0; color: var(--muted); font-size: 12px; }
        .section-block { margin-top: 32px; }
        .section-title h2 { margin: 0; font-size: 16px; letter-spacing: -.3px; }
        .section-title p { margin: 5px 0 0; color: var(--muted); font-size: 10px; }
        .quick-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            margin-top: 15px;
        }
        .quick-card {
            position: relative;
            display: flex;
            min-height: 160px;
            align-items: flex-start;
            gap: 17px;
            overflow: hidden;
            padding: 25px;
            color: var(--ink);
            border: 1px solid var(--line);
            border-radius: 20px;
            background: var(--surface);
            box-shadow: 0 8px 22px rgba(30,64,42,.04);
            text-align: left;
            text-decoration: none;
            transition: .2s ease;
        }
        .quick-card:hover {
            transform: translateY(-3px);
            border-color: #bcd9c5;
            box-shadow: var(--shadow);
        }
        .quick-card-icon {
            display: grid;
            width: 51px;
            height: 51px;
            flex: 0 0 51px;
            place-items: center;
            color: var(--green);
            border-radius: 15px;
            background: var(--green-soft);
        }
        .quick-card h3 { margin: 2px 0 7px; font-size: 14px; }
        .quick-card p { margin: 0; color: var(--muted); font-size: 10px; line-height: 1.6; }
        .quick-card-action {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 21px;
            color: var(--green);
            font-size: 10px;
            font-weight: 800;
        }
        .quick-card-green { background: linear-gradient(130deg, #eaf6ed, #fafffb); }
        .decor-circle {
            position: absolute;
            right: -30px;
            bottom: -40px;
            width: 120px;
            height: 120px;
            border: 25px solid rgba(47,125,79,.05);
            border-radius: 50%;
            pointer-events: none;
        }
        .impact-banner {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-top: 18px;
            padding: 20px 24px;
            border: 1px dashed #b8d4c0;
            border-radius: 18px;
            background: rgba(255,255,255,.55);
        }
        .impact-icon {
            display: grid;
            width: 49px;
            height: 49px;
            flex: 0 0 49px;
            place-items: center;
            color: var(--green);
            border-radius: 15px;
            background: #daf0e0;
        }
        .impact-copy small { color: var(--green); font-size: 8px; font-weight: 800; letter-spacing: 1px; }
        .impact-copy h3 { margin: 4px 0; font-size: 13px; }
        .impact-copy p { margin: 0; color: var(--muted); font-size: 9px; line-height: 1.6; }
        .mobile-nav { display: none; }

        @media (max-width: 1050px) {
            .sidebar { width: 210px; }
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
            .topbar-actions { gap: 10px; }
            .user-details { display: none; }
            .user-avatar { width: 36px; height: 36px; }
            .logout-btn { width: 40px; height: 40px; padding: 0; }
            .logout-btn span { display: none; }
            .content { min-height: calc(100vh - 67px); padding: 25px 16px 100px; }
            .page-head { margin-bottom: 22px; }
            .page-head h1 { font-size: 23px; }
            .quick-grid { grid-template-columns: 1fr; }
            .quick-card { min-height: 140px; padding: 20px; }
            .mobile-nav {
                position: fixed;
                right: 0;
                bottom: 0;
                left: 0;
                z-index: 30;
                display: flex;
                justify-content: space-around;
                padding: 8px 10px max(12px, env(safe-area-inset-bottom));
                border-top: 1px solid var(--line);
                background: rgba(255,255,255,.96);
                backdrop-filter: blur(15px);
            }
            .mobile-nav a {
                display: flex;
                min-width: 70px;
                min-height: 48px;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 3px;
                color: #78877e;
                text-decoration: none;
                font-size: 8px;
            }
            .mobile-nav a.active { color: var(--green); font-weight: 800; }
            .impact-banner { align-items: flex-start; padding: 17px; }
        }
        @media (max-width: 420px) {
            .quick-card { gap: 13px; padding: 18px; }
            .quick-card-icon { width: 44px; height: 44px; flex-basis: 44px; }
            .impact-banner { gap: 12px; }
            .impact-icon { width: 42px; height: 42px; flex-basis: 42px; }
            .impact-copy h3 { font-size: 12px; }
        }
        /* ================================
           PENYESUAIAN UKURAN TEKS DASHBOARD
           Greeting utama tetap dipertahankan.
        ================================ */
        .sidebar-role { font-size: 11px; }
        .sidebar-nav a { font-size: 14px; }
        .sidebar-impact strong { font-size: 13px; }
        .sidebar-impact p { font-size: 11px; }
        .sidebar-foot { font-size: 10px; }

        .topbar-title span { font-size: 14px; }
        .topbar-title small { font-size: 11px; }
        .user-details strong { font-size: 12px; }
        .user-details small { font-size: 10px; }
        .logout-btn { font-size: 12px; }

        .eyebrow { font-size: 10px; }
        .page-head p { font-size: 14px; line-height: 1.6; }
        .section-title h2 { font-size: 18px; }
        .section-title p { font-size: 12px; line-height: 1.6; }

        .quick-card h3 { font-size: 16px; }
        .quick-card p { font-size: 13px; line-height: 1.7; }
        .quick-card-action { font-size: 12px; }

        .impact-copy small { font-size: 10px; }
        .impact-copy h3 { font-size: 15px; line-height: 1.45; }
        .impact-copy p { font-size: 12px; line-height: 1.7; }

        @media (max-width: 768px) {
            .topbar-title { display: none; }
            .page-head p { font-size: 13px; }
            .section-title h2 { font-size: 17px; }
            .section-title p { font-size: 12px; }
            .quick-card h3 { font-size: 16px; }
            .quick-card p { font-size: 13px; }
            .quick-card-action { font-size: 12px; }
            .mobile-nav a { font-size: 10px; }
            .impact-copy h3 { font-size: 14px; }
            .impact-copy p { font-size: 12px; }
        }

        @media (max-width: 420px) {
            .quick-card p { font-size: 12px; }
            .impact-copy h3 { font-size: 14px; }
            .impact-copy p { font-size: 12px; }
        }
    </style>
</head>
<body>
    @php
        $studentName = auth()->user()->name;
        $studentInitials = strtoupper(substr($studentName, 0, 2));
    @endphp

    <div class="app-shell">
        <aside class="sidebar">
            <a href="{{ url('/dashboard') }}" class="logo">
                <span class="logo-mark">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
                </span>
                <span class="logo-name">Porsi<span>Kembali</span></span>
            </a>

            <div class="sidebar-role">MENU MAHASISWA</div>
            <nav class="sidebar-nav" aria-label="Navigasi mahasiswa">
                <a href="{{ url('/dashboard') }}" class="active">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 11 9-8 9 8"/><path d="M5 10v11h14V10M9 21v-7h6v7"/></svg>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('student.food-packages.index') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 11h16a8 8 0 0 1-16 0Z"/><path d="M12 3v4M8 5v2M16 5v2"/></svg>
                    <span>Katalog Paket</span>
                </a>
                <a href="{{ route('student.reservations.index') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 12a9 9 0 1 0 3-6.7L3 8"/><path d="M3 3v5h5M12 7v5l3 2"/></svg>
                    <span>Riwayat Reservasi</span>
                </a>
            </nav>

            <div class="sidebar-impact">
                <span class="sidebar-impact-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
                </span>
                <strong>Mulai dari satu porsi</strong>
                <p>Reservasi makanan surplus membantu mengurangi makanan yang terbuang.</p>
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
                    <span>Portal Mahasiswa</span>
                    <small>Satu porsi terselamatkan, satu langkah berarti.</small>
                </div>

                <div class="topbar-actions">
                    <div class="user-pill">
                        <span class="user-avatar">{{ $studentInitials }}</span>
                        <div class="user-details">
                            <strong>{{ $studentName }}</strong>
                            <small>Mahasiswa</small>
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
                <div class="page-head">
                    <span class="eyebrow">BERANDA MAHASISWA</span>
                    <h1>Selamat datang, {{ $studentName }}!</h1>
                    <p>Mau selamatkan makanan apa hari ini?</p>
                </div>

                <section class="section-block">
                    <div class="section-title">
                        <h2>Aksi cepat</h2>
                        <p>Mulai langkah kecilmu hari ini.</p>
                    </div>

                    <div class="quick-grid">
                        <a href="{{ route('student.food-packages.index') }}" class="quick-card quick-card-green">
                            <span class="quick-card-icon">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 11h16a8 8 0 0 1-16 0Z"/><path d="M12 3v4M8 5v2M16 5v2"/></svg>
                            </span>
                            <span>
                                <h3>Cari paket makanan</h3>
                                <p>Lihat makanan tersedia yang ditawarkan oleh mitra kantin.</p>
                                <span class="quick-card-action">Jelajahi katalog <span aria-hidden="true">→</span></span>
                            </span>
                            <span class="decor-circle" aria-hidden="true"></span>
                        </a>

                        <a href="{{ route('student.reservations.index') }}" class="quick-card">
                            <span class="quick-card-icon">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 12a9 9 0 1 0 3-6.7L3 8"/><path d="M3 3v5h5M12 7v5l3 2"/></svg>
                            </span>
                            <span>
                                <h3>Riwayat reservasi</h3>
                                <p>Pantau status dan daftar reservasi yang pernah kamu lakukan.</p>
                                <span class="quick-card-action">Lihat riwayat <span aria-hidden="true">→</span></span>
                            </span>
                        </a>
                    </div>
                </section>

                <section class="impact-banner">
                    <span class="impact-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
                    </span>
                    <div class="impact-copy">
                        <small>DAMPAK BERSAMA</small>
                        <h3>Satu reservasi bisa menjadi langkah kecil yang berarti.</h3>
                        <p>Pilih paket makanan yang tersedia dan bantu mengurangi makanan berlebih di lingkungan kampus.</p>
                    </div>
                </section>
            </main>

            <nav class="mobile-nav" aria-label="Navigasi bawah mahasiswa">
                <a href="{{ url('/dashboard') }}" class="active">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 11 9-8 9 8"/><path d="M5 10v11h14V10M9 21v-7h6v7"/></svg>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('student.food-packages.index') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 11h16a8 8 0 0 1-16 0Z"/><path d="M12 3v4M8 5v2M16 5v2"/></svg>
                    <span>Paket</span>
                </a>
                <a href="{{ route('student.reservations.index') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 12a9 9 0 1 0 3-6.7L3 8"/><path d="M3 3v5h5M12 7v5l3 2"/></svg>
                    <span>Riwayat</span>
                </a>
            </nav>
        </div>
    </div>
</body>
</html>