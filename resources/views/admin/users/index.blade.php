<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna - PorsiKembali</title>
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

        .description {
            color: #666;
            margin-bottom: 25px;
        }

        .success {
            background-color: #e0f2e5;
            color: #27633c;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 18px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
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

        .role {
            display: inline-block;
            background-color: #e0f2e5;
            color: #27633c;
            padding: 5px 9px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 600;
        }

        .edit-link {
            display: inline-block;
            background-color: #34734b;
            color: white;
            padding: 7px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 13px;
        }

        .empty {
            text-align: center;
            color: #777;
            padding: 25px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <strong>PorsiKembali</strong>
    </div>

    <div class="container">
        <div class="content">
            <h1>Daftar Pengguna</h1>

            <p class="description">
                Kelola data pengguna yang terdaftar di PorsiKembali.
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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jenis Pengguna</th>
                            <th>Tanggal Terdaftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="role">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>
                                    {{ $user->created_at->format('d-m-Y') }}
                                </td>
                                <td>
                                    <a
                                        href="{{ route('admin.users.edit', $user->id) }}"
                                        class="edit-link"
                                    >
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty">
                                    Belum ada data pengguna.
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