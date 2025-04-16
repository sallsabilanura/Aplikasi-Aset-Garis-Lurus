@extends('dashboard')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h1 class=" text-center">Tambah Testimonial</h1>

            <form action="{{ route('testimonials.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="review" class="form-label">Review:</label>
                    <textarea name="Riview" id="review" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rating:</label>
                    <div class="d-flex gap-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <input type="radio" class="btn-check" name="Rating" id="star{{ $i }}" value="{{ $i }}" required>
                            <label class="btn btn-outline-warning" for="star{{ $i }}">{{ str_repeat('⭐️', $i) }}</label>
                            @endfor
                    </div>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>


        </div>
    </div>
</div>
@endsection