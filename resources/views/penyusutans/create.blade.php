@extends('dashboard')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penyusutan</title>
    <!-- Link Bootstrap CSS -->
</head>

<body>
    <div class="container mt-5">
        <!-- Card for Add Depreciation Form -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="text-center mb-4">Tambah Penyusutan</h1>

                <!-- Tampilkan error jika validasi gagal -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Form Tambah Penyusutan -->
                <form action="{{ route('penyusutans.store') }}" method="POST">
                    @csrf
                    <!-- Data Aset -->
                    <h3>Data Aset</h3>



                    <div class="form-group mb-3">
    <label for="AsetID">Aset</label>
    <select name="AsetID" id="AsetID" class="form-select" required>
        <option value="" data-tanggal="" data-nilai="" data-residu="" data-manfaat="" data-kode="" data-kuantitas="">-- Pilih Aset --</option>
        @foreach ($asets as $aset)
       <option value="{{ $aset->AsetID }}"
    data-tanggal="{{ $aset->TanggalPerolehan }}"
    data-nilai="{{ $aset->NilaiPerolehan }}"
    data-residu="{{ $aset->NilaiResidu }}"
    data-manfaat="{{ $aset->MasaManfaat }}"
    data-kode="{{ $aset->KodeAset }}"
    data-kuantitas="{{ $aset->Kuantitas }}">
    
    {{ $aset->NamaAset }}
</option>

        @endforeach
    </select>
</div>
<div class="form-group mb-3">
    <label for="Kuantitas">Kuantitas</label>
    <input type="number" name="Kuantitas" id="Kuantitas" class="form-control" readonly>
</div>



                    <div class="form-group mb-3">
                        <label for="KodeAset">Kode Aset</label>
                        <input type="text" name="KodeAset" id="KodeAset" class="form-control" readonly>
                    </div>
                    

                    <div class="form-group mb-3">
                        <label for="TahunPenyusutan">Tahun Penyusutan</label>
                        <input type="text" name="TahunPenyusutan" id="TahunPenyusutan" class="form-control" placeholder="Contoh: 2025" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="MasaManfaat">Masa Manfaat (Tahun)</label>
                        <input type="number" name="MasaManfaat" id="MasaManfaat" class="form-control" placeholder="Contoh: 5" required readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="TahunPenyusutanAkhir">Tahun Penyusutan Akhir</label>
                        <input type="text" name="TahunPenyusutanAkhir" id="TahunPenyusutanAkhir" class="form-control" placeholder="Tahun Akhir Penyusutan" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="NilaiAwal">Nilai Awal</label>
                        <input type="number" name="NilaiAwal" id="NilaiAwal" class="form-control" step="0.01" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="PenyusutanTahunan">Penyusutan Tahunan</label>
                        <input type="number" name="PenyusutanTahunan" id="PenyusutanTahunan" class="form-control" step="0.01" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="NilaiAkhir">Nilai Akhir</label>
                        <input type="number" name="NilaiAkhir" id="NilaiAkhir" class="form-control" step="0.01" readonly>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('penyusutans.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Link Bootstrap JS (optional) -->

    <script>
        document.getElementById('AsetID').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const tanggalPerolehan = selectedOption.getAttribute('data-tanggal');
            const nilaiPerolehan = selectedOption.getAttribute('data-nilai');
            const nilaiResidu = selectedOption.getAttribute('data-residu');
            const masaManfaat = selectedOption.getAttribute('data-manfaat');
            const kodeAset = selectedOption.getAttribute('data-kode'); // Ambil data-kode dengan benar
            const kuantitas = selectedOption.getAttribute('data-kuantitas');
if (kuantitas) {
    document.getElementById('Kuantitas').value = kuantitas;
} else {
    document.getElementById('Kuantitas').value = '';
}


            // Isi Tahun Penyusutan
            if (tanggalPerolehan) {
                const tahun = new Date(tanggalPerolehan).getFullYear();
                document.getElementById('TahunPenyusutan').value = tahun;
            } else {
                document.getElementById('TahunPenyusutan').value = '';
            }

            // Isi Masa Manfaat
            if (masaManfaat) {
                document.getElementById('MasaManfaat').value = masaManfaat;
            } else {
                document.getElementById('MasaManfaat').value = '';
            }

            // Isi Nilai Awal
            if (nilaiPerolehan) {
                document.getElementById('NilaiAwal').value = nilaiPerolehan;
            } else {
                document.getElementById('NilaiAwal').value = '';
            }

            // Hitung Penyusutan Tahunan
            if (nilaiPerolehan && nilaiResidu && masaManfaat) {
                const penyusutanTahunan = (parseFloat(nilaiPerolehan) - parseFloat(nilaiResidu)) / parseFloat(masaManfaat);
                document.getElementById('PenyusutanTahunan').value = penyusutanTahunan.toFixed(2); // Format dua desimal
            } else {
                document.getElementById('PenyusutanTahunan').value = '';
            }

            // Isi Nilai Akhir
            if (nilaiResidu) {
                document.getElementById('NilaiAkhir').value = parseFloat(nilaiResidu).toFixed(2);
            } else {
                document.getElementById('NilaiAkhir').value = '';
            }

            // Menghitung Tahun Penyusutan Akhir secara otomatis
            if (masaManfaat && tanggalPerolehan) {
                const tahunPenyusutan = new Date(tanggalPerolehan).getFullYear();
                const tahunAkhir = tahunPenyusutan + parseInt(masaManfaat);
                document.getElementById('TahunPenyusutanAkhir').value = tahunAkhir;
            }

            // Isi Kode Aset
            if (kodeAset) {
                document.getElementById('KodeAset').value = kodeAset; // Pastikan kode aset terisi dengan benar
            } else {
                document.getElementById('KodeAset').value = '';
            }
        });
       


        // Menghitung Tahun Penyusutan Akhir ketika Masa Manfaat diubah
        document.getElementById('MasaManfaat').addEventListener('input', function() {
            const tahunPenyusutan = document.getElementById('TahunPenyusutan').value;
            const masaManfaat = this.value;

            if (tahunPenyusutan && masaManfaat) {
                const tahunAkhir = parseInt(tahunPenyusutan) + parseInt(masaManfaat);
                document.getElementById('TahunPenyusutanAkhir').value = tahunAkhir;
            }
        });
    </script>
</body>

</html>
@endsection