<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Dashboard Mahasiswa - PorsiKembali</title>

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

        .dashboard-links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 12px;
            margin: 25px 0;
        }

        .dashboard-link {
            display: block;
            background: #34734b;
            color: white;
            text-decoration: none;
            padding: 15px;
            border-radius: 7px;
            font-weight: 600;
        }

        .dashboard-link:hover {
            background: #285b3b;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <strong>PorsiKembali</strong>
    </div>

    <div class="container">
        <div class="content">
            <h1>Dashboard Mahasiswa</h1>

            <p>
                Selamat datang,
                {{ auth()->user()->name }}!
            </p>

            <p>
                Melalui PorsiKembali, mahasiswa dapat melihat
                paket makanan yang ditawarkan oleh mitra kantin
                dan melakukan reservasi.
            </p>

            <div class="dashboard-links">
                <a href="{{ route('student.food-packages.index') }}"
                class="dashboard-link">
                    Lihat Paket Makanan
                </a>

                <a href="{{ route('student.reservations.index') }}"
                class="dashboard-link">
                    Riwayat Reservasi
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