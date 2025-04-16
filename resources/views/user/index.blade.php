@extends('dashboard')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna</title>
    <!-- Link ke Bootstrap CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .table-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table thead {
            background-color: #696cff;
        }

        .table th {
            color: white !important;
            /* Memastikan teks header menjadi putih dengan prioritas tinggi */
        }

        .table tbody td {
            color: #555;
            /* Menjaga warna teks di tubuh tabel tetap gelap untuk keterbacaan */
        }

        h1 {
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Daftar Pengguna Terdaftar</h1>
        <div class="table-container">

            <!-- Tabel Pengguna -->
            <div class="table-responsive">
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pengguna</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Tanggal Daftar</th> <!-- Kolom Tanggal Daftar -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->created_at->format('d-m-Y') }}</td> <!-- Menampilkan Tanggal Daftar -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Optional Bootstrap JS (for features like modals or dropdowns) -->
</body>

</html>
@endsection