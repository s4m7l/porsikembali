<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Katalog Paket Makanan - PorsiKembali</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --green: #2f7d4f;
            --green-2: #4caf7a;
            --green-soft: #e7f4eb;
            --ink: #14211a;
            --muted: #64736a;
            --line: #dfe8e1;
            --amber: #f59e0b;
            --surface: #fff;
            --bg: #f0f5f0;
            --shadow: 0 12px 35px rgba(25,64,40,.08);
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
        button, input { font: inherit; }
        button { cursor: pointer; }
        a { color: inherit; }
        button:focus-visible, input:focus-visible, a:focus-visible {
            outline: 3px solid rgba(47,125,79,.24);
            outline-offset: 2px;
        }

        .app-shell { min-height: 100vh; }
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 30;
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
        .logo-mark {
            display: grid;
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            place-items: center;
            color: #fff;
            border-radius: 13px;
            background: linear-gradient(135deg,var(--green),var(--green-2));
            box-shadow: 0 8px 18px rgba(47,125,79,.24);
        }
        .logo-name span { color: var(--green); }
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
            background: linear-gradient(145deg,#e7f4eb,#f4faf5);
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
            z-index: 20;
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
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.7px;
        }
        .page-head h1 {
            margin: 0;
            font-size: 27px;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -1px;
        }
        .page-head p { margin: 8px 0 0; color: var(--muted); font-size: 12px; }
        .search-box {
            display: flex;
            width: 260px;
            height: 44px;
            align-items: center;
            gap: 8px;
            padding: 0 13px;
            color: #87968d;
            border: 1px solid var(--line);
            border-radius: 13px;
            background: var(--surface);
        }
        .search-box input {
            width: 100%;
            min-width: 0;
            border: 0;
            outline: 0;
            background: transparent;
            color: var(--ink);
            font-size: 10px;
        }
        .search-box input:focus-visible { outline: 0; }
        .catalog-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 17px;
        }
        .filter-chips { display: flex; flex-wrap: wrap; gap: 7px; }
        .filter-chips button {
            height: 34px;
            padding: 0 13px;
            color: var(--muted);
            border: 1px solid var(--line);
            border-radius: 999px;
            background: var(--surface);
            font-size: 9px;
            font-weight: 700;
        }
        .filter-chips button.active { color: #fff; border-color: var(--green); background: var(--green); }
        .catalog-toolbar p { margin: 0; color: var(--muted); font-size: 10px; }
        .catalog-toolbar p strong { color: var(--ink); }
        .catalog-grid { display: grid; grid-template-columns: repeat(3,minmax(0,1fr)); gap: 18px; align-items: stretch; }
        .food-card {
            min-width: 0;
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 21px;
            background: var(--surface);
            box-shadow: 0 8px 25px rgba(30,64,42,.05);
            transition: .25s ease;
        }
        .food-card:hover { transform: translateY(-4px); box-shadow: var(--shadow); }
        .food-card.unavailable { opacity: .78; }
        .food-image {
            position: relative;
            display: grid;
            height: 145px;
            place-items: center;
            overflow: hidden;
            background: radial-gradient(circle at 45% 40%,#eef5e9,#dce9d8);
        }
        .food-image::before {
            position: absolute;
            right: -20px;
            bottom: -65px;
            width: 180px;
            height: 180px;
            border: 25px solid rgba(255,255,255,.25);
            border-radius: 50%;
            content: '';
        }
        .food-image > .badge {
            position: absolute;
            top: 13px;
            left: 13px;
        }
        .badge {
            display: inline-flex;
            width: max-content;
            align-items: center;
            padding: 6px 9px;
            border-radius: 999px;
            font-size: 8px;
            font-weight: 800;
            letter-spacing: .4px;
            white-space: nowrap;
        }
        .badge-green { color: #16803d; background: #dcfce7; }
        .badge-amber { color: #a86100; background: #fff2ce; }
        .badge-neutral { color: #627068; background: #edf1ee; }
        .food-bowl {
            position: relative;
            z-index: 1;
            width: 128px;
            height: 70px;
            border-radius: 10px 10px 65px 65px;
            background: #f4b452;
            box-shadow: 0 15px 20px rgba(70,70,30,.13);
        }
        .food-bowl::after {
            position: absolute;
            top: -17px;
            right: 16px;
            left: 16px;
            height: 37px;
            border: 5px solid #f4b452;
            border-radius: 50%;
            background: #fff8e8;
            content: '';
        }
        .food-bowl span, .food-bowl i, .food-bowl b { position: absolute; z-index: 2; display: block; border-radius: 50%; }
        .food-bowl span { top: -10px; left: 23px; width: 43px; height: 25px; background: #f7f1d6; }
        .food-bowl i { top: -8px; right: 20px; width: 36px; height: 28px; background: #9a5b34; }
        .food-bowl b { top: 2px; left: 50px; width: 30px; height: 18px; background: #62a85b; }
        .food-body { padding: 17px; }
        .canteen-line { display: flex; align-items: center; gap: 8px; }
        .canteen-avatar {
            display: grid;
            width: 30px;
            height: 30px;
            flex: 0 0 30px;
            place-items: center;
            border-radius: 9px;
            background: var(--green-soft);
            color: var(--green);
            font-size: 8px;
            font-weight: 800;
        }
        .canteen-line strong, .canteen-line small { display: block; }
        .canteen-line strong { font-size: 9px; }
        .canteen-line small { display: flex; align-items: center; gap: 3px; margin-top: 2px; color: var(--muted); font-size: 8px; }
        .food-body h3 { margin: 14px 0 6px; font-size: 16px; letter-spacing: -.3px; }
        .food-desc { min-height: 43px; margin: 0; color: var(--muted); font-size: 9px; line-height: 1.6; overflow-wrap: anywhere; }
        .price-row { display: flex; align-items: flex-end; justify-content: space-between; gap: 8px; margin-top: 14px; }
        .price-row small, .price-row strong { display: block; }
        .price-row small { color: var(--muted); font-size: 8px; }
        .price-row strong { margin-top: 3px; color: var(--green); font-size: 18px; }
        .price-row del { color: #9aa69e; font-size: 9px; white-space: nowrap; }
        .stock-head { display: flex; justify-content: space-between; gap: 8px; margin-top: 14px; color: var(--muted); font-size: 8px; }
        .stock-head strong { color: var(--ink); }
        .stock-bar { height: 5px; margin-top: 6px; overflow: hidden; border-radius: 99px; background: #e5ece7; }
        .stock-bar i { display: block; height: 100%; border-radius: 99px; background: linear-gradient(90deg,var(--green),#7bcf97); }
        .deadline {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 13px;
            padding: 10px;
            border-radius: 10px;
            background: #f6f8f6;
            color: var(--muted);
            font-size: 8px;
        }
        .deadline strong { margin-left: auto; color: var(--ink); text-align: right; }
        .reservation-form { margin-top: 13px; }
        .reserve-row { display: flex; gap: 9px; }
        .stepper {
            display: flex;
            height: 44px;
            flex: 0 0 auto;
            align-items: center;
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 12px;
            background: var(--surface);
        }
        .stepper button {
            width: 31px;
            height: 100%;
            border: 0;
            background: transparent;
            color: var(--green);
            font-size: 17px;
        }
        .stepper button:disabled { color: #aab5ad; cursor: not-allowed; }
        .stepper input {
            width: 29px;
            height: 100%;
            padding: 0;
            border: 0;
            outline: 0;
            background: transparent;
            color: var(--ink);
            text-align: center;
            font-size: 10px;
            font-weight: 800;
            appearance: textfield;
            -moz-appearance: textfield;
        }
        .stepper input::-webkit-outer-spin-button, .stepper input::-webkit-inner-spin-button { margin: 0; -webkit-appearance: none; }
        .reserve-btn {
            display: inline-flex;
            min-width: 0;
            min-height: 44px;
            flex: 1;
            align-items: center;
            justify-content: center;
            padding: 0 12px;
            border: 1px solid transparent;
            border-radius: 12px;
            background: linear-gradient(135deg,var(--green),var(--green-2));
            color: #fff;
            font-size: 10px;
            font-weight: 800;
            transition: .2s ease;
        }
        .reserve-btn:hover:not(:disabled) { transform: translateY(-2px); box-shadow: 0 9px 20px rgba(47,125,79,.18); }
        .reserve-btn:disabled { opacity: .55; cursor: not-allowed; }
        .alert {
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-bottom: 20px;
            padding: 14px 16px;
            border-radius: 14px;
            font-size: 11px;
            line-height: 1.6;
        }
        .alert p { margin: 3px 0 0; }
        .alert-success { border: 1px solid #c8e7d1; background: #edf9f0; color: #27633c; }
        .alert-error { border: 1px solid #f3cfcc; background: #fff0ef; color: #a93226; }
        .pickup-code { display: inline-block; margin: 2px 0; font-size: 20px; font-weight: 800; letter-spacing: 3px; }
        .empty-state {
            padding: 58px 22px;
            border: 1px dashed #bed1c3;
            border-radius: 20px;
            background: rgba(255,255,255,.5);
            text-align: center;
        }
        .empty-icon {
            display: grid;
            width: 65px;
            height: 65px;
            margin: 0 auto;
            place-items: center;
            border-radius: 20px;
            background: var(--green-soft);
            color: var(--green);
        }
        .empty-state h2 { margin: 15px 0 5px; font-size: 16px; }
        .empty-state p { margin: 0; color: var(--muted); font-size: 10px; }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-top: 25px;
            color: var(--green);
            text-decoration: none;
            font-size: 10px;
            font-weight: 800;
        }
        .back-link:hover { text-decoration: underline; }
        .mobile-nav { display: none; }

        @media (max-width: 1050px) {
            .sidebar { width: 210px; }
            .app-main { margin-left: 210px; }
            .content { padding: 32px 25px 50px; }
            .topbar { padding: 0 25px; }
            .catalog-grid { grid-template-columns: repeat(2,minmax(0,1fr)); }
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
            .content { min-height: calc(100vh - 67px); padding: 24px 16px 100px; }
            .page-head { align-items: flex-start; flex-direction: column; margin-bottom: 22px; }
            .page-head h1 { font-size: 23px; }
            .page-head .search-box { width: 100%; }
            .catalog-toolbar { align-items: flex-start; flex-direction: column; gap: 10px; }
            .catalog-grid { grid-template-columns: 1fr; }
            .food-image { height: 180px; }
            .food-desc { min-height: 0; }
            .mobile-nav {
                position: fixed;
                right: 0;
                bottom: 0;
                left: 0;
                z-index: 40;
                display: flex;
                justify-content: space-around;
                padding: 8px 10px max(12px,env(safe-area-inset-bottom));
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
        }
        @media (max-width: 420px) {
            .filter-chips { width: 100%; flex-wrap: nowrap; overflow-x: auto; padding-bottom: 3px; }
            .filter-chips button { flex: 0 0 auto; }
            .food-body { padding: 16px; }
            .food-image { height: 170px; }
            .reserve-row { gap: 7px; }
            .stepper button { width: 29px; }
            .stepper input { width: 25px; }
        }

        .sidebar-role {
            font-size: 11px;
        }

        .sidebar-nav a {
            font-size: 14px;
        }

        .sidebar-impact strong {
            font-size: 13px;
        }

        .sidebar-impact p {
            font-size: 11px;
        }

        .sidebar-foot {
            font-size: 10px;
        }

        /* Header */
        .topbar-title span {
            font-size: 14px;
        }

        .topbar-title small {
            font-size: 11px;
        }

        .user-details strong {
            font-size: 12px;
        }

        .user-details small {
            font-size: 10px;
        }

        .logout-btn {
            font-size: 12px;
        }

        /* Judul halaman */
        .eyebrow {
            font-size: 10px;
        }

        .page-head h1 {
            font-size: 30px;
        }

        .page-head p {
            font-size: 14px;
            line-height: 1.6;
        }

        /* Pencarian dan filter */
        .search-box input {
            font-size: 12px;
        }

        .filter-chips button {
            font-size: 11px;
        }

        .catalog-toolbar p {
            font-size: 12px;
        }

        /* Kartu makanan */
        .badge {
            font-size: 10px;
        }

        .canteen-avatar {
            font-size: 10px;
        }

        .canteen-line strong {
            font-size: 11px;
        }

        .canteen-line small {
            font-size: 11px;
        }

        .food-body h3 {
            font-size: 18px;
        }

        .food-desc {
            font-size: 12px;
            line-height: 1.7;
        }

        /* Harga */
        .price-row small {
            font-size: 10px;
        }

        .price-row strong {
            font-size: 20px;
        }

        .price-row del {
            font-size: 11px;
        }

        /* Stok dan batas pengambilan */
        .stock-head {
            font-size: 10px;
        }

        .deadline {
            font-size: 11px;
        }

        /* Form reservasi */
        .stepper input {
            font-size: 12px;
        }

        .reserve-btn {
            font-size: 12px;
        }

        /* Pesan dan kondisi kosong */
        .alert {
            font-size: 13px;
        }

        .empty-state h2 {
            font-size: 18px;
        }

        .empty-state p {
            font-size: 12px;
        }

        .back-link {
            font-size: 12px;
        }

        /* Tampilan HP */
        @media (max-width: 768px) {
            .page-head h1 {
                font-size: 26px;
            }

            .page-head p {
                font-size: 13px;
            }

            .food-desc {
                font-size: 13px;
            }

            .mobile-nav a {
                font-size: 10px;
            }
        }

        @media (max-width: 420px) {
            .page-head h1 {
                font-size: 24px;
            }

            .food-desc {
                font-size: 12px;
            }
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
                <span class="logo-mark" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
                </span>
                <span class="logo-name">Porsi<span>Kembali</span></span>
            </a>

            <div class="sidebar-role">MENU MAHASISWA</div>
            <nav class="sidebar-nav" aria-label="Navigasi mahasiswa">
                <a href="{{ url('/dashboard') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 11 9-8 9 8"/><path d="M5 10v11h14V10M9 21v-7h6v7"/></svg>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('student.food-packages.index') }}" class="active" aria-current="page">
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
                    <span class="logo-mark" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
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
                        <div class="user-details"><strong>{{ $studentName }}</strong><small>Mahasiswa</small></div>
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
                    <div>
                        <span class="eyebrow">KATALOG HARI INI</span>
                        <h1>Paket Makanan Tersedia</h1>
                        <p>Makanan enak, harga hemat, dan ikut jaga bumi.</p>
                    </div>
                    <label class="search-box" aria-label="Cari paket atau kantin">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg>
                        <input type="search" id="packageSearch" placeholder="Cari paket atau kantin..." autocomplete="off">
                    </label>
                </div>

                @if (session('success'))
                    <div class="alert alert-success" role="status">
                        <strong>{{ session('success') }}</strong>
                        @if (session('pickup_code'))
                            <span>Kode pengambilan:</span>
                            <strong class="pickup-code">{{ session('pickup_code') }}</strong>
                            <span>Tunjukkan kode tersebut kepada petugas kantin saat mengambil pesanan.</span>
                        @endif
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error" role="alert">
                        <strong>Reservasi belum berhasil:</strong>
                        @foreach ($errors->all() as $error)
                            <span>{{ $error }}</span>
                        @endforeach
                    </div>
                @endif

                <div class="catalog-toolbar">
                    <div class="filter-chips" aria-label="Filter paket">
                        <button type="button" class="active" data-filter="all" aria-pressed="true">Semua paket</button>
                        <button type="button" data-filter="available" aria-pressed="false">Stok tersedia</button>
                        <button type="button" data-sort="price" aria-pressed="false">Harga terendah</button>
                    </div>
                    <p><strong id="packageCount">{{ $foodPackages->count() }} paket</strong> ditampilkan</p>
                </div>

                @if ($foodPackages->isNotEmpty())
                    <div class="catalog-grid" id="catalogGrid">
                        @foreach ($foodPackages as $package)
                            @php
                                $canteenName = $package->canteenPartner->canteen_name ?? 'Mitra kantin';
                                $canteenLocation = $package->canteenPartner->location ?? 'Lokasi tidak tersedia';
                                $discountPercent = $package->normal_price > 0
                                    ? max(0, (int) round((($package->normal_price - $package->offer_price) / $package->normal_price) * 100))
                                    : 0;
                                $stockAvailable = (int) $package->stock > 0;
                                $searchText = strtolower($package->name . ' ' . ($package->description ?? '') . ' ' . $canteenName . ' ' . $canteenLocation);
                            @endphp
                            <article
                                class="food-card {{ $stockAvailable ? '' : 'unavailable' }}"
                                data-search="{{ $searchText }}"
                                data-stock="{{ $stockAvailable ? '1' : '0' }}"
                                data-price="{{ $package->offer_price }}"
                            >
                                <div class="food-image" aria-hidden="true">
                                    <div class="food-bowl"><span></span><i></i><b></b></div>
                                    @if (!$stockAvailable)
                                        <span class="badge badge-neutral">STOK HABIS</span>
                                    @elseif ($discountPercent > 0)
                                        <span class="badge badge-amber">HEMAT {{ $discountPercent }}%</span>
                                    @else
                                        <span class="badge badge-green">SIAP DIRESERVASI</span>
                                    @endif
                                </div>

                                <div class="food-body">
                                    <div class="canteen-line">
                                        <span class="canteen-avatar">{{ strtoupper(substr($canteenName, 0, 2)) }}</span>
                                        <div>
                                            <strong>{{ $canteenName }}</strong>
                                            <small>
                                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                                                {{ $canteenLocation }}
                                            </small>
                                        </div>
                                    </div>

                                    <h3>{{ $package->name }}</h3>
                                    <p class="food-desc">{{ $package->description ?: 'Paket makanan dari mitra kantin PorsiKembali.' }}</p>

                                    <div class="price-row">
                                        <div>
                                            <small>Harga penawaran</small>
                                            <strong>Rp {{ number_format($package->offer_price, 0, ',', '.') }}</strong>
                                        </div>
                                        <del>Rp {{ number_format($package->normal_price, 0, ',', '.') }}</del>
                                    </div>

                                    <div class="stock-head">
                                        <span>Stok tersedia</span>
                                        <strong>{{ $package->stock }} paket</strong>
                                    </div>
                                    <div class="stock-bar"><i style="width: {{ min(max((int) $package->stock, 0) * 20, 100) }}%"></i></div>

                                    <div class="deadline">
                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                                        <span>Batas pengambilan</span>
                                        <strong>{{ \Carbon\Carbon::parse($package->pickup_deadline)->format('d-m-Y · H:i') }}</strong>
                                    </div>

                                    <div class="reservation-form">
                                        <form action="{{ route('student.reservations.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="food_package_id" value="{{ $package->id }}">
                                            <div class="reserve-row">
                                                <div class="stepper" aria-label="Jumlah paket">
                                                    <button type="button" data-qty-change="-1" data-target="quantity-{{ $package->id }}" aria-label="Kurangi jumlah" {{ !$stockAvailable ? 'disabled' : '' }}>−</button>
                                                    <input
                                                        type="number"
                                                        id="quantity-{{ $package->id }}"
                                                        name="quantity"
                                                        value="1"
                                                        min="1"
                                                        max="{{ max((int) $package->stock, 1) }}"
                                                        inputmode="numeric"
                                                        aria-label="Jumlah paket yang dipesan"
                                                        required
                                                    >
                                                    <button type="button" data-qty-change="1" data-target="quantity-{{ $package->id }}" aria-label="Tambah jumlah" {{ !$stockAvailable ? 'disabled' : '' }}>+</button>
                                                </div>
                                                <button type="submit" class="reserve-btn" {{ !$stockAvailable ? 'disabled' : '' }}>
                                                    {{ $stockAvailable ? 'Reservasi Paket' : 'Stok Habis' }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <div class="empty-state" id="searchEmpty" hidden>
                        <span class="empty-icon">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg>
                        </span>
                        <h2>Paket tidak ditemukan</h2>
                        <p>Coba gunakan kata kunci lain atau ubah filter pencarian.</p>
                    </div>
                @else
                    <div class="empty-state">
                        <span class="empty-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 11h16a8 8 0 0 1-16 0Z"/><path d="M12 3v4M8 5v2M16 5v2"/></svg>
                        </span>
                        <h2>Belum ada paket makanan</h2>
                        <p>Paket makanan dari mitra kantin akan muncul di sini saat tersedia.</p>
                    </div>
                @endif

                <a href="{{ url('/dashboard') }}" class="back-link">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m14 18-6-6 6-6"/><path d="M20 12H8"/></svg>
                    Kembali ke dashboard
                </a>
            </main>

            <nav class="mobile-nav" aria-label="Navigasi bawah mahasiswa">
                <a href="{{ url('/dashboard') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 11 9-8 9 8"/><path d="M5 10v11h14V10M9 21v-7h6v7"/></svg>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('student.food-packages.index') }}" class="active" aria-current="page">
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('packageSearch');
            const grid = document.getElementById('catalogGrid');
            const count = document.getElementById('packageCount');
            const searchEmpty = document.getElementById('searchEmpty');
            const filterButtons = document.querySelectorAll('[data-filter]');
            const sortButton = document.querySelector('[data-sort="price"]');
            let activeFilter = 'all';
            let sortByPrice = false;

            function updateCatalog() {
                if (!grid) return;

                const keyword = (searchInput?.value || '').trim().toLowerCase();
                const cards = Array.from(grid.querySelectorAll('.food-card'));
                let visibleCount = 0;

                cards.forEach(function (card) {
                    const matchesSearch = (card.dataset.search || '').includes(keyword);
                    const matchesFilter = activeFilter === 'all' || card.dataset.stock === '1';
                    const visible = matchesSearch && matchesFilter;
                    card.hidden = !visible;
                    if (visible) visibleCount++;
                });

                if (sortByPrice) {
                    cards.sort(function (a, b) {
                        return Number(a.dataset.price || 0) - Number(b.dataset.price || 0);
                    });
                } else {
                    cards.sort(function (a, b) {
                        return Number(a.dataset.originalOrder) - Number(b.dataset.originalOrder);
                    });
                }
                cards.forEach(function (card) { grid.appendChild(card); });

                if (count) count.textContent = visibleCount + ' paket';
                if (searchEmpty) searchEmpty.hidden = visibleCount !== 0;
                grid.hidden = visibleCount === 0;
            }

            if (grid) {
                Array.from(grid.querySelectorAll('.food-card')).forEach(function (card, index) {
                    card.dataset.originalOrder = String(index);
                });
            }

            searchInput?.addEventListener('input', updateCatalog);

            filterButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    activeFilter = button.dataset.filter;
                    filterButtons.forEach(function (item) {
                        const active = item === button;
                        item.classList.toggle('active', active);
                        item.setAttribute('aria-pressed', active ? 'true' : 'false');
                    });
                    updateCatalog();
                });
            });

            sortButton?.addEventListener('click', function () {
                sortByPrice = !sortByPrice;
                sortButton.classList.toggle('active', sortByPrice);
                sortButton.setAttribute('aria-pressed', sortByPrice ? 'true' : 'false');
                sortButton.textContent = sortByPrice ? 'Harga terendah ✓' : 'Harga terendah';
                updateCatalog();
            });

            document.querySelectorAll('[data-qty-change]').forEach(function (button) {
                button.addEventListener('click', function () {
                    const input = document.getElementById(button.dataset.target);
                    if (!input || button.disabled) return;
                    const min = Number(input.min || 1);
                    const max = Number(input.max || 1);
                    const current = Number(input.value || min);
                    const change = Number(button.dataset.qtyChange);
                    input.value = String(Math.min(max, Math.max(min, current + change)));
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                });
            });

            document.querySelectorAll('.stepper input').forEach(function (input) {
                input.addEventListener('change', function () {
                    const min = Number(input.min || 1);
                    const max = Number(input.max || 1);
                    const value = Number(input.value || min);
                    input.value = String(Math.min(max, Math.max(min, value)));
                });
            });

            updateCatalog();
        });
    </script>
</body>
</html>