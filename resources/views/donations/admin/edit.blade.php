@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <a href="{{ route('admin.donations.index') }}" class="btn btn-outline-secondary mb-4">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>

    <h2 class="fw-bold mb-4">Edit Donasi</h2>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('admin.donations.update', $donation['id']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Donasi <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $donation['title']) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi Singkat <span class="text-danger">*</span></label>
                    <textarea name="description" class="form-control" rows="3" required>{{ old('description', $donation['description']) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi Lengkap <span class="text-danger">*</span></label>
                    <textarea name="full_description" class="form-control" rows="8" required>{{ old('full_description', $donation['full_description']) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">URL Gambar</label>
                    <input type="url" name="image_url" class="form-control" value="{{ old('image_url', $donation['image_url']) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Nomor WhatsApp <span class="text-danger">*</span></label>
                    <input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $donation['whatsapp_number']) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Pesan WhatsApp <span class="text-danger">*</span></label>
                    <textarea name="whatsapp_message" class="form-control" rows="3" required>{{ old('whatsapp_message', $donation['whatsapp_message']) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ old('status', $donation['status']) === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status', $donation['status']) === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i> Update Donasi
                </button>
                <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
