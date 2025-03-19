@extends('dashboard')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">Daftar Testimonial</h1>

        @can('is-admin')
        <a href="{{ route('testimonials.create') }}" class="btn btn-primary">
            + Beri Testimonial
        </a>
        @endcan

        @can('is-instansi')
        @if(!$userHasTestimonial)
        <a href="{{ route('testimonials.create') }}" class="btn btn-primary">
            + Beri Testimonial
        </a>
        @else
        <span class="text-muted">Anda sudah memberikan testimonial.</span>
        @endif
        @endcan
    </div>

    @can('is-admin')
    <div class="mt-3 text-center"> <!-- DITENGAHKAN -->
        <h4>Rata-rata rating:
            <span class="text-warning">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <=round($averageRating))
                    ★
                    @else
                    ☆
                    @endif
                    @endfor
                    </span>
                    ({{ number_format($averageRating, 1) }}/5)
        </h4>
    </div>
    @endcan

    <div class="row mt-4">
        @foreach($testimonials as $testimonial)
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="fw-semibold">{{ $testimonial->Riview }}</p>
                    <p class="text-warning">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <=$testimonial->Rating)
                            ★
                            @else
                            ☆
                            @endif
                            @endfor
                    </p>
                    <small class="text-muted">Oleh: {{ $testimonial->user->name }}</small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection