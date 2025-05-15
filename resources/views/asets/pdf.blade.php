<!DOCTYPE html>
<html>
<head>
    <title>Daftar Aset</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
        }

        /* Center Title */
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
            font-size: 20px;
            font-weight: bold;
        }

        /* Category Info */
        p {
            font-size: 14px;
            margin: 0 0 15px 0;
            color: #555;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #ddd;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
            font-weight: bold;
        }

        td {
            background-color: #f9f9f9;
        }

        tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        /* Format Currency */
        .currency {
            text-align: right;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>

    <h2>Daftar Aset</h2>
    
    @if (isset($kategoriOptions) && count($kategoriOptions) > 0)
        <p><strong>Kategori: </strong>{{ $kategoriOptions->where('id', request('kategori'))->first()->NamaKategori ?? 'Semua Kategori' }}</p>
    @endif

    <div class="footer">
        <p>Dicetak oleh: {{ auth()->user()->name }}</p>
        <p>Tanggal: {{ \Carbon\Carbon::now()->toFormattedDateString() }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Aset</th>
                <th>Kategori</th>
                <th>Qty</th>
                <th>Dana</th>
                <th>Program</th>
                <th>Tanggal Perolehan</th>
                <th>Nilai</th>
                <th>Manfaat</th>
                <th>Instansi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asets as $i => $aset)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $aset->NamaAset }}</td>
                <td>{{ $aset->kategori->NamaKategori ?? '-' }}</td>
                <td>{{ $aset->Kuantitas }}</td>
                <td>{{ $aset->Dana }}</td>
                <td>{{ $aset->Program }}</td>
                <td>{{ $aset->TanggalPerolehan }}</td>
                <td class="currency">Rp {{ number_format($aset->NilaiPerolehan, 0, ',', '.') }}</td>
                <td>{{ $aset->MasaManfaat }} th</td>
                <td>{{ $aset->user->name ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>


</body>
</html>
