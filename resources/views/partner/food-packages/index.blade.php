<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Paket Makanan - PorsiKembali</title>

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
            --red: #dc3e3e;
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
        a { color: inherit; }
        button, input { font: inherit; }
        button, a { -webkit-tap-highlight-color: transparent; }
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
            color: var(--red);
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
        .btn-primary {
            display: inline-flex;
            min-height: 44px;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 18px;
            color: #fff;
            border: 1px solid transparent;
            border-radius: 13px;
            background: linear-gradient(135deg, var(--green), var(--green-light));
            box-shadow: 0 8px 18px rgba(47, 125, 79, .14);
            text-decoration: none;
            font-size: 13px;
            font-weight: 800;
            white-space: nowrap;
            transition: .2s ease;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 22px rgba(47, 125, 79, .2); }

        .flash {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            margin-bottom: 18px;
            padding: 14px 16px;
            border: 1px solid transparent;
            border-radius: 13px;
            font-size: 13px;
            line-height: 1.55;
        }
        .flash-success { color: #17643a; background: #e7f7ec; border-color: #c9ead3; }
        .flash-error { color: #a52d2d; background: #fff0ef; border-color: #f3d2cf; }
        .flash strong { display: block; margin-bottom: 2px; font-size: 13px; }
        .flash ul { margin: 5px 0 0; padding-left: 19px; }

        .data-panel {
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 20px;
            background: var(--surface);
            box-shadow: 0 8px 25px rgba(30, 64, 42, .035);
        }
        .data-panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 19px 22px;
            border-bottom: 1px solid var(--line);
        }
        .data-panel-title { display: flex; align-items: center; gap: 10px; min-width: 0; }
        .data-panel-title h2 { margin: 0; font-size: 17px; font-weight: 800; }
        .count-badge {
            display: inline-flex;
            align-items: center;
            min-height: 25px;
            padding: 3px 9px;
            color: #637269;
            border-radius: 999px;
            background: #edf2ee;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }
        .table-search {
            display: flex;
            width: min(260px, 40%);
            height: 40px;
            align-items: center;
            gap: 9px;
            padding: 0 12px;
            color: #85938a;
            border: 1px solid var(--line);
            border-radius: 12px;
            background: #fbfcfb;
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
        .table-search input:focus-visible { outline: 0; }
        .table-wrap { width: 100%; overflow-x: auto; }
        table { width: 100%; min-width: 850px; border-collapse: collapse; text-align: left; }
        thead th {
            padding: 15px 17px;
            color: #718078;
            background: #f6f8f6;
            border-bottom: 1px solid var(--line);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .55px;
            text-transform: uppercase;
            white-space: nowrap;
        }
        tbody td {
            padding: 17px;
            color: var(--muted);
            border-bottom: 1px solid #edf1ed;
            font-size: 13px;
            vertical-align: middle;
        }
        tbody tr:last-child td { border-bottom: 0; }
        tbody tr:hover { background: #fbfdfb; }
        .package-name { display: flex; align-items: center; gap: 11px; min-width: 190px; }
        .package-icon {
            display: grid;
            width: 42px;
            height: 42px;
            flex: 0 0 42px;
            place-items: center;
            color: var(--green);
            border-radius: 13px;
            background: var(--green-soft);
        }
        .package-name strong, .package-name small { display: block; }
        .package-name strong { color: var(--ink); font-size: 13px; line-height: 1.45; }
        .package-name small { margin-top: 3px; color: #89968e; font-size: 11px; }
        .price-normal { color: #89968e; text-decoration: line-through; white-space: nowrap; }
        .price-offer { color: var(--green); font-weight: 800; white-space: nowrap; }
        .stock-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 10px;
            color: var(--green);
            border-radius: 9px;
            background: var(--green-soft);
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }
        .stock-pill.empty { color: #b45309; background: #fff3d8; }
        .deadline-cell { min-width: 145px; color: #526157; font-size: 12px; line-height: 1.55; }
        .table-actions { display: flex; align-items: center; gap: 7px; }
        .action-btn {
            display: inline-flex;
            width: 37px;
            height: 37px;
            align-items: center;
            justify-content: center;
            color: var(--green);
            border: 1px solid var(--line);
            border-radius: 11px;
            background: #fff;
            text-decoration: none;
            transition: .18s ease;
        }
        .action-btn:hover { transform: translateY(-2px); border-color: #b9d9c3; background: var(--green-soft); }
        .action-btn.delete { color: var(--red); }
        .action-btn.delete:hover { border-color: #f0caca; background: #fff2f2; }
        .delete-form { display: inline-flex; margin: 0; }
        .empty-state { padding: 54px 20px; text-align: center; }
        .empty-icon {
            display: grid;
            width: 62px;
            height: 62px;
            margin: 0 auto 15px;
            place-items: center;
            color: var(--green);
            border-radius: 20px;
            background: var(--green-soft);
        }
        .empty-state h3 { margin: 0; color: var(--ink); font-size: 17px; }
        .empty-state p { max-width: 390px; margin: 8px auto 18px; color: var(--muted); font-size: 13px; line-height: 1.7; }
        .table-hint {
            display: none;
            margin: 0;
            padding: 10px 15px;
            color: var(--muted);
            border-top: 1px solid var(--line);
            background: #fbfcfb;
            font-size: 11px;
        }

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
            .topbar-actions { gap: 9px; }
            .user-details { display: none; }
            .user-avatar { width: 36px; height: 36px; }
            .logout-btn { width: 40px; height: 40px; padding: 0; }
            .logout-btn span { display: none; }
            .content { min-height: calc(100vh - 67px); padding: 25px 16px 100px; }
            .page-head { align-items: flex-start; flex-direction: column; gap: 14px; margin-bottom: 22px; }
            .page-head h1 { font-size: 25px; }
            .page-head .btn-primary { width: 100%; }
            .data-panel { margin-right: -16px; margin-left: -16px; border-right: 0; border-left: 0; border-radius: 0; }
            .data-panel-head { align-items: flex-start; flex-direction: column; padding: 16px; }
            .data-panel-title h2 { font-size: 16px; }
            .table-search { width: 100%; }
            table { min-width: 850px; }
            .table-hint { display: block; }
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
            .page-head .btn-primary { font-size: 12px; }
            .flash { font-size: 12px; }
            .data-panel-title { flex-wrap: wrap; }
        }
    </style>
</head>
<body>
    @php
        $partnerName = auth()->user()->name;
        $partnerInitials = collect(preg_split('/\s+/', trim($partnerName)))
            ->filter()
            ->take(2)
            ->map(fn ($part) => mb_substr($part, 0, 1))
            ->implode('');
        $packageCount = $foodPackages->count();
    @endphp

    <div class="app-shell">
        <aside class="sidebar">
            <a href="{{ url('/dashboard') }}" class="logo">
                <span class="logo-mark" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
                </span>
                <span class="logo-name">Porsi<span>Kembali</span></span>
            </a>

            <p class="sidebar-role">MENU MITRA KANTIN</p>
            <nav class="sidebar-nav" aria-label="Navigasi mitra kantin">
                <a href="{{ url('/dashboard') }}">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="2"/><rect x="14" y="3" width="7" height="7" rx="2"/><rect x="3" y="14" width="7" height="7" rx="2"/><rect x="14" y="14" width="7" height="7" rx="2"/></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('partner.food-packages.index') }}" class="active" aria-current="page">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m21 8-9 5-9-5 9-5 9 5Z"/><path d="m3 8 9 5 9-5v9l-9 5-9-5Z"/><path d="M12 13v9"/></svg>
                    <span>Paket Makanan</span>
                </a>
                <a href="{{ route('partner.reservations.index') }}">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 8h12l-1 13H7L6 8Z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/></svg>
                    <span>Reservasi Masuk</span>
                </a>
            </nav>

            <div class="sidebar-impact">
                <span class="sidebar-impact-icon" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
                </span>
                <strong>Setiap porsi berarti</strong>
                <p>Kelola paket surplus dengan baik untuk membantu mengurangi makanan terbuang.</p>
            </div>
            <p class="sidebar-foot">PorsiKembali v1.0</p>
        </aside>

        <div class="app-main">
            <header class="topbar">
                <a href="{{ url('/dashboard') }}" class="mobile-brand logo" aria-label="PorsiKembali">
                    <span class="logo-mark" aria-hidden="true">
                        <svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
                    </span>
                    <span class="logo-name">Porsi<span>Kembali</span></span>
                </a>

                <div class="topbar-title">
                    <span>Portal Mitra Kantin</span>
                    <small>Kelola paket makanan yang ditawarkan kantin.</small>
                </div>

                <div class="topbar-actions">
                    <div class="user-pill">
                        <span class="user-avatar">{{ $partnerInitials ?: 'MK' }}</span>
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
                        <span class="eyebrow">KELOLA MENU</span>
                        <h1>Daftar Paket Makanan</h1>
                        <p>Atur paket, harga, stok, dan batas pengambilan.</p>
                    </div>
                    <a href="{{ route('partner.food-packages.create') }}" class="btn-primary">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
                        Tambah Paket
                    </a>
                </section>

                @if (session('success'))
                    <div class="flash flash-success" role="status">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="flash flash-error" role="alert">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 8v4M12 16h.01"/></svg>
                        <div>
                            <strong>Ada hal yang perlu diperiksa.</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <section class="data-panel" aria-labelledby="package-panel-title">
                    <div class="data-panel-head">
                        <div class="data-panel-title">
                            <h2 id="package-panel-title">Semua Paket</h2>
                            <span class="count-badge">{{ number_format($packageCount, 0, ',', '.') }} paket</span>
                        </div>
                        <label class="table-search">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg>
                            <input type="search" id="packageSearch" placeholder="Cari nama paket..." aria-label="Cari nama paket">
                        </label>
                    </div>

                    @if ($foodPackages->isEmpty())
                        <div class="empty-state">
                            <span class="empty-icon" aria-hidden="true">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m21 8-9 5-9-5 9-5 9 5Z"/><path d="m3 8 9 5 9-5v9l-9 5-9-5Z"/><path d="M12 13v9"/></svg>
                            </span>
                            <h3>Belum ada paket makanan</h3>
                            <p>Tambahkan paket makanan surplus pertama dari kantin Anda agar mahasiswa dapat menemukannya.</p>
                            <a href="{{ route('partner.food-packages.create') }}" class="btn-primary">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
                                Tambah Paket Pertama
                            </a>
                        </div>
                    @else
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Paket</th>
                                        <th scope="col">Harga Normal</th>
                                        <th scope="col">Harga Penawaran</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col">Batas Pengambilan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="packageTableBody">
                                    @foreach ($foodPackages as $package)
                                        <tr data-package-row>
                                            <td>
                                                <div class="package-name">
                                                    <span class="package-icon" aria-hidden="true">
                                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m21 8-9 5-9-5 9-5 9 5Z"/><path d="m3 8 9 5 9-5v9l-9 5-9-5Z"/><path d="M12 13v9"/></svg>
                                                    </span>
                                                    <span>
                                                        <strong>{{ $package->name }}</strong>
                                                        <small>Paket makanan kantin</small>
                                                    </span>
                                                </div>
                                            </td>
                                            <td><span class="price-normal">Rp {{ number_format($package->normal_price, 0, ',', '.') }}</span></td>
                                            <td><span class="price-offer">Rp {{ number_format($package->offer_price, 0, ',', '.') }}</span></td>
                                            <td>
                                                <span class="stock-pill {{ $package->stock < 1 ? 'empty' : '' }}">
                                                    {{ number_format($package->stock, 0, ',', '.') }} paket
                                                </span>
                                            </td>
                                            <td class="deadline-cell">
                                                {{ \Carbon\Carbon::parse($package->pickup_deadline)->format('d-m-Y') }}<br>
                                                {{ \Carbon\Carbon::parse($package->pickup_deadline)->format('H:i') }} WIB
                                            </td>
                                            <td>
                                                <div class="table-actions">
                                                    <a
                                                        href="{{ route('partner.food-packages.edit', $package->id) }}"
                                                        class="action-btn"
                                                        title="Edit {{ $package->name }}"
                                                        aria-label="Edit {{ $package->name }}"
                                                    >
                                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m14 5 5 5M4 20l4.5-1 10.8-10.8a2.1 2.1 0 0 0-3-3L5.5 16 4 20Z"/></svg>
                                                    </a>
                                                    <form
                                                        action="{{ route('partner.food-packages.destroy', $package->id) }}"
                                                        method="POST"
                                                        class="delete-form"
                                                        onsubmit="return confirm('Yakin ingin menghapus paket makanan ini?')"
                                                    >
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            type="submit"
                                                            class="action-btn delete"
                                                            title="Hapus {{ $package->name }}"
                                                            aria-label="Hapus {{ $package->name }}"
                                                        >
                                                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6M10 11v5M14 11v5"/></svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <p class="table-hint">Geser tabel ke samping untuk melihat semua kolom dan tombol aksi.</p>
                        <p id="noSearchResult" class="empty-search" hidden style="padding:24px;text-align:center;color:#64736a;font-size:13px;">Paket yang dicari tidak ditemukan.</p>
                    @endif
                </section>
            </main>

            <nav class="mobile-nav" aria-label="Navigasi bawah mitra kantin">
                <a href="{{ url('/dashboard') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="2"/><rect x="14" y="3" width="7" height="7" rx="2"/><rect x="3" y="14" width="7" height="7" rx="2"/><rect x="14" y="14" width="7" height="7" rx="2"/></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('partner.food-packages.index') }}" class="active" aria-current="page">
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

    <script>
        const packageSearch = document.getElementById('packageSearch');
        const packageRows = document.querySelectorAll('[data-package-row]');
        const noSearchResult = document.getElementById('noSearchResult');

        if (packageSearch) {
            packageSearch.addEventListener('input', function () {
                const keyword = this.value.trim().toLocaleLowerCase('id');
                let visibleCount = 0;

                packageRows.forEach(function (row) {
                    const matches = row.textContent.toLocaleLowerCase('id').includes(keyword);
                    row.hidden = !matches;
                    if (matches) visibleCount++;
                });

                if (noSearchResult) {
                    noSearchResult.hidden = visibleCount !== 0;
                }
            });
        }
    </script>
</body>
</html>