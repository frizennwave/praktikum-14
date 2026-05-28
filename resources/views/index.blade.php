@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    .hover-zoom {
        overflow: hidden;
    }
    .hover-zoom img {
        transition: transform 0.5s ease;
    }
    .hover-zoom:hover img {
        transform: scale(1.05);
    }
    .card-animate {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-animate:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
    }
</style>

<div class="container">
    @if($headline)
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-dark text-white border-0 shadow-sm overflow-hidden animate__animated animate__fadeInDown" style="max-height: 450px;">
                <div class="hover-zoom" style="height: 450px;">
                    <img src="{{ $headline->image ? asset('storage/' . $headline->image) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=1200&q=80' }}" class="card-img opacity-50" alt="Headline News" style="object-fit: cover; width: 100%; height: 100%;">
                </div>
                <div class="card-img-overlay d-flex flex-column justify-content-end p-4">
                    <span class="badge bg-danger mb-2 align-self-start text-uppercase px-3 py-2 animate__animated animate__flash animate__infinite animate__slower">Breaking News</span>
                    <h1 class="card-title fw-bold display-5">
                        <a href="{{ route('news.show', $headline->slug) }}" class="text-white text-decoration-none">{{ $headline->title }}</a>
                    </h1>
                    <p class="card-text lead d-none d-md-block">{{ Str::limit(strip_tags($headline->content), 150) }}</p>
                    <p class="card-text small text-light">Oleh <strong>{{ $headline->user->name ?? 'Admin' }}</strong> • {{ $headline->created_at->translatedFormat('d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-8 animate__animated animate__fadeInUp">
            <h4 class="fw-bold mb-3 text-uppercase">
                <span class="border-bottom border-3 border-primary pb-1">Berita Terbaru</span>
            </h4>

            <div class="row g-4">
                @forelse($latestNews as $news)
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm border-0 card-animate">
                        <div class="hover-zoom">
                            <img src="{{ $news->image ? asset('storage/' . $news->image) : 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&w=600&q=80' }}" class="card-img-top" alt="Berita" style="height: 200px; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <span class="badge bg-primary small fw-bold text-uppercase mb-2">{{ $news->category->name ?? 'Umum' }}</span>
                            <h5 class="card-title mt-1 fw-bold">
                                <a href="{{ route('news.show', $news->slug) }}" class="text-dark text-decoration-none">{{ $news->title }}</a>
                            </h5>
                            <p class="card-text text-muted small">{{ Str::limit(strip_tags($news->content), 120) }}</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-muted small pt-0">
                            {{ $news->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted my-5">
                    <h5>Belum ada berita terbaru.</h5>
                </div>
                @endforelse
            </div>
        </div>

        <div class="col-lg-4 mt-5 mt-lg-0 animate__animated animate__fadeInRight">
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

            <div class="card bg-light border-0 shadow-sm p-4 text-center">
                <h5 class="fw-bold mb-2">Langganan Berita</h5>
                <p class="text-muted small">Dapatkan informasi berita terupdate langsung di email kamu setiap hari.</p>
                <div class="input-group mb-2">
                    <input type="email" class="form-control form-control-sm" placeholder="Email kamu..." aria-label="Email">
                    <button class="btn btn-primary btn-sm px-3" type="button">Join</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
