@extends('dashboard')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori Aset</title>
    <!-- Link Bootstrap CSS -->
</head>

<body>
    <div class="container mt-5">
        <!-- Card for Edit Form -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="text-center mb-4">Edit Kategori Aset</h1>
                <form action="{{ route('kategoris.update', $kategori->KategoriID) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Form for Kategori Aset -->
                    <h3>Data Kategori Aset</h3>
                    <div class="form-group mb-3">
                        <label for="NamaKategori">Nama Kategori</label>
                        <input type="text" name="NamaKategori" id="NamaKategori" class="form-control" value="{{ old('NamaKategori', $kategori->NamaKategori) }}" required>
                        @error('NamaKategori')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="Deskripsi">Deskripsi</label>
                        <textarea name="Deskripsi" id="Deskripsi" class="form-control" rows="4" required>{{ old('Deskripsi', $kategori->Deskripsi) }}</textarea>
                        @error('Deskripsi')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('kategoris.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Link Bootstrap JS (optional) -->
  
</body>

</html>
@endsection