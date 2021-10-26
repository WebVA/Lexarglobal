@extends('layout.home')
@section('style')
<link rel="stylesheet" href="{{asset('assets/user/css/style.css') }}" />
<style>
    html {
        scroll-behavior: smooth;
    }
.hero {
    /* background: linear-gradient(45deg, #262262, #9ec9ff); */
    background-color: #262262;
}
.custom-control-label {
    font-size: small;
}
a, span, i, small {
    font-size: 14px;
}
.price-filter {
    display:flex;
    align-items:center;
}
.price-filter i {
    margin-right:5px;
} 
.price-filter span {
    margin-right:10px;
    margin-left:10px;
}
.price-filter input{
    width: 70px;
}
</style>
@endsection('style')

@section('content')
    <section class="hero hero-page">
        <div class="container">
            <div class="row d-flex">
            <div class="col-lg-9 order-2 order-lg-1" style="display: flex;align-self: center;">
                <h4 style="color:white;margin: 0;">Products</h4>
            </div>
            <div class="col-lg-3 text-right order-1 order-lg-2">
                <ul class="breadcrumb justify-content-lg-end">
                <li class="breadcrumb-item"><a href="index.html" style="color:white">Home</a></li>
                <li class="breadcrumb-item active" style="color:white">Products</li>
                </ul>
            </div>
            </div>
        </div>
    </section>

    <main>
        <div class="container">
            <div class="row" style="margin-top: -70px;">
                <!-- Sidebar-->
                <div class="sidebar col-xl-3 col-lg-4 sidebar">
                    <div class="block">
                        <h6 class="text-uppercase">Product Filter</h6>
                        <div class="row mb-3">
                            <button class="apply" onclick="search_product_request()">Apply</button>
                            <button class="reset" onclick="reset()">Reset</button>
                        </div>
                        <div class="form-group">
                            <input type="text" id="search_description" placeholder="Search By Description" class="form-control">
                        </div>
                        <p>Filter By Price</p>
                        <div class="price-filter">
                            <i class="fa fa-usd"></i>
                            <input type="number" min=0 id="search_price_lower" placeholder="min" class="form-control">
                            <span class="glyphicon">&#x2212;</span>
                            <i class="fa fa-usd"></i>
                            <input type="number" min=0 id="search_price_upper" placeholder="max" class="form-control">
                        </div>
                        <ul class="list-unstyled">
                            <li>
                                <a class="d-flex justify-content-between align-items-center main-category"><span>Brand Name</span></a>
                                <div class="options ml-3">
                                    <div class="custom-control custom-checkbox mb-1 search_brand">
                                        @if($brandparam)
                                        <input type="checkbox" class="custom-control-input default_check" id="brand_all" name="brand_all" onchange="validation_check($(this))">
                                        @else
                                        <input type="checkbox" class="custom-control-input default_check" id="brand_all" name="brand_all" checked onchange="validation_check($(this))">
                                        @endif
                                        
                                        <label class="custom-control-label" for="brand_all">All</label>
                                        <small></small>
                                    </div>
                                @foreach($branddata as $item)
                                    @if($item->num)
                                        <div class="custom-control custom-checkbox mb-1 search_brand">
                                        @if($brandparam == $item->brand_name)
                                            <input type="checkbox" class="custom-control-input optional_check" id="brand_{{$item->id}}" name="brand_{{$item->id}}" checked onchange="check_default($(this))">
                                        @else
                                            <input type="checkbox" class="custom-control-input optional_check" id="brand_{{$item->id}}" name="brand_{{$item->id}}" onchange="check_default($(this))">
                                        @endif
                                            <label class="custom-control-label" for="brand_{{$item->id}}">{{$item->brand_name}}</label>
                                            <small>{{$item->num?$item->num:''}}</small>
                                        </div>
                                    @endif
                                @endforeach
                                </div>
                            </li>
                            <li>
                                <a class="d-flex justify-content-between align-items-center main-category"><span>Product Color</span></a>
                                <div class="options ml-3">
                                    <div class="custom-control custom-checkbox mb-1 search_color">
                                        <input type="checkbox" class="custom-control-input default_check" id="color_all" name="color_all" checked onchange="validation_check($(this))">
                                        <label class="custom-control-label" for="color_all">All</label>
                                        <small></small>
                                    </div>
                                @foreach($colordata as $item)
                                    @if($item['color_num'])
                                    <div class="custom-control custom-checkbox mb-1 search_color">
                                        <input type="checkbox" class="custom-control-input optional_check" id="color_{{$item['id']}}" name="color_{{$item['id']}}" onchange="check_default($(this))">
                                        <label class="custom-control-label" for="color_{{$item['id']}}">{{$item['color_name']}}</label>
                                        <small>{{$item['color_num']?$item['color_num']:''}}</small>
                                    </div>
                                    @endif
                                @endforeach
                                </div>
                            </li>
                            <li>
                                <a class="d-flex justify-content-between align-items-center main-category"><span>Product Material</span></a>
                                <div class="options ml-3">
                                    <div class="custom-control custom-checkbox mb-1 search_material">
                                        <input type="checkbox" class="custom-control-input default_check" id="material_all" name="material_all" checked onchange="validation_check($(this))">
                                        <label class="custom-control-label" for="material_all">All</label>
                                        <small></small>
                                    </div>
                                @foreach($materialdata as $item)
                                    @if($item->num)
                                    <div class="custom-control custom-checkbox mb-1 search_material">
                                        <input type="checkbox" class="custom-control-input optional_check" id="material_{{$item->id}}" name="material_{{$item->id}}" onchange="check_default($(this))">
                                        <label class="custom-control-label" for="material_{{$item->id}}">{{$item->name}}</label>
                                        <small>{{$item->num?$item->num:''}}</small>
                                    </div>
                                    @endif
                                @endforeach
                                </div>
                            </li>
                            <li>
                                <a class="d-flex justify-content-between align-items-center main-category"><span>Decoration Method</span></a>
                                <div class="options ml-3">
                                    <div class="custom-control custom-checkbox mb-1 search_decoration">
                                        <input type="checkbox" class="custom-control-input default_check" id="decoration_all" name="decoration_all" checked onchange="validation_check($(this))">
                                        <label class="custom-control-label" for="decoration_all">All</label>
                                        <small></small>
                                        <small></small>
                                    </div>
                                @foreach($decorationdata as $item)
                                    @if($item['num'])
                                    <div class="custom-control custom-checkbox mb-1 search_decoration">
                                        <input type="checkbox" class="custom-control-input optional_check" id="decoration_{{$item['id']}}" name="decoration_{{$item['id']}}" onchange="check_default($(this))">
                                        <small style="display:none;">{{$item['id']}}</small>
                                        <label class="custom-control-label" for="decoration_{{$item['id']}}">{{$item['name']}}</label>
                                        <small>{{$item['num']?$item['num']:''}}</small>
                                    </div>
                                    @endif
                                @endforeach
                                </div>
                            </li>
                            <li>
                                <a class="d-flex justify-content-between align-items-center main-category"><span>Discount Code</span></a>
                                <div class="options ml-3">
                                    <div class="custom-control custom-checkbox mb-1 search_discount">
                                        <input type="checkbox" class="custom-control-input default_check" id="discard_all" name="discard_all" checked onchange="validation_check($(this))">
                                        <label class="custom-control-label" for="discard_all">All</label>
                                        <small></small>
                                    </div>
                                @foreach($discarddata as $item)
                                    @if($item->num)
                                    <div class="custom-control custom-checkbox mb-1 search_discount">
                                        <input type="checkbox" class="custom-control-input optional_check" id="discard_{{$item->id}}" name="discard_{{$item->id}}" onchange="check_default($(this))">
                                        <label class="custom-control-label" for="discard_{{$item->id}}">{{$item->name}}</label>
                                        <small>{{$item->num?$item->num:''}}</small>
                                    </div>
                                    @endif
                                @endforeach
                                </div>
                            </li>
                            <li>
                                <a class="d-flex justify-content-between align-items-center main-category"><span>Featured and Sale Items</span></a>
                                <div class="options ml-3">
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input default_check" id="search_featured_all" name="search_featured_all" checked onchange="validation_check($(this))">
                                        <label class="custom-control-label" for="search_featured_all">All</label>
                                        <small></small>
                                    </div>
                                    @if($featureddata)
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input optional_check" id="search_featured" name="search_featured" onchange="check_default($(this))">
                                        <label class="custom-control-label" for="search_featured">Featured</label>
                                        <small>{{$featureddata?$featureddata:''}}</small>
                                    </div>
                                    @endif
                                    @if($onsaledata)
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input optional_check" id="search_onsale" name="search_onsale" onchange="check_default($(this))">
                                        <label class="custom-control-label" for="search_onsale">On Sale</label>
                                        <small>{{$onsaledata?$onsaledata:''}}</small>
                                    </div>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="block">
                        <h6 class="text-uppercase">Category Filter</h6>
                        <ul class="list-unstyled">
                            @foreach($categorydata as $item)
                            @if($item['num'])
                            <li class="search_category">
                                <a class="d-flex justify-content-between align-items-center main-category"><span>{{$item['name']}}</span><small>{{$item['num']?$item['num']:''}}</small><small class="category_id" style="display:none;">{{$item['id']}}</small></a>
                                <div class="options ml-3">
                                    <div class="custom-control custom-checkbox mb-1 search_subcategory">
                                        @if($categoryparam == $item['id'])
                                        <input type="checkbox" class="custom-control-input default_check" id="category_all_{{$item['id']}}" name="category_all_{{$item['id']}}" checked onchange="validation_check_category($(this))">
                                        @else
                                        <input type="checkbox" class="custom-control-input default_check" id="category_all_{{$item['id']}}" name="category_all_{{$item['id']}}" onchange="validation_check_category($(this))">
                                        @endif
                                        <label class="custom-control-label" for="category_all_{{$item['id']}}">All</label>
                                        <small></small><small class="subcategory_id" style="display:none;">0</small>
                                    </div>
                                @foreach($item['subcategory'] as $subitem)
                                @if($subitem['num'])
                                    <div class="custom-control custom-checkbox mb-1 search_subcategory">
                                        <input type="checkbox" class="custom-control-input optional_check" id="category_{{$subitem['id']}}" name="category_{{$subitem['id']}}" onclick="check_default_category($(this))">
                                        <label class="custom-control-label" for="category_{{$subitem['id']}}">{{$subitem['name']}}</label>
                                        <small>{{$subitem['num']?$subitem['num']:''}}</small><small class="subcategory_id" style="display:none;">{{$subitem['id']}}</small>
                                    </div>
                                @endif
                                @endforeach
                                </div>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="block row">
                        <button class="apply" onclick="search_product_request()">Apply</button>
                        <button class="reset" onclick="reset()">Reset</button>
                    </div>
                </div>
                <!-- /Sidebar end-->
                <!-- Grid -->
                <div class="products-grid col-xl-9 col-lg-8 sidebar-left">
                    <header class="d-flex justify-content-between align-items-start">
                        <span class="visible-items">
                            <button class="btn grid-view selected"><i class="fa fa-th"></i></button>
                            <button class="btn list-view"><i class="fa fa-th-list"></i></button>
                        </span>
                        <select id="sorting" class="bs-select" onchange="search_product_request()">
                            <option value="name_asc">Name(A-Z)</option>
                            <option value="name_desc">Name(Z-A)</option>
                            <option value="price_asc">Low Price</option>
                            <option value="price_desc">High Price</option>
                        </select>
                    </header>
                    <div class="row" id="product-list">
                        <!-- item-->
                        @foreach($productddata as $item)
                        <div class="item col-xl-3 col-md-6">
                            <div class="product is-gray">
                                <div class="image d-flex align-items-center justify-content-center" onclick="goto_detail({{$item['id']}})">
                                    @if($item['featured'] == 1)
                                    <div class="ribbon ribbon-primary text-uppercase">Featured</div>
                                    @endif
                                    @if($item['onsale'] == 1)
                                    <div class="ribbon ribbon-danger text-uppercase">Sale</div>
                                    @endif
                                    <!-- <div class="ribbon ribbon-success text-uppercase">New</div> -->
                                    <img src="{{asset('public/upload/product-images/'.$item['product_image'])}}" alt="{{$item['product_name']}}" class="img-fluid"/>
                                </div>
                                <div class="title">
                                    <small class="text-muted" style='display:block;line-height:1;'><b>{{$item['brand_name']}}</b></small>
                                    <small class="text-muted">Iterm#: {{$item['sku']}}</small>
                                    <a href="/user/detail/{{$item['id']}}"><h3 class="h6 text-uppercase no-margin-bottom">{{$item['product_name']}}</h3></a>
                                    <span style="display:none">{{$item['product_image']}}</span>
                                    <span class="price text-muted mb-1">EQP : ${{number_format($item['eqp'], 2, '.', '')}}</span>
                                    <a href="javascript:void(0)" class="action-btn mb-1" onclick="add_wishlist({{$item['id']}},$(this))"><i class="fa fa-heart"></i> Add to Wishlist</a>
                                    <p class="description"><?php echo strip_tags($item['description']);?></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <nav aria-label="page navigation example" class="d-flex justify-content-center">
                        <ul class="pagination pagination-custom">
                            <li class="page-item prev-btn" onclick="go_page(-1)">
                                <a href="javascript:void(0)" aria-label="Previous" class="page-link"><span aria-hidden="true">Prev</span><span class="sr-only">Previous</span></a>
                            </li>
                            <li class="page-item" onclick="set_page($(this))"><a href="javascript:void(0)" class="page-link page-num active">1 </a></li>
                            @for($i=2;$i<6;$i++)
                                @if(ceil($product_all / 24) >= $i)
                                    <li class="page-item" onclick="set_page($(this))"><a href="javascript:void(0)" class="page-link page-num">{{$i}} </a></li>
                                @else
                                    <li class="page-item" onclick="set_page($(this))"><a href="javascript:void(0)" class="page-link page-num" style="display:none;">{{$i}} </a></li>
                                @endif
                            @endfor
                            <li class="page-item next-btn" onclick="go_page(1)">
                                <a href="javascript:void(0)" aria-label="Next" class="page-link"><span aria-hidden="true">Next</span><span class="sr-only">Next </span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- / Grid End-->
            </div>
        </div>
    </main>
    <div class='wishlist-modal'></div>

@endsection

@section('script')

<script>
    $("#search_key").val("<?php echo $key; ?>");
    var total_product = {{$product_all}};
    $(function () {
        var $grid = $(".masonry-wrapper").masonry({
            itemSelector: ".item",
            columnWidth: ".item",
            percentPosition: true,
            transitionDuration: 0,
        });

        $grid.imagesLoaded().progress(function () {
            $grid.masonry();
        });
    });
    $(".main-category").on("click", function() {
        if(!$(this).hasClass('active')) {
            $(".main-category").each(function(){
                $(this).removeClass('active')
                $(this).parent().find('.options').slideUp();
            })
            $(this).addClass('active')
            $(this).parent().find('.options').slideDown();
        }
        // $(this).toggleClass('active')
        // $(this).parent().find('.options').slideToggle()
    });
    
    function goto_detail(id){
        window.location.href = "/user/detail/"+id;
        // window.open("/user/detail/"+id);
    };

    function search_product_request(){
        $(".page-num").each(function(){
            $(this).removeClass('active');
        })
        
        $(".page-num").eq(0).addClass('active');
        $(".page-num").eq(0).html('1');
        search_product();
        window.scrollTo(0, 0);

    }

    function search_product(){
        search_brand = [];
        search_color = [];
        search_material = [];
        search_decoration = [];
        search_discount = [];
        search_category_arry = [];
        $(".search_brand input[type=checkbox]:checked").each(function(){
            search_brand.push($(this).next().html());
        })
        $(".search_color input[type=checkbox]:checked").each(function(){
            search_color.push($(this).next().html());
        })
        $(".search_material input[type=checkbox]:checked").each(function(){
            search_material.push($(this).next().html());
        })
        $(".search_decoration input[type=checkbox]:checked").each(function(){
            search_decoration.push($(this).next().html());
        })
        $(".search_discount input[type=checkbox]:checked").each(function(){
            search_discount.push($(this).next().html());
        })
        $(".search_category").each(function(){
            search_category = {
                id:'',
                subcategory:[]
            };
            count_cat = 0;
            $(this).find(".search_subcategory input[type=checkbox]:checked").each(function(){
                count_cat++;
            })
            if(count_cat){
                search_category.id = $(this).find(".category_id").html();
                $(this).find(".search_subcategory input[type=checkbox]:checked").each(function(){
                    search_category.subcategory.push($(this).next().next().next().html());
                })
                search_category_arry.push(search_category);
            }
        })
        if ($("#search_featured").is(
            ":checked")) {
            search_featured = 1;
        }else{
            search_featured = 0;
        }
        if ($("#search_onsale").is(
            ":checked")) {
            search_onsale = 1;
        }else{
            search_onsale = 0;
        }
        console.log(search_category_arry);

        search_by_des = $("#search_description").val();
        if(search_by_des.includes("/")){
            search_by_des = search_by_des.replace("/", "_lol_");
        }
        
        $.ajax({
            url: "/user/search_product_api",
            method:"get",
            dataType:"json",
            data:{
                description:search_by_des,
                price_lower:$("#search_price_lower").val(),
                price_upper:$("#search_price_upper").val(),
                brand:search_brand,
                color:search_color,
                material:search_material,
                decoration:search_decoration,
                discount:search_discount,
                featured:search_featured,
                onsale:search_onsale,
                category:search_category_arry,
                sorting:$("#sorting").val(),
                page:$(".page-item").find(".active").html(),
                "_token":"{{csrf_token()}}"
            },
            success: function(result){
                console.log(result);
                txt = "";
                total_product = result['length'];
                result = result['search_result'];
                for(i in result){
                    txt += "<div class='item col-xl-3 col-md-6'><div class='product is-gray'><div class='image d-flex align-items-center justify-content-center' onclick='goto_detail("+result[i]['id']+")'>";
                    if(result[i]['featured'] == 1){
                        txt += "<div class='ribbon ribbon-primary text-uppercase'>Featured</div>";
                    }
                    if(result[i]['onsale'] == 1){
                        txt += "<div class='ribbon ribbon-danger text-uppercase'>Sale</div>";
                    }
                    txt += "<img src='/public/upload/product-images/"+result[i]['product_image']+"' alt='"+result[i]['product_name']+"' class='img-fluid' /></div><div class='title'><small class='text-muted' style='display:block;line-height:1;'><b>"+result[i]['brand_name']+"</b></small><small class='text-muted'>Iterm# :"+result[i]['sku']+"</small><a href='/user/detail/"+result[i]['id']+"'><h3 class='h6 text-uppercase no-margin-bottom'>"+result[i]['product_name']+"</h3></a><span style='display:none;'>"+result[i]['product_image']+"</span><span class='price text-muted mb-1'>EQP: $"+(result[i]['eqp']?parseFloat(result[i]['eqp']).toFixed(2):'0.00')+"</span><a href='javascript:void(0)' class='action-btn mb-1' onclick='add_wishlist("+result[i]['id']+",$(this))'><i class='fa fa-heart'></i> Add to Wishlist</a><p class='description'>";
                    txt += result[i]['description'].replace(/(<([^>]+)>)/gi, "");
                    txt += "</p></div></div></div>";
                }
                
                // alert(total_product);
                $("#product-list").html('');
                $("#product-list").append(txt);
                $(".page-num").each(function(){
                    var pageNum = parseInt($(this).html());
                    console.log(pageNum, total_product, 'in initial')
                    if(Math.ceil(total_product / 24) < pageNum){
                        $(this).hide();
                        $(this).removeClass('active');
                        $(this).html(parseInt($(this).parent().prev().find("a").html())+1);
                    } else if(Math.ceil(total_product / 24) >= pageNum) {
                        $(this).show();
                        // $(this).html(parseInt($(this).html()));
                        $(this).removeClass('active');
                        // $(".page-num").eq(0).addClass('active');
                    }
                })
                $(".page-num").eq(0).addClass('active');
                    
            },
            error: function(error){
                console.log(error);
            }
        });
    }

    function reset(){
        $("#search_description").val('');
        $("#search_price_lower").val('');
        $("#search_price_upper").val('');
        $(".optional_check").each(function(){
            $(this).prop("checked", false);
        })
        $(".default_check").each(function(){
            $(this).prop("checked", true);
        })
        $(".search_category .default_check").each(function(){
            $(this).prop("checked", false);
        })
        $(".main-category").each(function(){
            $(this).removeClass('active')
            $(this).parent().find('.options').slideUp();
        })
    }

    function go_page(type){
        if(type>0){
            if($(".page-num").eq(4).html()<=Math.ceil(total_product / 24)){
                $(".page-num").each(function(){
                    var pageNum = parseInt($(this).html())+5;
                    if(Math.ceil(total_product / 24) < pageNum){
                        $(this).hide();
                        $(this).removeClass('active');
                        $(this).html(parseInt($(this).html())+5);
                    } else if(Math.ceil(total_product / 24) >= pageNum) {
                        $(this).show();
                        $(this).html(parseInt($(this).html())+5);
                        $(this).removeClass('active');
                    }
                })
                $(".page-num").eq(0).addClass('active');
                search_product();
                
                setTimeout(() => {
                    $(".page-num").each(function(){
                        $(this).removeClass('active');
                    })
                    $(".page-num").eq(0).addClass('active');    
                }, 1000);
            }
        }else{
            if($(".page-num").eq(0).html()!=1){
                $(".page-num").each(function(){
                    $(this).show();
                    $(this).html(parseInt($(this).html())-5);
                    $(this).removeClass('active');
                })
                $(".page-num").eq(4).addClass('active');
                search_product();
                
                setTimeout(() => {
                    $(".page-num").each(function(){
                        $(this).removeClass('active');
                    })
                    $(".page-num").eq(4).addClass('active');    
                }, 1000);
            }
        }
    }

    function set_page(obj){
        $(".page-num").each(function(){
            $(this).removeClass('active');
        })
        obj.find("a").addClass('active');
        search_product();
        
        setTimeout(() => {
            $(".page-num").each(function(){
                $(this).removeClass('active');
            })
            obj.find("a").addClass('active');    
        }, 1000);
    }

    function check_default(obj){
        count = 0;
        obj.parent().parent().find(".optional_check").each(function(){
            if ($(this).is(
            ":checked")) {
                count = 1;
            }
        });
        if(count){
            obj.parent().parent().find(".default_check").prop("checked", false);
        }else{
            obj.parent().parent().find(".default_check").prop("checked", true);
        }
    }

    function check_default_category(obj){
        count = 0;
        obj.parent().parent().find(".optional_check").each(function(){
            if ($(this).is(
            ":checked")) {
                count = 1;
            }
        });
        if(count){
            obj.parent().parent().find(".default_check").prop("checked", false);
        }
    }

    function validation_check(obj){
        if (obj.is(
        ":checked")) {
            obj.parent().parent().find(".optional_check").each(function(){
                $(this).prop("checked", false);
            })
        }else{
            obj.prop("checked", true);
        }
    }

    function validation_check_category(obj){
        if (obj.is(
        ":checked")) {
            obj.parent().parent().find(".optional_check").each(function(){
                $(this).prop("checked", false);
            })
        }
    }

    function add_wishlist(id,obj){
        $.ajax({
            url: "/user/add_wishlist",
            method:"post",
            dataType:"json",
            data:{
                id:id,
                "_token":"{{csrf_token()}}"
            },
            success: function(result){console.log(result);
                if(result['type'] == 'success'){
                    txt = "<div aria-labelledby='cartdetails' class='wishlist-card'><div class='cart-product'><div class='d-flex align-items-center'><div class='img'><img src='/public/upload/product-images/"+obj.prev().prev().html()+"' alt='...' class='wishlist-img'></div><div class='details justify-content-between'><p class='mb-0'>Success ! </p><div class='wishlist-name'><a href='/user/detail/"+id+"'><strong>"+obj.prev().prev().prev().find("h3").html()+"</strong></a> </div><p>has been added to your wishlist.</p></div><i class='fa fa-close' onclick='close_wishlist($(this))'></i></div></div><div class='dropdown-item CTA d-flex'><a href='/user/main' class='btn-wishlist'>Continue</a><a href='/user/wishlist' class='btn-wishlist'>Wishlist</a></div></div>";
                }else if(result['type'] == 'login'){
                    txt = "<div aria-labelledby='cartdetails' class='wishlist-card'><div class='cart-product'><div class='d-flex align-items-center'><div class='details justify-content-between'><p class='mb-0'>Alert ! </p><p>You must login or create an account to save <a href='/user/detail/"+id+"'><strong class='wishlist-name'>"+obj.prev().prev().prev().find("h3").html()+"</strong></a> to your wish list!</p></div><i class='fa fa-close' onclick='close_wishlist($(this))'></i></div></div><div class='dropdown-item CTA d-flex'><a href='/user/main' class='btn-wishlist'>Continue</a><a href='/user/wishlist' class='btn-wishlist'>Wishlist</a></div></div>";
                }
                $(".wishlist-modal").append(txt);
            },
            error: function(error){
                console.log(error);
            }
        });
        topFunction();
    }

    function close_wishlist(obj){
        obj.closest('.wishlist-card').remove();
    }

    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    function scrollToTop(){
    }
</script>
@endsection