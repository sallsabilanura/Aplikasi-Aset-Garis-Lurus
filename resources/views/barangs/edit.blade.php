@extends('dashboard')
@section('content')

<div class="container mt-5">
    <!-- Card untuk Edit Barang -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <h1 class="text-center mb-4 fw-bold text-primary">Edit Data Barang</h1>

            <form action="{{ route('barangs.update', $barang->BarangID) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <h3 class="mb-3">Data Barang</h3>

                <div class="form-group mb-3">
                    <label for="NamaBarang" class="form-label">Nama Barang</label>
                    <input type="text" name="NamaBarang" id="NamaBarang" class="form-control"
                           value="{{ old('NamaBarang', $barang->NamaBarang) }}" required>
                    @error('NamaBarang')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="Tanggal" class="form-label">Tanggal</label>
                    <input type="date" id="Tanggal" name="Tanggal" class="form-control"
                           value="{{ old('Tanggal', $barang->Tanggal) }}" required>
                    @error('Tanggal')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="HargaFormatted" class="form-label">Harga</label>
                    <input type="text" id="HargaFormatted" class="form-control"
                           value="{{ number_format($barang->Harga, 0, ',', '.') }}" required>
                    <input type="hidden" name="Harga" id="Harga" value="{{ $barang->Harga }}">
                    @error('Harga')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="DanaDari" class="form-label">Dana Dari</label>
                    <input type="text" name="DanaDari" id="DanaDari" class="form-control"
                           value="{{ old('DanaDari', $barang->DanaDari) }}" required>
                    @error('DanaDari')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <h4 class="mt-4 mb-2">Lokasi Barang</h4>
                <div id="lokasi-container">
                    @foreach ($barang->lokasis as $lokasi)
                        <div class="lokasi-item mb-3 border p-3 rounded-3 bg-light">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label>Lokasi Barang</label>
                                    <input type="text" name="LokasiBarang[]" class="form-control"
                                           value="{{ $lokasi->LokasiBarang }}" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Kuantitas</label>
                                    <input type="number" name="Kuantitas[]" class="form-control"
                                           value="{{ $lokasi->Kuantitas }}" required>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" id="add-lokasi" class="btn btn-success btn-sm mb-3">
                    + Tambah Lokasi
                </button>

               
               
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-4">💾 Simpan Perubahan</button>
                    <a href="{{ route('barangs.index') }}" class="btn btn-secondary px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script untuk tambah lokasi baru --}}
<script>
document.getElementById('add-lokasi').addEventListener('click', () => {
    const container = document.getElementById('lokasi-container');
    const div = document.createElement('div');
    div.classList.add('lokasi-item', 'mb-3', 'border', 'p-3', 'rounded-3', 'bg-light');
    div.innerHTML = `
        <div class="row">
            <div class="col-md-6 mb-2">
                <label>Lokasi Barang</label>
                <input type="text" name="LokasiBarang[]" class="form-control" required>
            </div>
            <div class="col-md-6 mb-2">
                <label>Kuantitas</label>
                <input type="number" name="Kuantitas[]" class="form-control" required>
            </div>
        </div>
    `;
    container.appendChild(div);
});
</script>

{{-- Script format harga ke rupiah --}}
<script>
document.getElementById('HargaFormatted').addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value) {
        e.target.value = new Intl.NumberFormat('id-ID').format(value);
        document.getElementById('Harga').value = value;
    } else {
        e.target.value = '';
        document.getElementById('Harga').value = '';
    }
});
</script>

@endsection
