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
    <title>Hello, world!</title>
  </head>
  <body>

    <div class="logo-container">
        <img src="{{ asset('assets/logoCN.png') }}" alt="Logo" class="logo">
        <span class="logo-text">Tefa SMK Citra Negara</span>
    </div>
    <div class="sidebar-admin">
    <a href=""><span class="material-symbols-outlined" style="display:flex; align-items:center; justify-content:center;">
        local_shipping
        </span></a>
    <a href=""><span class="material-symbols-outlined" style="display:flex; align-items:center; justify-content:center;">
        Inventory
        </span></a>
    <a href=""><span class="material-symbols-outlined" style="display:flex; align-items:center; justify-content:center;">
        account_Circle
        </span></a>
    <a href=""><span class="material-symbols-outlined" style="display:flex; align-items:center; justify-content:center;">
        Dashboard
        </span></a>
    <a href=""><span class="material-symbols-outlined" style="display:flex; align-items:center; justify-content:center;">
            assignment_add
        </span></a>
    <a href=""><span class="material-symbols-outlined" style="display:flex; align-items:center; justify-content:center;">
            Monitoring
        </span></a>

    <a href=""><span class="material-symbols-outlined" style="display:flex; align-items:center; justify-content:center;">
        Login
        </span></a>
  </div>
   <header>
       <div class="page-information">
          <h1>Input Stock</h1>
       </div>
        <div class="profile">
            <img src="{{ asset('assets/logoCN.png') }}" alt="profile picture">
            <h2 id="username"></h2>
        </div>
   </header>
{{-- 
   <form action="{{ route('product.add-stock', $product->id) }}" method="POST">
    @csrf
    <input type="number" name="amount" placeholder="Jumlah yang ditambah">
    <button type="submit">Tambah Stok</button>
</form>

<form action="{{ route('product.reduce-stock', $product->id) }}" method="POST">
    @csrf
    <input type="number" name="amount" placeholder="Jumlah yang dikurangi">
    <button type="submit">Kurangi Stok</button>
</form> --}}





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  

  </body>
</html>
