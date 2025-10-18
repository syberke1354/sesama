@extends('layouts.public')

@section('title', 'Program - Berbagi Asa')

@section('content')

<section class="hero-section" style="padding: 80px 0;">
    <div class="container position-relative">
        <div class="text-center">
            <h1 class="display-4 fw-bold mb-3">Program Kami</h1>
            <p class="lead">Bergabunglah dalam program-program kami untuk Indonesia yang lebih baik</p>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        @if(count($programs) === 0)
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                <p class="text-muted">Belum ada program tersedia saat ini</p>
            </div>
        @else
            <div class="row g-4">
                @foreach($programs as $program)
                    <div class="col-md-6 col-lg-4">
                        <div class="card-program h-100">
                            @if($program['image_url'])
                                <div style="height: 200px; overflow: hidden; border-radius: 12px 12px 0 0;">
                                    <img src="{{ $program['image_url'] }}" alt="{{ $program['title'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            @else
                                <div style="height: 200px; background: linear-gradient(135deg, var(--primary-green), #00c968); border-radius: 12px 12px 0 0; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-hands-helping text-white" style="font-size: 64px; opacity: 0.3;"></i>
                                </div>
                            @endif
                            <div class="card-body p-4">
                                <div class="mb-2">
                                    <span class="badge bg-success">{{ ucfirst($program['category']) }}</span>
                                </div>
                                <h4 class="fw-bold mb-3">{{ $program['title'] }}</h4>
                                <p class="text-muted mb-4">{{ Str::limit($program['description'], 120) }}</p>
                                <a href="{{ route('program.show', $program['id']) }}" class="btn btn-primary w-100">
                                    Lihat Detail <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<section class="py-5" style="background: var(--bg-light);">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title mb-4">Ingin Berdonasi?</h2>
            <p class="text-muted mb-4">Bantu kami mewujudkan program-program yang lebih baik untuk Indonesia</p>
            <a href="{{ route('donasi') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-hand-holding-heart me-2"></i> Lihat Opsi Donasi
            </a>
        </div>
    </div>
</section>

@endsection
