<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Daftar Penghapusan Aset</h1>

        <!-- Pesan sukses jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <!-- Tabel untuk menampilkan data PenghapusanAset -->
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Aset</th>
                    <th>Kode Aset</th>
                    <th>Masa Manfaat</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach($penghapusan as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->Aset->NamaAset }}</td>
        <td>{{ $item->Aset->KodeAset }}</td>
        <td>{{ $item->Aset->kategori->NamaKategori ?? 'Tidak ada kategori' }}</td>
        <td>{{ $item->Aset->MasaManfaat }}</td>
        <td>
            @php
                $masaManfaatHabis = \Carbon\Carbon::now()->greaterThanOrEqualTo(\Carbon\Carbon::parse($item->Aset->MasaManfaat));
            @endphp
            <input type="checkbox" disabled {{ $masaManfaatHabis ? 'checked' : '' }}>
        </td>
    </tr>
@endforeach

            </tbody>
        </table>
    </div>
</body>
</html>
