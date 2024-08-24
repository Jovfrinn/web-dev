@extends('fronsite.layouts.navbar')
@section('content')
<div class="detail" style="background-color: rgb(215, 215, 215)">
<div class="container">
    <div class="row mx-auto detail-product-img">
        <div class="col-md-4">
            <img  src="https://dandan-assets.s3-ap-southeast-1.amazonaws.com/public/product/321249.jpg" class="img-detail">
            <div class="section-img">
                <img src="https://dandan-assets.s3-ap-southeast-1.amazonaws.com/public/product/321249.jpg" class="img-support">
            </div>
        </div>
        <div class="col-md-8">
            <div class="detail-product">
                <div class="title-product">Sunlight? Sabun Cuci Piring</div>
                <div class="ready-stock">Stock: 200</div>
                <div class="price-product">Rp. 2.500</div>
                <div class="quantity">
                    <form>
                        <label for="quantity">Quantity : </label>
                        <input type="number" id="quantity" name="quantity" min="1" max="10">
                    </form>
                </div>
                <div class="btn-productCart"><a href="#"><span class="material-symbols-outlined">
                    add
                    </span>Keranjang</a></div>
            </div>

            <div class="detail-description">
                <div class="description-title">Deskripsi</div>
                    <div class="text-description">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perferendis unde dicta libero, deleniti cum incidunt excepturi iure ipsam fugiat fuga magnam eveniet ipsum fugit repellendus inventore voluptatem, error beatae aspernatur facilis. Explicabo impedit molestias magnam. Nesciunt similique assumenda tenetur optio repellat dolorum beatae harum earum quis saepe deleniti commodi vel iure, voluptatem dolor quidem deserunt rem aut qui nostrum cum reprehenderit odio? Minus maiores accusamus quis, ipsa quaerat ipsam velit illum libero dignissimos fugit nam necessitatibus perspiciatis commodi numquam dolor, modi quo ducimus adipisci animi asperiores sequi. Deserunt nisi dolores eligendi, fuga debitis ratione sunt dicta perspiciatis quaerat nobis commodi!
                    </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection