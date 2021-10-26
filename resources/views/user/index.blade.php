@extends('layout.home')

@section('style')
    <style>
        pre {
            font-weight: 500;
            font-size: 1.5rem;
            font-family: "Poppins", sans-serif;
            color: white;
        }

        .blockquote {
            display:none;
        }

        .active-blog {
            display:show;
        }

        .blog-div {
            height: 250px;
            overflow: auto;
        }

        .blog-title {
            color: #262262;
            font-weight: bold;
            font-size: larger;
        }

        .blog-time {
            color: blue;
            font-size: medium;
        }
        
        @media (max-width: 567px) {
          section.first-page {
            display: none;
          }
        }
    </style>
@endsection('style')

@section('content')
    <section class="hero no-padding first-page">
        <!-- Hero Slider-->
        <div class="owl-carousel owl-theme hero-slider">
            @for ($i = 1; $i <= 10; $i++)
                @if ($homepage_setting->{"hero_title".$i} && $homepage_setting->{"hero_image".$i})
                    <div class="item align-items-center row">
                        <div class="text-white col-sm-6">
                            <h1 class="mb-4">{{ $homepage_setting->{"hero_title".$i} }}</h1>
                            <pre>{{ $homepage_setting->{"hero_text".$i} }}</pre>
                        </div>
                        <a target="_blank" href="{{ $homepage_setting->{"hero_url".$i} }}" class="ml-auto">
                            <img src="{{ asset('public/upload/website-setting-images/' . $homepage_setting->{"hero_image".$i}) }}"
                                class="ml-auto" alt="">
                        </a>
                    </div>        
                @endif
            @endfor
        </div>
    </section>

    <section class="daily-product">
        <div class="container-fluid">
            <div class="owl-carousel owl-theme products-slider">
                @for ($i = 1; $i <= 10; $i++)
                    @if ($homepage_setting->{"imgbar_img".$i})
                        <div class="item">
                            <div class="image d-flex align-items-center justify-content-center">
                                <a target="_blank" href="{{ $homepage_setting->{"imgbar_url".$i} }}" style="width: -webkit-fill-available;"><img class="imgbar"
                                        src="{{ asset('public/upload/website-setting-images/' . $homepage_setting->{"imgbar_img".$i}) }}"
                                        alt="product" class="img-fluid" /></a>
                            </div>
                        </div>       
                    @endif
                @endfor
            </div>
        </div>
    </section>

    <section class="categories mt-1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <a target="_blank" href="{{ $homepage_setting->sideimg_url }}" style="width:100%;height:100%;"><img
                            src="{{ asset('public/upload/website-setting-images/' . $homepage_setting->sideimg_img) }}"
                            class="img-1" alt=".." /></a>
                </div>
                <div class="col-lg-8">
                    <div class="container-fluid">
                        <div class="row text-left">
                            <div class="col-sm-4 pl-0">
                                <a target="_blank" href="/user/search_by_category/{{ $category1->id }}">
                                    <div class="item d-flex align-items-end">
                                        <img src="{{ asset('public/upload/website-setting-images/' . $homepage_setting->category_image1) }}"
                                            class='index_img' alt="">
                                    </div>
                                    <div class="content">
                                        <h3 class="h5">{{ $category1->category_name }}</h3>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a target="_blank" href="/user/search_by_category/{{ $category2->id }}">
                                    <div class="item d-flex align-items-end">
                                        <img src="{{ asset('public/upload/website-setting-images/' . $homepage_setting->category_image2) }}"
                                            class='index_img' alt="">
                                    </div>
                                    <div class="content">
                                        <h3 class="h5">{{ $category2->category_name }}</h3>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-4 pr-0">
                                <a target="_blank" href="/user/search_by_category/{{ $category3->id }}">
                                    <div class="item d-flex align-items-end">
                                        <img src="{{ asset('public/upload/website-setting-images/' . $homepage_setting->category_image3) }}"
                                            class='index_img' alt="">
                                    </div>
                                    <div class="content">
                                        <h3 class="h5">{{ $category3->category_name }}</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row text-left mt-4">
                            <div class="col-sm-4 pl-0">
                                <a target="_blank" href="/user/search_by_category/{{ $category4->id }}">
                                    <div class="item d-flex align-items-end">
                                        <img src="{{ asset('public/upload/website-setting-images/' . $homepage_setting->category_image4) }}"
                                            class='index_img' alt="">
                                    </div>
                                    <div class="content">
                                        <h3 class="h5">{{ $category4->category_name }}</h3>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a target="_blank" href="/user/search_by_category/{{ $category5->id }}">
                                    <div class="item d-flex align-items-end">
                                        <img src="{{ asset('public/upload/website-setting-images/' . $homepage_setting->category_image5) }}"
                                            class='index_img' alt="">
                                    </div>
                                    <div class="content">
                                        <h3 class="h5">{{ $category5->category_name }}</h3>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-4 pr-0">
                                <a target="_blank" href="/user/search_by_category/{{ $category6->id }}">
                                    <div class="item d-flex align-items-end">
                                        <img src="{{ asset('public/upload/website-setting-images/' . $homepage_setting->category_image6) }}"
                                            class='index_img' alt="">
                                    </div>
                                    <div class="content">
                                        <h3 class="h5">{{ $category6->category_name }}</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 news-blog blog-div">
                    <h5 class="ml-3">Latest News</h5>
                    <!-- <span class="date ml-4"><i class="fa fa-clock-o"></i>May 10th 2016</span> -->
                    @foreach ($news as $item)
                        <blockquote class="blockquote blockquote-primary">
                            <span class="blog-title">{{ $item->title }}</span><br>
                            <span>{{ $item->description }}</span><br>
                            <span class="blog-time">{{ date("m-d-Y", strtotime($item->created)) }}</span>
                        </blockquote>    
                    @endforeach
                </div>
                <div class="col-md-4 testimonial-blog blog-div">
                    <h5 class="ml-3">Testimonial</h5>
                    <!-- <span class="date ml-4"><i class="fa fa-clock-o"></i>May 10th 2016</span> -->
                    @foreach ($testimonial as $item)
                        <blockquote class="blockquote blockquote-primary">
                            <span class="blog-title">{{ $item->title }}</span><br>
                            <span>{{ $item->description }}</span><br>
                            <span class="blog-time">{{ date("m-d-Y", strtotime($item->created)) }}</span>
                        </blockquote>    
                    @endforeach
                </div>
                <div class="col-md-4 announcement-blog blog-div">
                    <h5 class="ml-3">Announcements</h5>
                    <!-- <span class="date ml-4"><i class="fa fa-clock-o"></i>May 10th 2016</span> -->
                    @foreach ($announcement as $item)
                        <blockquote class="blockquote blockquote-primary">
                            <span class="blog-title">{{ $item->title }}</span><br>
                            <span>{{ $item->description }}</span><br>
                            <span class="blog-time">{{ date("m-d-Y", strtotime($item->created)) }}</span>
                        </blockquote>    
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="brands">
        <div class="container-fluid">
            <div class="owl-carousel owl-theme brands-slider">
                @foreach ($allbrand as $item)
                    <div class="item d-flex align-items-center justify-content-center">
                        <div class="brand d-flex align-items-center"><img
                                src="{{ asset('public/upload/brand_images/' . $item->brand_image) }}" alt="..."
                                class="img-fluid brand-img" /></div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $(".brands").find(".owl-item").css("margin-right","0px");
            $(".news-blog").find(".blockquote").first().addClass("active-blog").show();
            $(".testimonial-blog").find(".blockquote").first().addClass("active-blog").show();
            $(".announcement-blog").find(".blockquote").first().addClass("active-blog").show();
            setInterval(alertFunc, 10000);
        });

        function alertFunc() {
            $prevobj_news = $(".news-blog").find(".active-blog").removeClass("active-blog").hide("slow");
            if($prevobj_news.next().is("blockquote")){
                $prevobj_news.next().addClass("active-blog").show("slow");
            }else{
                $(".news-blog").find(".blockquote").first().addClass("active-blog").show("slow");
            }

            $prevobj_testimonial = $(".testimonial-blog").find(".active-blog").removeClass("active-blog").hide("slow");
            if($prevobj_testimonial.next().is("blockquote")){
                $prevobj_testimonial.next().addClass("active-blog").show("slow");
            }else{
                $(".testimonial-blog").find(".blockquote").first().addClass("active-blog").show("slow");
            }

            $prevobj_announcement = $(".announcement-blog").find(".active-blog").removeClass("active-blog").hide("slow");
            if($prevobj_announcement.next().is("blockquote")){
                $prevobj_announcement.next().addClass("active-blog").show("slow");
            }else{
                $(".announcement-blog").find(".blockquote").first().addClass("active-blog").show("slow");
            }
            
        }
        
    </script>
@endsection
