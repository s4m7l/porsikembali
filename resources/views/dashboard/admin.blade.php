<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Dashboard Admin - PorsiKembali</title>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f3;
            margin: 0;
            color: #333;
        }

        .navbar {
            background-color: #34734b;
            color: white;
            padding: 18px 30px;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .content {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        h1 {
            color: #34734b;
        }

        button {
            background-color: #34734b;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <strong>PorsiKembali</strong>
    </div>

    <div class="container">
        <div class="content">
            <h1>Dashboard Admin</h1>

            <p>
                Selamat datang,
                {{ auth()->user()->name }}!
            </p>

            <p>
                Melalui PorsiKembali, admin dapat mengelola
                data pengguna dan mitra kantin serta melihat
                laporan sederhana aktivitas aplikasi.
            </p>

            <div class="dashboard-links">
                <a href="{{ route('admin.users.index') }}"
                class="dashboard-link">
                    Kelola Pengguna
                </a>

                <a href="{{ route('admin.partners.index') }}"
                class="dashboard-link">
                    Kelola Mitra Kantin
                </a>

                <a href="{{ route('admin.reports.index') }}"
                class="dashboard-link">
                    Laporan Aktivitas
                </a>
            </div>

            <form action="/logout" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>