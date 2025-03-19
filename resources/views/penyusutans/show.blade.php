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
            <h4 class="mb-0 text-white">Rincian Penyusutan</h4>
        </div>
        <div class="card-body p-4">
            <!-- Bagian Judul yang Muncul saat Cetak -->
            <div class="print-header text-center">
                <h3 class="fw-bold">Penyusutan Data</h3>
                <h4 class="text-primary">Nama Aset: {{ $penyusutan->aset->NamaAset }}</h4>
                <hr>
            </div>

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
                        <td class="text-success">Rp {{ number_format($penyusutan->aset->NilaiPerolehan, 0, ',', '.') }}</td>
                        <td class="text-danger">Rp {{ number_format($data['penyusutan'], 0, ',', '.') }}</td>
                        <td class="text-primary fw-bold">Rp {{ number_format($data['nilai_akhir'], 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Action Button -->
    <div class="mt-4 d-flex justify-content-right">
            <a href="{{ route('penyusutans.index') }}" class="btn btn-outline-primary px-4 py-2">
                    <i class="bx bx-arrow-back"></i> Kembali ke Penyusutan
                </a>    
            <button id="cetakPdf" class="btn btn-danger px-4 py-2">
                    <i class="bx bx-printer"></i> Cetak PDF
                </button>
            
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
            display: none !important; /* Sembunyikan tombol dan elemen yang tidak perlu */
        }
        .print-header {
            display: block !important;
        }
    }

    /* Supaya header hanya muncul saat cetak */
    .print-header {
        display: none;
    }
</style>

<script>
    document.getElementById('cetakPdf').addEventListener('click', function () {
        window.print(); // Cetak halaman langsung ke PDF tanpa perlu route tambahan
    });
</script>

@endsection
