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
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
        @endif

        <!-- Add Asset Button and Search Form -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('asets.index') }}" class="d-flex">
                        <input type="text" name="search" class="form-control w-75" placeholder="Cari Aset" value="{{ request('search') }}">
                        <button class="btn btn-primary ms-2" type="submit">Cari</button>
                    </form>

                    <!-- Add New Asset Button -->
                    @if(auth()->user()->role == 'Instansi')
                    <a href="{{ route('asets.create') }}" class="btn btn-primary">Tambah Aset</a>
                    @endif
                </div>
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
                                <th>Nilai Perolehan</th>
                                <th>Nilai Residu</th>
                                <th>Masa Manfaat</th>
                                <th>Tanggal Perolehan</th>
                                <th>Status</th>
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
                                    <a href="{{ route('asets.show', $aset->AsetID) }}" class="btn btn-info btn-sm" title="Lihat Detail">
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