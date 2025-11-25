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
        <h1 class="text-center mb-4">Daftar Aset</h1>

        <!-- Success Message -->
       @if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif


<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('asets.index') }}">
            <div class="row g-2 align-items-center">

                <!-- Input Cari -->
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control"
                           placeholder="Cari Aset..." value="{{ request('search') }}">
                </div>

                <!-- Dropdown Kategori -->
                <div class="col-md-3">
                    <select name="kategori" class="form-select">
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $kategoriOption)
                            <option value="{{ $kategoriOption->KategoriID }}"
                                {{ request('kategori') == $kategoriOption->KategoriID ? 'selected' : '' }}>
                                {{ $kategoriOption->NamaKategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Tahun -->
                <div class="col-md-2">
                    <select name="tahun" class="form-select">
                        <option value="">Semua Tahun</option>
                        @for ($tahun = date('Y'); $tahun >= 2020; $tahun--)
                            <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endfor
                    </select>
                </div>

                <!-- Tombol Cari -->
                <div class="col-auto">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>

                <!-- Tombol Tambah Aset -->
                @if(auth()->user()->role == 'Instansi')
                    <div class="col-auto">
                        <a href="{{ route('asets.create') }}" class="btn btn-primary">Tambah</a>
                    </div>
                @endif

                <!-- Export -->
                <div class="col-auto d-flex gap-2 align-items-center">

                    <!-- Tombol Export PDF -->
                    <a href="{{ route('asets.exportPDF', ['kategori' => request('kategori'), 'tahun' => request('tahun')]) }}"
                       class="btn btn-outline-danger shadow-sm d-flex align-items-center justify-content-center"
                       title="Export PDF" style="width:45px;height:38px;">
                        <i class="fas fa-file-pdf fa-lg"></i>
                    </a>

                    <!-- Tombol Export Excel -->
                    <a href="{{ route('asets.exportExcel', ['kategori' => request('kategori'), 'tahun' => request('tahun')]) }}"
                       class="btn btn-outline-success shadow-sm d-flex align-items-center justify-content-center"
                       title="Export Excel" style="width:45px;height:38px;">
                        <i class="fas fa-file-excel fa-lg"></i>
                    </a>

                </div>


<script>
    // Tooltip Bootstrap (biar muncul saat hover)
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>


            </div>
        </form>
    </div>
</div>
      

        <!-- Asset Table Inside a Card -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Aset</th>
                                <th>Kode Aset</th>
                                <th>Kategori</th>
                                <th>Dana</th>
                                <th>Kuantitas</th>
                                <th>Nilai Perolehan</th>
                                <th>Nilai Residu</th>
                                <th>Masa Manfaat</th>
                                <th>Tanggal Perolehan</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Lokasi Aset</th>
                                <th>Nama Instansi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asets as $aset)
                            <tr>
                                <td>{{ $loop->iteration + ($asets->currentPage() - 1) * $asets->perPage() }}</td>
                                <td>{{ $aset->NamaAset }}</td>
                                <td>{{ $aset->KodeAset }}</td>
                                <td>{{ $aset->kategori->NamaKategori ?? 'Tidak ada kategori' }}</td>
                                <td>{{ $aset->Dana }}</td>
                                <td>{{ $aset->Kuantitas }}</td>
                                <td>Rp {{ number_format($aset->NilaiPerolehan, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($aset->NilaiResidu, 0, ',', '.') }}</td>
                                <td>{{ $aset->MasaManfaat }}</td>
                                <td>{{ $aset->TanggalPerolehan }}</td>
                                <td class="text-center">
                                    <span class="px-3 py-1 font-weight-bold text-white 
                                        {{ $aset->Status == 'Aktif' ? 'bg-primary' : 'bg-danger' }} 
                                        rounded-pill d-inline-block">
                                        {{ $aset->Status }}
                                    </span>
                                </td>

                                <td>{{ $aset->Program }}</td>

                                <td>
                                    <form action="{{ route('asets.updateLocation', $aset->AsetID) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT') <!-- Menyatakan bahwa ini request PUT -->
                                        <input type="text" name="LokasiAset" value="{{ $aset->LokasiAset }}" class="form-control form-control-sm" required>
                                        <button type="submit" class="btn btn-sm btn-success mt-2">
                                            <i class="fas fa-location-arrow"></i> Update Lokasi
                                        </button>
                                    </form>

                                </td>
                                <td>{{ $aset->user->name ?? 'Tidak Diketahui' }}</td>

                                <td>
                                    <a href="{{ route('asets.show', $aset->AsetID) }}" class="btn btn-primary btn-sm mb-1" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('asets.edit', $aset->AsetID) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                  
                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-center">
                        {{ $asets->links('pagination::simple-bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Auto-hide alert script -->
        <script>
            // Hapus alert setelah 5 detik
            setTimeout(function() {
                let alert = document.querySelector('.alert');
                if (alert) {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500); // Menghapus elemen dari DOM
                }
            }, 5000);
        </script>
        <script>
            $(document).ready(function() {
                // Mengubah status aset menjadi "Tidak Aktif" ketika tombol hapus diklik
                $('.delete-aset').on('click', function() {
                    let asetID = $(this).data('id');

                    if (confirm("Apakah Anda yakin ingin menonaktifkan aset ini?")) {
                        $.ajax({
                            url: "/asets/" + asetID, // Pastikan route benar
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                alert(response.message);
                                location.reload(); // Reload halaman untuk memperbarui tampilan
                            },
                            error: function(xhr) {
                                alert("Terjadi kesalahan saat memperbarui status aset.");
                            }
                        });
                    }
                });
            });
        </script>

        <!-- Link Bootstrap JS -->

    </div>
</body>

</html>
@endsection