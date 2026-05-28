
@extends('admin.layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tulis Berita</h1>
    <a href="{{ route('articles.index') }}" class="btn btn-secondary btn-sm shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 bg-light">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-pencil-alt mr-2"></i>Form Pembuatan Berita Baru</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="title" class="font-weight-bold text-dark">Judul Berita</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Masukkan judul berita utama" required autofocus>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="category_id" class="font-weight-bold text-dark">Kategori Berita</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Upload File Image -->
            <div class="form-group">
                <label for="image" class="font-weight-bold text-dark">Gambar Sampul Berita</label>
                <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" required>
                <small class="text-muted">Format yang diizinkan: JPG, PNG, JPEG, WEBP. Maksimal 2MB.</small>
                @error('image')
                <div class="text-danger mt-1 small font-weight-bold">{{ $message }}</div>
                @enderror
            </div>

            <!-- Multi Select / Checkbox Tags -->
            <div class="form-group">
                <label class="font-weight-bold text-dark d-block">Pilih Tag/Label Berita</label>
                <div class="row px-3">
                    @forelse($tags as $tag)
                    <div class="custom-control custom-checkbox mr-4 mb-2">
                        <input type="checkbox" class="custom-control-input" id="tag-{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}"
                            {{ is_array(old('tags')) && in_array($tag->id, old('tags')) ? 'checked' : '' }}>
                        <label class="custom-control-label text-dark" for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                    </div>
                    @empty
                    <span class="text-muted small">Belum ada tag yang tersedia. Silakan <a href="{{ route('tags.create') }}">buat tag baru</a> terlebih dahulu.</span>
                    @endforelse
                </div>
            </div>

            <div class="form-group">
                <label for="content" class="font-weight-bold text-dark">Isi Berita Lengkap</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10" placeholder="Tuliskan berita secara mendalam..." required>{{ old('content') }}</textarea>
                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>
            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary shadow-sm"><i class="fas fa-save mr-1"></i> Simpan dan Publikasikan</button>
                <a href="{{ route('articles.index') }}" class="btn btn-secondary shadow-sm">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

