@extends('layout.home')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/quill/dist/quill.core.css') }}">   --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/argon.css?v=1.1.0') }}"> --}}
    <style>
        .hero {
            background-color: #262262;
            margin-bottom: 50px;
        }

        #decoration_method {
            width: 200px;
            margin-left: 10px;
        }
        .zoom {
            width: 400px;
            height: 400px;
            object-fit: contain;            
        }

        .zoom_cover {
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: #000;
            opacity: .9;
        }

        #zoommodal {
            width: 100%;
            height: 100%;
            /* background-color: #f9f7f7; */
            position: absolute;
            top: 0px;
            z-index: 1000;
            display: none;
        }

        #zoommodal img {
            position: fixed;
            top: 50%;
            left: 50%;
            z-index: 1000;
            transform: translate(-50%, -50%);
            border: 10px solid #888888;
            border-radius: 7px;
            width: auto;
            height: 700px;
        }

    </style>
@endsection('style')
@section('content')

    <section class="hero hero-page" style="">
        <div class="container">
            <div class="row d-flex">
                <div class="col-lg-9 order-2 order-lg-1" style="display: flex;align-self: center;">
                    <h4 style="color:white;margin: 0;">Product Details</h4>
                </div>
                <div class="col-lg-3 text-right order-1 order-lg-2">
                    <ul class="breadcrumb justify-content-lg-end">
                        <li class="breadcrumb-item"><a href="/" style="color:white">Home</a></li>
                        <li class="breadcrumb-item active" style="color:white">Product Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="product-details">
        <div class="container">
            <div class="row">
                <div class="product-images col-lg-6">
                    @if ($product->featured)
                        <div class="ribbon-info text-uppercase">Featured</div>
                    @endif
                    @if ($product->onsale)
                        <div class="ribbon-primary text-uppercase">Sale</div>
                    @endif
                    <div data-slider-id="1" class="owl-carousel items-slider owl-drag">
                        @foreach ($product_image as $item)
                            <img class="zoom"
                                src="{{ asset('public/upload/product-images/' . $item->product_image) }}"
                                alt="{{ $product->product_name }}" onclick="showmodal($(this))"/>
                        @endforeach
                    </div>
                    <div data-slider-id="1" class="owl-thumbs">
                        @foreach ($product_image as $item)
                            <button class="owl-thumb-item"><img
                                    src="{{ asset('public/upload/product-images/' . $item->product_image) }}"
                                    alt="{{ $product->product_name }}" /></button>
                        @endforeach
                    </div>
                </div>
                <div class="details col-lg-6">
                    <h4>{{ $product->product_name }}</h4><br>
                    
                    <div class="d-flex">
                        <h6>SKU : <span>{{ $product->sku }}</span></h6>
                        <h6 class="ml-4">Brand : <span><a
                                    href="/user/search_by_brand/{{ $product->brand_name }}">{{ $product->brand_name }}</a></span>
                        </h6>
                    </div>
                    <div class="row mt-3">
                        <a href="" style="display:none;">
                            <h3>{{ $product->product_name }}</h3>
                        </a><span style="display: none" id="imgname">{{$product_image[0]->product_image}}</span><span></span>
                        <button class="action-btn mb-1" onclick="add_wishlist({{ $product->id }},$(this))"><i
                                class="fa fa-heart"></i> Add to Wishlist</button>
                        <button class="action-btn mb-1" data-toggle="modal" data-target="#MoreInfo"><i
                                class="fa fa-eye"></i> More info</button>
                        <button class="action-btn mb-1" data-toggle="modal" data-target="#CustomerSafe"><i
                                class="fa fa-print"></i> Customer Safe Flyer</button>
                    </div>
                    <div class="d-flex quantity pb-2">
                        <table class="qp">
                            <tr class="quatity">
                                <td>QTY</td>
                                @foreach ($price_list as $item)
                                    <td>{{ $item->quantity }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Price</td>
                                @foreach ($price_list as $item)
                                    <td>${{ $item->price }}</td>
                                @endforeach
                            </tr>
                        </table>
                        <p class="discount ml-auto">{{ $product->discount ? $product->discount : 'CALL' }}</p>
                    </div>
                    <div class="row">
                        <button class="action-btn mb-1" data-toggle="modal" data-target="#SampleOrder"><i
                                class="fa fa-send-o"></i> Sample Order</button>
                        <button class="action-btn mb-1" data-toggle="modal" data-target="#shippingEstimator"><i
                                class="fa fa-calculator"></i> Shipping Estimate</button>
                        <button class="action-btn mb-1" onclick="copy_link()"><i class="fa fa-link"></i> Copy Product
                            Link</button>
                    </div><br>
                    <div class="row">
                        <button class="action-btn mb-1" data-toggle="modal" data-target="#decoration"
                            style="font-size: large;color:#106eea;"><i class="fa fa-key"></i> Decoration Methods Explained</button>
                        <button class="action-btn mb-1" data-toggle="modal" data-target="#service"
                            style="font-size: large;color:#106eea;"><i class="fa fa-cubes"></i> Services We Provide</button>
                    </div>
                    <h5 class="mt-2">Product Information</h5>
                    <h6>Material : <span>{{ $product->manufacturar }}</span></h6>
                    <h6>Size(inch) : <span>{{ $product->dim_width }} x {{ $product->dim_height }} x
                            {{ $product->dim_depth }}</span></h6>
                    <h6>Weight(lbs) : <span>{{ $product->weight }}*per unit, {{ $product->box_weight }}*per box</span>
                    </h6>
                    <h6>Master Box : <span>({{ $product->master_dimention }}), {{ $product->master_qty }}qty,
                            {{ $product->master_weight }}lbs</span></h6>
                    <h6>Imprint Area Size (WxH) : <span>{{ $product->imprint_width }} x
                            {{ $product->imprint_height }}</span></h6>
                    <div class="productColors fz18  mb3 d-flex align-items-center">
                        <h6>Product Colors:</h6>
                        <ul class="colors">
                            @foreach ($product_color as $item)
                                <li class="pro-color" style="background-color:{{ $item }}"></li>
                            @endforeach
                        </ul>
                    </div>
                    <div style="display:flex;">
                        <h6>Decoration Methods For This Product</h6>
                        <select class="form-control" id="decoration_method" name="decoration_method">
                            @foreach ($decorationdata as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-description no-padding">
        <div class="container">
            <ul role="tablist" class="nav nav-tabs flex-column flex-sm-row">
                <li class="description-item"><a data-toggle="tab" href="#description" role="tab"
                        class="nav-link active">Description</a></li>
                <li class="description-item"><a data-toggle="tab" href="#specification" role="tab"
                        class="nav-link">Specification</a></li>
                <li class="description-item"><a data-toggle="tab" href="#case-studies" role="tab" class="nav-link">Case
                        Studies</a></li>
            </ul>
            <div class="tab-content">
                <div id="description" role="tabpanel" class="description-pane active">
                    <?php echo ($product->description); ?>
                </div>
                <div id="specification" role="tabpanel" class="description-pane" style="display: none;">
                    <?php echo ($product->specification); ?>
                </div>
                <div id="case-studies" role="tabpanel" class="description-pane" style="display: none;">
                    <?php echo ($product->imprint_note); ?>
                </div>
            </div>
        </div>
    </section>
    <section class="related-products">
        <div class="container">
            <header class="text-center">
                <h2><small>Similar Items</small>You may also like</h2>
            </header>
            <div class="row">
                @foreach ($relative_product_data as $item)
                    <div class="item col-xl-3 col-md-6">
                        <div class="product is-gray">
                            <div class="image d-flex align-items-center justify-content-center"
                                onclick="goto_detail({{ $item['id'] }})">
                                @if ($item['featured'])
                                    <div class="ribbon ribbon-primary text-uppercase">Featured</div>
                                @endif
                                @if ($item['onsale'])
                                    <div class="ribbon ribbon-danger text-uppercase">Sale</div>
                                @endif
                                <img src="{{ asset('public/upload/product-images/' . $item['product_image']) }}"
                                    alt="{{ $item['product_name'] }}" class="img-fluid" />

                            </div>
                            <div class="title">
                                <small class="text-muted"
                                    style="display:block;line-height:1;"><b>{{ $item['brand_name'] }}</b></small>
                                <small class="text-muted">Item#: {{ $item['sku'] }}</small>
                                <a href="/user/detail/{{ $item['id'] }}">
                                    <h3 class="h6 text-uppercase no-margin-bottom"
                                        style="transition: all 0.3s;text-overflow: ellipsis;overflow: hidden;width: 100%;white-space: nowrap;">
                                        {{ $item['product_name'] }}</h3>
                                </a>
                                <span style="display:none">{{ $item['product_image'] }}</span>
                                <span class="price text-muted mb-1" style="font-size: 13px;">EQP:
                                    ${{ $item['eqp'] }}</span>
                                <a href="javascript:void(0)" class="action-btn mb-1"
                                    onclick="add_wishlist({{ $item['id'] }},$(this))"><i class="fa fa-heart"></i> Add to
                                    Wishlist</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="modal" id="SampleOrder">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sample Order</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p><u>Request Sample</u></p>
                    <p class="mb-0">Dear Distributor, this section is to help you submit a sample request without
                        calling, emailing or faxing us.</p>
                    <p class="mb-0">However, ALL submitted requests will be verified and upon verification, we will
                        confirm your Sample order and contact you.</p>
                    <p>Thank you</p>
                    <p class="mb-0"><b>Product Name : </b><span>{{ $product->product_name }}</span></p>
                    <p class="mb-0"><b>Product Item Number : </b><span>{{ $product->item_no }}</span></p>
                    <p><b>Product Brnad : </b><span>{{ $product->brand_name }}</span></p>
                    <p class="mb-0"><b>Ship to : </b></p>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="first_name">First name:</label>
                            <input type="text" class="form-control" placeholder="" id="so_first_name">
                        </div>
                        <div class="form-group col-6">
                            <label for="last_name">Last name:</label>
                            <input type="text" class="form-control" placeholder="" id="so_last_name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="company_name">Company name:</label>
                            <input type="text" class="form-control" placeholder="" id="so_company_name">
                        </div>
                        <div class="form-group col-6">
                            <label for="industry_num">Industry number:</label>
                            <input type="text" class="form-control" placeholder="" id="so_industry_num">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="state">State:</label>
                            <input type="text" class="form-control" placeholder="" id="so_state">
                        </div>
                        <div class="form-group col-6">
                            <label for="ship_address">Ship address:</label>
                            <input type="text" class="form-control" placeholder="" id="so_ship_address">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="phone_num">Phone number:</label>
                            <input type="text" class="form-control" placeholder="" id="so_phone_num">
                        </div>
                        <div class="form-group col-6">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" placeholder="" id="so_email">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="blueReBtn" data-dismiss="modal" onclick="send_sample_order()">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="MoreInfo" tabindex="-1" role="dialog" aria-labelledby="MoreInfo" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shippingEstimatorLabel">More Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modalContent">
                        <div class="productImageTop">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="productImag">
                                        <img src="{{ asset('public/upload/product-images/' . $product_image[0]->product_image) }}"
                                            alt="{{ $product->product_name }}">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row h-100">
                                        @foreach ($product_image as $item)
                                            <div class="col-6 d-flex align-items-center pt-3 pt-md-0 ">
                                                <div class="productImag">
                                                    <img src="{{ asset('public/upload/product-images/' . $item->product_image) }}"
                                                        alt="{{ $product->product_name }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="s-product-right pl-0 pt-3">
                            <h3 class="fz30 fwm mb-2">{{ $product->product_name }}</h3>
                            <div class="s-product-rations">
                                <p class="s-items fz14">Item {{ $product->item_no }}</p>
                                <p class="s-brand fz14">Brand {{ $product->brand_name }}</p>
                            </div>
                            <div class="review mb-4">Product rating
                                <ul class="rate list-inline">
                                    <li class="list-inline-item"><i class="fa fa-star text-primary"></i></li>
                                    <li class="list-inline-item"><i class="fa fa-star text-primary"></i></li>
                                    <li class="list-inline-item"><i class="fa fa-star text-primary"></i></li>
                                    <li class="list-inline-item"><i class="fa fa-star text-primary"></i></li>
                                    <li class="list-inline-item"><i class="fa fa-star text-primary"></i></li>
                                </ul>
                            </div>
                            <p class="textbox fz14 mb-2">
                                <?php echo strip_tags($product->description); ?>
                            </p>
                        </div> <!-- /.s-product-right -->
                        <br>
                        <form action="#" class="sendMail">
                            <div class="row col-md-12">
                                <div class="form-group col-md-6 col-md-6">
                                    <label for="moreinfo_name">Your Name</label>
                                    <input class="form-control" type="text" placeholder="" id="moreinfo_name"
                                        name="moreinfo_name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="moreinfo_company_name">Company Name</label>
                                    <input class="form-control" type="text" placeholder="" id="moreinfo_company_name"
                                        name="moreinfo_company_name">
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="moreinfo_compayn_address">Company Address</label>
                                    <input class="form-control" type="text" placeholder="" id="moreinfo_compayn_address"
                                        name="moreinfo_compayn_address">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="moreinfo_company_phone">Company Phone number</label>
                                    <input class="form-control" type="text" placeholder="" id="moreinfo_company_phone"
                                        name="moreinfo_company_phone">
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="moreinfo_cell_phone">Cell Phone number</label>
                                    <input class="form-control" type="text" placeholder="" id="moreinfo_cell_phone"
                                        name="moreinfo_cell_phone">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="moreinfo_email">Email Address</label>
                                    <input class="form-control" type="email" placeholder="" id="moreinfo_email"
                                        name="moreinfo_email">
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="form-group col-md-12">
                                    <label for="moreinfo_comment">Comments</label>
                                    <textarea class="form-control" name="moreinfo_comment" id="moreinfo_comment"
                                        class=""></textarea>
                                </div>
                            </div>
                            <br>
                            <br>
                            <button type="button" class="blueReBtn" data-dismiss="modal"
                                onclick="send_moreinfo_email()">Send eMail</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="shippingEstimator" tabindex="-1" role="dialog" aria-labelledby="shippingEstimatorLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shippingEstimatorLabel">Shipping Estimator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center fwsb mb-0">Ship Estimator</h5>
                    <p class="text-center">Corkcicle 16oz Canteen</p>
                    <form action="" class="shippingForm mt-3 border-dark">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="quality">Quantity</label>
                            </div>
                            <div class="col-md-8 mb-3">
                                <div class="single-input">
                                    <input class="form-control" type="text" placeholder="Quantity" name="Quantity"
                                        id="quality">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="City">City</label>
                            </div>
                            <div class="col-md-8 mb-3">
                                <div class="single-input">
                                    <input class="form-control" type="text" placeholder="City" name="City" id="City">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="ship-estimator-state">State/Province</label>
                            </div>
                            <div class="col-md-8 mb-3">
                                <div class="single-input">
                                    <select class="form-control" id="ship-estimator-state" name="ship-estimator-state">
                                        @foreach ($allstate as $item)
                                            <option value="{{ $item->abbr }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="ZipCode">Zip Code</label>
                            </div>
                            <div class="col-md-8 mb-3">
                                <div class="single-input">
                                    <input class="form-control" type="text" placeholder="ZipCode" name="ZipCode"
                                        id="ZipCode">
                                </div>
                            </div>
                            <div class="col-md-4 col-5">
                                <label for="Residential">Residential</label>
                            </div>
                            <div class="col-md-8 col-7">
                                <div class="single-input">
                                    <input type="checkbox" placeholder="Residential" name="Residential" id="Residential">
                                </div>
                            </div>
                            <div class="col-md-4 col-5">
                                <label for="FreightRates">Freight Rates</label>
                            </div>
                            <div class="col-md-8 col-7 ">
                                <div class="single-input checkChange">
                                    <input type="checkbox" placeholder="Freight Rates" name="Freight Rates"
                                        id="FreightRates">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="blueReBtn mt-3" data-dismiss="modal">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="CustomerSafe" tabindex="-1" role="dialog" aria-labelledby="CustomerSafe" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modalContent">
                        <div class="productImageTop">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="productImag">
                                        <img src="{{ asset('public/upload/product-images/' . $product_image[0]->product_image) }}"
                                            alt="{{ $product->product_name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row h-100">
                                        @foreach ($product_image as $item)
                                            <div class="col-6 d-flex align-items-center pt-3 pt-md-0 ">
                                                <div class="productImag">
                                                    <img src="{{ asset('public/upload/product-images/' . $item->product_image) }}"
                                                        alt="{{ $product->product_name }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="s-product-right pl-0 pt-3">
                            <h3 class="fz30 fwm mb-2">{{ $product->product_name }}</h3>
                            <div class="s-product-rations">
                                <p class="s-items fz14">Item {{ $product->item_no }}</p>
                                <p class="s-brand fz14">Brand {{ $product->brand_name }}</p>
                            </div>
                            <p class="textbox fz14 mb-2">
                                <?php echo strip_tags($product->description); ?>
                            </p>
                            <div class="customerSafeTable s-prduct-table">
                                <h5 class="mt-4">Price per Quantity</h5>
                                <div class="d-flex quantity pb-2">
                                    <table class="qp">
                                        <tr class="quatity">
                                            @foreach ($price_list as $item)
                                                <td>{{ $item->quantity }}</td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            @foreach ($price_list as $item)
                                                <td>${{ $item->price }}</td>
                                            @endforeach
                                        </tr>
                                    </table>
                                    <p class="discount ml-auto">{{ $product->discount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="modalTextPro">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="s-productDetail border-0 mt-0 pt-3">
                                        <p class="fz18 fwm mb-2">{{ $product->product_name }}</p>
                                        <div class="productColors fz18  mb3 d-flex align-items-center">
                                            Product Colors:
                                            <ul class="colors">
                                                @foreach ($product_color as $item)
                                                    <li class="pro-color" style="background-color:{{ $item }}">
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <p class="fz14 mt-3 ">
                                            Material- {{ $product->manufacturar }} <br>
                                            Size- {{ $product->dim_width }} x {{ $product->dim_height }} x
                                            {{ $product->dim_depth }} <br>
                                            Packaging- Retail Box
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="s-pro-shipping mt-0 pt-2">
                                        <p class="fz18 fwm mb-3">Pricing</p>
                                        <p class="fz14 fwsb">
                                            ${{ $product->price }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="s-pro-shipping mt-0 pt-0 pb-3">
                                <p class="fz18 fwm mb-2">Shipping</p>
                                <p class="fz14 ">
                                    Quantity- X pcs <br>
                                    Weight- X Lbs <br>
                                    Dimensions- {{ $product->dim_width }} x {{ $product->dim_height }} x
                                    {{ $product->dim_depth }}
                                </p>
                            </div>
                            <div class="s-pro-description border-0 pt-0">
                                <p class="fz18 fwm mb-2">Decoration</p>
                                <p class="fz14 ">Imprint Method- Pad Print, Laser Engraving, 4 color Process <br>
                                    Imprint Size- {{ $product->imprint_width }} x {{ $product->imprint_height }}</p>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="sender_name">Sender Name:</label>
                                    <input type="text" class="form-control" placeholder="" id="sender_name">
                                </div>
                                <div class="form-group col-6">
                                    <label for="sender_email">Sender Email:</label>
                                    <input type="text" class="form-control" placeholder="" id="sender_email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="receiver_name">Recepient Name:</label>
                                    <input type="text" class="form-control" placeholder="" id="receiver_name">
                                </div>
                                <div class="form-group col-6">
                                    <label for="receiver_email">Recepient Email:</label>
                                    <input type="text" class="form-control" placeholder="" id="receiver_email">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="blueReBtn">Send</button>
                    <button type="button" class="blueReBtn" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="decoration">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Decoration Methods Explained</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <button class="submodal-btn" data-toggle="modal" data-target="#decoSub">Black Oxyde</button>
                    <button class="submodal-btn" data-toggle="modal" data-target="#decoSub">Laser Engraving</button>
                    <button class="submodal-btn" data-toggle="modal" data-target="#decoSub">Laser Etching</button>
                    <button class="submodal-btn" data-toggle="modal" data-target="#decoSub">Pad Printing</button>
                    <button class="submodal-btn" data-toggle="modal" data-target="#decoSub">Screen Printing</button>
                    <button class="submodal-btn" data-toggle="modal" data-target="#decoSub">Full Color UV Printing</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="service">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Services We Provide</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <button class="submodal-btn" data-toggle="modal" data-target="#subModal">Fullfilment</button>
                    <button class="submodal-btn" data-toggle="modal" data-target="#subModal">Individual Drop
                        Shipping</button>
                    <button class="submodal-btn" data-toggle="modal" data-target="#subModal">Split Shipping</button>
                    <button class="submodal-btn" data-toggle="modal" data-target="#subModal">Personalizations</button>
                    <button class="submodal-btn" data-toggle="modal" data-target="#subModal">PMS color matching</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" class="sub-modal" id="subModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Decoration Methods Explained</h5>
                    <button type="button" class="close service-close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Section 1
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" class="sub-modal" id="decoSub">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Decoration Methods Explained</h5>
                    <button type="button" class="close deco-close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Section 2
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class='wishlist-modal'></div>
    <div class="show">
        <div class="overlay"></div>
        <div class="img-show">
            <span>X</span>
            <img src="">
        </div>
    </div>
    <div id="zoommodal"></div>
@endsection
@section('script')
    <script src="https://thdoan.github.io/magnify/js/jquery.magnify.js"></script>
    <script>
        send_visit_report();
        $(".ql-clipboard").remove();
        $(".ql-tooltip").remove();
        var spiner_plus = document.getElementsByClassName("spiner-plus");
        var spiner_minus = document.getElementsByClassName("spiner-minus");
        for (var i = 0; i < spiner_plus.length; i++) {
            spiner_plus[i].addEventListener("click", function() {
                var spiner_target_id = this.getAttribute("target");
                document.getElementById(spiner_target_id).value = Number(document.getElementById(spiner_target_id)
                    .value) + 1;
            });
        }
        for (var i = 0; i < spiner_minus.length; i++) {
            spiner_minus[i].addEventListener("click", function() {
                var spiner_target_id = this.getAttribute("target");
                var j = 0;
                document.getElementById(spiner_target_id).value = (j = Number(document.getElementById(
                    spiner_target_id).value) - 1) == -1 ? 0 : j;
            });
        }

        $(function() {
            var $grid = $(".masonry-wrapper").masonry({
                itemSelector: ".item",
                columnWidth: ".item",
                percentPosition: true,
                transitionDuration: 0,
            });
            $grid.imagesLoaded().progress(function() {
                $grid.masonry();
            });
        });
        $('.submodal-btn').on('click', function() {
            $(this).parent().parent().find('.close').click()
        })
        $('.service-close').on('click', function() {
            $('#service').modal();
        })
        $('.deco-close').on('click', function() {
            $('#decoration').modal();
        })

        function add_wishlist(id, obj) {
            $.ajax({
                url: "/user/add_wishlist",
                method: "post",
                dataType: "json",
                data: {
                    id: id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(result) {
                    console.log(result);
                    if (result['type'] == 'success') {
                        txt =
                            "<div aria-labelledby='cartdetails' class='wishlist-card'><div class='cart-product'><div class='d-flex align-items-center'><div class='img'><img src='/public/upload/product-images/" +
                            obj.prev().prev().html() + "' alt='...' class='wishlist-img'></div><div class='details justify-content-between'><p class='mb-0'>Success ! </p><div class='wishlist-name'><a href='/user/detail/" +
                            id + "'><strong>" + obj.prev().prev().prev().find("h3").html() +
                            "</strong></a> </div><p>has been added to your wishlist.</p></div><i class='fa fa-close' onclick='close_wishlist($(this))'></i></div></div><div class='dropdown-item CTA d-flex'><a href='/user/main' class='btn-wishlist'>Continue</a><a href='/user/wishlist' class='btn-wishlist'>Wishlist</a></div></div>";
                    } else if (result['type'] == 'login') {
                        txt =
                            "<div aria-labelledby='cartdetails' class='wishlist-card'><div class='cart-product'><div class='d-flex align-items-center'><div class='details justify-content-between'><p class='mb-0'>Alert ! </p><p>You must login or create an account to save <a href='/user/detail/" +
                            id + "'><strong class='wishlist-name'>" + obj.prev().prev().prev().find("h3")
                            .html() +
                            "</strong></a> to your wish list!</p></div><i class='fa fa-close' onclick='close_wishlist($(this))'></i></div></div><div class='dropdown-item CTA d-flex'><a href='/user/main' class='btn-wishlist'>Continue</a><a href='/user/wishlist' class='btn-wishlist'>Wishlist</a></div></div>";
                    }
                    $(".wishlist-modal").append(txt);
                },
                error: function(error) {
                    console.log(error);
                }
            });
            topFunction();
        }

        function close_wishlist(obj) {
            obj.closest('.wishlist-card').remove();
        }

        function goto_detail(id) {
            window.location.href = "/user/detail/" + id;
        };

        function send_moreinfo_email() {
            $.ajax({
                url: "/user/email_moreinfo",
                method: "post",
                dataType: "json",
                data: {
                    product_id: {{ $product->id }},
                    moreinfo_name: $("#moreinfo_name").val(),
                    moreinfo_company_name: $("#moreinfo_company_name").val(),
                    moreinfo_compayn_address: $("#moreinfo_compayn_address").val(),
                    moreinfo_company_phone: $("#moreinfo_company_phone").val(),
                    moreinfo_cell_phone: $("#moreinfo_cell_phone").val(),
                    moreinfo_email: $("#moreinfo_email").val(),
                    moreinfo_comment: $("#moreinfo_comment").val(),
                    "_token": "{{ csrf_token() }}"
                },
                success: function(result) {
                    console.log(result);

                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function copy_link() {
            var dummy = document.createElement('input'),
                text = window.location.href;
            document.body.appendChild(dummy);
            dummy.value = text;
            dummy.select();
            document.execCommand('copy');
            document.body.removeChild(dummy);
        }

        function showmodal(obj) {
            topFunction();
            $("#zoommodal").show();
            $("#zoommodal").empty();
            $("#zoommodal").append("<img src='"+obj.attr('src')+"' /><div class='zoom_cover' onclick='del_image()'></div>");
            $('body,html').css('overflow','hidden');
        }

        function del_image(obj) {
            $("#zoommodal").hide();
            $('body,html').css('overflow','auto');
        }

        function send_visit_report() {
            $.ajax({
                url: "/user/send_visit_report",
                method: "post",
                dataType: "json",
                data: {
                    product_id: {{ $product->id }},
                    "_token": "{{ csrf_token() }}"
                },
                success: function(result) {
                    console.log(result);

                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function send_sample_order() {
            // $.ajax({
            //     url: "/user/send_sample_order",
            //     method: "post",
            //     dataType: "json",
            //     data: {
            //         product_id: {{ $product->id }},
            //         product_name: {{ $product->product_name }},
            //         category_id: {{ $product->category_id }},
            //         subcategory_id: {{ $product->subcategory_id }},
            //         brand_name: {{ $product->brand_name }},
            //         sku: {{ $product->sku }},
            //         company: $("#so_company_name").val(),
            //         "_token": "{{ csrf_token() }}"
            //     },
            //     success: function(result) {
            //         console.log(result);

            //     },
            //     error: function(error) {
            //         console.log(error);
            //     }
            // });
        }

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }

    </script>
@endsection
