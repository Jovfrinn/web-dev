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
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">    
<title>Hello, world!</title>
  </head>
  <body>

  

    
          <div class="sidebar-backsite">
            <a class="logo-sidebar"><img src="data:image/png;base64,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" alt=""></a>
            <a class="profile-icon"><span class="material-symbols-outlined">
              account_circle
              </span></a>
              <hr>
            <a class="dashboard-icon"><span class="material-symbols-outlined">
              space_dashboard
              </span></a>
              <a href="/backsite/product/add" class="addProducts-icon"><span class="material-symbols-outlined">
                box_add
                </span></a>
            <a class="addStock-icon"><span class="material-symbols-outlined">
              inventory_2
              </span></a>
              <hr>
            <a class="logout-icon"><span class="material-symbols-outlined">
              logout
              </span></a>
          </div>
        </div>
      
          @yield('backContent')
      

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


{{-- <H1 class="d-none">GAjelas</H1> --}}





{{-- <script src=""></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

      
  </body>
</html>