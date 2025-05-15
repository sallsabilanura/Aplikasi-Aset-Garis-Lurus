@extends('dashboard')

@section('content')

    <title>Panduan Teknis Aset</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
    }

    .container {
        max-width: 1200px;
    }

    h2 {
        font-weight: bold;
        color: #333;
    }

    .table-search-wrapper {
        margin-bottom: 20px;
    }

    .table {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        font-size: 13px; /* tulisan kecil */
        border-width: 1px; /* border kecil */
    }

    .table th {
        background-color: rgb(161, 206, 255);
        color: white;
        text-align: center;
        font-size: 13px; /* tulisan kecil */
    }

    .table td {
        vertical-align: middle;
        text-align: center;
        font-size: 13px; /* tulisan kecil */
    }

    .table td, .table th {
        padding: 10px;
        border: 1px solid #ddd;
    }

    .table-striped tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .table-responsive {
        margin-top: 30px;
    }

    .table-wrapper {
        margin-top: 20px;
    }

    input.form-control {
        width: 100%;
        max-width: 300px;
        margin-bottom: 20px;
    }

    .table-search-wrapper {
        margin-top: 20px;
        margin-bottom: 30px;
        text-align: center;
    }

    .acuan-text {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 10px;
    }
</style>

</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Panduan Teknis Aset</h2>
    <p class="acuan">
        Acuan: Peraturan Menteri Keuangan Nomor 72 Tahun 2023 tentang Penyusutan Harta Berwujud dan/atau Amortisasi Harta Tak Berwujud
        <a href="https://jdih.kemenkeu.go.id/api/download/46cededa-86ae-4cc9-93e5-b6bef8892074/2023pmkeuangan072.pdf" target="_blank">
            (Unduh Dokumen PDF)
        </a>
    </p>

    <div class="table-search-wrapper">
        <input type="text" class="form-control" id="searchAset" placeholder="Cari nama aset..." onkeyup="searchAset()">
    </div>

    <div class="table-wrapper">
        <h5 class="mt-4">Kelompok: Elektronik</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="elektronik">
                <thead>
                    <tr>
                        <th>Nama Aset</th>
                        <th>Masa Ekonomis (Tahun)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Laptop</td><td>4</td></tr>
                    <tr><td>Printer</td><td>4</td></tr>
                    <tr><td>Proyektor</td><td>4</td></tr>
                    <tr><td>Scanner</td><td>4</td></tr>
                    <tr><td>Mesin Fotokopi</td><td>4</td></tr>
                    <tr><td>AC (Air Conditioner)</td><td>4</td></tr>
                    <tr><td>Televisi</td><td>4</td></tr>
                    <tr><td>Speaker Aktif</td><td>4</td></tr>
                    <tr><td>Router/Modem</td><td>4</td></tr>
                    <tr><td>UPS</td><td>4</td></tr>
                </tbody>
            </table>
        </div>

        <h5 class="mt-4">Kelompok: Perabotan</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="perabotan">
                <thead>
                    <tr>
                        <th>Nama Aset</th>
                        <th>Masa Ekonomis (Tahun)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Meja Kerja</td><td>8</td></tr>
                    <tr><td>Lemari Arsip</td><td>8</td></tr>
                    <tr><td>Kursi</td><td>8</td></tr>
                    <tr><td>Meja Rapat</td><td>8</td></tr>
                    <tr><td>Rak Buku</td><td>8</td></tr>
                    <tr><td>Filing Cabinet</td><td>8</td></tr>
                </tbody>
            </table>
        </div>

        <h5 class="mt-4">Kelompok: Peralatan</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="peralatan">
                <thead>
                    <tr>
                        <th>Nama Aset</th>
                        <th>Masa Ekonomis (Tahun)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Genset</td><td>8</td></tr>
                    <tr><td>Mesin Jahit</td><td>8</td></tr>
                    <tr><td>Kompor Gas</td><td>8</td></tr>
                    <tr><td>Mesin Cuci</td><td>8</td></tr>
                    <tr><td>Alat Pemotong Rumput</td><td>8</td></tr>
                </tbody>
            </table>
        </div>

        <h5 class="mt-4">Kelompok: Kendaraan</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="kendaraan">
                <thead>
                    <tr>
                        <th>Nama Aset</th>
                        <th>Masa Ekonomis (Tahun)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Sepeda Motor Dinas</td><td>4</td></tr>
                    <tr><td>Mobil Operasional</td><td>8</td></tr>
                    <tr><td>Truk Angkut</td><td>8</td></tr>
                    <tr><td>Bus</td><td>8</td></tr>
                    <tr><td>Mobil Ambulans</td><td>8</td></tr>
                </tbody>
            </table>
        </div>

        <h5 class="mt-4">Kelompok: Bangunan</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="bangunan">
                <thead>
                    <tr>
                        <th>Nama Aset</th>
                        <th>Masa Ekonomis (Tahun)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Gedung Kantor Permanen</td><td>20</td></tr>
                    <tr><td>Gedung Sementara</td><td>10</td></tr>
                    <tr><td>Gudang</td><td>20</td></tr>
                    <tr><td>Pos Satpam Sementara</td><td>10</td></tr>
                    <tr><td>Ruang Kelas</td><td>20</td></tr>
                    <tr><td>Laboratorium</td><td>20</td></tr>
                </tbody>
            </table>
        </div>

        <h5 class="mt-4">Kelompok: Infrastruktur</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped mb-5" id="infrastruktur">
                <thead>
                    <tr>
                        <th>Nama Aset</th>
                        <th>Masa Ekonomis (Tahun)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Jalan Setapak</td><td>20</td></tr>
                    <tr><td>Jaringan Air Bersih</td><td>20</td></tr>
                    <tr><td>Saluran Drainase</td><td>20</td></tr>
                    <tr><td>Jaringan Listrik</td><td>20</td></tr>
                    <tr><td>Jembatan Kecil</td><td>20</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
  function searchAset() {
    const searchValue = document.getElementById("searchAset").value.toLowerCase();
    const tables = document.querySelectorAll('table tbody');
    
    tables.forEach(table => {
        const rows = table.getElementsByTagName('tr');
        Array.from(rows).forEach(row => {
            const cells = row.getElementsByTagName('td');
            const namaAset = cells[0] ? cells[0].innerText.toLowerCase() : '';
            if (namaAset.includes(searchValue)) {
                row.style.display = ''; // Menampilkan baris jika nama aset cocok
            } else {
                row.style.display = 'none'; // Menyembunyikan baris jika nama aset tidak cocok
            }
        });
    });
}
</script>

@endsection