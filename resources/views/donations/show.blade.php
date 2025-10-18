@extends('layouts.public')

@section('title', $donation['title'] . ' - Berbagi Asa')

@section('content')

<section class="py-5">
    <div class="container">
        <a href="{{ route('donasi') }}" class="btn btn-outline-primary mb-4">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Donasi
        </a>

        <div class="row">
            <div class="col-lg-8">
                @if($donation['image_url'])
                    <div class="mb-4" style="border-radius: 12px; overflow: hidden;">
                        <img src="{{ $donation['image_url'] }}" alt="{{ $donation['title'] }}" style="width: 100%; height: 400px; object-fit: cover;">
                    </div>
                @else
                    <div class="mb-4" style="height: 400px; background: linear-gradient(135deg, #0066B3, #0088dd); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-hand-holding-heart text-white" style="font-size: 120px; opacity: 0.3;"></i>
                    </div>
                @endif

                <h1 class="display-5 fw-bold mb-4">{{ $donation['title'] }}</h1>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <p class="text-muted mb-3"><strong>Deskripsi Singkat:</strong></p>
                        <p class="lead">{{ $donation['description'] }}</p>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3">Detail Donasi</h4>
                        <div style="white-space: pre-line;">{{ $donation['full_description'] }}</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-lg sticky-top" style="top: 20px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4 text-center">Hubungi Kami</h5>

                        <div class="text-center mb-4">
                            <i class="fab fa-whatsapp text-success" style="font-size: 80px;"></i>
                        </div>

                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>WhatsApp:</strong> {{ $donation['whatsapp_number'] }}
                        </div>

                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $donation['whatsapp_number']) }}?text={{ urlencode($donation['whatsapp_message']) }}"
                           target="_blank"
                           class="btn btn-success btn-lg w-100 mb-3">
                            <i class="fab fa-whatsapp me-2"></i> Chat via WhatsApp
                        </a>

                        <hr class="my-4">

                        <div class="d-grid gap-2">
                            <a href="{{ route('program') }}" class="btn btn-outline-primary">
                                <i class="fas fa-hands-helping me-2"></i> Lihat Program
                            </a>

                            <a href="{{ route('about') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-info-circle me-2"></i> Tentang Kami
                            </a>
                        </div>

                        <hr class="my-4">

                        <div class="text-center">
                            <p class="text-muted small mb-2">Bagikan:</p>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('donasi.show', $donation['id'])) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fab fa-facebook"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('donasi.show', $donation['id'])) }}&text={{ urlencode($donation['title']) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($donation['title'] . ' - ' . route('donasi.show', $donation['id'])) }}" target="_blank" class="btn btn-sm btn-outline-success">
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
