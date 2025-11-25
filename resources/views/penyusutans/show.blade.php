@extends('dashboard')
@section('content')
<div class="container mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Detail Penyusutan: {{ $penyusutan->aset->NamaAset }}</h2>
    </div>

    <!-- Card Section -->
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0 text-white">Data Aset & Rincian Penyusutan</h4>
        </div>

        <div class="card-body p-4">

            <!-- Header untuk Cetak -->
            <div class="print-header text-center">
                <h3 class="fw-bold mb-2">Data Penyusutan Aset</h3>
                <h4 class="text-primary mb-3">Nama Aset: {{ $penyusutan->aset->NamaAset }}</h4>
                <hr>
            </div>

            <!-- Data Aset -->
            <h5 class="fw-bold text-secondary mb-3">Informasi Aset</h5>
            <table class="table table-bordered mb-4">
                <tr>
                    <th width="30%">Nama Aset</th>
                    <td>{{ $penyusutan->aset->NamaAset ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Perolehan</th>
                    <td>{{ $penyusutan->aset->TanggalPerolehan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nilai Perolehan</th>
                    <td>Rp {{ number_format($penyusutan->aset->NilaiPerolehan ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Dana Dari</th>
                    <td>{{ $penyusutan->aset->Dana ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Total Kuantitas</th>
                    <td>{{ $penyusutan->aset->Kuantitas ?? 0 }} unit</td>
                </tr>
                <tr>
                    <th>Nama Instansi / Penginput</th>
                    <td>{{ $penyusutan->aset->user->name ?? 'Tidak Diketahui' }}</td>
                </tr>
            </table>

            <!-- Rincian Penyusutan -->
            <h5 class="fw-bold text-secondary mb-3">Rincian Penyusutan per Tahun</h5>
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tahun</th>
                        <th>Nilai Awal</th>
                        <th>Penyusutan Tahunan</th>
                        <th>Nilai Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rincian as $data)
                    <tr>
                        <td><strong>{{ $data['tahun'] }}</strong></td>
                        <td>Rp {{ number_format($data['nilai_awal'], 0, ',', '.') }}</td>
                        <td class="text-danger">Rp {{ number_format($data['penyusutan'], 0, ',', '.') }}</td>
                        <td class="text-primary fw-bold">Rp {{ number_format($data['nilai_akhir'], 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <!-- Action Buttons -->
    <div class="mt-4 d-flex justify-content-end gap-2">
        <a href="{{ route('penyusutans.index') }}" class="btn btn-outline-primary px-4 py-2">
            <i class="bx bx-arrow-back"></i> Kembali ke Penyusutan
        </a>
       <a href="{{ route('penyusutans.exportPdfShow', $penyusutan->PenyusutanID) }}" 
   class="btn btn-danger px-4 py-2" target="_blank">
    <i class="bx bx-file"></i> Export PDF (Detail)
</a>

    </div>
</div>

<style>
    @media print {
        body {
            visibility: hidden;
        }
        .card {
            visibility: visible;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none;
            box-shadow: none;
        }
        .card-body {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #000 !important;
            padding: 8px;
        }
        .btn, .d-flex {
            display: none !important;
        }
        .print-header {
            display: block !important;
        }
    }

    .print-header {
        display: none;
    }
</style>

<script>
    document.getElementById('cetakPdf').addEventListener('click', function () {
        window.print();
    });
</script>

@endsection
