<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Riwayat Reservasi - PorsiKembali</title>
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
        .sidebar-impact strong { display: block; font-size: 13px; }
        .sidebar-impact p { margin: 5px 0 0; color: #5c7564; font-size: 11px; line-height: 1.6; }
        .sidebar-foot { margin-top: 16px; color: #a0aba4; text-align: center; font-size: 10px; }

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
        .topbar-title span { display: block; font-size: 14px; font-weight: 700; }
        .topbar-title small { color: var(--muted); font-size: 11px; }
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
            font-size: 10px;
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
        .page-head p { margin: 8px 0 0; color: var(--muted); font-size: 14px; line-height: 1.6; }

        .history-list { display: flex; flex-direction: column; gap: 14px; }
        .history-card {
            padding: 21px 23px;
            border: 1px solid var(--line);
            border-radius: 19px;
            background: var(--surface);
            box-shadow: 0 8px 22px rgba(30,64,42,.035);
        }
        .history-card.is-completed { opacity: .9; }
        .history-top {
            display: flex;
            align-items: center;
            gap: 13px;
            padding-bottom: 17px;
            border-bottom: 1px solid var(--line);
        }
        .history-food-icon {
            display: grid;
            width: 46px;
            height: 46px;
            flex: 0 0 46px;
            place-items: center;
            color: var(--green);
            border-radius: 14px;
            background: var(--green-soft);
        }
        .history-title { min-width: 0; flex: 1; }
        .history-title h2 { margin: 0 0 5px; font-size: 17px; font-weight: 800; line-height: 1.35; }
        .history-title p { margin: 0; color: var(--muted); font-size: 12px; line-height: 1.5; }
        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
            padding: 7px 11px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }
        .status-green { color: #16803d; background: #dcfce7; }
        .status-amber { color: #a86100; background: #fff2ce; }
        .status-red { color: #c42c2c; background: #fee2e2; }
        .status-neutral { color: #627068; background: #edf1ee; }

        .history-info {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            padding-top: 17px;
        }
        .history-info > div {
            min-width: 0;
            padding: 0 16px;
            border-right: 1px solid var(--line);
        }
        .history-info > div:first-child { padding-left: 0; }
        .history-info > div:last-child { padding-right: 0; border-right: 0; }
        .history-info small, .history-info strong { display: block; }
        .history-info small {
            color: var(--muted);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .55px;
            line-height: 1.5;
        }
        .history-info strong {
            margin-top: 6px;
            font-size: 13px;
            font-weight: 800;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }
        .history-code strong {
            color: var(--green);
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
            font-size: 16px;
            letter-spacing: 1.5px;
        }
        .empty-state {
            padding: 62px 25px;
            border: 1px dashed #bed1c3;
            border-radius: 20px;
            background: rgba(255,255,255,.55);
            text-align: center;
        }
        .empty-icon {
            display: grid;
            width: 68px;
            height: 68px;
            margin: 0 auto 16px;
            place-items: center;
            color: var(--green);
            border-radius: 20px;
            background: var(--green-soft);
        }
        .empty-state h2 { margin: 0 0 7px; font-size: 19px; }
        .empty-state p { max-width: 430px; margin: 0 auto 19px; color: var(--muted); font-size: 13px; line-height: 1.7; }
        .primary-link {
            display: inline-flex;
            min-height: 44px;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 17px;
            color: #fff;
            border-radius: 13px;
            background: linear-gradient(135deg, var(--green), var(--green-light));
            box-shadow: 0 8px 18px rgba(47,125,79,.16);
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
            transition: .2s ease;
        }
        .primary-link:hover { transform: translateY(-2px); box-shadow: 0 10px 22px rgba(47,125,79,.22); }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-top: 22px;
            color: var(--green);
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
        }
        .back-link:hover { text-decoration: underline; }

        @media (max-width: 1050px) {
            .sidebar { width: 210px; }
            .app-main { margin-left: 210px; }
            .content { padding: 32px 25px 50px; }
            .topbar { padding: 0 25px; }
            .history-info > div { padding-right: 11px; padding-left: 11px; }
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
            .page-head h1 { font-size: 24px; }
            .page-head p { font-size: 13px; }
            .history-card { padding: 18px; }
            .history-top { align-items: flex-start; flex-wrap: wrap; }
            .history-title { flex: 1 1 calc(100% - 60px); }
            .status-badge { margin-left: 59px; }
            .history-info { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 17px 12px; }
            .history-info > div, .history-info > div:first-child, .history-info > div:last-child { padding: 0; border: 0; }
            .history-info small { font-size: 10px; }
            .history-info strong { font-size: 13px; }
            .history-code strong { font-size: 15px; }
            .empty-state { padding: 45px 20px; }
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
                font-size: 10px;
            }
            .mobile-nav a.active { color: var(--green); font-weight: 800; }
        }
        @media (max-width: 420px) {
            .page-head h1 { font-size: 22px; }
            .history-card { padding: 16px; }
            .history-title h2 { font-size: 16px; }
            .history-info { column-gap: 8px; }
            .history-info small { font-size: 9px; }
            .history-info strong { font-size: 12px; }
            .history-code strong { font-size: 14px; letter-spacing: 1px; }
            .status-badge { margin-left: 0; font-size: 10px; }
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
                <a href="{{ url('/dashboard') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 11 9-8 9 8"/><path d="M5 10v11h14V10M9 21v-7h6v7"/></svg>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('student.food-packages.index') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 11h16a8 8 0 0 1-16 0Z"/><path d="M12 3v4M8 5v2M16 5v2"/></svg>
                    <span>Katalog Paket</span>
                </a>
                <a href="{{ route('student.reservations.index') }}" class="active" aria-current="page">
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
                    <span class="eyebrow">AKTIVITASMU</span>
                    <h1>Riwayat Reservasi</h1>
                    <p>Pantau semua paket yang pernah kamu selamatkan.</p>
                </div>

                @if (count($reservations) > 0)
                    <div class="history-list">
                        @foreach ($reservations as $reservation)
                            @php
                                $foodPackage = $reservation->foodPackage;
                                $canteenPartner = $foodPackage ? $foodPackage->canteenPartner : null;
                                $statusValue = strtolower((string) $reservation->status);
                                $statusLabel = ucfirst(str_replace('_', ' ', $statusValue));
                                $statusClass = in_array($statusValue, ['selesai', 'completed'], true)
                                    ? 'status-green'
                                    : ((str_contains($statusValue, 'menunggu') || $statusValue === 'pending')
                                        ? 'status-amber'
                                        : ((str_contains($statusValue, 'batal') || $statusValue === 'cancelled')
                                            ? 'status-red'
                                            : 'status-neutral'));
                            @endphp
                            <article class="history-card {{ $statusClass === 'status-green' ? 'is-completed' : '' }}">
                                <div class="history-top">
                                    <span class="history-food-icon" aria-hidden="true">
                                        <svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M4 11h16a8 8 0 0 1-16 0Z"/><path d="M12 3v4M8 5v2M16 5v2"/></svg>
                                    </span>
                                    <div class="history-title">
                                        <h2>{{ $foodPackage->name ?? 'Paket makanan' }}</h2>
                                        <p>
                                            {{ $canteenPartner->canteen_name ?? 'Kantin' }}
                                            @if (!empty($canteenPartner?->location))
                                                · {{ $canteenPartner->location }}
                                            @endif
                                        </p>
                                    </div>
                                    <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                                </div>

                                <div class="history-info">
                                    <div>
                                        <small>JUMLAH PESANAN</small>
                                        <strong>{{ $reservation->quantity }} paket</strong>
                                    </div>
                                    <div>
                                        <small>TOTAL HARGA</small>
                                        <strong>Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</strong>
                                    </div>
                                    <div>
                                        <small>WAKTU RESERVASI</small>
                                        <strong>{{ $reservation->created_at->format('d-m-Y, H:i') }}</strong>
                                    </div>
                                    <div class="history-code">
                                        <small>KODE PENGAMBILAN</small>
                                        <strong>{{ $reservation->pickup_code }}</strong>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <span class="empty-icon" aria-hidden="true">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8h12l-1 13H7L6 8Z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/></svg>
                        </span>
                        <h2>Belum ada reservasi</h2>
                        <p>Paket makanan yang kamu reservasi akan muncul di sini. Jelajahi katalog untuk menemukan paket makanan dari mitra kantin.</p>
                        <a href="{{ route('student.food-packages.index') }}" class="primary-link">
                            Jelajahi katalog
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                        </a>
                    </div>
                @endif

                <a href="{{ route('student.food-packages.index') }}" class="back-link">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5M11 18l-6-6 6-6"/></svg>
                    Kembali ke katalog paket
                </a>
            </main>

            <nav class="mobile-nav" aria-label="Navigasi bawah mahasiswa">
                <a href="{{ url('/dashboard') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 11 9-8 9 8"/><path d="M5 10v11h14V10M9 21v-7h6v7"/></svg>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('student.food-packages.index') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 11h16a8 8 0 0 1-16 0Z"/><path d="M12 3v4M8 5v2M16 5v2"/></svg>
                    <span>Paket</span>
                </a>
                <a href="{{ route('student.reservations.index') }}" class="active" aria-current="page">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 12a9 9 0 1 0 3-6.7L3 8"/><path d="M3 3v5h5M12 7v5l3 2"/></svg>
                    <span>Riwayat</span>
                </a>
            </nav>
        </div>
    </div>
</body>
</html>