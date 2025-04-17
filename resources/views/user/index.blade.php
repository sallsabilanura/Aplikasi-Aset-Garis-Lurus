@extends('dashboard')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna</title>
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
        }

        .table tbody td {
            color: #555;
        }

        h1 {
            color: #555;
        }

        .form-status select {
            padding: 5px 10px;
        }

        .form-status button {
            padding: 6px 12px;
            background-color: #696cff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-status button:hover {
            background-color: #555;
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
                            <th>Tanggal Daftar</th>
                            <th>Update Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->created_at->format('d-m-Y') }}</td>
                            <td>
                                <!-- Form untuk Update Status -->
                                <form action="{{ route('users.updateStatus', $user->id) }}" method="POST" class="form-status">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label for="status" class="form-label">Pilih Status Pengguna</label>
        <select name="Status" id="status" class="form-select">
            <option value="Aktif" {{ $user->Status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Nonaktif" {{ $user->Status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Update Status</button>
    </div>
</form>


                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
@endsection
<style>
    .form-status {
        max-width: 400px;
        margin: 20px auto;
    }

    .form-select {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 8px 20px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

