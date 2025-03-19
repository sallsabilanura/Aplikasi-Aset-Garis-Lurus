@extends('dashboard')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Aset</title>
    <!-- Tambahkan CSS Bootstrap 5 -->
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="text-center mb-4">Edit Aset</h2>

                <!-- Tampilkan pesan sukses jika ada -->
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <!-- Form edit aset -->
                <form action="{{ route('asets.update', $aset->AsetID) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="NamaAset" class="form-label">Nama Aset</label>
                        <input type="text" name="NamaAset" id="NamaAset" class="form-control @error('NamaAset') is-invalid @enderror" value="{{ old('NamaAset', $aset->NamaAset) }}" required>
                        @error('NamaAset')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="KodeAset" class="form-label">Nama Aset</label>
                        <input type="text" name="KodeAset" id="KodeAset" class="form-control @error('KodeAset') is-invalid @enderror" value="{{ old('KodeAset', $aset->KodeAset) }}" required>
                        @error('NamaAset')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="KategoriID" class="form-label">Kategori</label>
                        <select name="KategoriID" id="KategoriID" class="form-select @error('KategoriID') is-invalid @enderror" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->KategoriID }}" {{ old('KategoriID', $aset->KategoriID) == $kategori->KategoriID ? 'selected' : '' }}>
                                {{ $kategori->NamaKategori }}
                            </option>
                            @endforeach
                        </select>
                        @error('KategoriID')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="NilaiPerolehan" class="form-label">Nilai Perolehan</label>
                        <input type="number" name="NilaiPerolehan" id="NilaiPerolehan" class="form-control @error('NilaiPerolehan') is-invalid @enderror" value="{{ old('NilaiPerolehan', $aset->NilaiPerolehan) }}" step="0.01" min="0" max="999999999999.99" required>
                        @error('NilaiPerolehan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="NilaiResidu" class="form-label">Nilai Residu</label>
                        <input type="number" name="NilaiResidu" id="NilaiResidu" class="form-control @error('NilaiResidu') is-invalid @enderror" value="{{ old('NilaiResidu', $aset->NilaiResidu) }}" step="0.01" min="0" max="999999999999.99" required>
                        @error('NilaiResidu')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="MasaManfaat" class="form-label">Masa Manfaat</label>
                        <input type="text" name="MasaManfaat" id="MasaManfaat" class="form-control @error('MasaManfaat') is-invalid @enderror" value="{{ old('MasaManfaat', $aset->MasaManfaat) }}" required>
                        @error('MasaManfaat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="TanggalPerolehan" class="form-label">Tanggal Perolehan</label>
                        <input type="date" name="TanggalPerolehan" id="TanggalPerolehan" class="form-control @error('TanggalPerolehan') is-invalid @enderror" value="{{ old('TanggalPerolehan', $aset->TanggalPerolehan) }}" required>
                        @error('TanggalPerolehan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="LokasiAset" class="form-label">Lokasi Aset</label>
                        <input type="text" name="LokasiAset" id="LokasiAset" class="form-control @error('LokasiAset') is-invalid @enderror" value="{{ old('LokasiAset', $aset->LokasiAset) }}" required>
                        @error('LokasiAset')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('asets.index') }}" class="btn btn-secondary">Batal</a>

                </form>
            </div>
        </div>
    </div>

    <!-- Tambahkan JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
@endsection