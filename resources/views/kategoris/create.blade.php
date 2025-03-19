@extends('dashboard')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori Aset</title>
    <!-- Link Bootstrap CSS -->
</head>

<body>
    <div class="container mt-5">
        <!-- Card for Add Category Form -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="text-center mb-4">Tambah Kategori Aset</h1>
                <form action="{{ route('kategoris.store') }}" method="POST">
                    @csrf
                    <!-- Form for Kategori Aset -->
                    <h3>Data Kategori Aset</h3>
                    <div class="form-group mb-3">
                        <label for="NamaKategori">Nama Kategori</label>
                        <input type="text" name="NamaKategori" id="NamaKategori" class="form-control" value="{{ old('NamaKategori') }}" required>
                        @error('NamaKategori')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="Deskripsi">Deskripsi</label>
                        <textarea name="Deskripsi" id="Deskripsi" class="form-control" rows="4" required>{{ old('Deskripsi') }}</textarea>
                        @error('Deskripsi')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('penyusutans.index') }}" class="btn btn-secondary">Batal</a>
            </div>
            </form>
        </div>
    </div>
    </div>

    <!-- Link Bootstrap JS (optional) -->

</body>

</html>
@endsection