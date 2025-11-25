<!DOCTYPE html>
<html>
<head>
    <title>Daftar Aset</title>
    <style>
        /* Global Styles */
        @page {
            size: A4 landscape;
            margin: 20mm;
        }
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

        /* Dokumentasi Gambar Aset Styles */
        h3 {
            margin-top: 30px;
            margin-bottom: 20px;
            color: #2c3e50;
            font-size: 18px;
            page-break-before: always;
        }
        
        .container-aset {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 15px;
        }
        
        .card-aset {
            width: calc(50% - 8px);
            border: 1px solid #ddd;
            border-radius: 6px;
            background: #fafafa;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            page-break-inside: avoid;
            margin-bottom: 15px;
        }
        
        .konten-aset {
            display: flex;
            align-items: flex-start;
            padding: 12px;
            min-height: 140px;
        }
        
        .gambar-aset {
            flex-shrink: 0;
            width: 120px;
            height: 120px;
            margin-right: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fff;
        }
        
        .gambar-aset img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .gambar-aset .placeholder {
            color: #999;
            font-size: 10px;
            text-align: center;
            padding: 8px;
        }
        
        .info-aset {
            flex-grow: 1;
        }
        
        .nama-aset {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 6px;
            color: #2c3e50;
        }
        
        .lokasi-aset {
            font-size: 11px;
            color: #555;
            margin-bottom: 8px;
            font-weight: bold;
        }
        
        .detail-aset {
            font-size: 10px;
            color: #666;
            line-height: 1.3;
        }
        
        .detail-item {
            margin-bottom: 3px;
        }
        
        /* Untuk memastikan tidak terpotong di PDF */
        .page-break {
            page-break-before: always;
        }
        
        /* Responsif untuk PDF */
        @media print {
            .card-aset {
                page-break-inside: avoid;
            }
            
            h3 {
                page-break-before: always;
            }
        }
    </style>
</head>
<body>

    <h2>Daftar Aset</h2>
    
    @if (isset($kategoriOptions) && count($kategoriOptions) > 0)
        <p><strong>Kategori: </strong>{{ $kategoriOptions->where('id', request('kategori'))->first()->NamaKategori ?? 'Semua Kategori' }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Aset</th>
                <th>Kategori</th>
                <th>Qty</th>
                <th>Dana</th>
                <th>Tanggal Perolehan</th>
                <th>Nilai Perolehan</th>
                <th>Manfaat</th>
                <th>Lokasi Aset</th>
                <th>Keterangan</th>
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
                <td>{{ $aset->TanggalPerolehan }}</td>
                <td class="currency">Rp {{ number_format($aset->NilaiPerolehan, 0, ',', '.') }}</td>
                <td>{{ $aset->MasaManfaat }} th</td>
                <td>{{ $aset->LokasiAset }}</td>
                <td>{{ $aset->Program }}</td>
                <td>{{ $aset->user->name ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Dokumentasi Gambar Aset</h3>

    <div class="container-aset">
        @foreach ($asets as $index => $aset)
            @php
                $lokasiNama = 'Tidak ada lokasi';
                $gambar = null;

                if($aset->barang && $aset->barang->lokasis->count() > 0) {
                    $lokasiFirst = $aset->barang->lokasis->first();
                    $lokasiNama = $lokasiFirst->NamaLokasi ?? 'Lokasi';

                    $gambarArray = json_decode($lokasiFirst->Gambar, true);
                    if (!empty($gambarArray) && isset($gambarArray[0])) {
                        $gambar = $gambarArray[0];
                    }
                }
            @endphp

            <div class="card-aset">
                <div class="konten-aset">
                    <div class="gambar-aset">
                        @if($gambar)
                            <img src="{{ public_path('storage/' . $gambar) }}" alt="Gambar Aset">
                        @else
                            <div class="placeholder">Tidak ada gambar</div>
                        @endif
                    </div>
                    <div class="info-aset">
                        <div class="nama-aset">{{ $aset->NamaAset }}</div>
                        <div class="lokasi-aset">📍 {{ $lokasiNama }}</div>
                        <div class="detail-aset">
                            <div class="detail-item"><strong>Kategori:</strong> {{ $aset->kategori->NamaKategori ?? '-' }}</div>
                            <div class="detail-item"><strong>Qty:</strong> {{ $aset->Kuantitas }}</div>
                            <div class="detail-item"><strong>Tanggal:</strong> {{ $aset->TanggalPerolehan }}</div>
                            <div class="detail-item"><strong>Nilai:</strong> Rp {{ number_format($aset->NilaiPerolehan, 0, ',', '.') }}</div>
                            <div class="detail-item"><strong>Manfaat:</strong> {{ $aset->MasaManfaat }} tahun</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tambah page break setiap 6 card (3 baris) --}}
            @if(($index + 1) % 6 == 0)
                <div style="page-break-after: always;"></div>
            @endif
        @endforeach
    </div>

    <div class="footer">
        <p>Dicetak oleh: {{ auth()->user()->name }}</p>
        <p>Tanggal: {{ \Carbon\Carbon::now()->toFormattedDateString() }}</p>
    </div>

</body>
</html>