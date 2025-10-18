@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <a href="{{ route('admin.donations.index') }}" class="btn btn-outline-secondary mb-4">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>

    <h2 class="fw-bold mb-4">Tambah Donasi Baru</h2>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('admin.donations.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Donasi <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi Singkat <span class="text-danger">*</span></label>
                    <textarea name="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi Lengkap <span class="text-danger">*</span></label>
                    <textarea name="full_description" class="form-control" rows="8" required>{{ old('full_description') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">URL Gambar</label>
                    <input type="url" name="image_url" class="form-control" value="{{ old('image_url') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Nomor WhatsApp <span class="text-danger">*</span></label>
                    <input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', '089506147763') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Pesan WhatsApp <span class="text-danger">*</span></label>
                    <textarea name="whatsapp_message" class="form-control" rows="3" required>{{ old('whatsapp_message', 'Halo, saya tertarik untuk berdonasi') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="active">Aktif</option>
                        <option value="inactive">Tidak Aktif</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i> Simpan Donasi
                </button>
                <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
