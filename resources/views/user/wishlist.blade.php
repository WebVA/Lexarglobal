@extends('layout.home')

@section('style')
<style>
    .hero {
        /* background: linear-gradient(45deg, #262262, #9ec9ff); */
        background-color: #262262;
    }
</style>
@endsection('style')

@section('content')
    <!-- Hero Section-->
    <section class="hero hero-page">
        <div class="container">
          <div class="row d-flex">
            <div class="col-lg-9 order-2 order-lg-1" style="display: flex;align-self: center;">
              <h4 style="color:white;margin: 0;">Wishlist</h4>
            </div>
            <div class="col-lg-3 text-right order-1 order-lg-2">
              <ul class="breadcrumb justify-content-lg-end">
                <li class="breadcrumb-item"><a href="index.html" style="color:white">Home</a></li>
                <li class="breadcrumb-item active" style="color:white">Wishlist</li>
              </ul>
            </div>
          </div>
        </div>
    </section>

    <!-- Shopping Cart Section-->
    <section class="shopping-cart">
      <div class="container py-5">
        <div class="basket">
          <div class="basket-holder">
            <div class="basket-header">
              <div class="row">
                <div class="col-7">Product</div>
                <div class="col-2">Price</div>
                <div class="col-2">SKU</div>
                <div class="col-1 text-center">Remove</div>
              </div>
            </div>
            <div class="basket-body">
              <!-- Product-->
              @foreach($wishlist as $item)
              <div class="item">
                <div class="row d-flex align-items-center">
                  <div class="col-7">
                    <div class="d-flex align-items-center"><a href="/user/detail/{{$item['product_id']}}"><img src="{{asset('public/upload/product-images/'.$item['product_image'])}}" alt="{{$item['product_name']}}" class="img-fluid"></a>
                      <div class="title"><a href="/user/detail/{{$item['product_id']}}">
                          <h5>{{$item['product_name']}}</h5><span class="text-muted"></span></a></div>
                    </div>
                  </div>
                  <div class="col-2"><span>${{$item['eqp']}}</span></div>
                  <div class="col-2"><span>{{$item['sku']}}</span></div>
                  <div class="col-1 text-center" onclick="del_wishlist({{$item['id']}})"><i class="delete fa fa-trash"></i></div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="CTAs d-flex align-items-center justify-content-center justify-content-md-end flex-column flex-md-row"><a href="/user/main" class="btn btn-template wide">Continue Shopping</a></div>
      </div>
    </section>
@endsection

@section('script')
<script>
  function del_wishlist(id){
    $.ajax({
        url: "/user/del_wishlist",
        method:"post",
        dataType:"json",
        data:{
            id:id,
            "_token":"{{csrf_token()}}"
        },
        success: function(result){
        },
        error: function(error){
            console.log(error);
        }
    });
  }
</script>
@endsection