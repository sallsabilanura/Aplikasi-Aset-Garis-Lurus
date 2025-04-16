<!DOCTYPE html>
<html>

<head>
    <title>Laporan Aset Tahun {{ $tahun }}</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Laporan Aset Tahun {{ $tahun }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Aset</th>
                <th>Kode Aset</th>
                <th>Kategori</th>
                <th>Nilai Perolehan</th>
                <th>Tanggal Perolehan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asets as $key => $aset)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $aset->NamaAset }}</td>
                <td>{{ $aset->KodeAset }}</td>
                <td>{{ $aset->kategori->NamaKategori ?? 'Tidak ada kategori' }}</td>
                <td>Rp {{ number_format($aset->NilaiPerolehan, 0, ',', '.') }}</td>
                <td>{{ $aset->TanggalPerolehan }}</td>
                <td>{{ $aset->Status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>