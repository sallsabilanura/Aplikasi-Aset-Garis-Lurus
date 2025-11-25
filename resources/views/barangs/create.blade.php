@extends('dashboard')
@section('content')

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h1 class="text-center mb-4">Tambah Barang</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <form action="{{ route('barangs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <h3 class="mb-3">Data Barang</h3>

                {{-- Pilih Aset --}}
                <div class="form-group mb-3">
                    <label for="AsetID">Nama Aset</label>
                    <select name="AsetID" id="AsetID" class="form-control" required>
                        <option value="">-- Pilih Aset --</option>
                        @foreach($asets as $aset)
                            <option value="{{ $aset->AsetID }}"
                                data-tanggal="{{ $aset->TanggalPerolehan }}"
                                data-harga="{{ number_format($aset->NilaiPerolehan, 0, ',', '.') }}"
                                data-dana="{{ $aset->Dana }}"
                                data-kuantitas="{{ $aset->Kuantitas }}">
                                {{ $aset->NamaAset }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Detail Aset --}}
                <div id="aset-info" class="border rounded p-3 mb-3 bg-light" style="display:none;">
                    <h5>Detail Aset</h5>
                    <p><strong>Tanggal Perolehan:</strong> <span id="info-tanggal">-</span></p>
                    <p><strong>Harga / Nilai Perolehan:</strong> <span id="info-harga">-</span></p>
                    <p><strong>Dana Dari:</strong> <span id="info-dana">-</span></p>
                    <p><strong>Kuantitas Aset:</strong> <span id="info-kuantitas">-</span></p>
                </div>

                {{-- Lokasi Barang --}}
                <h4 class="mt-4 mb-2">Lokasi Barang</h4>
                <div id="lokasi-container">
                    <div class="lokasi-item mb-3 border p-3 rounded">
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label>Lokasi Barang</label>
                                <input type="text" name="LokasiBarang[]" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Kuantitas</label>
                                <input type="number" name="Kuantitas[]" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Upload Gambar</label>
                                <input type="file" name="Gambar[]" class="form-control" accept="image/*" multiple>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" id="add-lokasi" class="btn btn-success btn-sm mb-3">
                    + Tambah Lokasi
                </button>

                {{-- Upload Invoice --}}
                <div class="form-group mb-3">
                    <label for="Invoice" class="form-label">Upload Invoice (opsional)</label>
                    <input type="file" name="Invoice" id="Invoice" class="form-control" accept="image/*">
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script --}}
<script>
    const asetSelect = document.getElementById('AsetID');
    const asetInfo = document.getElementById('aset-info');
    const infoTanggal = document.getElementById('info-tanggal');
    const infoHarga = document.getElementById('info-harga');
    const infoDana = document.getElementById('info-dana');
    const infoKuantitas = document.getElementById('info-kuantitas');

    asetSelect.addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        const tanggal = selected.getAttribute('data-tanggal');
        const harga = selected.getAttribute('data-harga');
        const dana = selected.getAttribute('data-dana');
        const kuantitas = selected.getAttribute('data-kuantitas');

        if (tanggal && harga && dana && kuantitas) {
            asetInfo.style.display = 'block';
            infoTanggal.textContent = tanggal;
            infoHarga.textContent = harga;
            infoDana.textContent = dana;
            infoKuantitas.textContent = kuantitas;
            asetSelect.dataset.kuantitasTerpilih = kuantitas;
        } else {
            asetInfo.style.display = 'none';
            asetSelect.dataset.kuantitasTerpilih = 0;
        }
    });

    // Tambah lokasi barang dinamis
    document.getElementById('add-lokasi').addEventListener('click', () => {
        const container = document.getElementById('lokasi-container');
        const div = document.createElement('div');
        div.classList.add('lokasi-item', 'mb-3', 'border', 'p-3', 'rounded');
        div.innerHTML = `
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label>Lokasi Barang</label>
                    <input type="text" name="LokasiBarang[]" class="form-control" required>
                </div>
                <div class="col-md-4 mb-2">
                    <label>Kuantitas</label>
                    <input type="number" name="Kuantitas[]" class="form-control" required>
                </div>
                <div class="col-md-4 mb-2">
                    <label>Upload Gambar</label>
                    <input type="file" name="Gambar[]" class="form-control" accept="image/*" multiple>
                </div>
            </div>
        `;
        container.appendChild(div);
    });

    // Validasi kuantitas total sebelum submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const kuantitasAset = parseInt(asetSelect.dataset.kuantitasTerpilih || 0);
        const kuantitasInputs = document.querySelectorAll('input[name="Kuantitas[]"]');
        let total = 0;

        kuantitasInputs.forEach(input => {
            total += parseInt(input.value || 0);
        });

        // ✅ Validasi: total harus sama dengan kuantitas aset
        if (total !== kuantitasAset) {
            e.preventDefault();
            const pesan = total > kuantitasAset
                ? `Total kuantitas lokasi (${total}) melebihi kuantitas aset (${kuantitasAset})!`
                : `Total kuantitas lokasi (${total}) kurang dari kuantitas aset (${kuantitasAset})!`;
            alert(pesan);
        }
    });
</script>

@endsection
