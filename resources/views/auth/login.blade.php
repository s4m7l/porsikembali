<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#e8f5eb">
    <title>Login - PorsiKembali</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --green: #2f7d4f;
            --green-dark: #205c39;
            --green-light: #e7f4eb;
            --ink: #14211a;
            --muted: #64736a;
            --line: #dfe8e1;
            --danger: #c93636;
        }

        * { box-sizing: border-box; }

        html { min-height: 100%; }

        body {
            min-width: 320px;
            min-height: 100vh;
            min-height: 100svh;
            margin: 0;
            color: var(--ink);
            background: #f7faf7;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        button, input { font: inherit; }

        .login-page {
            display: grid;
            grid-template-columns: minmax(0, 55%) minmax(420px, 45%);
            min-height: 100vh;
            min-height: 100svh;
        }

        /* Panel branding */
        .login-visual {
            position: relative;
            min-height: 720px;
            overflow: hidden;
            padding: 35px clamp(32px, 6vw, 90px);
            background: linear-gradient(145deg, #e8f5eb 0%, #d8ecdd 100%);
            isolation: isolate;
        }

        .login-logo, .login-copy { position: relative; z-index: 2; }

        .logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #14211a;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -.8px;
        }

        .logo-name span { color: var(--green); }

        .logo-mark {
            display: grid;
            width: 40px;
            height: 40px;
            place-items: center;
            color: #fff;
            border-radius: 13px;
            background: linear-gradient(135deg, var(--green), #4caf7a);
            box-shadow: 0 8px 18px rgba(47, 125, 79, .22);
        }

        .orb {
            position: absolute;
            z-index: -1;
            border-radius: 50%;
            pointer-events: none;
        }

        .orb-one {
            top: -75px;
            right: -95px;
            width: 340px;
            height: 340px;
            background: rgba(106, 190, 133, .17);
        }

        .orb-two {
            bottom: -105px;
            left: -105px;
            width: 280px;
            height: 280px;
            border: 50px solid rgba(255, 255, 255, .42);
        }

        /* Ilustrasi piring dibuat dari CSS agar tidak membutuhkan aset tambahan */
        .food-illustration {
            position: absolute;
            top: 38%;
            left: 50%;
            width: 390px;
            height: 260px;
            transform: translate(-50%, -50%);
        }

        .plate {
            position: absolute;
            bottom: 23px;
            left: 50%;
            width: 245px;
            height: 110px;
            border: 14px solid #fff;
            border-radius: 50%;
            background: #fffdf5;
            box-shadow: 0 30px 55px rgba(42, 90, 55, .18);
            transform: translateX(-50%);
        }

        .rice {
            position: absolute;
            top: 2px;
            left: 25px;
            width: 100px;
            height: 72px;
            border-radius: 50%;
            background: #fff5d7;
        }

        .greens {
            position: absolute;
            top: 33px;
            right: 19px;
            width: 80px;
            height: 45px;
            border-radius: 60% 40%;
            background: #68a963;
        }

        .chicken {
            position: absolute;
            top: -1px;
            right: 35px;
            width: 84px;
            height: 57px;
            border-radius: 45% 55% 45% 55%;
            background: #a96538;
            transform: rotate(-10deg);
        }

        .steam {
            position: absolute;
            top: 38px;
            width: 3px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(transparent, rgba(47, 125, 79, .3), transparent);
        }

        .steam-one { left: 155px; transform: rotate(-8deg); }
        .steam-two { top: 22px; left: 195px; }
        .steam-three { left: 233px; transform: rotate(8deg); }

        .float-tag {
            position: absolute;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 11px 14px;
            color: var(--green);
            border: 1px solid rgba(255, 255, 255, .7);
            border-radius: 12px;
            background: rgba(255, 255, 255, .86);
            box-shadow: 0 9px 25px rgba(47, 90, 55, .11);
            font-size: 12px;
            font-weight: 800;
            backdrop-filter: blur(7px);
        }

        .tag-one { bottom: 55px; left: 0; }
        .tag-two { top: 73px; right: 4px; }

        .login-copy {
            position: absolute;
            right: clamp(32px, 6vw, 90px);
            bottom: 43px;
            left: clamp(32px, 6vw, 90px);
        }

        .campaign-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 11px;
            color: #16803d;
            border-radius: 999px;
            background: #dcfce7;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .6px;
        }

        .login-copy h1 {
            margin: 14px 0 12px;
            color: #14211a;
            font-size: clamp(30px, 3vw, 40px);
            font-weight: 800;
            line-height: 1.13;
            letter-spacing: -1.6px;
        }

        .login-copy h1 em { color: var(--green); font-style: normal; }

        .login-copy > p {
            max-width: 490px;
            margin: 0;
            color: #52685a;
            font-size: 14px;
            line-height: 1.75;
        }

        .impact-note {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-top: 21px;
            color: #52685a;
            font-size: 12px;
            line-height: 1.5;
        }

        .impact-note-icon {
            display: grid;
            flex: 0 0 36px;
            width: 36px;
            height: 36px;
            place-items: center;
            color: var(--green);
            border: 1px solid rgba(47, 125, 79, .12);
            border-radius: 12px;
            background: rgba(255, 255, 255, .75);
        }

        .impact-note strong { display: block; color: #294c34; font-size: 12px; }

        /* Panel form login */
        .login-panel {
            display: grid;
            min-width: 0;
            padding: 48px clamp(28px, 5vw, 76px);
            place-items: center;
            background: #fff;
        }

        .login-card { width: min(420px, 100%); }
        .mobile-login-logo { display: none; }

        .eyebrow {
            display: block;
            margin-bottom: 9px;
            color: var(--green);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .login-card h2 {
            margin: 8px 0 9px;
            color: #14211a;
            font-size: clamp(27px, 2.2vw, 32px);
            font-weight: 800;
            letter-spacing: -1px;
        }

        .login-intro {
            margin: 0 0 28px;
            color: #6b7c71;
            font-size: 14px;
            line-height: 1.7;
        }

        .form-stack { display: flex; flex-direction: column; gap: 19px; }

        .field { display: block; }

        .field-label {
            display: block;
            margin-bottom: 8px;
            color: #263b2d;
            font-size: 13px;
            font-weight: 700;
        }

        .input-wrap { position: relative; }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            display: grid;
            color: #8c9991;
            pointer-events: none;
            transform: translateY(-50%);
        }

        .field input {
            display: block;
            width: 100%;
            height: 52px;
            padding: 0 15px 0 46px;
            color: #24372b;
            border: 1px solid #dfe8e1;
            border-radius: 13px;
            outline: none;
            background: #fff;
            font-size: 14px;
            transition: border-color .18s, box-shadow .18s;
        }

        .field input::placeholder { color: #a1ada5; }
        .field input:focus {
            border-color: #4caf7a;
            box-shadow: 0 0 0 4px rgba(47, 125, 79, .09);
        }

        .field-error {
            margin: 7px 0 0;
            color: var(--danger);
            font-size: 12px;
            line-height: 1.5;
        }

        .login-alert {
            margin-bottom: 18px;
            padding: 12px 14px;
            color: #a52d2d;
            border: 1px solid #f2cccc;
            border-radius: 12px;
            background: #fff3f3;
            font-size: 13px;
            line-height: 1.5;
        }

        .login-button {
            display: flex;
            width: 100%;
            min-height: 52px;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 5px;
            padding: 0 20px;
            color: #fff;
            border: 0;
            border-radius: 13px;
            background: linear-gradient(135deg, var(--green), #4caf7a);
            box-shadow: 0 9px 20px rgba(47, 125, 79, .17);
            cursor: pointer;
            font-size: 14px;
            font-weight: 800;
            transition: transform .18s, box-shadow .18s;
        }

        .login-button:hover {
            box-shadow: 0 12px 24px rgba(47, 125, 79, .23);
            transform: translateY(-1px);
        }

        .login-button:focus-visible {
            outline: 3px solid rgba(47, 125, 79, .25);
            outline-offset: 3px;
        }

        .secure-note {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            gap: 8px;
            margin: 25px 0 0;
            padding-top: 20px;
            color: #78887e;
            border-top: 1px solid #e4eae5;
            font-size: 12px;
            line-height: 1.6;
            text-align: center;
        }

        .secure-note svg { flex: 0 0 17px; margin-top: 1px; color: var(--green); }

        @media (max-width: 1050px) {
            .login-page { grid-template-columns: 52% 48%; }
            .login-visual { padding-right: 4vw; padding-left: 4vw; }
            .login-copy { right: 4vw; left: 4vw; }
            .food-illustration { transform: translate(-50%, -50%) scale(.85); }
            .login-panel { padding-right: 30px; padding-left: 30px; }
        }

        @media (max-width: 768px) {
            .login-page { display: block; min-height: 100vh; min-height: 100svh; background: #fff; }
            .login-visual { display: none; }
            .login-panel {
                display: block;
                min-height: 100vh;
                min-height: 100svh;
                padding: 34px 24px 40px;
            }
            .login-card { width: min(440px, 100%); margin: 0 auto; }
            .mobile-login-logo { display: block; margin-bottom: clamp(48px, 12vh, 76px); }
            .login-card h2 { font-size: 28px; }
        }

        @media (max-width: 420px) {
            .login-panel { padding: 27px 20px 32px; }
            .mobile-login-logo { margin-bottom: 48px; }
            .login-card h2 { font-size: 26px; }
            .login-intro { margin-bottom: 24px; font-size: 13px; }
            .field input { height: 50px; font-size: 14px; }
        }

        @media (max-height: 760px) and (min-width: 769px) {
            .login-visual { min-height: 680px; }
            .food-illustration { top: 34%; transform: translate(-50%, -50%) scale(.78); }
            .login-copy { bottom: 28px; }
            .login-copy h1 { margin-top: 10px; font-size: 31px; }
            .login-copy > p { font-size: 13px; }
            .login-panel { padding-top: 28px; padding-bottom: 28px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { scroll-behavior: auto !important; transition-duration: .01ms !important; }
        }
    </style>
</head>
<body>
    <main class="login-page">
        <section class="login-visual" aria-label="Informasi PorsiKembali">
            <div class="login-logo">
                <div class="logo">
                    <span class="logo-mark" aria-hidden="true">
                        <svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/>
                        </svg>
                    </span>
                    <span class="logo-name">Porsi<span>Kembali</span></span>
                </div>
            </div>

            <div class="orb orb-one" aria-hidden="true"></div>
            <div class="orb orb-two" aria-hidden="true"></div>

            <div class="food-illustration" aria-hidden="true">
                <span class="steam steam-one"></span>
                <span class="steam steam-two"></span>
                <span class="steam steam-three"></span>
                <div class="plate">
                    <div class="rice"></div>
                    <div class="greens"></div>
                    <div class="chicken"></div>
                </div>
                <span class="float-tag tag-one">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
                    Lebih hemat
                </span>
                <span class="float-tag tag-two">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1 4-4 1 4 1 1 4 1-4 4-1-4-1-1-4Z"/><path d="m19 14-.7 2.3L16 17l2.3.7L19 20l.7-2.3L22 17l-2.3-.7L19 14Z"/></svg>
                    Tetap nikmat
                </span>
            </div>

            <div class="login-copy">
                <span class="campaign-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
                    GERAKAN KAMPUS BERKELANJUTAN
                </span>
                <h1>Selamatkan makanan.<br><em>Hemat pengeluaran.</em></h1>
                <p>Temukan paket makanan layak konsumsi dari kantin kampus dengan harga lebih ramah mahasiswa.</p>
                <div class="impact-note">
                    <span class="impact-note-icon" aria-hidden="true">
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
                    </span>
                    <span><strong>Satu porsi, satu langkah berarti.</strong>Ikut kurangi makanan terbuang di lingkungan kampus.</span>
                </div>
            </div>
        </section>

        <section class="login-panel" aria-labelledby="login-title">
            <div class="login-card">
                <div class="mobile-login-logo">
                    <div class="logo">
                        <span class="logo-mark" aria-hidden="true">
                            <svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/>
                            </svg>
                        </span>
                        <span class="logo-name">Porsi<span>Kembali</span></span>
                    </div>
                </div>

                <span class="eyebrow">SELAMAT DATANG KEMBALI</span>
                <h2 id="login-title">Masuk ke akunmu</h2>
                <p class="login-intro">Masuk untuk melanjutkan ke layanan PorsiKembali.</p>

                @if (session('status'))
                    <div class="login-alert" role="status" style="color:#21623b;border-color:#cce8d3;background:#effaf2;">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="form-stack" action="/login" method="POST">
                    @csrf

                    <label class="field" for="email">
                        <span class="field-label">Email</span>
                        <span class="input-wrap">
                            <span class="input-icon" aria-hidden="true">
                                <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                            </span>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="nama@email.com"
                                autocomplete="username"
                                inputmode="email"
                                required
                                autofocus
                                @error('email') aria-describedby="email-error" @enderror
                            >
                        </span>
                        @error('email')
                            <span class="field-error" id="email-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="field" for="password">
                        <span class="field-label">Password</span>
                        <span class="input-wrap">
                            <span class="input-icon" aria-hidden="true">
                                <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 1 1 8 0v3"/></svg>
                            </span>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Masukkan password"
                                autocomplete="current-password"
                                required
                                @error('password') aria-describedby="password-error" @enderror
                            >
                        </span>
                        @error('password')
                            <span class="field-error" id="password-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <button type="submit" class="login-button">
                        Masuk ke PorsiKembali
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                    </button>
                </form>

                <p class="secure-note">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 4C10 4 4 9 4 18c4-5 8-7 14-8"/><path d="M4 21c0-6 4-10 10-12"/></svg>
                    Pembayaran dilakukan langsung di kantin. Aman dan sederhana.
                </p>
            </div>
        </section>
    </main>
</body>
</html>