<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mitra Kantin - PorsiKembali</title>
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
            max-width: 600px;
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
            font-weight: 600;
            margin-bottom: 7px;
        }

        input {
            width: 100%;
            box-sizing: border-box;
            padding: 11px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: 'Inter', sans-serif;
        }

        button {
            background-color: #34734b;
            color: white;
            border: none;
            padding: 12px 18px;
            border-radius: 5px;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
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

        .partner-info {
            background-color: #edf4ef;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <strong>PorsiKembali</strong>
    </div>

    <div class="container">
        <a href="{{ route('admin.partners.index') }}" class="back-link">
            &larr; Kembali ke daftar mitra
        </a>

        <div class="content">
            <h1>Edit Mitra Kantin</h1>
            <p>Perbarui informasi mitra kantin.</p>

            <div class="partner-info">
                <strong>Nama Pengguna:</strong>
                {{ $partner->user->name }}
                <br>
                <strong>Email:</strong>
                {{ $partner->user->email }}
            </div>

            <form
                action="{{ route('admin.partners.update', $partner->id) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <label for="canteen_name">Nama Kantin</label>
                <input
                    type="text"
                    id="canteen_name"
                    name="canteen_name"
                    value="{{ old('canteen_name', $partner->canteen_name) }}"
                    required
                >

                @error('canteen_name')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label for="location">Lokasi Kantin</label>
                <input
                    type="text"
                    id="location"
                    name="location"
                    value="{{ old('location', $partner->location) }}"
                    required
                >

                @error('location')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label for="phone">Nomor Telepon</label>
                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="{{ old('phone', $partner->phone) }}"
                >

                @error('phone')
                    <p class="error">{{ $message }}</p>
                @enderror

                <button type="submit">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</body>
</html>