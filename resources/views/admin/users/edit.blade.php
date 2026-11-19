<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna - PorsiKembali</title>
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

        .role-info {
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
        <a href="{{ route('admin.users.index') }}" class="back-link">
            &larr; Kembali ke daftar pengguna
        </a>

        <div class="content">
            <h1>Edit Pengguna</h1>
            <p>Perbarui informasi akun pengguna.</p>

            <div class="role-info">
                <strong>Jenis Pengguna:</strong>
                {{ ucfirst($user->role) }}
            </div>

            <form
                action="{{ route('admin.users.update', $user->id) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <label for="name">Nama Pengguna</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    required
                >

                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    required
                >

                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror

                <button type="submit">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</body>
</html>