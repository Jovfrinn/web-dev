@extends('fronsite.layouts.navbar')
@section('title', 'Profil Saya — TrendStore')
@section('content')

<style>
  .tkp-profile-card {
    background: #FFFFFF;
    border-radius: 12px;
    box-shadow: 0 1px 6px 0 rgba(49,53,59,0.12);
    padding: 24px;
    margin-bottom: 24px;
  }
  .tkp-avatar-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    background-color: #F3F4F5;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    color: #00AA5B;
    border: 2px solid #E5E7E9;
  }
  .tkp-input {
    border: 1px solid #E5E7E9;
    border-radius: 8px;
    padding: 10px 16px;
    font-size: 14px;
    color: #31353B;
    width: 100%;
    transition: 0.2s;
  }
  .tkp-input:focus {
    outline: none;
    border-color: #00AA5B;
  }
  .tkp-input:disabled {
    background-color: #F3F4F5;
    cursor: not-allowed;
  }
  .tkp-label {
    font-size: 14px;
    font-weight: 600;
    color: #31353B;
    margin-bottom: 8px;
    display: block;
  }
  .tkp-btn-primary {
    background: #00AA5B;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 12px 16px;
    font-weight: 700;
    transition: 0.2s;
    width: 100%;
  }
  .tkp-btn-primary:hover {
    background: #008F4C;
  }
  .tkp-btn-outline {
    background: white;
    color: #00AA5B;
    border: 1px solid #00AA5B;
    border-radius: 8px;
    padding: 12px 16px;
    font-weight: 700;
    transition: 0.2s;
    width: 100%;
  }
  .tkp-btn-outline:hover {
    background: #F3F4F5;
  }
  .tkp-nav-item {
    display: flex;
    align-items: center;
    padding: 16px;
    color: #31353B;
    text-decoration: none;
    border-bottom: 1px solid #E5E7E9;
    transition: background-color 0.2s;
  }
  .tkp-nav-item:hover {
    background-color: #F3F4F5;
    color: #00AA5B;
  }
  .tkp-nav-item:last-child {
    border-bottom: none;
  }
  .tkp-nav-icon {
    font-size: 20px;
    margin-right: 12px;
    color: #6D7588;
  }
  .tkp-nav-item:hover .tkp-nav-icon {
    color: #00AA5B;
  }
</style>

<div style="background-color: #F3F4F5; padding-top: 32px; padding-bottom: 60px; min-height: 80vh;">
  <div class="container" style="max-width: 1000px;">
    
    <div class="row">
      
      <!-- Kiri: Menu Profil -->
      <div class="col-lg-3 col-md-4 mb-4">
        <div class="tkp-profile-card text-center">
          <div class="d-flex justify-content-center mb-3">
            @if($user->avatar)
              <img src="{{ asset('assets/img/avatars/'.$user->avatar) }}" alt="Avatar" class="tkp-avatar-circle">
            @else
              <div class="tkp-avatar-circle">
                <span class="material-symbols-outlined" style="font-size: 40px;">person</span>
              </div>
            @endif
          </div>
          <h2 style="font-size: 16px; font-weight: 700; color: #31353B; margin-bottom: 4px;">{{ $user->name }}</h2>
          <div style="font-size: 13px; color: #6D7588; margin-bottom: 12px;">{{ $user->email }}</div>
          <span class="badge" style="background-color: #E5F9F1; color: #00AA5B; font-weight: 600; padding: 6px 12px;">Pelanggan</span>
        </div>

        <div class="tkp-profile-card p-0 overflow-hidden">
          <a href="{{ route('profile.index') }}" class="tkp-nav-item" style="background-color: #F3F4F5; border-left: 4px solid #00AA5B;">
            <span class="material-symbols-outlined tkp-nav-icon" style="color: #00AA5B;">manage_accounts</span>
            <span style="font-weight: 600; color: #00AA5B;">Profil Saya</span>
          </a>
          <a href="{{ route('orders.index') }}" class="tkp-nav-item">
            <span class="material-symbols-outlined tkp-nav-icon">shopping_bag</span>
            <span style="font-weight: 600;">Pesanan Saya</span>
          </a>
          <a href="{{ route('logout') }}" class="tkp-nav-item text-danger">
            <span class="material-symbols-outlined tkp-nav-icon text-danger">logout</span>
            <span style="font-weight: 600;">Keluar</span>
          </a>
        </div>
      </div>

      <!-- Kanan: Form Edit Profil -->
      <div class="col-lg-9 col-md-8">
        
        <!-- Kartu Ubah Biodata Diri -->
        <div class="tkp-profile-card">
          <h3 style="font-size: 18px; font-weight: 700; color: #31353B; margin-bottom: 24px; border-bottom: 1px solid #E5E7E9; padding-bottom: 16px;">Ubah Biodata Diri</h3>
          
          @if(session('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert" style="border-radius: 8px; font-size: 14px;">
              <span class="material-symbols-outlined me-2">check_circle</span>
              {{ session('success') }}
            </div>
          @endif
          @if($errors->any())
            <div class="alert alert-danger d-flex align-items-center" role="alert" style="border-radius: 8px; font-size: 14px;">
              <span class="material-symbols-outlined me-2">error</span>
              {{ $errors->first() }}
            </div>
          @endif

          <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            
            <div class="row mb-3">
              <div class="col-md-3">
                <label class="tkp-label mt-2">Nama Lengkap</label>
              </div>
              <div class="col-md-9">
                <input type="text" name="name" class="tkp-input" value="{{ old('name', $user->name) }}" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-3">
                <label class="tkp-label mt-2">Email</label>
              </div>
              <div class="col-md-9">
                <input type="email" class="tkp-input" value="{{ $user->email }}" disabled>
                <div style="font-size: 12px; color: #6D7588; margin-top: 6px;">Email tidak dapat diubah untuk alasan keamanan.</div>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-3">
                <label class="tkp-label mt-2">Nomor HP</label>
              </div>
              <div class="col-md-9">
                <input type="tel" name="phone" class="tkp-input" value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 081234567890">
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-3">
                <label class="tkp-label mt-2">Alamat Pengiriman</label>
              </div>
              <div class="col-md-9">
                <textarea name="address" class="tkp-input" rows="3" placeholder="Masukkan alamat lengkap pengiriman">{{ old('address', $user->address) }}</textarea>
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-md-3">
                <label class="tkp-label mt-2">Foto Profil</label>
              </div>
              <div class="col-md-9">
                <input type="file" name="avatar" class="tkp-input" accept="image/*" style="padding: 6px 12px;">
              </div>
            </div>

            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-4">
                <button type="submit" class="tkp-btn-primary">Simpan Biodata</button>
              </div>
            </div>
          </form>
        </div>

        <!-- Kartu Ubah Password -->
        <div class="tkp-profile-card">
          <h3 style="font-size: 18px; font-weight: 700; color: #31353B; margin-bottom: 24px; border-bottom: 1px solid #E5E7E9; padding-bottom: 16px;">Ubah Kata Sandi</h3>
          
          <form action="{{ route('profile.password') }}" method="POST">
            @csrf @method('PUT')
            
            <div class="row mb-3">
              <div class="col-md-3">
                <label class="tkp-label mt-2">Kata Sandi Saat Ini</label>
              </div>
              <div class="col-md-9">
                <input type="password" name="current_password" class="tkp-input" required placeholder="Masukkan kata sandi lama">
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-3">
                <label class="tkp-label mt-2">Kata Sandi Baru</label>
              </div>
              <div class="col-md-9">
                <input type="password" name="password" class="tkp-input" required placeholder="Minimal 8 karakter">
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-md-3">
                <label class="tkp-label mt-2">Konfirmasi Sandi Baru</label>
              </div>
              <div class="col-md-9">
                <input type="password" name="password_confirmation" class="tkp-input" required placeholder="Ulangi kata sandi baru">
              </div>
            </div>

            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-4">
                <button type="submit" class="tkp-btn-outline">Perbarui Sandi</button>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
