@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <a href="{{ route('admin.chatbot.index') }}" class="btn btn-outline-secondary mb-4">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>

    <h2 class="fw-bold mb-4">Edit Knowledge Base</h2>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('admin.chatbot.update', $knowledge['id']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $knowledge['title']) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Konten <span class="text-danger">*</span></label>
                    <textarea name="content" class="form-control" rows="8" required>{{ old('content', $knowledge['content']) }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                        <select name="category" class="form-select" required>
                            <option value="program" {{ old('category', $knowledge['category']) === 'program' ? 'selected' : '' }}>Program</option>
                            <option value="registration" {{ old('category', $knowledge['category']) === 'registration' ? 'selected' : '' }}>Pendaftaran</option>
                            <option value="partner" {{ old('category', $knowledge['category']) === 'partner' ? 'selected' : '' }}>Partner</option>
                            <option value="service" {{ old('category', $knowledge['category']) === 'service' ? 'selected' : '' }}>Layanan</option>
                            <option value="general" {{ old('category', $knowledge['category']) === 'general' ? 'selected' : '' }}>Umum</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="active" {{ old('status', $knowledge['status']) === 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status', $knowledge['status']) === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i> Update Knowledge
                </button>
                <a href="{{ route('admin.chatbot.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
