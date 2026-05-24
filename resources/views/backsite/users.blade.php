@extends('backsite.layouts.sidebar')
@section('title', 'Manajemen Pengguna')
@section('breadcrumb')
  <span>Pengguna</span>
@endsection
@section('content')

<div class="admin-page-header">
  <h1 class="admin-page-title">Manajemen Pengguna</h1>
</div>

<div class="admin-card">
  <div class="admin-card-header">
    <h3 class="admin-card-title">Semua Pengguna Terdaftar</h3>
    <div class="d-flex gap-2">
      <form method="GET" class="d-flex gap-2">
        <input type="text" name="search" class="admin-form-control" placeholder="Cari nama atau email..." value="{{ request('search') }}" style="width:250px">
        <button type="submit" class="admin-btn admin-btn-primary">Cari</button>
      </form>
    </div>
  </div>
  
  <div class="admin-card-body p-0">
    <table class="admin-table">
      <thead>
        <tr>
          <th>#ID</th>
          <th>Informasi Pengguna</th>
          <th>Role Saat Ini</th>
          <th>Aksi (Ubah Role)</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
        <tr>
          <td><strong>{{ $user->id }}</strong></td>
          <td>
            <div class="d-flex align-items-center gap-3">
              <div class="admin-user-avatar d-flex align-items-center justify-content-center text-white fw-bold" style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, var(--ts-primary), var(--ts-primary-dark));">
                @if($user->avatar)
                  <img src="{{ asset('assets/img/avatars/'.$user->avatar) }}" alt="Avatar" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                @else
                  {{ strtoupper(substr($user->name, 0, 1)) }}
                @endif
              </div>
              <div>
                <strong>{{ $user->name }}</strong><br>
                <small class="text-muted">{{ $user->email }} | {{ $user->phone ?? '-' }}</small>
              </div>
            </div>
          </td>
          <td>
            @if($user->id_role == 1)
              <span class="admin-badge admin-badge-danger">Super Admin</span>
            @elseif($user->id_role == 2)
              <span class="admin-badge admin-badge-info">Admin</span>
            @else
              <span class="admin-badge admin-badge-success">Customer</span>
            @endif
          </td>
          <td>
            <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST" class="d-flex gap-2 align-items-center" onsubmit="return confirm('Anda yakin ingin mengubah role pengguna ini?');">
              @csrf
              @method('PUT')
              <select name="id_role" class="admin-form-control form-select-sm" style="width: 140px;">
                <option value="1" {{ $user->id_role == 1 ? 'selected' : '' }}>Super Admin</option>
                <option value="2" {{ $user->id_role == 2 ? 'selected' : '' }}>Admin</option>
                <option value="3" {{ $user->id_role == 3 ? 'selected' : '' }}>Customer</option>
              </select>
              <button type="submit" class="admin-btn admin-btn-ghost admin-btn-sm" title="Simpan Role">
                <span class="material-symbols-outlined text-primary">save</span>
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="text-center py-4 text-muted">Belum ada data pengguna yang ditemukan.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($users->hasPages())
  <div class="admin-card-body d-flex justify-content-end">
    {{ $users->links() }}
  </div>
  @endif
</div>

@endsection
