<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar — TrendStore</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body style="font-family: 'Inter', sans-serif; background: #F5F5F5; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem 0;">

<div style="width: 100%; max-width: 480px; margin: auto; padding: 1rem;">
  
  <div style="text-align: center; margin-bottom: 2rem;">
    <a href="/" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none; color: #059669;">
      <span class="material-symbols-outlined" style="font-size: 2.5rem;">storefront</span>
      <span style="font-size: 1.8rem; font-weight: 800; color: #1F2937;">TrendStore</span>
    </a>
    <p style="color: #6B7280; margin-top: 0.5rem; font-size: 0.9rem;">Bergabung dan mulai belanja!</p>
  </div>

  <div style="background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 4px 24px rgba(0,0,0,0.08);">
    <h2 style="font-size: 1.4rem; font-weight: 700; margin-bottom: 1.5rem; color: #1F2937;">Buat Akun Baru</h2>

    @if ($errors->any())
      <div style="background: #FEF2F2; border: 1px solid #FECACA; color: #DC2626; padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.875rem;">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
      @csrf

      @foreach([['name','Nama Lengkap','person','text','Nama lengkap kamu'],['email','Email','email','email','email@contoh.com'],['password','Password','lock','password','Minimal 8 karakter'],['password_confirmation','Konfirmasi Password','lock_reset','password','Ulangi password']] as [$field, $label, $icon, $type, $placeholder])
      <div style="margin-bottom: 1.25rem;">
        <label style="display: block; font-weight: 500; margin-bottom: 0.4rem; color: #374151; font-size: 0.875rem;">{{ $label }}</label>
        <div style="position: relative;">
          <span class="material-symbols-outlined" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #9CA3AF; font-size: 20px;">{{ $icon }}</span>
          <input type="{{ $type }}" name="{{ $field }}" value="{{ $type !== 'password' ? old($field) : '' }}" required
            style="width: 100%; padding: 0.75rem 0.75rem 0.75rem 2.5rem; border: 1.5px solid #E5E7EB; border-radius: 8px; font-family: inherit; font-size: 0.9rem; transition: border-color 0.2s; outline: none;"
            onfocus="this.style.borderColor='#059669'" onblur="this.style.borderColor='#E5E7EB'"
            placeholder="{{ $placeholder }}">
        </div>
      </div>
      @endforeach

      <button type="submit" style="width: 100%; padding: 0.875rem; background: #059669; color: white; border: none; border-radius: 8px; font-size: 1rem; font-weight: 600; font-family: inherit; cursor: pointer; transition: background 0.2s; display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 0.5rem;"
        onmouseover="this.style.background='#047857'" onmouseout="this.style.background='#059669'">
        <span class="material-symbols-outlined">person_add</span>
        Daftar Sekarang
      </button>
    </form>

    <p style="text-align: center; margin-top: 1.5rem; font-size: 0.875rem; color: #6B7280;">
      Sudah punya akun?
      <a href="{{ route('login') }}" style="color: #059669; font-weight: 600; text-decoration: none;">Masuk di sini</a>
    </p>
  </div>

  <p style="text-align: center; margin-top: 1.5rem; font-size: 0.8rem; color: #9CA3AF;">
    <a href="/" style="color: #9CA3AF; text-decoration: none;">← Kembali ke Beranda</a>
  </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
