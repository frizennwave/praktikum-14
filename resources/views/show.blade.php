@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-3">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $article->category->name }}</li>
                </ol>
            </nav>

            <h1 class="fw-bold mb-3">{{ $article->title }}</h1>

            <div class="text-muted mb-4 small d-flex align-items-center gap-3">
                <span><i class="fas fa-user me-1"></i> Oleh: <strong>{{ $article->user->name }}</strong></span>
                <span><i class="fas fa-calendar-alt me-1"></i> {{ $article->created_at->diffForHumans() }}</span>
            </div>

            @if($article->image)
                <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid rounded mb-4 w-100" style="max-height: 450px; object-fit: cover;" alt="{{ $article->title }}">
            @else
                <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=800" class="img-fluid rounded mb-4 w-100" style="max-height: 450px; object-fit: cover;" alt="Placeholder">
            @endif

            <div class="article-content lh-lg mb-5" style="font-size: 1.1rem; text-align: justify;">
                {!! nl2br(e($article->content)) !!}
            </div>

            <div class="card bg-light border-0 shadow-sm rounded-3 p-4 mb-5">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center mb-3 mb-md-0">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($article->user->name) }}&background=random&color=fff&size=128"
                             class="rounded-circle img-fluid shadow-sm"
                             alt="{{ $article->user->name }}"
                             style="width: 80px; height: 80px; object-fit: cover;">
                    </div>
                    <div class="col-md-10">
                        <span class="text-muted small text-uppercase fw-bold d-block mb-1">Tentang Penulis</span>
                        <h5 class="fw-bold text-dark mb-1">{{ $article->user->name }}</h5>

                        <p class="text-primary small mb-2">
                            <i class="fas fa-phone-alt me-1"></i>
                            {{ $article->user->profile->phone ?? 'Nomor telepon tidak tersedia' }}
                        </p>

                        <p class="text-secondary small mb-0 lh-base" style="text-align: justify;">
                            {{ $article->user->profile->bio ?? 'Penulis ini belum menuliskan biografi singkat.' }}
                        </p>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <a href="{{ url('/') }}" class="btn btn-secondary mb-4">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
            </a>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-bold text-uppercase py-3">
                    🔥 Berita Terpopuler
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($popularNews as $index => $popular)
                    <li class="list-group-item py-3 header-link-toggle" style="transition: background 0.2s;">
                        <span class="badge {{ $index == 0 ? 'bg-primary' : 'bg-secondary' }} me-2">{{ $index + 1 }}</span>
                        <a href="{{ route('news.show', $popular->slug) }}" class="text-dark text-decoration-none fw-semibold">{{ $popular->title }}</a>
                    </li>
                    @empty
                    <li class="list-group-item py-3 text-muted text-center">Belum ada berita populer.</li>
                    @endforelse
                </ul>
            </div>

            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="fas fa-tags me-1"></i> Tag Populer
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        @forelse($tags as $tag)
                            <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                #{{ $tag->name }}
                            </a>
                        @empty
                            <span class="text-muted small">Belum ada tag tersedia.</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="fas fa-tags me-1"></i> Categories
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        @forelse($categories as $category)
                            <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                {{ $category->name }}
                            </a>
                        @empty
                            <span class="text-muted small">Belum ada tag tersedia.</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
