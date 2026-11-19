<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Daftar Paket Makanan - PorsiKembali</title>

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

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .add-button {
            background-color: #34734b;
            color: white;
            padding: 11px 16px;
            border-radius: 5px;
            text-decoration: none;
        }

        .success {
            background-color: #e0f2e5;
            color: #27633c;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 13px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #edf4ef;
            color: #34734b;
        }

        .empty {
            text-align: center;
            color: #777;
            padding: 25px;
        }

        @media (max-width: 700px) {
            .table-wrapper {
                overflow-x: auto;
            }

            table {
                min-width: 650px;
            }
        }

        .action-link {
            display: inline-block;
            background-color: #34734b;
            color: white;
            padding: 7px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .delete-button {
            background-color: #c0392b;
            color: white;
            padding: 7px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
        }

        .action-form {
            display: inline;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <strong>PorsiKembali</strong>
    </div>

    <div class="container">
        <div class="content">

            <div class="header">
                <div>
                    <h1>Daftar Paket Makanan</h1>
                    <p>Kelola paket makanan yang ditawarkan kantin Anda.</p>
                </div>

                <a href="{{ route('partner.food-packages.create') }}"
                   class="add-button">
                    + Tambah Paket
                </a>
            </div>

            @if (session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Paket</th>
                            <th>Harga Normal</th>
                            <th>Harga Penawaran</th>
                            <th>Stok</th>
                            <th>Batas Pengambilan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($foodPackages as $package)
                            <tr>
                                <td>{{ $package->name }}</td>

                                <td>
                                    Rp {{ number_format($package->normal_price, 0, ',', '.') }}
                                </td>

                                <td>
                                    Rp {{ number_format($package->offer_price, 0, ',', '.') }}
                                </td>

                                <td>{{ $package->stock }}</td>

                                <td>
                                    {{ \Carbon\Carbon::parse($package->pickup_deadline)->format('d-m-Y H:i') }}
                                </td>

                                <td>
                                    <a
                                        href="{{ route('partner.food-packages.edit', $package->id) }}"
                                        class="action-link"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('partner.food-packages.destroy', $package->id) }}"
                                        method="POST"
                                        class="action-form"
                                        onsubmit="return confirm('Yakin ingin menghapus paket ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="delete-button">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty">
                                    Belum ada paket makanan yang ditambahkan.
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