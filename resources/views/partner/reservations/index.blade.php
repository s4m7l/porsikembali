<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reservasi Masuk - PorsiKembali</title>

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
            --amber: #a16207;
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
        button { font: inherit; }
        button, a { -webkit-tap-highlight-color: transparent; }
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
        .page-head p { margin: 8px 0 0; color: var(--muted); font-size: 14px; line-height: 1.65; }

        .flash {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            margin-bottom: 18px;
            padding: 14px 16px;
            border: 1px solid #c9ead3;
            border-radius: 13px;
            color: #17643a;
            background: #e7f7ec;
            font-size: 13px;
            line-height: 1.55;
        }
        .flash svg { flex: 0 0 auto; margin-top: 1px; }
        .flash div { flex: 1; }
        .flash strong { display: block; margin-bottom: 2px; font-size: 13px; }
        .flash p { margin: 0; color: #39734e; font-size: 12px; }
        .flash-error {
            margin-bottom: 18px;
            padding: 14px 16px;
            color: #a52d2d;
            border: 1px solid #f3d2cf;
            border-radius: 13px;
            background: #fff0ef;
            font-size: 13px;
        }
        .flash-error ul { margin: 6px 0 0; padding-left: 20px; }

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
        .table-wrap { width: 100%; overflow-x: auto; }
        table { width: 100%; min-width: 1080px; border-collapse: collapse; text-align: left; }
        thead th {
            padding: 15px 16px;
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
            padding: 16px;
            color: var(--muted);
            border-bottom: 1px solid #edf1ed;
            font-size: 13px;
            vertical-align: middle;
        }
        tbody tr:last-child td { border-bottom: 0; }
        tbody tr:hover { background: #fbfdfb; }
        .student-cell { min-width: 155px; }
        .student-cell strong, .student-cell small { display: block; }
        .student-cell strong { color: var(--ink); font-size: 13px; line-height: 1.45; }
        .student-cell small { margin-top: 3px; color: #89968e; font-size: 11px; }
        .package-cell { min-width: 145px; color: var(--ink); font-weight: 700; }
        .quantity-cell { white-space: nowrap; }
        .total-price { color: var(--green); font-weight: 800; white-space: nowrap; }
        .pickup-code {
            display: inline-flex;
            min-height: 34px;
            align-items: center;
            padding: 0 10px;
            color: var(--green);
            border: 1px dashed #b9d9c3;
            border-radius: 9px;
            background: #f2faf4;
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1px;
            white-space: nowrap;
        }
        .status-badge {
            display: inline-flex;
            min-height: 29px;
            align-items: center;
            gap: 6px;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }
        .status-pending { color: #946200; background: #fff3cd; }
        .status-complete { color: #17643a; background: #e0f2e5; }
        .status-cancelled { color: #a52d2d; background: #fde8e7; }
        .status-other { color: #5c6670; background: #eef1f3; }
        .date-cell { min-width: 125px; color: #526157; font-size: 12px; line-height: 1.6; white-space: nowrap; }
        .date-cell small { color: #89968e; font-size: 11px; }
        .complete-form { margin: 0; }
        .complete-button {
            display: inline-flex;
            min-height: 38px;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 12px;
            color: #fff;
            border: 1px solid transparent;
            border-radius: 11px;
            background: linear-gradient(135deg, var(--green), var(--green-light));
            box-shadow: 0 6px 14px rgba(47, 125, 79, .13);
            font-size: 11px;
            font-weight: 800;
            cursor: pointer;
            white-space: nowrap;
            transition: .18s ease;
        }
        .complete-button:hover { transform: translateY(-1px); box-shadow: 0 8px 17px rgba(47, 125, 79, .2); }
        .complete-button:active { transform: translateY(0); }
        .done-label {
            display: inline-flex;
            min-height: 36px;
            align-items: center;
            gap: 6px;
            padding: 0 10px;
            color: #17643a;
            border: 1px solid #c9ead3;
            border-radius: 10px;
            background: #f0faf3;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }
        .table-hint {
            display: none;
            margin: 0;
            padding: 10px 15px;
            color: var(--muted);
            border-top: 1px solid var(--line);
            background: #fbfcfb;
            font-size: 11px;
        }
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
        .package-link {
            display: inline-flex;
            min-height: 42px;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 15px;
            color: var(--green);
            border: 1px solid #c8e2d0;
            border-radius: 12px;
            background: #f5fbf6;
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
        }
@media (max-width: 1050px) {
            .sidebar { width: 210px; }
            .app-main { margin-left: 210px; }
            .content { padding: 32px 25px 50px; }
            .topbar { padding: 0 25px; }
            table { min-width: 1040px; }
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
            .page-head p { font-size: 13px; }
            .data-panel { margin-right: -16px; margin-left: -16px; border-right: 0; border-left: 0; border-radius: 0; }
            .data-panel-head { align-items: flex-start; flex-direction: column; padding: 16px; }
            .data-panel-title h2 { font-size: 16px; }
            table { min-width: 1040px; }
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
            .flash { font-size: 12px; }
        }
        @media (max-width: 420px) {
            .page-head h1 { font-size: 23px; }
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
        $reservationCount = $reservations->count();
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
                <a href="{{ route('partner.food-packages.index') }}">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m21 8-9 5-9-5 9-5 9 5Z"/><path d="m3 8 9 5 9-5v9l-9 5-9-5Z"/><path d="M12 13v9"/></svg>
                    <span>Paket Makanan</span>
                </a>
                <a href="{{ route('partner.reservations.index') }}" class="active" aria-current="page">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 8h12l-1 13H7L6 8Z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/></svg>
                    <span>Reservasi Masuk</span>
                </a>
            </nav>

            <div class="sidebar-impact">
                <span class="sidebar-impact-icon" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
                </span>
                <strong>Setiap porsi berarti</strong>
                <p>Konfirmasi pesanan setelah mahasiswa mengambil paket agar status reservasi selalu akurat.</p>
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
                    <small>Satu porsi terselamatkan, satu langkah berarti.</small>
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
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 17l5-5-5-5M15 12H3"/><path d="M15 3h5a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1h-5"/></svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </header>

            <main class="content">
                <div class="page-head">
                    <span class="eyebrow">PESANAN MAHASISWA</span>
                    <h1>Reservasi Masuk</h1>
                    <p>Konfirmasi paket yang sudah diambil dan dibayar di kantin.</p>
                </div>

                @if (session('success'))
                    <div class="flash" role="status">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg>
                        <div>
                            <strong>Reservasi berhasil diperbarui.</strong>
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="flash-error" role="alert">
                        <strong>Permintaan belum berhasil diproses.</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <section class="data-panel">
                    <div class="data-panel-head">
                        <div class="data-panel-title">
                            <h2>Daftar reservasi</h2>
                            <span class="count-badge">{{ $reservationCount }} reservasi</span>
                        </div>
                    </div>

                    @if ($reservations->isEmpty())
                        <div class="empty-state">
                            <span class="empty-icon" aria-hidden="true">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8h12l-1 13H7L6 8Z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/></svg>
                            </span>
                            <h3>Belum ada reservasi masuk</h3>
                            <p>Reservasi mahasiswa untuk paket makanan kantin Anda akan muncul di halaman ini.</p>
                            <a href="{{ route('partner.food-packages.index') }}" class="package-link">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="m21 8-9 5-9-5 9-5 9 5Z"/><path d="m3 8 9 5 9-5v9l-9 5-9-5Z"/></svg>
                                Lihat Paket Makanan
                            </a>
                        </div>
                    @else
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Mahasiswa</th>
                                        <th scope="col">Nama Paket</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Total Harga</th>
                                        <th scope="col">Kode Pengambilan</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Waktu Reservasi</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservations as $reservation)
                                        @php
                                            $status = $reservation->status;
                                            $statusLabel = ucwords(str_replace('_', ' ', $status));
                                            $statusClass = match ($status) {
                                                'menunggu_pengambilan' => 'status-pending',
                                                'selesai' => 'status-complete',
                                                'dibatalkan' => 'status-cancelled',
                                                default => 'status-other',
                                            };
                                        @endphp
                                        <tr>
                                            <td class="student-cell">
                                                <strong>{{ $reservation->user->name }}</strong>
                                                <small>{{ $reservation->user->email }}</small>
                                            </td>
                                            <td class="package-cell">{{ $reservation->foodPackage->name }}</td>
                                            <td class="quantity-cell">{{ $reservation->quantity }} paket</td>
                                            <td><span class="total-price">Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</span></td>
                                            <td><span class="pickup-code">{{ $reservation->pickup_code }}</span></td>
                                            <td>
                                                <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                                            </td>
                                            <td class="date-cell">
                                                {{ $reservation->created_at->format('d-m-Y') }}<br>
                                                <small>{{ $reservation->created_at->format('H:i') }} WIB</small>
                                            </td>
                                            <td>
                                                @if ($status === 'menunggu_pengambilan')
                                                    <form
                                                        action="{{ route('partner.reservations.complete', $reservation->id) }}"
                                                        method="POST"
                                                        class="complete-form"
                                                        onsubmit="return confirm('Pastikan pesanan sudah diambil dan pembayaran sudah diterima. Konfirmasi reservasi ini?')"
                                                    >
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="complete-button">
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg>
                                                            Konfirmasi Pengambilan
                                                        </button>
                                                    </form>
                                                @elseif ($status === 'selesai')
                                                    <span class="done-label">
                                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg>
                                                        Selesai
                                                    </span>
                                                @else
                                                    <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <p class="table-hint">Geser tabel ke samping untuk melihat seluruh informasi dan tombol konfirmasi.</p>
                    @endif
                </section>
</main>

            <nav class="mobile-nav" aria-label="Navigasi bawah mitra kantin">
                <a href="{{ url('/dashboard') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="2"/><rect x="14" y="3" width="7" height="7" rx="2"/><rect x="3" y="14" width="7" height="7" rx="2"/><rect x="14" y="14" width="7" height="7" rx="2"/></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('partner.food-packages.index') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m21 8-9 5-9-5 9-5 9 5Z"/><path d="m3 8 9 5 9-5v9l-9 5-9-5Z"/><path d="M12 13v9"/></svg>
                    <span>Paket</span>
                </a>
                <a href="{{ route('partner.reservations.index') }}" class="active" aria-current="page">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 8h12l-1 13H7L6 8Z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/></svg>
                    <span>Reservasi</span>
                </a>
            </nav>
        </div>
    </div>
</body>
</html>