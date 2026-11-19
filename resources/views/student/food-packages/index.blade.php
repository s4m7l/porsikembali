<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Paket Makanan - PorsiKembali</title>

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
            max-width: 1000px;
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

        .package-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-top: 18px;
        }

        .package-card h2 {
            color: #34734b;
            margin-top: 0;
        }

        .price {
            font-size: 18px;
            font-weight: bold;
            color: #34734b;
        }

        .normal-price {
            color: #888;
            text-decoration: line-through;
            font-size: 14px;
            font-weight: normal;
            margin-left: 8px;
        }

        .package-info {
            line-height: 1.7;
        }

        .empty {
            text-align: center;
            color: #777;
            padding: 30px;
        }

        button {
            background-color: #34734b;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 5px;
            cursor: pointer;
        }

        .reservation-form {
            border-top: 1px solid #ddd;
            margin-top: 18px;
            padding-top: 15px;
        }

        .reservation-form label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .reservation-form input {
            width: 100%;
            max-width: 150px;
            box-sizing: border-box;
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .reservation-form button {
            display: block;
        }

        .success {
            background-color: #e0f2e5;
            color: #27633c;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 18px;
        }

        .error-box {
            background-color: #fde8e7;
            color: #a93226;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 18px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <strong>PorsiKembali</strong>
    </div>

    <div class="container">
        <div class="content">
            <h1>Paket Makanan Tersedia</h1>

            <p>
                Temukan paket makanan dari mitra kantin
                dengan harga penawaran lebih hemat.
            </p>

            @if (session('success'))
                <div class="success">
                    {{ session('success') }}

                    @if (session('pickup_code'))
                        <p>
                            <strong>Kode Pengambilan:</strong>
                            {{ session('pickup_code') }}
                        </p>
                        <p>Gunakan kode tersebut saat mengambil pesanan di kantin.</p>
                    @endif
                </div>
            @endif

            @if ($errors->any())
                <div class="error-box">
                    <strong>Reservasi belum berhasil:</strong>

                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @forelse ($foodPackages as $package)
                <div class="package-card">
                    <h2>{{ $package->name }}</h2>

                    <div class="package-info">
                        <p>
                            <strong>Nama Kantin:</strong>
                            {{ $package->canteenPartner->canteen_name }}
                        </p>

                        <p>
                            <strong>Lokasi:</strong>
                            {{ $package->canteenPartner->location }}
                        </p>

                        <p>
                            <strong>Deskripsi:</strong>
                            {{ $package->description }}
                        </p>

                        <p>
                            <strong>Harga Penawaran:</strong>
                            <span class="price">
                                Rp {{ number_format($package->offer_price, 0, ',', '.') }}
                            </span>

                            <span class="normal-price">
                                Rp {{ number_format($package->normal_price, 0, ',', '.') }}
                            </span>
                        </p>

                        <p>
                            <strong>Stok Tersedia:</strong>
                            {{ $package->stock }}
                        </p>

                        <p>
                            <strong>Batas Pengambilan:</strong>
                            {{ \Carbon\Carbon::parse($package->pickup_deadline)->format('d-m-Y H:i') }}
                        </p>
                    </div>
                    <div class="reservation-form">
                        <form
                            action="{{ route('student.reservations.store') }}"
                            method="POST"
                        >
                            @csrf

                            <input
                                type="hidden"
                                name="food_package_id"
                                value="{{ $package->id }}"
                            >

                            <label for="quantity-{{ $package->id }}">
                                Jumlah Paket yang Dipesan
                            </label>

                            <input
                                type="number"
                                id="quantity-{{ $package->id }}"
                                name="quantity"
                                value="1"
                                min="1"
                                max="{{ $package->stock }}"
                                required
                            >

                            <button type="submit">Reservasi Paket</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty">
                    <p>Belum ada paket makanan yang tersedia.</p>
                </div>
            @endforelse

        </div>
    </div>
</body>
</html>