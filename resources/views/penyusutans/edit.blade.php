@extends('dashboard')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penyusutan</title>
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="text-center mb-4">Edit Penyusutan</h2>
                <form action="{{ route('penyusutans.update', $penyusutan->PenyusutanID) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="AsetID" class="form-label">Aset</label>
                        <select name="AsetID" id="AsetID" class="form-select" required>
                            <option value="" data-tanggal="" data-nilai="" data-residu="" data-manfaat="">-- Pilih Aset --</option>
                            @foreach ($asets as $aset)
                            <option value="{{ $aset->AsetID }}"
                                data-tanggal="{{ $aset->TanggalPerolehan }}"
                                data-nilai="{{ $aset->NilaiPerolehan }}"
                                data-residu="{{ $aset->NilaiResidu }}"
                                data-manfaat="{{ $aset->MasaManfaat }}"
                                {{ $aset->AsetID == $penyusutan->AsetID ? 'selected' : '' }}>
                                {{ $aset->NamaAset }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="TahunPenyusutan" class="form-label">Tahun Penyusutan</label>
                        <input type="text" name="TahunPenyusutan" id="TahunPenyusutan" class="form-control" value="{{ old('TahunPenyusutan', $penyusutan->TahunPenyusutan) }}" placeholder="Contoh: 2025" required>
                    </div>
                    <div class="mb-3">
                        <label for="NilaiAwal" class="form-label">Nilai Awal</label>
                        <input type="number" name="NilaiAwal" id="NilaiAwal" class="form-control" value="{{ old('NilaiAwal', $penyusutan->NilaiAwal) }}" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="PenyusutanTahunan" class="form-label">Penyusutan Tahunan</label>
                        <input type="number" name="PenyusutanTahunan" id="PenyusutanTahunan" class="form-control" value="{{ old('PenyusutanTahunan', $penyusutan->PenyusutanTahunan) }}" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="NilaiAkhir" class="form-label">Nilai Akhir</label>
                        <input type="number" name="NilaiAkhir" id="NilaiAkhir" class="form-control" value="{{ old('NilaiAkhir', $penyusutan->NilaiAkhir) }}" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('penyusutans.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('AsetID').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const tanggalPerolehan = selectedOption.getAttribute('data-tanggal');
            const nilaiPerolehan = selectedOption.getAttribute('data-nilai');
            const nilaiResidu = selectedOption.getAttribute('data-residu');
            const masaManfaat = selectedOption.getAttribute('data-manfaat');

            if (tanggalPerolehan) {
                const tahun = new Date(tanggalPerolehan).getFullYear();
                document.getElementById('TahunPenyusutan').value = tahun;
            } else {
                document.getElementById('TahunPenyusutan').value = '';
            }

            if (nilaiPerolehan) {
                document.getElementById('NilaiAwal').value = nilaiPerolehan;
            } else {
                document.getElementById('NilaiAwal').value = '';
            }

            if (nilaiPerolehan && nilaiResidu && masaManfaat) {
                const penyusutanTahunan = (parseFloat(nilaiPerolehan) - parseFloat(nilaiResidu)) / parseFloat(masaManfaat);
                document.getElementById('PenyusutanTahunan').value = penyusutanTahunan.toFixed(2);
            } else {
                document.getElementById('PenyusutanTahunan').value = '';
            }

            if (nilaiResidu) {
                document.getElementById('NilaiAkhir').value = parseFloat(nilaiResidu).toFixed(2);
            } else {
                document.getElementById('NilaiAkhir').value = '';
            }
        });

        window.addEventListener('load', function() {
            document.getElementById('AsetID').dispatchEvent(new Event('change'));
        });
    </script>
</body>

</html>
@endsection