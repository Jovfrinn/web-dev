<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Blinker:wght@100;200;300;400;600;700;800;900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Hello, world!</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#E387CC;">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="/">TEFA SMK CITRA NEGARA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Pindahkan form search ke dalam div baru dengan class mx-auto -->
                <div class="mx-auto mt-1">
                    <form action="{{ route('search.product') }}" method="GET" class="d-flex  search-bar-center custom-search">
                        <input type="text" name="query" class="form-control " placeholder="Cari produk..." aria-label="Search" value="{{ request('query') }}">
                           <button class="btn-custom btn-outline-success" type="submit"><span class="material-symbols-outlined">
                            search
                            </span></button>
                    </form>
                </div>
                <ul class="navbar-nav me-auto mb-2 ms-3 mb-lg-0 d-flex align-items-start">
                  <li class="nav-item ms-4 mt-2 mb-1">
                    <a href="{{route('cart.show')}}"><i class="material-symbols-outlined" style="color:rgb(6, 6, 6);">
                        shopping_cart
                        </i>
                        {{-- @dd(session('cart')) --}}
                        @if(session('cart'))
                        <span class="start-100 translate-middle badge rounded-pill bg-danger">
                            {{ session('cart')}}
                            <span class="visually-hidden"></span>
                          </span>
                          @endif
                    </a>

                </li>
                    <li class="nav-item mt-1 mb-1">
                    @if(Auth::check())
                    <a class="btn-login" href="{{route('logout')}}">Logout</a>
                    @else
                    <a class="btn-login" href="{{route('login')}}">Login</a>
                    @endif
                </li>

                 

                </ul>
            </div>
        </div>
    </nav>




      @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
    // <script src="https://kit.fontawesome.com/f1fd297175.js" crossorigin="anonymous"></script>
    <script>
    $('.slider-slick').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 6,
  slidesToScroll: 6,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});
    </script>
    @yield('script')
  </body>
</html>
