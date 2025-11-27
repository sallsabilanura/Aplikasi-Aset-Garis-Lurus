@extends('dashboard')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Aset</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    
</head>

<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Penyusutan</h1>

    <!-- Form Pencarian -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('penyusutans.index') }}">
                <div class="row g-2 align-items-end">
                    <!-- Input Pencarian -->
                    <div class="col-md-4">
                        <label class="form-label">Pencarian</label>
                        <input type="text" name="search" class="form-control" placeholder="Cari Penyusutan" value="{{ request('search') }}">
                    </div>

                    <!-- Dropdown Tahun -->
                    <div class="col-md-3">
                        <label class="form-label">Tahun Penyusutan</label>
                        <select name="TahunPenyusutan" class="form-control">
                            <option value="">Pilih Tahun</option>
                            @foreach ($daftar_tahun as $tahun)
                                <option value="{{ $tahun }}" {{ request('TahunPenyusutan') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dropdown Instansi (hanya untuk Admin) -->
                    @if(auth()->user()->role == 'Admin')
                    <div class="col-md-3">
                        <label class="form-label">Instansi</label>
                        <select name="instansi" class="form-control">
                            <option value="">Pilih Instansi</option>
                            @foreach($instansis as $instansi)
                                <option value="{{ $instansi->id }}" {{ request('instansi') == $instansi->id ? 'selected' : '' }}>
                                    {{ $instansi->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                      <!-- Tombol Tambah Aset -->
                @if(auth()->user()->role == 'Instansi')
                    <div class="col-auto">
                        <a href="{{ route('penyusutans.create') }}" class="btn btn-primary">Tambah Aset</a>
                    </div>
                @endif
                    <!-- Tombol Aksi -->
                    <div class="col-md-2 d-flex gap-2">
                        <button class="btn btn-primary w-100" type="submit">Cari</button>
                        <a href="{{ route('penyusutans.cetak', ['TahunPenyusutan' => request('TahunPenyusutan')]) }}" target="_blank" class="btn btn-success w-100">
                            <i class="fas fa-print"></i> Cetak
                        </a>
                    </div>
                @endif
                   <!-- Tombol Aksi -->
<div class="col-md-2 d-flex align-items-center gap-2">
    <!-- Tombol Cari -->
    <button class="btn btn-primary shadow-sm d-flex align-items-center justify-content-center" type="submit" style="height: 40px;">
                        <i class="fas fa-search me-1"></i> Cari
                    </button>

    <!-- Tombol Cetak -->
    <a href="{{ route('penyusutans.cetak', ['TahunPenyusutan' => request('TahunPenyusutan')]) }}" 
       target="_blank"
       class="btn btn-outline-danger shadow-sm d-flex align-items-center justify-content-center"
       data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak PDF"
       style="width: 45px; height: 38px;">
        <i class="fas fa-file-pdf fa-lg"></i>
    </a>

    <!-- Tombol Export Excel -->
    <a href="{{ route('penyusutans.export-excel', ['TahunPenyusutan' => request('TahunPenyusutan')]) }}" 
       class="btn btn-outline-success shadow-sm d-flex align-items-center justify-content-center"
       data-bs-toggle="tooltip" data-bs-placement="top" title="Export ke Excel"
       style="width: 45px; height: 38px;">
        <i class="fas fa-file-excel fa-lg"></i>
    </a>
</div>

<script>
    // Tooltip Bootstrap biar muncul saat hover
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

            </form>
     


    <!-- Pesan Sukses -->
    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Penyusutan dalam Card -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Aset</th>
                            <th>Kode Aset</th>
                            <th>Tahun Perolehan</th>
                            <th>Masa Manfaat (Tahun)</th>
                            <th>Tahun Akhir Penyusutan</th>
                            <th>Nilai Perolehan</th>
                            <th>Penyusutan Tahunan</th>
                            <th>Nilai Akhir</th>
                            <th>Nama Instansi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penyusutan as $penyusutan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $penyusutan->aset->NamaAset ?? '-' }}</td>
                            <td>{{ $penyusutan->aset->KodeAset ?? '-' }}</td>
                            <td>{{ $penyusutan->TahunPenyusutan }}</td>
                            <td>{{ $penyusutan->aset->MasaManfaat ?? '-' }}</td>
                            <td>
                                @if ($penyusutan->TahunPenyusutan && $penyusutan->aset->MasaManfaat)
                                {{ $penyusutan->TahunPenyusutan + $penyusutan->aset->MasaManfaat }}
                                @else
                                -
                                @endif
                            </td>
                            <td>Rp {{ number_format($penyusutan->NilaiAwal, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($penyusutan->PenyusutanTahunan, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($penyusutan->NilaiAkhir, 0, ',', '.') }}</td>
                            <td>{{ $penyusutan->user->name ?? 'Tidak Diketahui' }}</td>
                            <td>
                                <a href="{{ route('penyusutans.show', $penyusutan->PenyusutanID) }}" class="btn btn-primary btn-sm mb-1" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('penyusutans.edit', $penyusutan->PenyusutanID) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('penyusutans.destroy', $penyusutan->PenyusutanID) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus Data">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center">Tidak ada data penyusutan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>
</body>

</html>
@endsection
