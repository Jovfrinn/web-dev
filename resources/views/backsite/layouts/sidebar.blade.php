<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Admin Panel') — TrendStore</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts: Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Material Symbols -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

  <!-- TrendStore Admin CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

  @yield('styles')
</head>
<body class="admin-body">

<div class="admin-wrapper">

  <!-- ===================== SIDEBAR ===================== -->
  <aside class="admin-sidebar" id="adminSidebar">

    <!-- Logo/Brand -->
    <div class="admin-sidebar-logo">
      <div class="logo-icon">
        <span class="material-symbols-outlined">storefront</span>
      </div>
      <div class="logo-text">
        Trend<span>Store</span>
      </div>
      <div class="logo-badge">Admin</div>
    </div>

    <!-- Navigation -->
    <nav class="admin-sidebar-nav">

      <div class="nav-section-label">UTAMA</div>

      <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <span class="material-symbols-outlined nav-icon">dashboard</span>
        <span class="nav-label">Dashboard</span>
      </a>

      <div class="nav-section-label">PRODUK</div>

      <a href="{{ route('get.product.backsite') }}" class="{{ request()->routeIs('get.product.backsite') || request()->routeIs('edit.product.backsite') ? 'active' : '' }}">
        <span class="material-symbols-outlined nav-icon">inventory_2</span>
        <span class="nav-label">Semua Produk</span>
      </a>

      <a href="{{ route('add.product.backsite') }}" class="{{ request()->routeIs('add.product.backsite') ? 'active' : '' }}">
        <span class="material-symbols-outlined nav-icon">add_box</span>
        <span class="nav-label">Tambah Produk</span>
      </a>

      <a href="{{ route('get.stock') }}" class="{{ request()->routeIs('get.stock') || request()->routeIs('show.stock') ? 'active' : '' }}">
        <span class="material-symbols-outlined nav-icon">table_chart</span>
        <span class="nav-label">Manajemen Stok</span>
      </a>

      <a href="{{ route('admin.categories') }}" class="{{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
        <span class="material-symbols-outlined nav-icon">category</span>
        <span class="nav-label">Kategori</span>
      </a>

      <div class="nav-section-label">PENJUALAN</div>

      <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
        <span class="material-symbols-outlined nav-icon">receipt_long</span>
        <span class="nav-label">Pesanan</span>
        @php $pendingCount = \App\Models\Checkout::where('status','pending')->count(); @endphp
        @if($pendingCount > 0)
          <span class="nav-badge">{{ $pendingCount }}</span>
        @endif
      </a>

      @if(Auth::check() && Auth::user()->isSuperAdmin())
      <div class="nav-section-label">PENGGUNA</div>
      <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
        <span class="material-symbols-outlined nav-icon">group</span>
        <span class="nav-label">Pengguna</span>
      </a>
      @endif

    </nav>

    <!-- Sidebar Footer -->
    <div class="admin-sidebar-footer">
      <div class="admin-user-info" style="display:flex; justify-content:space-between; width:100%; align-items:center;">
        <div style="display:flex; align-items:center; gap:10px;">
          <div class="admin-user-avatar">
            @if(Auth::check() && Auth::user()->avatar)
              <img src="{{ asset('assets/img/avatars/'.Auth::user()->avatar) }}" alt="Avatar" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
            @else
              <span class="material-symbols-outlined">person</span>
            @endif
          </div>
          <div class="admin-user-details">
            <div class="admin-user-name">{{ Auth::check() ? Str::limit(Auth::user()->name, 12) : 'Admin' }}</div>
            <div class="admin-user-role">{{ Auth::check() && Auth::user()->isSuperAdmin() ? 'Super Admin' : 'Admin' }}</div>
          </div>
        </div>
        
        <form action="{{ route('logout') }}" method="POST" class="m-0 p-0 d-inline-block footer-logout-form">
          @csrf
          <button type="submit" style="background:transparent; border:none; color:var(--ts-secondary); cursor:pointer;" title="Logout">
            <span class="material-symbols-outlined">logout</span>
          </button>
        </form>
      </div>
    </div>
  </aside>

  <!-- Mobile overlay -->
  <div class="admin-sidebar-overlay" id="sidebarOverlay"></div>

  <!-- ===================== MAIN CONTENT ===================== -->
  <main class="admin-main">

    <!-- Header -->
    <header class="admin-header">
      <div class="admin-header-left">
        <button class="admin-toggle-btn admin-sidebar-toggle" id="sidebarToggle">
          <span class="material-symbols-outlined">menu</span>
        </button>
        <div class="admin-breadcrumb">
          <a href="{{ route('admin.dashboard') }}">Dashboard</a>
          @hasSection('breadcrumb')
            <span class="material-symbols-outlined sep">chevron_right</span>
            @yield('breadcrumb')
          @endif
        </div>
      </div>
      <div class="admin-header-right">
        <a href="{{ url('/') }}" class="admin-header-icon-btn" title="Lihat Toko" target="_blank">
          <span class="material-symbols-outlined">storefront</span>
        </a>
        <div class="admin-header-user d-flex align-items-center gap-2">
          <div class="admin-header-avatar">
            @if(Auth::check() && Auth::user()->avatar)
              <img src="{{ asset('assets/img/avatars/'.Auth::user()->avatar) }}" alt="Avatar" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
            @else
              <span class="material-symbols-outlined">person</span>
            @endif
          </div>
          <span class="d-none d-md-inline fw-semibold text-dark">{{ Auth::check() ? Str::limit(Auth::user()->name, 12) : 'Admin' }}</span>
        </div>
      </div>
    </header>

    <!-- Content Area -->
    <div class="admin-content">

      {{-- Flash Messages --}}
      @if(session('success'))
        <div class="alert alert-success d-flex align-items-center mb-4" role="alert" id="adminAlert">
          <span class="material-symbols-outlined me-2">check_circle</span>
          <div>{{ session('success') }}</div>
        </div>
      @endif
      @if(session('error'))
        <div class="alert alert-danger d-flex align-items-center mb-4" role="alert" id="adminAlert">
          <span class="material-symbols-outlined me-2">error</span>
          <div>{{ session('error') }}</div>
        </div>
      @endif

      @yield('content')
    </div>
  </main>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
  // Sidebar toggle
  const sidebarToggle = document.getElementById('sidebarToggle');
  const sidebar = document.getElementById('adminSidebar');
  const overlay = document.getElementById('sidebarOverlay');
  const body = document.body;

  // Restore collapsed state on desktop
  if (localStorage.getItem('sidebarCollapsed') === 'true' && window.innerWidth > 768) {
      body.classList.add('sidebar-collapsed');
  }

  if (sidebarToggle) {
    sidebarToggle.addEventListener('click', function() {
      if (window.innerWidth <= 768) {
        // Mobile behavior: slide in
        sidebar.style.transform = 'translateX(0)';
        overlay.classList.add('show');
      } else {
        // Desktop behavior: collapse sidebar
        body.classList.toggle('sidebar-collapsed');
        localStorage.setItem('sidebarCollapsed', body.classList.contains('sidebar-collapsed'));
      }
    });
    
    overlay.addEventListener('click', function() {
      sidebar.style.transform = '';
      overlay.classList.remove('show');
    });
  }

  // Auto dismiss alert
  const alert = document.getElementById('adminAlert');
  if (alert) {
    setTimeout(() => { alert.style.opacity = '0'; setTimeout(() => alert.remove(), 400); }, 5000);
  }
</script>

@yield('script')
</body>
</html>
