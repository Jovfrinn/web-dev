<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="TrendStore - Belanja Online Terpercaya. Temukan produk terbaik dengan harga terjangkau.">

    <title>@yield('title', 'TrendStore — Belanja Online Terpercaya')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Material Symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

    <!-- Slick Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">

    <!-- TrendStore CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css?v=' . time()) }}">

    @yield('styles')
  </head>
  <body>

    <!-- ==================== NAVBAR ==================== -->
    <nav class="ts-navbar" id="mainNavbar">
      <div class="container ts-navbar-inner">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="navbar-brand">
          <span class="material-symbols-outlined">storefront</span>
          <span class="ts-brand-name">TrendStore</span>
        </a>

        <!-- Search Bar -->
        <form action="{{ route('search.product') }}" method="GET" class="ts-search-bar">
          <span class="material-symbols-outlined ts-search-icon">search</span>
          <input
            type="text"
            name="query"
            class="ts-search-input"
            placeholder="Cari produk, merek, kategori..."
            value="{{ request('query') }}"
            autocomplete="off"
          >
          <button type="submit" class="ts-search-btn">Cari</button>
        </form>

        <!-- Nav Actions -->
        <div class="ts-navbar-actions">

          <!-- Cart -->
          <a href="{{ route('cart.show') }}" class="ts-nav-icon-btn" title="Keranjang">
            <span class="material-symbols-outlined">shopping_cart</span>
            @if(session('cart') && session('cart') > 0)
              <span class="ts-cart-badge">{{ session('cart') }}</span>
            @endif
          </a>

          <!-- User Auth -->
          @auth
            <div class="ts-user-dropdown">
              <button class="ts-nav-user-btn" id="userDropdownBtn">
                <div class="ts-user-avatar">
                  <span class="material-symbols-outlined">person</span>
                </div>
                <span class="ts-user-name d-none d-md-inline">{{ Str::limit(Auth::user()->name, 12) }}</span>
                <span class="material-symbols-outlined ts-chevron">expand_more</span>
              </button>
              <div class="ts-dropdown-menu" id="userDropdown">
                <div class="ts-dropdown-header">
                  <div class="ts-dropdown-user-name">{{ Auth::user()->name }}</div>
                  <div class="ts-dropdown-user-email">{{ Auth::user()->email }}</div>
                </div>
                <div class="ts-dropdown-divider"></div>
                <a href="{{ route('orders.index') }}" class="ts-dropdown-item">
                  <span class="material-symbols-outlined">package_2</span>
                  Pesanan Saya
                </a>

                <a href="{{ route('profile.index') }}" class="ts-dropdown-item">
                  <span class="material-symbols-outlined">manage_accounts</span>
                  Profil Saya
                </a>
                @if(Auth::user()->id_role == 1 || Auth::user()->id_role == 2)
                  <div class="ts-dropdown-divider"></div>
                  <a href="{{ route('get.product.backsite') }}" class="ts-dropdown-item ts-dropdown-item-admin">
                    <span class="material-symbols-outlined">admin_panel_settings</span>
                    Admin Panel
                  </a>
                @endif
                <div class="ts-dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="ts-dropdown-item ts-dropdown-item-danger">
                  <span class="material-symbols-outlined">logout</span>
                  Keluar
                </a>
              </div>
            </div>
          @else
            <a href="{{ route('login') }}" class="ts-btn ts-btn-outline-primary ts-btn-sm">
              Masuk
            </a>
            <a href="{{ route('register') }}" class="ts-btn ts-btn-primary ts-btn-sm">
              Daftar
            </a>
          @endauth

          <!-- Mobile menu toggle -->
          <button class="ts-mobile-toggle d-lg-none" id="mobileToggle">
            <span class="material-symbols-outlined">menu</span>
          </button>
        </div>
      </div>

      <!-- Mobile Search (visible on small screens) -->
      <div class="ts-navbar-mobile-search d-lg-none">
        <form action="{{ route('search.product') }}" method="GET" class="ts-search-form">
          <div class="ts-search-wrap">
            <input type="text" name="query" class="ts-search-input" placeholder="Cari produk..." value="{{ request('query') }}">
            <button type="submit" class="ts-search-btn">
              <span class="material-symbols-outlined">search</span>
            </button>
          </div>
        </form>
      </div>

      <!-- Category Nav Bar -->
      <div class="ts-navbar-bottom">
        <div class="container ts-nav-cats py-2">
          @foreach(getCategory() as $category)
            <a href="{{ route('get.category', $category->id) }}"
               class="ts-nav-cat-link {{ Request::is('category/'.$category->id) ? 'active' : '' }}">
              {{ $category->name_categories }}
            </a>
          @endforeach
        </div>
      </div>
    </nav>

    <!-- Navbar spacer -->
    <div class="ts-navbar-spacer"></div>

    <!-- Flash Messages -->
    @if(session('success'))
      <div class="ts-toast ts-toast-success" id="flashToast">
        <span class="material-symbols-outlined">check_circle</span>
        {{ session('success') }}
        <button class="ts-toast-close" onclick="this.parentElement.remove()">×</button>
      </div>
    @endif
    @if(session('error'))
      <div class="ts-toast ts-toast-error" id="flashToast">
        <span class="material-symbols-outlined">error</span>
        {{ session('error') }}
        <button class="ts-toast-close" onclick="this.parentElement.remove()">×</button>
      </div>
    @endif

    <!-- ==================== CONTENT ==================== -->
    @yield('content')

    <!-- ==================== FOOTER ==================== -->
    <footer style="background-color: #FFFFFF; border-top: 1px solid #E5E7E9; padding: 40px 0 20px 0; margin-top: 60px;">
      <div class="container">
        <div class="row mb-4">
          <div class="col-lg-5 col-md-12 mb-4 mb-lg-0">
            <div class="d-flex align-items-center mb-3">
              <span class="material-symbols-outlined text-success me-2" style="font-size: 28px;">storefront</span>
              <h5 style="color: #00AA5B; font-weight: 800; margin: 0; font-size: 24px;">TrendStore</h5>
            </div>
            <p style="color: #6D7588; font-size: 14px; line-height: 1.6; max-width: 350px;">
              Destinasi belanja online pilihan Anda. Menawarkan pengalaman berbelanja yang aman, nyaman, dan produk berkualitas terbaik.
            </p>
          </div>
          <div class="col-lg-2 col-md-4 col-6 mb-4 mb-lg-0">
            <h6 style="color: #31353B; font-weight: 700; font-size: 14px; margin-bottom: 16px;">TrendStore</h6>
            <ul class="list-unstyled" style="font-size: 14px; line-height: 2;">
              <li><a href="#" style="color: #6D7588; text-decoration: none;">Tentang Kami</a></li>
              <li><a href="#" style="color: #6D7588; text-decoration: none;">Karir</a></li>
              <li><a href="#" style="color: #6D7588; text-decoration: none;">Blog</a></li>
              <li><a href="#" style="color: #6D7588; text-decoration: none;">Kebijakan Privasi</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-4 col-6 mb-4 mb-lg-0">
            <h6 style="color: #31353B; font-weight: 700; font-size: 14px; margin-bottom: 16px;">Bantuan</h6>
            <ul class="list-unstyled" style="font-size: 14px; line-height: 2;">
              <li><a href="#" style="color: #6D7588; text-decoration: none;">TrendStore Care</a></li>
              <li><a href="#" style="color: #6D7588; text-decoration: none;">Syarat & Ketentuan</a></li>
              <li><a href="#" style="color: #6D7588; text-decoration: none;">Mitra Kami</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-4 col-12">
            <h6 style="color: #31353B; font-weight: 700; font-size: 14px; margin-bottom: 16px;">Ikuti Kami</h6>
            <div class="d-flex gap-2">
              <a href="#" style="color: #6D7588; text-decoration: none;"><span class="material-symbols-outlined" style="font-size: 24px;">public</span></a>
              <a href="#" style="color: #6D7588; text-decoration: none;"><span class="material-symbols-outlined" style="font-size: 24px;">share</span></a>
              <a href="#" style="color: #6D7588; text-decoration: none;"><span class="material-symbols-outlined" style="font-size: 24px;">thumb_up</span></a>
            </div>
          </div>
        </div>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center pt-3" style="border-top: 1px solid #E5E7E9;">
          <span style="color: #6D7588; font-size: 14px;">© {{ date('Y') }} TrendStore. Hak Cipta Dilindungi.</span>
          <div class="d-flex gap-3 mt-3 mt-md-0" style="color: #6D7588; font-size: 14px;">
            <span>Indonesia</span>
            <span>English</span>
          </div>
        </div>
      </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

    <script>
    // Slick carousel defaults
    $('.slider-slick').slick({
      dots: false,
      infinite: false,
      speed: 400,
      slidesToShow: 5,
      slidesToScroll: 2,
      arrows: true,
      responsive: [
        { breakpoint: 1200, settings: { slidesToShow: 4, slidesToScroll: 2 }},
        { breakpoint: 992, settings: { slidesToShow: 3, slidesToScroll: 2 }},
        { breakpoint: 768, settings: { slidesToShow: 2, slidesToScroll: 1 }},
        { breakpoint: 480, settings: { slidesToShow: 1, slidesToScroll: 1 }}
      ]
    });

    // User dropdown toggle
    const userBtn = document.getElementById('userDropdownBtn');
    const userDropdown = document.getElementById('userDropdown');
    if (userBtn && userDropdown) {
      userBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        userDropdown.classList.toggle('show');
        userBtn.classList.toggle('active');
      });
      document.addEventListener('click', function() {
        userDropdown.classList.remove('show');
        userBtn.classList.remove('active');
      });
    }

    // Auto-dismiss flash toast
    const toast = document.getElementById('flashToast');
    if (toast) {
      setTimeout(() => { toast.style.opacity = '0'; setTimeout(() => toast.remove(), 400); }, 4000);
    }

    // Navbar scroll effect
    window.addEventListener('scroll', function() {
      const nav = document.getElementById('mainNavbar');
      if (nav) {
        if (window.scrollY > 10) nav.classList.add('scrolled');
        else nav.classList.remove('scrolled');
      }
    });
    </script>

    @yield('script')
  </body>
</html>
