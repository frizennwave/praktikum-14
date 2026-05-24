@extends('admin.layouts.app')

@section('content')
    @php
        $userCount = \App\Models\User::count();
        $categoryCount = \App\Models\Category::count();
        $articleCount = \App\Models\Article::count();

        // Mengambil 5 berita terbaru untuk visualisasi tabel dashboard
        $latestArticles = \App\Models\Article::latest()->take(5)->get();
    @endphp

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
        <a href="{{ route('articles.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <span class="icon text-white-50">
                <i class="fas fa-plus fa-sm"></i>
            </span>
            <span class="text font-weight-bold">Tulis Berita Baru</span>
        </a>
    </div>

    <div class="row">

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pengguna
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $userCount }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Kategori
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $categoryCount }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tags fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Berita
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $articleCount }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-8 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Berita Terbaru yang Diterbitkan</h6>
                    <a href="{{ route('articles.index') }}" class="btn btn-sm btn-outline-primary font-weight-bold px-3 btn-round shadow-sm">
                        Lihat Semua <i class="fas fa-arrow-right fa-sm ml-1"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" width="100%" cellspacing="0">
                            <thead class="bg-light text-gray-700">
                                <tr>
                                    <th>Judul Berita</th>
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestArticles as $article)
                                    <tr>
                                        <td class="font-weight-bold text-gray-800 align-middle">{{ Str::limit($article->title, 40) }}</td>
                                        <td class="align-middle"><span class="badge badge-light border text-dark px-2 py-1">{{ $article->category->name ?? 'Umum' }}</span></td>
                                        <td class="align-middle text-muted small">{{ $article->created_at->format('d M Y') }}</td>
                                        <td class="text-center align-middle">
                                            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-sm btn-info btn-circle shadow-sm" title="Edit Artikel">
                                                <i class="fas fa-edit fa-sm"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-gray-500 py-5">
                                            <i class="fas fa-folder-open fa-2x text-gray-300 mb-2 d-block"></i>
                                            Belum ada berita yang diterbitkan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Akses Cepat Pengelolaan</h6>
                </div>
                <div class="card-body">
                    <p class="text-xs text-gray-500 mb-3">Klik tombol untuk langsung menuju menu manajemen:</p>

                    <a href="{{ route('articles.create') }}" class="btn btn-primary btn-block text-left shadow-sm py-1 mb-2">
                        <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                        <span class="text font-weight-bold">Buat Artikel Baru</span>
                    </a>

                    <a href="{{ route('categories.index') }}" class="btn btn-success btn-block text-left shadow-sm py-1 mb-2">
                        <span class="icon text-white-50"><i class="fas fa-folder-open"></i></span>
                        <span class="text font-weight-bold">Kelola Kategori</span>
                    </a>

                    <a href="{{ route('users.index') }}" class="btn btn-info btn-block text-left shadow-sm py-1 mb-2">
                        <span class="icon text-white-50"><i class="fas fa-user-cog"></i></span>
                        <span class="text font-weight-bold">Manajemen User</span>
                    </a>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-light border-bottom">
                    <h6 class="m-0 font-weight-bold text-secondary">Status Sistem</h6>
                </div>
                <div class="card-body py-3">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray-600 mb-1">Versi Framework</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Laravel 13.x</div>
                        </div>
                        <div class="col-auto">
                            <i class="fab fa-laravel fa-2x text-danger opacity-50"></i>
                        </div>
                    </div>
                    <hr class="my-2">
                    <p class="mb-0 text-xs text-muted">
                        <i class="fas fa-user-shield text-success mr-1"></i> Login sebagai:
                        <strong class="text-gray-800">{{ Auth::user()->name ?? 'Administrator' }}</strong>
                    </p>
                </div>
            </div>

        </div>
    </div>
@endsection
