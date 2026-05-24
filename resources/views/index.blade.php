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
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-dark text-white border-0 shadow-sm overflow-hidden animate__animated animate__fadeInDown" style="max-height: 450px;">
                <div class="hover-zoom" style="height: 450px;">
                    <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=1200&q=80" class="card-img opacity-50" alt="Headline News" style="object-fit: cover; width: 100%; height: 100%;">
                </div>
                <div class="card-img-overlay d-flex flex-column justify-content-end p-4">
                    <span class="badge bg-danger mb-2 align-self-start text-uppercase px-3 py-2 animate__animated animate__flash animate__infinite animate__slower">Breaking News</span>
                    <h1 class="card-title fw-bold display-5">
                        <a href="#" class="text-white text-decoration-none">Teknologi AI Diprediksi Akan Mengubah Pola Kerja Kantoran di Tahun 2026</a>
                    </h1>
                    <p class="card-text lead d-none d-md-block">Kecerdasan buatan kini semakin matang. Berbagai sektor industri mulai mengadopsi sistem otomatisasi tingkat tinggi yang efisien.</p>
                    <p class="card-text small text-light">Oleh <strong>Admin</strong> • 24 Mei 2026</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 animate__animated animate__fadeInUp">
            <h4 class="fw-bold mb-3 text-uppercase">
                <span class="border-bottom border-3 border-primary pb-1">Berita Terbaru</span>
            </h4>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm border-0 card-animate">
                        <div class="hover-zoom">
                            <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Berita" style="height: 200px; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <span class="text-primary small fw-bold text-uppercase">Teknologi</span>
                            <h5 class="card-title mt-1 fw-bold"><a href="#" class="text-dark text-decoration-none">Laravel 12 Resmi Dirilis, Apa Saja Fitur Barunya?</a></h5>
                            <p class="card-text text-muted small">Framework PHP terpopuler ini kembali membawa pembaruan pembaruan performa yang signifikan untuk developer...</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-muted small pt-0">
                            2 jam yang lalu
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 shadow-sm border-0 card-animate">
                        <div class="hover-zoom">
                            <img src="https://assets.goal.com/images/v3/blt92a2b3d4858af391/Timnas%20Indonesia.jpg?auto=webp&format=pjpg&width=1920&quality=60" class="card-img-top" alt="Berita" style="height: 200px; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <span class="text-success small fw-bold text-uppercase">Olahraga</span>
                            <h5 class="card-title mt-1 fw-bold"><a href="#" class="text-dark text-decoration-none">Timnas Indonesia Melaju ke Babak Final Piala Asia</a></h5>
                            <p class="card-text text-muted small">Kemenangan dramatis lewat adu penalti membuat seluruh stadion bergemuruh malam ini...</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-muted small pt-0">
                            5 jam yang lalu
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 shadow-sm border-0 card-animate">
                        <div class="hover-zoom">
                            <img src="https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Berita" style="height: 200px; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <span class="text-warning small fw-bold text-uppercase">Ekonomi</span>
                            <h5 class="card-title mt-1 fw-bold"><a href="#" class="text-dark text-decoration-none">Pasar Saham Meroket Pasca Pengumuman Suku Bunga Baru</a></h5>
                            <p class="card-text text-muted small">Investor merespon positif langkah bank sentral dalam menjaga stabilitas nilai tukar mata uang...</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-muted small pt-0">
                            1 hari yang lalu
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 shadow-sm border-0 card-animate">
                        <div class="hover-zoom">
                            <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Berita" style="height: 200px; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <span class="text-info small fw-bold text-uppercase">Hiburan</span>
                            <h5 class="card-title mt-1 fw-bold"><a href="#" class="text-dark text-decoration-none">Konser Band Legendaris di Jakarta Berlangsung Spektakuler</a></h5>
                            <p class="card-text text-muted small">Puluhan ribu fans memadati area stadion sejak siang hari demi melihat penampilan sang idola...</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-muted small pt-0">
                            1 hari yang lalu
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mt-5 mt-lg-0 animate__animated animate__fadeInRight">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-bold text-uppercase py-3">
                    🔥 Berita Terpopuler
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item py-3 header-link-toggle" style="transition: background 0.2s;">
                        <span class="badge bg-primary me-2">1</span>
                        <a href="#" class="text-dark text-decoration-none fw-semibold">Tips Menjaga Kesehatan Mata Bagi Pekerja Remote</a>
                    </li>
                    <li class="list-group-item py-3" style="transition: background 0.2s;">
                        <span class="badge bg-secondary me-2">2</span>
                        <a href="#" class="text-dark text-decoration-none fw-semibold">5 Kuliner Hidden Gem di Yogyakarta yang Wajib Dicoba</a>
                    </li>
                    <li class="list-group-item py-3" style="transition: background 0.2s;">
                        <span class="badge bg-secondary me-2">3</span>
                        <a href="#" class="text-dark text-decoration-none fw-semibold">Rekomendasi Laptop 5 Jutaan Terbaik untuk Mahasiswa</a>
                    </li>
                </ul>
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
