@extends('dashboard')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Aset</title>
    <!-- Link Bootstrap CSS -->
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 700px;
        }

        .card {
            border: none;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 2rem;
        }

        .card-title {
            font-size: 1.75rem;
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .asset-info .form-group {
            margin-bottom: 1.25rem;
        }

        .asset-info label {
            font-weight: 600;
            color: #555;
        }

        .form-control {
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            padding: 0.75rem;
            font-size: 1rem;
            color: #333;
        }

        .btn {
            border-radius: 5px;
            padding: 0.75rem;
            font-size: 1rem;
            width: 100%;
        }

        .btn-print {
            background-color: #007bff;
            color: #fff;
            margin-top: 1rem;
        }

        .btn-back {
            background-color: #6c757d;
            color: #fff;
            margin-top: 1rem;
        }

        .qr-code {
            text-align: center;
            margin: 2rem 0;
        }

        /* QR Code Styling */
        .qr-frame {
            display: inline-block;
            padding: 10px;
            background: #ffffff;
            border: 3px solid #007bff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .qr-code canvas {
            width: 200px !important;
            height: 200px !important;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="card-title">Detail Aset</h2>

                <!-- QR Code Section -->
                <div class="qr-code">
                    <div class="qr-frame">
                        {!! $qrCode !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="KodeAset">Kode Aset</label>
                    <div class="form-control" id="KodeAset">{{ $aset->KodeAset }}</div>
                </div>
                <div class="form-group">
                    <label for="NamaAset">Nama Aset</label>
                    <div class="form-control" id="NamaAset">{{ $aset->NamaAset }}</div>
                </div>
                <div class="form-group">
                    <label for="NilaiPerolehan">Nilai Perolehan</label>
                    <div class="form-control" id="NilaiPerolehan">
                        {{ number_format($aset->NilaiPerolehan, 0, ',', '.') }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="NilaiResidu">Nilai Residu</label>
                    <div class="form-control" id="NilaiResidu">
                        {{ number_format($aset->NilaiResidu, 0, ',', '.') }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="MasaManfaat">Masa Manfaat</label>
                    <div class="form-control" id="MasaManfaat">{{ $aset->MasaManfaat }} tahun</div>
                </div>
                <div class="form-group">
                    <label for="TanggalPerolehan">Tanggal Perolehan</label>
                    <div class="form-control" id="TanggalPerolehan">{{ $aset->TanggalPerolehan }}</div>
                </div>
                <div class="form-group">
                    <label for="LokasiAset">Lokasi Aset</label>
                    <div class="form-control" id="LokasiAset">{{ $aset->LokasiAset }}</div>
                </div>

                <div class="form-group">
                    <label for="MasaSelesai">Masa Selesai</label>
                    <div class="form-control" id="MasaSelesai">
                        {{ \Carbon\Carbon::parse($aset->TanggalPerolehan)->addYears($aset->MasaManfaat)->format('d-m-Y') }}
                    </div>
                </div>

                <!-- Button to print QR Code -->
                <button class="btn btn-print" onclick="printQRCode()">Cetak QR Code</button>

                <!-- Button to return to index -->
                <a href="{{ route('asets.index') }}" class="btn btn-back">Kembali</a>
            </div>
        </div>
    </div>

    <!-- Link Bootstrap JS -->
    <!-- QR Code Library -->
    <script>
        function printQRCode() {
            var printContents = document.querySelector('.qr-code').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</body>

</html>
@endsection