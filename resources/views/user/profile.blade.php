@extends('dashboard')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg p-4">
                <div class="card-body text-center">
                    <h4 class="mb-4 fw-bold">Profil Pengguna</h4>
                    <div class="mb-3 d-flex justify-content-center">
                        <img id="profilePreview" src="{{ asset('storage/' . $user->Gambar) }}" 
                            alt="Profile Picture" 
                            class="img-thumbnail rounded-circle shadow-lg" 
                            style="width: 150px; height: 150px; object-fit: cover; cursor: pointer;" 
                            data-bs-toggle="modal" data-bs-target="#profilePictureModal">
                    </div>
                    <p class="mt-2">
                        <a href="#" class="text-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#changeProfileModal">Ubah Foto Profil</a>
                    </p>

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @php
                        $fields = [
                        'name' => 'Name',
                        'email' => 'Email',
                        'Alamat' => 'Alamat',
                        'NoTelp' => 'No. Telepon',
                        'NamaPetugas' => 'Nama Petugas',
                        'Jabatan' => 'Jabatan'
                        ];
                        @endphp

                        @foreach ($fields as $key => $label)
                        <div class="mb-3 text-start">
                            <label for="{{ $key }}" class="form-label fw-bold">{{ $label }}</label>
                            <input type="text" class="form-control shadow-sm" id="{{ $key }}" name="{{ $key }}" value="{{ $user->$key }}" {{ $key == 'email' || $key == 'Jabatan' ? 'readonly' : '' }}>
                        </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ubah Foto Profil -->
<div class="modal fade" id="changeProfileModal" tabindex="-1" aria-labelledby="changeProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Foto Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="file" class="form-control shadow-sm" name="Gambar" accept="image/*" onchange="previewImage(event)">
                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('profilePreview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
