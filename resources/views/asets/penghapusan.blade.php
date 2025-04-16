@extends('dashboard')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Aset</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Daftar Aset</h1>

        <!-- Success Message -->
        @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
        @endif

       <!-- Add Asset Button and Search Form -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('asets.penghapusan') }}">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Cari Nama/Kode Aset</label>
                    <input type="text" name="search" class="form-control" placeholder="Cari Aset" value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value=""> Pilih Status </option>
                        <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Tidak Aktif" {{ request('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                @if(auth()->user()->role == 'Admin')
                <div class="col-md-3">
                    <label class="form-label">Instansi</label>
                    <select name="instansi" class="form-select">
                        <option value=""> Pilih Instansi </option>
                        @foreach($instansis as $instansi)
                            <option value="{{ $instansi->id }}" {{ request('instansi') == $instansi->id ? 'selected' : '' }}>
                                {{ $instansi->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div class="col-md-2 d-flex gap-2">
                    <button class="btn btn-primary w-100" type="submit" name="filter" value="search">Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>


        <!-- Asset Table Inside a Card -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Aset</th>
                                <th>Kode Aset</th>
                                <th>Masa Manfaat</th>
                                <th>Tanggal Perolehan</th>
                                <th>Nama Instansi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asets as $aset)
                            <tr>
                                <td>{{ $loop->iteration + ($asets->currentPage() - 1) * $asets->perPage() }}</td>
                                <td>{{ $aset->NamaAset }}</td>
                                <td>{{ $aset->KodeAset }}</td>
                                <td>{{ $aset->MasaManfaat }}</td>
                                <td>{{ $aset->TanggalPerolehan }}</td>
                                <td>{{ $aset->user->name ?? 'Tidak Diketahui' }}</td>

                                <td>
                                    <input type="checkbox" class="status-checkbox" data-id="{{ $aset->AsetID }}"
                                        {{ $aset->Status == 'Tidak Aktif' ? 'checked' : '' }}
                                        {{ $aset->MasaManfaat <= 0 ? 'disabled' : '' }}>

                                    <span class="status-text 
          {{ $aset->MasaManfaat <= 0 ? 'text-danger' : ($aset->Status == 'Tidak Aktif' ? 'text-warning' : 'text-success') }}">
                                        {{ $aset->MasaManfaat <= 0 ? 'Habis Masa Manfaat' : ($aset->Status == 'Tidak Aktif' ? 'Tidak Aktif' : 'Aktif') }}
                                    </span>
                                </td>




                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-center">
                        {{ $asets->links('pagination::simple-bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Auto-hide alert script -->
        <script>
            // Hapus alert setelah 5 detik
            setTimeout(function() {
                let alert = document.querySelector('.alert');
                if (alert) {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500); // Menghapus elemen dari DOM
                }
            }, 5000);
        </script>

        <!-- Link Bootstrap JS -->

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.status-checkbox').on('change', function() {
                    let asetID = $(this).data('id');
                    let status = $(this).is(':checked') ? 'Tidak Aktif' : 'Aktif'; // Dibalik logikanya

                    $.ajax({
                        url: "{{ route('asets.updateStatus') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            AsetID: asetID,
                            Status: status
                        },
                        success: function(response) {
                            alert(response.message);
                        },
                        error: function(xhr) {
                            alert("Terjadi kesalahan!");
                        }
                    });
                });
            });
        </script>


    </div>
</body>

</html>
@endsection