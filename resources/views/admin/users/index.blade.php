
@extends('admin.layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Pengguna</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm shadow-sm">
        <i class="fas fa-user-plus fa-sm text-white-50"></i> Tambah Pengguna
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
    <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pengguna Sistem (Admin & Penulis)</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                <thead class="bg-primary text-white">
                    <tr>
                        <th width="10%" class="text-center">No</th>
                        <th>Nama Pengguna</th>
                        <th>Alamat Email</th>
                        <th>Tanggal Terdaftar</th>
                        <th width="25%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $user->name }}</strong>
                            @if($user->id === auth()->id())
                                <span class="badge badge-success ml-1 shadow-sm">Aktif Login</span>
                            @endif
                        </td>
                        <td><code>{{ $user->email }}</code></td>
                        <td>{{ $user->created_at->format('d M Y H:i') }} WIB</td>
                        <td class="text-center">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm shadow-sm">
                                <i class="fas fa-edit fa-xs"></i> Edit
                            </a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm shadow-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini? Semua data relasional profil dan artikelnya akan ikut terhapus permanen!')"
                                    {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                                    <i class="fas fa-trash fa-xs"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            <i class="fas fa-users-slash fa-2x mb-2 d-block"></i> Belum ada data pengguna.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
