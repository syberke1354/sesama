@extends('layouts.public')

@section('title', $program['title'] . ' - Berbagi Asa')

@section('content')

<section class="py-5">
    <div class="container">
        <a href="{{ route('program') }}" class="btn btn-outline-primary mb-4">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Program
        </a>

        <div class="row">
            <div class="col-lg-8">
                @if($program['image_url'])
                    <div class="mb-4" style="border-radius: 12px; overflow: hidden;">
                        <img src="{{ $program['image_url'] }}" alt="{{ $program['title'] }}" style="width: 100%; height: 400px; object-fit: cover;">
                    </div>
                @else
                    <div class="mb-4" style="height: 400px; background: linear-gradient(135deg, var(--primary-green), #00c968); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-hands-helping text-white" style="font-size: 120px; opacity: 0.3;"></i>
                    </div>
                @endif

                <div class="mb-3">
                    <span class="badge bg-success">{{ ucfirst($program['category']) }}</span>
                </div>

                <h1 class="display-5 fw-bold mb-4">{{ $program['title'] }}</h1>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <p class="text-muted mb-3"><strong>Deskripsi Singkat:</strong></p>
                        <p class="lead">{{ $program['description'] }}</p>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3">Detail Program</h4>
                        <div style="white-space: pre-line;">{{ $program['full_description'] }}</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Dukungan</h5>

                        <div class="d-grid gap-3">
                            <a href="{{ route('donasi') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-hand-holding-heart me-2"></i> Donasi Sekarang
                            </a>

                            <a href="{{ route('about') }}" class="btn btn-outline-primary">
                                <i class="fas fa-info-circle me-2"></i> Tentang Kami
                            </a>

                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-home me-2"></i> Beranda
                            </a>
                        </div>

                        <hr class="my-4">

                        <div class="text-center">
                            <p class="text-muted small mb-2">Bagikan program ini:</p>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('program.show', $program['id'])) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fab fa-facebook"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('program.show', $program['id'])) }}&text={{ urlencode($program['title']) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($program['title'] . ' - ' . route('program.show', $program['id'])) }}" target="_blank" class="btn btn-sm btn-outline-success">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
