<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Riwayat Reservasi - PorsiKembali</title>

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
            margin: 35px auto;
            padding: 0 20px;
        }

        .content {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        h1, h2 {
            color: #34734b;
        }

        .reservation-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-top: 18px;
        }

        .reservation-card h2 {
            margin-top: 0;
        }

        .pickup-code {
            background-color: #e0f2e5;
            color: #27633c;
            padding: 12px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 18px;
            letter-spacing: 2px;
            display: inline-block;
        }

        .empty {
            text-align: center;
            color: #777;
            padding: 30px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 18px;
            color: #34734b;
            text-decoration: none;
        }

        .logout-button {
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

            <a
                href="{{ route('student.food-packages.index') }}"
                class="back-link"
            >
                &larr; Kembali ke katalog paket
            </a>

            <h1>Riwayat Reservasi</h1>

            <p>
                Berikut adalah daftar reservasi paket makanan
                yang pernah Anda lakukan.
            </p>

            @forelse ($reservations as $reservation)
                <div class="reservation-card">

                    <h2>
                        {{ $reservation->foodPackage->name }}
                    </h2>

                    <p>
                        <strong>Nama Kantin:</strong>
                        {{ $reservation->foodPackage->canteenPartner->canteen_name }}
                    </p>

                    <p>
                        <strong>Jumlah Pesanan:</strong>
                        {{ $reservation->quantity }} paket
                    </p>

                    <p>
                        <strong>Total Harga:</strong>
                        Rp {{ number_format($reservation->total_price, 0, ',', '.') }}
                    </p>

                    <p>
                        <strong>Kode Pengambilan:</strong>
                    </p>

                    <div class="pickup-code">
                        {{ $reservation->pickup_code }}
                    </div>

                    <p>
                        <strong>Status Reservasi:</strong>
                        {{ str_replace('_', ' ', ucfirst($reservation->status)) }}
                    </p>

                    <p>
                        <strong>Waktu Reservasi:</strong>
                        {{ $reservation->created_at->format('d-m-Y H:i') }}
                    </p>

                </div>
            @empty
                <div class="empty">
                    <p>Belum ada reservasi yang dilakukan.</p>
                </div>
            @endforelse

            <br>

            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="logout-button">
                    Logout
                </button>
            </form>

        </div>
    </div>
</body>
</html>