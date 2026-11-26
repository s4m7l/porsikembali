<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Paket Makanan - PorsiKembali</title>

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
            --surface: #fff;
            --bg: #f0f5f0;
            --red: #dc3e3e;
            --amber: #e99a22;
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
        button, input, textarea { font: inherit; }
        button, a { -webkit-tap-highlight-color: transparent; }
        button:focus-visible, a:focus-visible, input:focus-visible, textarea:focus-visible {
            outline: 3px solid rgba(47, 125, 79, .23);
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
            border-right: 1px solid var(--line);
            background: rgba(255, 255, 255, .95);
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
        .sidebar-foot { margin: 16px 0 0; color: #a0aba4; text-align: center; font-size: 10px; }

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
            padding: 34px 40px 60px;
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            color: var(--muted);
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            transition: color .2s ease;
        }
        .back-link:hover { color: var(--green); }
        .page-head { margin-bottom: 25px; }
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
        .page-head p { margin: 8px 0 0; color: var(--muted); font-size: 14px; line-height: 1.65; }

        .flash {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            margin-bottom: 19px;
            padding: 14px 16px;
            border: 1px solid transparent;
            border-radius: 13px;
            font-size: 13px;
            line-height: 1.6;
        }
        .flash-success { color: #23633a; border-color: #cce8d3; background: #edf8ef; }
        .flash-error { color: #a63232; border-color: #f0cccc; background: #fff2f2; }
        .flash svg { flex: 0 0 19px; margin-top: 1px; }
        .flash ul { margin: 5px 0 0; padding-left: 19px; }

        .form-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 340px;
            align-items: start;
            gap: 20px;
        }
        .edit-form {
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 20px;
            background: var(--surface);
            box-shadow: var(--shadow);
        }
        .form-section { padding: 24px; }
        .form-section + .form-section { border-top: 1px solid var(--line); }
        .form-section-head {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 20px;
        }
        .section-icon {
            display: grid;
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            place-items: center;
            color: var(--green);
            border-radius: 12px;
            background: var(--green-soft);
        }
        .form-section-head h2 { margin: 0; font-size: 16px; font-weight: 800; }
        .form-section-head p { margin: 3px 0 0; color: var(--muted); font-size: 12px; line-height: 1.5; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 17px 16px; }
        .field { display: block; min-width: 0; }
        .field.full { grid-column: 1 / -1; }
        .field > span {
            display: block;
            margin-bottom: 8px;
            color: #35443a;
            font-size: 12px;
            font-weight: 800;
        }
        .required-mark { color: #d34a4a; }
        .field input, .field textarea {
            display: block;
            width: 100%;
            min-height: 47px;
            padding: 11px 13px;
            color: var(--ink);
            border: 1px solid #d9e3db;
            border-radius: 12px;
            outline: 0;
            background: #fff;
            font-size: 13px;
            transition: border-color .18s ease, box-shadow .18s ease;
        }
        .field input::placeholder, .field textarea::placeholder { color: #a1aca4; }
        .field textarea { min-height: 112px; resize: vertical; line-height: 1.65; }
        .field input:focus, .field textarea:focus {
            border-color: var(--green-light);
            box-shadow: 0 0 0 4px rgba(47, 125, 79, .09);
        }
        .field input.is-invalid, .field textarea.is-invalid { border-color: #dc6262; }
        .field-hint { display: block; margin-top: 7px; color: #839087; font-size: 11px; line-height: 1.5; }
        .field-error { display: block; margin-top: 6px; color: #c0392b; font-size: 11px; line-height: 1.45; }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 17px 24px;
            border-top: 1px solid var(--line);
            background: #f8faf8;
        }
        .btn {
            display: inline-flex;
            min-height: 45px;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 17px;
            border: 1px solid transparent;
            border-radius: 12px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: transform .18s ease, box-shadow .18s ease, background .18s ease;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn-primary {
            color: #fff;
            background: linear-gradient(135deg, var(--green), var(--green-light));
            box-shadow: 0 8px 18px rgba(47, 125, 79, .16);
        }
        .btn-primary:hover { box-shadow: 0 10px 22px rgba(47, 125, 79, .22); }
        .btn-secondary { color: #526157; border-color: var(--line); background: #fff; }
        .btn-secondary:hover { background: #f4f7f4; }

        .preview-panel {
            position: sticky;
            top: 100px;
            padding: 18px;
            border: 1px dashed #b9d4c1;
            border-radius: 20px;
            background: rgba(255, 255, 255, .58);
        }
        .preview-title { display: flex; align-items: center; justify-content: space-between; gap: 9px; }
        .preview-title span:first-child { color: var(--green); font-size: 10px; font-weight: 800; letter-spacing: 1.4px; }
        .preview-label { padding: 5px 8px; color: #447653; border-radius: 8px; background: var(--green-soft); font-size: 9px; font-weight: 800; }
        .preview-card {
            overflow: hidden;
            margin-top: 13px;
            border: 1px solid #e5ece6;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 8px 24px rgba(25, 64, 40, .07);
        }
        .preview-image {
            position: relative;
            display: grid;
            height: 150px;
            overflow: hidden;
            place-items: center;
            background: linear-gradient(140deg, #e8f2e6 0%, #f8e9ce 55%, #e5f0df 100%);
        }
        .preview-image::before, .preview-image::after {
            position: absolute;
            width: 170px;
            height: 170px;
            border: 1px solid rgba(255,255,255,.64);
            border-radius: 50%;
            content: '';
        }
        .preview-image::after { width: 215px; height: 215px; }
        .food-plate {
            position: relative;
            z-index: 1;
            display: grid;
            width: 112px;
            height: 112px;
            place-items: center;
            border: 8px solid #fff;
            border-radius: 50%;
            background: #f9f5e8;
            box-shadow: 0 9px 23px rgba(79, 75, 47, .16), inset 0 0 0 2px #e5dfcf;
        }
        .food-bowl {
            position: relative;
            width: 72px;
            height: 46px;
            overflow: hidden;
            border: 3px solid #d1a25a;
            border-top: 0;
            border-radius: 5px 5px 38px 38px;
            background: #fffdf5;
        }
        .food-bowl::before {
            position: absolute;
            top: -12px;
            left: 3px;
            width: 58px;
            height: 24px;
            border-radius: 50%;
            background: #e9c47f;
            box-shadow: 19px 3px 0 -4px #75a66a, -11px 5px 0 -5px #d96e4f;
            content: '';
        }
        .food-bowl::after {
            position: absolute;
            top: 13px;
            left: 25px;
            width: 23px;
            height: 13px;
            border-radius: 50%;
            background: #b85d3f;
            transform: rotate(-15deg);
            content: '';
        }
        .preview-image-tag {
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 2;
            padding: 6px 9px;
            color: #28613d;
            border: 1px solid rgba(255,255,255,.75);
            border-radius: 8px;
            background: rgba(255,255,255,.88);
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .4px;
        }
        .preview-body { padding: 16px; }
        .preview-canteen { display: flex; align-items: center; gap: 8px; color: var(--muted); font-size: 11px; }
        .preview-canteen-icon {
            display: grid;
            width: 25px;
            height: 25px;
            place-items: center;
            color: var(--green);
            border-radius: 8px;
            background: var(--green-soft);
        }
        .preview-body h3 { margin: 12px 0 6px; color: var(--ink); font-size: 17px; line-height: 1.35; }
        .preview-description { min-height: 54px; margin: 0; color: var(--muted); font-size: 11px; line-height: 1.65; overflow-wrap: anywhere; }
        .preview-price-label { display: block; margin-top: 15px; color: #8a968e; font-size: 10px; }
        .preview-prices { display: flex; align-items: baseline; flex-wrap: wrap; gap: 8px; margin-top: 3px; }
        .preview-offer { color: var(--green); font-size: 21px; font-weight: 800; letter-spacing: -.5px; }
        .preview-normal { color: #9aa59d; font-size: 11px; text-decoration: line-through; }
        .preview-meta { display: flex; justify-content: space-between; gap: 10px; margin-top: 14px; padding-top: 12px; border-top: 1px solid #edf1ed; }
        .preview-meta div { min-width: 0; }
        .preview-meta small { display: block; color: #8b978f; font-size: 9px; }
        .preview-meta strong { display: block; margin-top: 4px; color: #435248; font-size: 11px; }
        .preview-note { display: flex; align-items: flex-start; gap: 7px; margin: 12px 2px 0; color: var(--muted); font-size: 11px; line-height: 1.55; }
        .preview-note svg { flex: 0 0 16px; margin-top: 1px; color: var(--green); }
        .preview-note strong { color: #435d4a; }

        @media (max-width: 1100px) {
            .sidebar { width: 215px; }
            .app-main { margin-left: 215px; }
            .content { padding-right: 26px; padding-left: 26px; }
            .topbar { padding-right: 26px; padding-left: 26px; }
            .form-layout { grid-template-columns: minmax(0, 1fr) 300px; }
        }
        @media (max-width: 900px) {
            .form-layout { grid-template-columns: 1fr; }
            .preview-panel { position: static; max-width: 520px; }
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
            .content { min-height: calc(100vh - 67px); padding: 24px 16px 100px; }
            .page-head { margin-bottom: 20px; }
            .page-head h1 { font-size: 25px; }
            .page-head p { font-size: 13px; }
            .form-section { padding: 19px 17px; }
            .form-actions { padding: 15px 17px; }
            .preview-panel { max-width: none; }
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
                background: rgba(255,255,255,.97);
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
        @media (max-width: 480px) {
            .page-head h1 { font-size: 23px; }
            .form-grid { grid-template-columns: 1fr; gap: 14px; }
            .field.full { grid-column: auto; }
            .form-actions { flex-direction: column-reverse; }
            .form-actions .btn { width: 100%; }
            .preview-meta { flex-direction: column; }
            .preview-meta div { display: flex; align-items: baseline; justify-content: space-between; gap: 12px; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { scroll-behavior: auto !important; transition-duration: .01ms !important; }
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
                <a href="{{ route('partner.food-packages.index') }}" class="back-link">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m15 18-6-6 6-6"/><path d="M9 12h12"/></svg>
                    Kembali ke daftar paket
                </a>

                <section class="page-head">
                    <span class="eyebrow">PAKET MAKANAN</span>
                    <h1>Tambah Paket Baru</h1>
                    <p>Lengkapi informasi paket makanan surplus yang akan ditawarkan.</p>
                </section>

                @if (session('success'))
                    <div class="flash flash-success" role="status">
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="flash flash-error" role="alert">
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 8v4M12 16h.01"/></svg>
                        <div>
                            <strong>Periksa kembali data yang dimasukkan.</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="form-layout">
                    <form action="{{ route('partner.food-packages.store') }}" method="POST" class="edit-form" id="packageForm">
                        @csrf

                        <section class="form-section">
                            <div class="form-section-head">
                                <span class="section-icon" aria-hidden="true">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v18M3 12h18"/><rect x="4" y="4" width="16" height="16" rx="4" opacity="0.35"/></svg>
                                </span>
                                <div>
                                    <h2>Informasi Paket</h2>
                                    <p>Masukkan nama dan detail makanan yang ditawarkan.</p>
                                </div>
                            </div>

                            <div class="form-grid">
                                <label class="field full" for="name">
                                    <span>Nama Paket Makanan <i class="required-mark">*</i></span>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name') }}"
                                        placeholder="Contoh: Paket Nasi Ayam"
                                        maxlength="255"
                                        required
                                        class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
                                    >
                                    @error('name') <small class="field-error">{{ $message }}</small> @enderror
                                </label>

                                <label class="field full" for="description">
                                    <span>Deskripsi Paket <i class="required-mark">*</i></span>
                                    <textarea
                                        id="description"
                                        name="description"
                                        placeholder="Jelaskan isi paket makanan, misalnya nasi, lauk, sayur, dan minuman."
                                        required
                                        class="{{ $errors->has('description') ? 'is-invalid' : '' }}"
                                        aria-invalid="{{ $errors->has('description') ? 'true' : 'false' }}"
                                    >{{ old('description') }}</textarea>
                                    <small class="field-hint">Tuliskan isi paket dengan jelas agar mahasiswa mengetahui makanan yang akan diterima.</small>
                                    @error('description') <small class="field-error">{{ $message }}</small> @enderror
                                </label>
                            </div>
                        </section>

                        <section class="form-section">
                            <div class="form-section-head">
                                <span class="section-icon" aria-hidden="true">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="3"/><path d="M3 10h18M7 15h3"/></svg>
                                </span>
                                <div>
                                    <h2>Harga &amp; Ketersediaan</h2>
                                    <p>Atur harga penawaran, jumlah stok, dan waktu pengambilan.</p>
                                </div>
                            </div>

                            <div class="form-grid">
                                <label class="field" for="normal_price">
                                    <span>Harga Normal (Rp) <i class="required-mark">*</i></span>
                                    <input
                                        type="number"
                                        id="normal_price"
                                        name="normal_price"
                                        value="{{ old('normal_price') }}"
                                        placeholder="Contoh: 20000"
                                        min="0"
                                        step="0.01"
                                        required
                                        class="{{ $errors->has('normal_price') ? 'is-invalid' : '' }}"
                                        aria-invalid="{{ $errors->has('normal_price') ? 'true' : 'false' }}"
                                    >
                                    @error('normal_price') <small class="field-error">{{ $message }}</small> @enderror
                                </label>

                                <label class="field" for="offer_price">
                                    <span>Harga Penawaran (Rp) <i class="required-mark">*</i></span>
                                    <input
                                        type="number"
                                        id="offer_price"
                                        name="offer_price"
                                        value="{{ old('offer_price') }}"
                                        placeholder="Contoh: 12000"
                                        min="0"
                                        step="0.01"
                                        required
                                        class="{{ $errors->has('offer_price') ? 'is-invalid' : '' }}"
                                        aria-invalid="{{ $errors->has('offer_price') ? 'true' : 'false' }}"
                                    >
                                    @error('offer_price') <small class="field-error">{{ $message }}</small> @enderror
                                </label>

                                <label class="field" for="stock">
                                    <span>Jumlah Stok <i class="required-mark">*</i></span>
                                    <input
                                        type="number"
                                        id="stock"
                                        name="stock"
                                        value="{{ old('stock') }}"
                                        placeholder="Contoh: 10"
                                        min="1"
                                        step="1"
                                        required
                                        class="{{ $errors->has('stock') ? 'is-invalid' : '' }}"
                                        aria-invalid="{{ $errors->has('stock') ? 'true' : 'false' }}"
                                    >
                                    @error('stock') <small class="field-error">{{ $message }}</small> @enderror
                                </label>

                                <label class="field" for="pickup_deadline">
                                    <span>Batas Waktu Pengambilan <i class="required-mark">*</i></span>
                                    <input
                                        type="datetime-local"
                                        id="pickup_deadline"
                                        name="pickup_deadline"
                                        value="{{ old('pickup_deadline') }}"
                                        required
                                        class="{{ $errors->has('pickup_deadline') ? 'is-invalid' : '' }}"
                                        aria-invalid="{{ $errors->has('pickup_deadline') ? 'true' : 'false' }}"
                                    >
                                    @error('pickup_deadline') <small class="field-error">{{ $message }}</small> @enderror
                                </label>
                            </div>
                        </section>

                        <div class="form-actions">
                            <a href="{{ route('partner.food-packages.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg>
                                Simpan Paket Makanan
                            </button>
                        </div>
                    </form>

                    <aside class="preview-panel" aria-label="Pratinjau kartu paket makanan">
                        <div class="preview-title">
                            <span>PRATINJAU KARTU</span>
                            <span class="preview-label">TAMPILAN MAHASISWA</span>
                        </div>

                        <article class="preview-card">
                            <div class="preview-image" aria-hidden="true">
                                <span class="preview-image-tag">PAKET SURPLUS</span>
                                <div class="food-plate"><div class="food-bowl"></div></div>
                            </div>
                            <div class="preview-body">
                                <div class="preview-canteen">
                                    <span class="preview-canteen-icon" aria-hidden="true">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M5 21V7l7-4 7 4v14M9 10h.01M15 10h.01M9 14h.01M15 14h.01"/></svg>
                                    </span>
                                    <span>{{ $partnerName }}</span>
                                </div>
                                <h3 id="previewName">{{ old('name', 'Nama Paket Makanan') }}</h3>
                                <p class="preview-description" id="previewDescription">{{ old('description', 'Deskripsi paket makanan akan tampil di sini.') }}</p>
                                <span class="preview-price-label">Harga penawaran</span>
                                <div class="preview-prices">
                                    <strong class="preview-offer" id="previewOffer">Rp {{ old('offer_price') !== null && old('offer_price') !== '' ? number_format((float) old('offer_price'), 0, ',', '.') : '0' }}</strong>
                                    <del class="preview-normal" id="previewNormal">Rp {{ old('normal_price') !== null && old('normal_price') !== '' ? number_format((float) old('normal_price'), 0, ',', '.') : '0' }}</del>
                                </div>
                                <div class="preview-meta">
                                    <div><small>Stok tersedia</small><strong id="previewStock">{{ old('stock', '0') }} paket</strong></div>
                                    <div><small>Batas pengambilan</small><strong id="previewDeadline">{{ old('pickup_deadline') ? \Carbon\Carbon::parse(old('pickup_deadline'))->format('d-m-Y H:i') : 'Belum diatur' }}</strong></div>
                                </div>
                            </div>
                        </article>

                        <p class="preview-note">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 3 1.9 5.8L20 11l-6.1 2.2L12 19l-1.9-5.8L4 11l6.1-2.2L12 3Z"/></svg>
                            <span>Pratinjau akan mengikuti perubahan informasi yang kamu masukkan pada formulir.</span>
                        </p>
                    </aside>
                </div>
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
        (() => {
            const fields = {
                name: document.getElementById('name'),
                description: document.getElementById('description'),
                normalPrice: document.getElementById('normal_price'),
                offerPrice: document.getElementById('offer_price'),
                stock: document.getElementById('stock'),
                deadline: document.getElementById('pickup_deadline')
            };

            const preview = {
                name: document.getElementById('previewName'),
                description: document.getElementById('previewDescription'),
                normalPrice: document.getElementById('previewNormal'),
                offerPrice: document.getElementById('previewOffer'),
                stock: document.getElementById('previewStock'),
                deadline: document.getElementById('previewDeadline')
            };

            const rupiah = (value) => {
                const amount = Number(value);
                return Number.isFinite(amount)
                    ? 'Rp ' + new Intl.NumberFormat('id-ID', { maximumFractionDigits: 0 }).format(amount)
                    : 'Rp 0';
            };

            const showDeadline = (value) => {
                if (!value) return 'Belum diatur';
                const date = new Date(value);
                if (Number.isNaN(date.getTime())) return 'Belum diatur';
                return new Intl.DateTimeFormat('id-ID', {
                    day: '2-digit', month: '2-digit', year: 'numeric',
                    hour: '2-digit', minute: '2-digit', hour12: false
                }).format(date).replace(',', '');
            };

            fields.name?.addEventListener('input', () => {
                preview.name.textContent = fields.name.value.trim() || 'Nama Paket Makanan';
            });
            fields.description?.addEventListener('input', () => {
                preview.description.textContent = fields.description.value.trim() || 'Deskripsi paket makanan akan tampil di sini.';
            });
            fields.normalPrice?.addEventListener('input', () => {
                preview.normalPrice.textContent = rupiah(fields.normalPrice.value);
            });
            fields.offerPrice?.addEventListener('input', () => {
                preview.offerPrice.textContent = rupiah(fields.offerPrice.value);
            });
            fields.stock?.addEventListener('input', () => {
                preview.stock.textContent = (fields.stock.value || '0') + ' paket';
            });
            fields.deadline?.addEventListener('input', () => {
                preview.deadline.textContent = showDeadline(fields.deadline.value);
            });
        })();
    </script>
</body>
</html>