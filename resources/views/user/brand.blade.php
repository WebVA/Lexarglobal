@extends('layout.home')

@section('style')
<style>
.hero {
    /* background: linear-gradient(45deg, #262262, #9ec9ff); */
    background-color: #262262;
}

.brandbtn {
  padding: 10px;
}

.brand:hover .brandbtn{
  /* padding-left: 20px;
  padding-right: 20px; */
  padding: 0px;
}
</style>
@endsection('style')

@section('content')
    <!-- Hero Section-->
    <section class="hero hero-page">
        <div class="container">
          <div class="row d-flex">
            <div class="col-lg-9 order-2 order-lg-1" style="display: flex;align-self: center;">
              <h4 style="color:white;margin: 0;">Brand</h4>
            </div>
            <div class="col-lg-3 text-right order-1 order-lg-2">
              <ul class="breadcrumb justify-content-lg-end">
                <li class="breadcrumb-item"><a href="index.html" style="color:white">Home</a></li>
                <li class="breadcrumb-item active" style="color:white">Brand</li>
              </ul>
            </div>
          </div>
        </div>
    </section>

    <main>
        <div class="container brand-list mt-5 mb-5">
            <?php $i=6;?>
            @if($i%6==0)
                <div class="row">
            @endif
                @foreach($allbrand as $item)
                    <div class="col-sm-2 brand">
                      <a href="/user/search_by_brand/{{$item->brand_name}}" style="margin:10px;">
                        <img src="{{asset('public/upload/brand_images/'.$item->brand_image)}}" alt="{{$item->brand_name}}"  class="brandbtn"/>
                      </a>
                    </div>
                @endforeach
            @if($i%6==0)
                </div>
            @endif
            <?php $i++;?>
        </div>
    </main>
@endsection

@section('script')
<script>

</script>
@endsection