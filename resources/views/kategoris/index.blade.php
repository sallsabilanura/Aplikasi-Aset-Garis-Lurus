@extends('dashboard')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Aset</title>
    <!-- Tambahkan CSS Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Kategori Aset</h1>

        <!-- Tombol Tambah Kategori Aset -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Form Pencarian di sebelah kiri -->
                    <form method="GET" action="{{ route('kategoris.index') }}" class="d-flex">
                        <input type="text" name="search" class="form-control w-75" placeholder="Cari Kategori Aset" value="{{ request('search') }}">
                        <button class="btn btn-primary ms-2" type="submit">Cari</button>
                    </form>

                    <!-- Tombol Tambah Kategori Aset di sebelah kanan -->
                    @if(auth()->user()->role == 'Instansi')
    <a href="{{ route('kategoris.create') }}" class="btn btn-primary">Tambah Kategori Aset</a>
@endif
                </div>
            </div>
        </div>

        <!-- Pesan Sukses -->
        @if(session('success'))
        <div class="alert alert-success mb-4" id="success-alert">
            {{ session('success') }}
        </div>
        @endif

        <!-- Tabel Kategori Aset dalam Card -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Deskripsi</th>
                                <th>Nama Instansi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $kategori)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kategori->NamaKategori }}</td>
                                    <td>{{ $kategori->Deskripsi }}</td>
                                    <td>{{ $kategori->user->name ?? 'Tidak Diketahui' }}</td>
                                    <td>
                                        <a href="{{ route('kategoris.edit', $kategori->KategoriID) }}" class="btn btn-warning btn-sm" title="Edit Kategori">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('kategoris.destroy', $kategori->KategoriID) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                                           
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus Kategori">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan JavaScript Bootstrap -->
    <script>
        // Menyembunyikan alert setelah 5 detik
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500); // Hapus elemen setelah efek transisi selesai
            }
        }, 5000);
    </script>
</body>
</html>
@endsection