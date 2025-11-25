<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Penyusutan - {{ $penyusutan->aset->NamaAset ?? 'Aset' }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 25px;
            background-color: #f9fafb;
        }

        .header {
            text-align: center;
            background-color: #2563eb;
            color: white;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 25px;
        }

        h2 {
            margin: 0;
            font-size: 18px;
        }

        h4 {
            color: #374151;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: white;
        }

        th, td {
            padding: 8px 10px;
            border: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background-color: #f3f4f6;
        }

        .text-primary {
            color: #1d4ed8;
        }

        .text-danger {
            color: #dc2626;
        }

        .fw-bold {
            font-weight: bold;
        }

        footer {
            text-align: center;
            margin-top: 35px;
            font-size: 11px;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>📉 Detail Penyusutan Aset</h2>
        <p>Nama Aset: <strong>{{ $penyusutan->aset->NamaAset ?? '-' }}</strong></p>
    </div>

    <!-- Informasi Aset -->
    <h4 class="fw-bold text-primary">Informasi Aset</h4>
    <table>
        <tr>
            <th>Nama Aset</th>
            <td>{{ $penyusutan->aset->NamaAset ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tanggal Perolehan</th>
            <td>{{ $penyusutan->aset->TanggalPerolehan ?? '-' }}</td>
        </tr>
        <tr>
            <th>Nilai Perolehan</th>
            <td>Rp {{ number_format($penyusutan->aset->NilaiPerolehan ?? 0, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Dana Dari</th>
            <td>{{ $penyusutan->aset->Dana ?? '-' }}</td>
        </tr>
        <tr>
            <th>Total Kuantitas</th>
            <td>{{ $penyusutan->aset->Kuantitas ?? 0 }} unit</td>
        </tr>
        <tr>
            <th>Nama Instansi / Penginput</th>
            <td>{{ $penyusutan->aset->user->name ?? 'Tidak Diketahui' }}</td>
        </tr>
    </table>

    <!-- Rincian Penyusutan -->
    <h4 class="fw-bold text-primary">Rincian Penyusutan per Tahun</h4>
    <table>
        <thead>
            <tr>
                <th style="width: 20%">Tahun</th>
                <th style="width: 26%">Nilai Awal</th>
                <th style="width: 27%">Penyusutan Tahunan</th>
                <th style="width: 27%">Nilai Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rincian as $data)
            <tr>
                <td class="fw-bold">{{ $data['tahun'] }}</td>
                <td>Rp {{ number_format($data['nilai_awal'], 0, ',', '.') }}</td>
                <td class="text-danger">Rp {{ number_format($data['penyusutan'], 0, ',', '.') }}</td>
                <td class="text-primary fw-bold">Rp {{ number_format($data['nilai_akhir'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <footer>
        Dicetak otomatis oleh <strong>Sistem Aset</strong> — {{ now()->format('d M Y, H:i') }}
    </footer>

</body>
</html>
