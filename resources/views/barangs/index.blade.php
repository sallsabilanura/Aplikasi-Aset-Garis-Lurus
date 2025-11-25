@extends('dashboard')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lokasi Aset</title>
    <!-- Tambahkan CSS Bootstrap dan FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4 fw-semibold" style="color:#475569;">Daftar Lokasi Aset</h1>

    <div class="card shadow-sm mb-4 border-0 rounded-4">
        <div class="card-body bg-light">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                
                <!-- Form Pencarian -->
                <form method="GET" action="{{ route('barangs.index') }}" class="d-flex flex-grow-1 me-3">
                    <input type="text" name="search" class="form-control rounded-3 shadow-sm" 
                           placeholder="Cari Lokasi Aset" value="{{ request('search') }}">
                    <button class="btn btn-primary ms-2 px-4 shadow-sm fw-semibold" type="submit" 
                            style="background-color:#6366f1; border:none;">
                        Cari
                    </button>
                </form>

                <!-- Tombol Tambah Barang (kecuali Admin) -->
                @unless(auth()->user()->role === 'Admin')
                <a href="{{ route('barangs.create') }}" 
                   class="btn fw-semibold shadow-sm px-4" 
                   style="background-color:#6366f1; color:white; border:none;">
                    + Tambah Lokasi Aset
                </a>
                @endunless

                <!-- Tombol Export -->
                <div class="d-flex align-items-center gap-2">
                    <!-- Export PDF -->
                    <a href="{{ route('barangs.exportPDF', ['search' => request('search')]) }}" 
                       target="_blank" 
                       class="btn btn-outline-danger shadow-sm d-flex align-items-center justify-content-center rounded-3"
                       data-bs-toggle="tooltip" title="Export ke PDF"
                       style="width: 45px; height: 40px;">
                        <i class="fas fa-file-pdf fa-lg"></i>
                    </a>

                    <!-- Export Excel -->
                    <a href="{{ route('barangs.exportExcel', ['search' => request('search')]) }}" 
                       class="btn btn-outline-success shadow-sm d-flex align-items-center justify-content-center rounded-3"
                       data-bs-toggle="tooltip" title="Export ke Excel"
                       style="width: 45px; height: 40px;">
                        <i class="fas fa-file-excel fa-lg"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>

          

    <!-- Pesan Sukses -->
    @if(session('success'))
    <div class="alert alert-success mb-4" id="success-alert">
        {{ session('success') }}
    </div>
    @endif

    <!-- Tabel Barang -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Tanggal</th>
                            <th>Total Kuantitas</th>
                            <th>Lokasi & Kuantitas</th>
                             <th>Nama Instansi</th>
                            <th>Aksi</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangs as $barang)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                          <td>{{ $barang->aset->NamaAset ?? '-' }}</td>
                            <td>{{ $barang->aset->TanggalPerolehan ?? '-' }}</td>
                            <td>{{ $barang->lokasis->sum('Kuantitas') }} unit</td>
                          <td>
    <button class="btn d-flex align-items-center gap-2 px-3 py-1 shadow-sm"
            style="
                background-color: white;
                border: 1px solid #6366f1;
                color: #6366f1;
                border-radius: 8px;
                font-weight: 600;
                font-size: 14px;
            "
            data-bs-toggle="modal"
            data-bs-target="#lokasiModal{{ $barang->BarangID }}">
        <i class="fas fa-map-marker-alt"></i>
        Lokasi
    </button>
</td>

<div class="modal fade" id="lokasiModal{{ $barang->BarangID }}" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Lokasi Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">

        @if ($barang->lokasis->count() > 0)
            <div class="row g-3">
                @foreach ($barang->lokasis as $lokasi)
                <div class="col-md-6">
                    <div class="border rounded p-3 bg-light shadow-sm">
                        <strong>{{ strtoupper($lokasi->LokasiBarang) }}</strong>
                        <span class="ms-2">({{ $lokasi->Kuantitas }} unit)</span>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">Belum ada lokasi.</p>
        @endif

      </div>
    </div>
  </div>
</div>



                         

<td>{{ $barang->user->name ?? 'Tidak Diketahui' }}</td>

                           <td>
                            <a href="{{ route('barangs.show', $barang->BarangID) }}" 
       class="btn btn-primary btn-sm mb-1" 
       title="Lihat Detail Barang">
        <i class="fas fa-eye"></i>
    </a>

    <!-- Tombol Lihat Invoice -->
    @if ($barang->Invoice)
        <button class="btn btn-info btn-sm mb-1" 
                data-bs-toggle="modal" 
                data-bs-target="#invoiceModal{{ $barang->BarangID }}" 
                title="Lihat Invoice">
            <i class="fas fa-file-invoice"></i>
        </button>

        <!-- Modal Invoice -->
        <div class="modal fade" id="invoiceModal{{ $barang->BarangID }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-transparent border-0">
                    <div class="modal-body text-center p-0">
                        <img src="{{ asset('storage/' . $barang->Invoice) }}" 
                             alt="Invoice" 
                             class="img-fluid rounded shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    @else
        <button class="btn btn-secondary btn-sm mb-1" disabled>
            <i class="fas fa-file-invoice"></i>
        </button>
    @endif

    
    <form action="{{ route('barangs.destroy', $barang->BarangID) }}" 
          method="POST" 
          class="d-inline"
          onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" title="Hapus Barang">
            <i class="fas fa-trash-alt"></i>
        </button>
    </form>
</td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-muted">Belum ada data barang.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 <div class="d-flex justify-content-center">
                        {{ $barangs->links('pagination::simple-bootstrap-4') }}
                    </div>

<!-- JavaScript untuk efek alert -->
<script>
    // Menyembunyikan alert setelah 5 detik
    setTimeout(() => {
        const alert = document.getElementById('success-alert');
        if (alert) {
            alert.style.transition = "opacity 0.5s ease";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 500);
        }
    }, 5000);
</script>
</body>
</html>
@endsection
