<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Barang</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 20mm;
        }
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            page-break-inside: auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px 10px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #2c3e50;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 25px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
        .lokasi {
            font-size: 11px;
            line-height: 1.4;
        }
    </style>
</head>
<body>
    <h2>Daftar Barang Aset</h2>

    <table>
        <thead>
            <tr>
                <th style="width: 40px;">No</th>
                <th>Nama Aset</th>
                <th style="width: 100px;">Tanggal Perolehan</th>
                <th style="width: 100px;">Nilai Perolehan</th>
                <th style="width: 100px;">Sumber Dana</th>
                <th>Lokasi & Kuantitas</th>
                <th style="width: 150px;">Nama Penginput</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $i => $barang)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $barang->aset->NamaAset ?? '-' }}</td>
                    <td>{{ $barang->aset->TanggalPerolehan ?? '-' }}</td>
                    <td class="text-right">Rp {{ number_format($barang->aset->NilaiPerolehan ?? 0, 0, ',', '.') }}</td>
                    <td>{{ $barang->aset->Dana ?? '-' }}</td>
                    <td class="lokasi">
                        @if ($barang->lokasis->count() > 0)
                            @foreach ($barang->lokasis as $lokasi)
                                • {{ strtoupper($lokasi->LokasiBarang) }} ({{ $lokasi->Kuantitas }} unit)
                                @if (!$loop->last)<br>@endif
                            @endforeach
                        @else
                            <span class="text-muted">Tidak ada lokasi</span>
                        @endif
                    </td>
                    <td>{{ $barang->user->name ?? 'Tidak Diketahui' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak oleh: {{ auth()->user()->name ?? 'Sistem Aset' }}</p>
        <p>Tanggal: {{ \Carbon\Carbon::now()->format('d M Y, H:i') }}</p>
    </div>
</body>
</html>
