<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penyusutan Tahun {{ $tahun }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
            font-size: 20px;
            font-weight: bold;
        }

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

        .currency {
            text-align: right;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>

    <h2>Laporan Penyusutan Tahun {{ $tahun }}</h2>
    <div class="footer">
        <p>Dicetak oleh: {{ auth()->user()->name }}</p>
        <p>Tanggal: {{ \Carbon\Carbon::now()->toFormattedDateString() }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Aset</th>
                <th>Kode Aset</th>
                <th>Tahun Penyusutan</th>
                <th>Nilai Awal</th>
                <th>Penyusutan Tahunan</th>
                <th>Nilai Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penyusutan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->aset->NamaAset ?? '-' }}</td>
                <td>{{ $item->aset->KodeAset ?? '-' }}</td>
                <td>{{ $item->TahunPenyusutan }}</td>
                <td class="currency">Rp {{ number_format($item->NilaiAwal, 0, ',', '.') }}</td>
                <td class="currency">Rp {{ number_format($item->PenyusutanTahunan, 0, ',', '.') }}</td>
                <td class="currency">Rp {{ number_format($item->NilaiAkhir, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    

</body>
</html>
