@extends('dashboard')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Aset</title>
    <!-- Link Bootstrap CSS -->
</head>

<body>
    <div class="container mt-5">
        <!-- Card for Add Asset Form -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="text-center mb-4">Tambah Aset</h1>

                <!-- Display errors if validation fails -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Form to Add Asset -->
                <form action="{{ route('asets.store') }}" method="POST">
                    @csrf
                    <!-- Asset Details -->
                    <div class="mb-3">
                        <label for="NamaAset" class="form-label">Nama Aset:</label>
                        <input type="text" id="NamaAset" name="NamaAset" class="form-control" value="{{ old('NamaAset') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="KodeAset" class="form-label">Kode Aset:</label>
                        <input type="text" id="KodeAset" name="KodeAset" class="form-control" readonly required>
                    </div>

                    <div class="mb-3">
                        <label for="NilaiPerolehan" class="form-label">Nilai Perolehan:</label>
                        <input type="text" id="FormattedNilaiPerolehan" class="form-control" value="{{ old('NilaiPerolehan') }}" required>
                        <input type="hidden" id="NilaiPerolehan" name="NilaiPerolehan" value="{{ old('NilaiPerolehan') }}">
                    </div>

                    <div class="mb-3">
                        <label for="NilaiResidu" class="form-label">Nilai Residu:</label>
                        <input type="text" id="FormattedNilaiResidu" class="form-control" readonly required>
                        <input type="hidden" id="NilaiResidu" name="NilaiResidu" value="{{ old('NilaiResidu') }}">
                    </div>
                    <div class="mb-3">
                        <label for="MasaManfaat" class="form-label">Masa Manfaat:</label>
                        <div class="input-group">
                            <input type="number" id="MasaManfaat" name="MasaManfaat" class="form-control" value="{{ old('MasaManfaat') }}" placeholder="Contoh: 5" required>
                            <span class="input-group-text">Tahun</span>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="TanggalPerolehan" class="form-label">Tanggal Perolehan:</label>
                        <input type="date" id="TanggalPerolehan" name="TanggalPerolehan" class="form-control" value="{{ old('TanggalPerolehan') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="LokasiAset" class="form-label">Lokasi Aset:</label>
                        <input type="text" id="LokasiAset" name="LokasiAset" class="form-control" value="{{ old('LokasiAset') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="Status" class="form-label">Status:</label>
                        <select id="Status" name="Status" class="form-control" required>
                            <option value="Aktif" {{ old('Status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Tidak Aktif" {{ old('Status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="KategoriID" class="form-label">Kategori:</label>
                        <select class="form-select" id="KategoriID" name="KategoriID" required>
                            <option value="" disabled selected>-- Pilih Kategori --</option> <!-- Ini adalah bacaan awal -->
                            @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->KategoriID }}">{{ $kategori->NamaKategori }}</option>
                            @endforeach
                        </select>
                    </div>




                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('asets.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Link Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        const formatRupiah = (angka) => {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        };

        const parseRupiah = (rupiah) => {
            return parseInt(rupiah.replace(/\./g, '')) || 0; // Parse to integer
        };

        const formattedPerolehanInput = document.getElementById('FormattedNilaiPerolehan');
        const hiddenPerolehanInput = document.getElementById('NilaiPerolehan');
        const formattedResiduInput = document.getElementById('FormattedNilaiResidu');
        const hiddenResiduInput = document.getElementById('NilaiResidu');

        formattedPerolehanInput.addEventListener('input', function() {
            const rawValue = parseRupiah(this.value); // Convert to plain number
            this.value = formatRupiah(rawValue); // Display formatted value
            hiddenPerolehanInput.value = rawValue; // Store plain number for backend

            const residuValue = Math.floor(rawValue * 0.1); // Calculate 10%
            formattedResiduInput.value = formatRupiah(residuValue); // Display formatted residu
            hiddenResiduInput.value = residuValue; // Store plain number for backend
        });

        const namaAsetInput = document.getElementById('NamaAset');
        const kodeAsetInput = document.getElementById('KodeAset');

        namaAsetInput.addEventListener('input', function() {
            const namaAset = this.value.trim().toUpperCase();
            const kodeUnik = Math.floor(10000 + Math.random() * 90000); // Generate kode unik 5 digit
            const kodeAset = namaAset.slice(0, 3) + kodeUnik; // Gabungkan tiga huruf pertama dengan kode unik
            kodeAsetInput.value = kodeAset; // Isi nilai KodeAset
        });
    </script>
</body>

</html>
@endsection