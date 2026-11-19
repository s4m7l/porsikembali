<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Masuk - PorsiKembali</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

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
            max-width: 1100px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .content {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        h1 {
            color: #34734b;
            margin-top: 0;
        }

        .description {
            color: #666;
            margin-bottom: 25px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th, td {
            padding: 13px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        th {
            background-color: #edf4ef;
            color: #34734b;
        }

        .pickup-code {
            font-weight: 700;
            color: #34734b;
            letter-spacing: 1px;
        }

        .status {
            display: inline-block;
            background-color: #fff3cd;
            color: #856404;
            padding: 6px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 600;
        }

        .empty {
            text-align: center;
            color: #777;
            padding: 30px;
        }

        .success {
            background-color: #e0f2e5;
            color: #27633c;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 18px;
        }

        .complete-button {
            background-color: #34734b;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
        }

        .status-complete {
            display: inline-block;
            background-color: #e0f2e5;
            color: #27633c;
            padding: 6px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <strong>PorsiKembali</strong>
    </div>

    <div class="container">
        <div class="content">
            <h1>Reservasi Masuk</h1>

            <p class="description">
                Berikut adalah daftar reservasi mahasiswa
                untuk paket makanan yang ditawarkan kantin Anda.
            </p>

            @if (session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>Nama Paket</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Kode Pengambilan</th>
                            <th>Status</th>
                            <th>Waktu Reservasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($reservations as $reservation)
                            <tr>
                                <td>
                                    {{ $reservation->user->name }}
                                </td>

                                <td>
                                    {{ $reservation->foodPackage->name }}
                                </td>

                                <td>
                                    {{ $reservation->quantity }} paket
                                </td>

                                <td>
                                    Rp {{ number_format($reservation->total_price, 0, ',', '.') }}
                                </td>

                                <td>
                                    <span class="pickup-code">
                                        {{ $reservation->pickup_code }}
                                    </span>
                                </td>

                                <td>
                                    <span class="status">
                                        {{ str_replace('_', ' ', ucfirst($reservation->status)) }}
                                    </span>
                                </td>

                                <td>
                                    {{ $reservation->created_at->format('d-m-Y H:i') }}
                                </td>
                                <td>
                                @if ($reservation->status === 'menunggu_pengambilan')
                                    <form
                                        action="{{ route('partner.reservations.complete', $reservation->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Pastikan pesanan sudah diambil dan pembayaran sudah diterima. Konfirmasi reservasi ini?')"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="complete-button">
                                            Konfirmasi Pengambilan
                                        </button>
                                    </form>
                                @else
                                    <span class="status-complete">
                                        Selesai
                                    </span>
                                @endif
                            </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="empty">
                                    Belum ada reservasi yang masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>