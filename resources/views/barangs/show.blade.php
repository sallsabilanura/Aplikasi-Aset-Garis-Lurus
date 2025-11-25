@extends('dashboard')
@section('content')

<style>
    body {
        background-color: #f5f5f5;
        font-family: 'Arial', sans-serif;
    }

    .container {
        max-width: 850px;
    }

    .card {
        border: none;
        border-radius: 12px;
        background-color: #ffffff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .card-header {
        background-color: #6366f1;
        color: white;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        font-weight: bold;
        padding: 1rem 1.25rem;
    }

    .table th {
        width: 240px;
        background-color: #f8f9fa;
    }

    .table td, .table th {
        vertical-align: middle !important;
    }

    .img-preview {
        width: 130px;
        height: 130px;
        object-fit: cover;
        border-radius: 10px;
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .img-preview:hover {
        transform: scale(1.05);
    }

    .location-box {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 0.8rem 1rem;
        background-color: #f9fafb;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .modal-content {
        background: transparent;
        border: none;
    }

    .modal-body img {
        border-radius: 10px;
    }

    .btn-back {
        background-color: #6c757d;
        color: #fff;
        border-radius: 5px;
    }

    .btn-back:hover {
        background-color: #5a6268;
    }
</style>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-white">{{ $barang->aset->NamaAset ?? 'Detail Barang' }}</h4>
        </div>

        <div class="card-body">
            {{-- Detail Barang --}}
            <table class="table table-bordered mb-4">
                <tr>
                    <th>Nama Aset</th>
                    <td>{{ $barang->aset->NamaAset ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Perolehan</th>
                    <td>{{ $barang->aset->TanggalPerolehan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nilai Perolehan</th>
                    <td>Rp {{ number_format($barang->aset->NilaiPerolehan ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Dana Dari</th>
                    <td>{{ $barang->aset->Dana ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Total Kuantitas</th>
                    <td>{{ $barang->lokasis->sum('Kuantitas') }} unit</td>
                </tr>
                <tr>
                    <th>Nama Instansi / Penginput</th>
                    <td>{{ $barang->user->name ?? 'Tidak Diketahui' }}</td>
                </tr>
                <tr>
                    <th>Invoice</th>
                    <td>
                        @if ($barang->Invoice)
                            <button class="btn btn-outline-primary btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#invoiceModal">
                                <i class="fas fa-file-invoice"></i> Lihat Invoice
                            </button>

                            <!-- Modal Invoice -->
                            <div class="modal fade" id="invoiceModal" tabindex="-1" aria-hidden="true">
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
                            <span class="text-muted">Tidak ada invoice</span>
                        @endif
                    </td>
                </tr>
            </table>

            {{-- Lokasi & Kuantitas --}}
            <h5 class="fw-bold mb-3 text-primary border-bottom pb-2">📍 Lokasi dan Kuantitas</h5>
            @if ($barang->lokasis->count() > 0)
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($barang->lokasis as $lokasi)
                        <div class="location-box">
                            <strong>{{ strtoupper($lokasi->LokasiBarang) }}</strong>
                            <span class="text-muted"> - {{ $lokasi->Kuantitas }} unit</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">Belum ada data lokasi</p>
            @endif

            {{-- Foto Barang per Lokasi --}}
          {{-- Foto Barang per Lokasi --}}
<h5 class="fw-bold mb-3 text-primary border-bottom pb-2 mt-4">📸 Foto Barang per Lokasi</h5>
@if ($barang->lokasis->count() > 0)
    <div class="d-flex flex-column gap-3">
        @foreach($barang->lokasis as $lokasi)
            <div class="d-flex align-items-center border rounded-4 shadow-sm p-3 bg-light">
                @php
                    $gambarArray = json_decode($lokasi->Gambar, true);
                @endphp

                @if (!empty($gambarArray))
                    @foreach ($gambarArray as $gambar)
                        <img src="{{ asset('storage/' . $gambar) }}" 
                             alt="{{ $barang->aset->NamaAset ?? 'Barang' }}" 
                             class="img-preview me-3"
                             data-bs-toggle="modal" 
                             data-bs-target="#gambarModal{{ $lokasi->id }}">
                    @endforeach
                @else
                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded-3 me-3"
                         style="width: 120px; height: 120px;">
                        No Image
                    </div>
                @endif

                <!-- Modal Zoom -->
                <div class="modal fade" id="gambarModal{{ $lokasi->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-body text-center p-0">
                                @if (!empty($gambarArray))
                                    @foreach ($gambarArray as $gambar)
                                        <img src="{{ asset('storage/' . $gambar) }}" 
                                             alt="{{ $barang->aset->NamaAset ?? 'Barang' }}" 
                                             class="img-fluid rounded shadow-lg mb-3">
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h6 class="mb-1 text-primary fw-bold">{{ strtoupper($lokasi->LokasiBarang) }}</h6>
                    <p class="mb-0 text-muted">Jumlah: {{ $lokasi->Kuantitas }} unit</p>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p class="text-muted text-center">Belum ada gambar / lokasi</p>
@endif

           <div class="mt-4 text-center d-flex justify-content-center gap-2">
    <a href="{{ route('barangs.index') }}" class="btn btn-back px-4">← Kembali ke Daftar Barang</a>

    <a href="{{ route('barangs.exportPdfShow', $barang->BarangID) }}" 
       class="btn btn-danger px-4" target="_blank">
       <i class="fas fa-file-pdf"></i> Export PDF (Detail)
    </a>
</div>

        </div>
    </div>
</div>
@endsection
