<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Barang - {{ $barang->aset->NamaAset ?? 'Aset' }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 13px;
            background-color: #f9fafb;
            color: #333;
            margin: 20px;
        }

        .header {
            text-align: center;
            background-color: #6366f1;
            color: white;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .header h2 {
            margin: 0;
            font-size: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 10px 12px;
            border: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background-color: #f3f4f6;
            width: 220px;
        }

        .section-title {
            font-weight: bold;
            font-size: 15px;
            color: #4f46e5;
            margin: 25px 0 10px;
            border-bottom: 2px solid #6366f1;
            display: inline-block;
            padding-bottom: 3px;
        }

        .location {
            background-color: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .location strong {
            color: #111827;
        }

        .images {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }

        .images img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 11px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>📋 Detail Barang</h2>
    </div>

    <table>
        <tr><th>Nama Aset</th><td>{{ $barang->aset->NamaAset ?? '-' }}</td></tr>
        <tr><th>Tanggal Perolehan</th><td>{{ $barang->aset->TanggalPerolehan ?? '-' }}</td></tr>
        <tr><th>Nilai Perolehan</th><td>Rp {{ number_format($barang->aset->NilaiPerolehan ?? 0, 0, ',', '.') }}</td></tr>
        <tr><th>Dana Dari</th><td>{{ $barang->aset->Dana ?? '-' }}</td></tr>
        <tr><th>Total Kuantitas</th><td>{{ $barang->lokasis->sum('Kuantitas') }} unit</td></tr>
        <tr><th>Nama Penginput</th><td>{{ $barang->user->name ?? 'Tidak Diketahui' }}</td></tr>
    </table>

    <h4 class="section-title">📍 Lokasi dan Kuantitas</h4>
    @if ($barang->lokasis->count() > 0)
        @foreach ($barang->lokasis as $lokasi)
            <div class="location">
                <strong>{{ strtoupper($lokasi->LokasiBarang) }}</strong>
                <span> — {{ $lokasi->Kuantitas }} unit</span>
            </div>
        @endforeach
    @else
        <p>Tidak ada data lokasi</p>
    @endif

    <h4 class="section-title">📸 Foto Barang</h4>
    @foreach ($barang->lokasis as $lokasi)
        @php $gambarArray = json_decode($lokasi->Gambar, true); @endphp
        @if (!empty($gambarArray))
            <p><strong>{{ strtoupper($lokasi->LokasiBarang) }}</strong></p>
            <div class="images">
                @foreach ($gambarArray as $gambar)
                    <img src="{{ public_path('storage/' . $gambar) }}" alt="Gambar">
                @endforeach
            </div>
        @endif
    @endforeach

    <footer>
        <p>Dicetak otomatis oleh Sistem Aset — {{ now()->format('d M Y, H:i') }}</p>
    </footer>
</body>
</html>
