@extends('layouts.public')

@section('title', 'Donasi - Berbagi Asa')

@section('content')

<section class="hero-section" style="padding: 80px 0;">
    <div class="container position-relative">
        <div class="text-center">
            <h1 class="display-4 fw-bold mb-3">Donasi</h1>
            <p class="lead">Berbagi kebaikan untuk Indonesia yang lebih baik</p>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        @if(count($donations) === 0)
            <div class="text-center py-5">
                <i class="fas fa-heart fa-4x text-muted mb-3"></i>
                <p class="text-muted">Belum ada opsi donasi tersedia saat ini</p>
            </div>
        @else
            <div class="row g-4">
                @foreach($donations as $donation)
                    <div class="col-md-6 col-lg-4">
                        <div class="card-program h-100">
                            @if($donation['image_url'])
                                <div style="height: 200px; overflow: hidden; border-radius: 12px 12px 0 0;">
                                    <img src="{{ $donation['image_url'] }}" alt="{{ $donation['title'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            @else
                                <div style="height: 200px; background: linear-gradient(135deg, #0066B3, #0088dd); border-radius: 12px 12px 0 0; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-hand-holding-heart text-white" style="font-size: 64px; opacity: 0.3;"></i>
                                </div>
                            @endif
                            <div class="card-body p-4">
                                <h4 class="fw-bold mb-3">{{ $donation['title'] }}</h4>
                                <p class="text-muted mb-4">{{ Str::limit($donation['description'], 120) }}</p>
                                <a href="{{ route('donasi.show', $donation['id']) }}" class="btn btn-primary w-100">
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
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="section-title mb-3">Mengapa Donasi Itu Penting?</h2>
                <p class="text-muted mb-4">
                    Dengan berdonasi, Anda membantu kami mewujudkan program-program yang memberikan dampak nyata bagi masyarakat kurang mampu. Setiap rupiah yang Anda sumbangkan akan dikelola dengan amanah dan transparan untuk membantu mereka yang membutuhkan.
                </p>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Transparan</strong> - Laporan penggunaan dana dapat diakses oleh donatur
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Amanah</strong> - Dikelola oleh lembaga terpercaya
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Berdampak</strong> - Langsung menyentuh mereka yang membutuhkan
                    </li>
                </ul>
            </div>
            <div class="col-lg-4 text-center">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <i class="fas fa-heart text-danger" style="font-size: 80px;"></i>
                        <h4 class="fw-bold mt-3">Mulai Berdonasi</h4>
                        <p class="text-muted small">Hubungi kami untuk informasi lebih lanjut</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
