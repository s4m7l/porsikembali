<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Edit Paket Makanan - PorsiKembali</title>

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
            max-width: 650px;
            margin: 35px auto;
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
            margin-top: 0;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 7px;
        }

        input, textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 11px;
            margin-bottom: 17px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: 'Inter', sans-serif;
        }

        textarea {
            resize: vertical;
            min-height: 90px;
        }

        button {
            background-color: #34734b;
            color: white;
            border: none;
            padding: 12px 18px;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 18px;
            color: #34734b;
            text-decoration: none;
        }

        .error {
            color: #c0392b;
            font-size: 13px;
            margin-top: -12px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <strong>PorsiKembali</strong>
    </div>

    <div class="container">
        <a href="{{ route('partner.food-packages.index') }}" class="back-link">
            &larr; Kembali ke daftar paket
        </a>

        <div class="content">
            <h1>Edit Paket Makanan</h1>
            <p>Perbarui informasi paket makanan Anda.</p>

            <form
                action="{{ route('partner.food-packages.update', $foodPackage->id) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <label for="name">Nama Paket Makanan</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $foodPackage->name) }}"
                    required
                >
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label for="description">Deskripsi Paket</label>
                <textarea
                    id="description"
                    name="description"
                    required
                >{{ old('description', $foodPackage->description) }}</textarea>
                @error('description')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label for="normal_price">Harga Normal (Rp)</label>
                <input
                    type="number"
                    id="normal_price"
                    name="normal_price"
                    value="{{ old('normal_price', $foodPackage->normal_price) }}"
                    min="0"
                    step="0.01"
                    required
                >
                @error('normal_price')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label for="offer_price">Harga Penawaran (Rp)</label>
                <input
                    type="number"
                    id="offer_price"
                    name="offer_price"
                    value="{{ old('offer_price', $foodPackage->offer_price) }}"
                    min="0"
                    step="0.01"
                    required
                >
                @error('offer_price')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label for="stock">Jumlah Stok</label>
                <input
                    type="number"
                    id="stock"
                    name="stock"
                    value="{{ old('stock', $foodPackage->stock) }}"
                    min="0"
                    step="1"
                    required
                >
                @error('stock')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label for="pickup_deadline">Batas Waktu Pengambilan</label>
                <input
                    type="datetime-local"
                    id="pickup_deadline"
                    name="pickup_deadline"
                    value="{{ old('pickup_deadline', \Carbon\Carbon::parse($foodPackage->pickup_deadline)->format('Y-m-d\TH:i')) }}"
                    required
                >
                @error('pickup_deadline')
                    <p class="error">{{ $message }}</p>
                @enderror

                <button type="submit">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</body>
</html>