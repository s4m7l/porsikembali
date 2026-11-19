<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Aktivitas - PorsiKembali</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

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
            max-width: 1100px;
            margin: 35px auto;
            padding: 0 20px;
        }

        h1 {
            color: #34734b;
            margin-top: 0;
        }

        .description {
            color: #666;
            margin-bottom: 25px;
        }

        .report-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .report-card {
            background-color: white;
            padding: 23px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .report-card h3 {
            margin: 0 0 12px;
            color: #666;
            font-size: 14px;
            font-weight: 500;
        }

        .report-value {
            color: #34734b;
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }

        .revenue-card {
            grid-column: 1 / -1;
            background-color: #34734b;
        }

        .revenue-card h3,
        .revenue-card .report-value {
            color: white;
        }

        @media (min-width: 768px) {
            .report-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .revenue-card {
                grid-column: auto;
            }
        }

        @media (max-width: 480px) {
            .report-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="navbar">
        <strong>PorsiKembali</strong>
    </div>

    <div class="container">
        <h1>Laporan Aktivitas</h1>

        <p class="description">
            Ringkasan data pengguna, mitra kantin, paket makanan,
            dan aktivitas reservasi PorsiKembali.
        </p>

        <div class="report-grid">

            <div class="report-card">
                <h3>Total Mahasiswa</h3>
                <p class="report-value">
                    {{ number_format($reports['total_students'], 0, ',', '.') }}
                </p>
            </div>

            <div class="report-card">
                <h3>Total Mitra Kantin</h3>
                <p class="report-value">
                    {{ number_format($reports['total_partners'], 0, ',', '.') }}
                </p>
            </div>

            <div class="report-card">
                <h3>Total Paket Makanan</h3>
                <p class="report-value">
                    {{ number_format($reports['total_packages'], 0, ',', '.') }}
                </p>
            </div>

            <div class="report-card">
                <h3>Total Reservasi</h3>
                <p class="report-value">
                    {{ number_format($reports['total_reservations'], 0, ',', '.') }}
                </p>
            </div>

            <div class="report-card">
                <h3>Menunggu Pengambilan</h3>
                <p class="report-value">
                    {{ number_format($reports['pending_reservations'], 0, ',', '.') }}
                </p>
            </div>

            <div class="report-card">
                <h3>Reservasi Selesai</h3>
                <p class="report-value">
                    {{ number_format($reports['completed_reservations'], 0, ',', '.') }}
                </p>
            </div>

            <div class="report-card revenue-card">
                <h3>Total Nilai Reservasi Selesai</h3>
                <p class="report-value">
                    Rp {{ number_format($reports['completed_revenue'], 0, ',', '.') }}
                </p>
            </div>

        </div>
    </div>
</body>
</html>