<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Lexar | Global</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="all,follow" />

    <link rel="stylesheet" href="{{ asset('assets/user/vendor/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/user/vendor/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/user/vendor/bootstrap-select/css/bootstrap-select.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/user/vendor/nouislider/nouislider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/user/css/custom-fonticons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/user/vendor/owl.carousel/assets/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/user/vendor/owl.carousel/assets/owl.theme.default.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/user/css/style.default.css') }}" id="theme-stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/user/css/custom.css') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/user/img/favicon.ico') }}" />
    <script src="{{ asset('assets/user/js/modernizr.custom.79639.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @yield('style')
</head>

<style>
    
.brandbtn {
  padding: 10px;
}

.brand:hover .brandbtn{
  /* padding-left: 20px;
  padding-right: 20px; */
  padding: 0px;
}
</style>

<body>
    <div id="preloader"></div>
    <!-- navbar-->
    <header class="header">
        <!-- Tob Bar-->
        <div class="" style="color: #fff; background: #262262; padding: 14px 0; display:flex;">
            <div class="left-col d-flex align-items-lg-center flex-column flex-lg-row" style="margin-left: 50px;">
                <div class="menu-icon">
                    <a href="#" style="color:white;"><i class="fa fa-facebook-f"></i></a>
                </div>
                <div class="menu-icon">
                    <a href="#" style="color:white;"><i class="fa fa-twitter"></i></a></li>
                </div>
                <div class="menu-icon">
                    <a href="#" style="color:white;"><i class="fa fa-linkedin"></i></a>
                </div>
            </div>
            <div class="right-col d-flex align-items-lg-center flex-column flex-lg-row" style="margin-left: auto; margin-right: 50px;">
                @if(session()->has('logged_customer'))
                <div class="menu-icon">
                    <a href="/user/myaccount" style="color:white;"><span style="color:white;">Welcome: {{ Session::get('logged_customer')->firstname }} {{ Session::get('logged_customer')->lastname }}</span></a>
                </div>
                @endif
                <div class="menu-icon">
                    <a href="/user/trackorder" style="color:white;"><i class="fa fa-paw"></i><span style="color:white;">Track your order</span></a>
                </div>
                <div class="menu-icon">
                    <a href="/user/wishlist" style="color:white;"><i class="fa fa-heart-o"></i><span style="color:white;">Wishlist</span></a>
                </div>
                <div class="menu-icon">
                    <a href="/user/login" style="color:white;"><i class="icon-profile"></i><span style="color:white;">My Account</span></a>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg">
            <div class="search-area">
                <div class="search-area-inner d-flex align-items-center justify-content-center">
                    <div class="close-btn"><i class="icon-close"></i></div>
                    <form action="#">
                        <div class="form-group">
                            <input type="search" name="search" id="search" placeholder="What are you looking for?" />
                            <button type="submit" class="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container-fluid">
                <!-- Navbar Header  -->
                <a href="/" class="navbar-brand" style="margin-left: 60px;"><img src="{{ asset('assets/user/img/logo.png') }}" alt="..." /></a>
                <button type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"
                    class="navbar-toggler navbar-toggler-right">
                    <i class="fa fa-bars"></i>
                </button>
                <!-- Navbar Collapse -->
                <div id="navbarCollapse" class="collapse navbar-collapse">
                    <ul class="navbar-nav mx-auto" style="margin-right: 0px !important;">
                        <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
                        <li class="nav-item"><a href="/user/main" class="nav-link">Products</a></li>
                        <!-- Megamenu-->
                        <li class="nav-item dropdown menu-large">
                            <a href="javascript:void(0)" data-toggle="dropdown" class="nav-link"
                                onclick="see_all_brands()">Brand<i class="fa fa-angle-down"></i></a>
                            <div class="dropdown-menu megamenu">
                                <div class="container brand-menu">
                                    <?php $i = 6; ?>
                                    @if ($i % 6 == 0)
                                        <div class="row">
                                    @endif
                                    @foreach ($brand as $item)
                                        <div class="col-sm-2 brand">
                                            <a href="/user/search_by_brand/{{ $item->brand_name }}">
                                                <img src="{{ asset('public/upload/brand_images/' . $item->brand_image) }}"
                                                    alt="{{ $item->brand_name }}" class="brandbtn" /></a>
                                        </div>
                                    @endforeach
                                    @if ($i % 6 == 0)
                                </div>
                                @endif
                                <?php $i++; ?>
                                <button class="view-more" onclick="see_all_brands()">View more</button>
                            </div>
                </div>
                </li>

                <li class="nav-item dropdown"><a id="navbarHomeLink" href="#" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" class="nav-link">Info<i
                            class="fa fa-angle-down"></i></a>
                    <ul aria-labelledby="navbarDropdownHomeLink" class="dropdown-menu">
                        <li><a href="/user/aboutus" class="dropdown-item">About Us</a></li>
                        <li><a href="/user/faq" class="dropdown-item">FAQ</a></li>
                        <li><a href="/user/policy" class="dropdown-item">Privacy-Policy</a></li>
                        <li><a href="/user/international" class="dropdown-item">International Customers</a></li>
                        <li><a href="/user/artwork" class="dropdown-item">Artwork Requirements</a></li>
                        <li><a href="/user/refund" class="dropdown-item">Refund / Return Policy</a></li>
                        <li><a href="/user/shipping_policies" class="dropdown-item">Shipping Policies</a></li>
                        <li><a href="/user/solution" class="dropdown-item">Fulfillment Solution policies</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="/user/contactus" class="nav-link">Contact</a></li>
                </ul>
                <div class="form-group search-box">
                    <input type="text" class="form-control" id="search_key" placeholder="Search Products..."
                        onchange="search_products($(this))" style="height: initial;width: 250px;">
                    <div class="input-group-append">
                        <button class="btn" style="background-color: #262262; color:white; margin-left:-10px;" type="submit"
                            onclick="search_products($(this).parent().prev())"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
            </div>
        </nav>
    </header>

    @yield('content')

    <div id="scrollTop"><i class="fa fa-long-arrow-up"></i></div>

    <footer class="main-footer">
        <div class="top-bar"></div>
        <div class="main-block">
            <div class="container">
                <div class="row">
                    <div class="info col-lg-4">
                        <div class="logo"><img src="{{ asset('assets/user/img/logo.png') }}" alt="..." /></div>
                        <p>Committed to consistency in quality and reliability !</p>
                        <ul class="social-menu list-inline">
                            <li class="list-inline-item">
                                <a href="#" target="_blank" title="twitter"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" target="_blank" title="facebook"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" target="_blank" title="instagram"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" target="_blank" title="pinterest"><i class="fa fa-pinterest"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" target="_blank" title="vimeo"><i class="fa fa-vimeo"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="site-links col-lg-2 col-md-6">
                        <h5 class="text-uppercase">Quick Links</h5>
                        <ul class="list-unstyled">
                            <li><a href="/">Home</a></li>
                            <li><a href="/user/main">Product</a></li>
                            <li><a href="/user/brand">Brands</a></li>
                            <li><a href="/user/main">Product Categories</a></li>
                            
                        </ul>
                    </div>
                    <div class="site-links col-lg-2 col-md-6">
                        <h5 class="text-uppercase">Company</h5>
                        <ul class="list-unstyled">
                            <li><a href="/user/login">Login</a></li>
                            <li><a href="/user/register">Register</a></li>
                            <li><a href="/user/wishlist">Wishlist</a></li>
                            <li><a href="/user/faq">FAQ</a></li>
                            <li><a href="/user/aboutus">About Us</a></li>
                            <li><a href="/user/profile">My Account</a></li>
                            <li><a href="/user/trackorder">Track Your Order</a></li>
                            <li><a href="/user/policy">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="newsletter col-lg-4">
                        <h5 class="text-uppercase">Daily Offers & Discounts</h5>
                        <p>Subscribe to receive latest news, announcements and specials.</p>
                        <form action="#" id="newsletter-form">
                            <div class="form-group">
                                <input type="email" name="subscribermail" id="subscribermail" placeholder="Your Email Address" />
                                <button onclick="send_subscribe()"><i class="fa fa-paper-plane"></i></button>
                            </div>
                            <div class="g-recaptcha" data-sitekey="6Lcj6HMbAAAAACXXvS6LYYXE23uhvktfi3vb7JCz"></div>
                            <!-- <button type="submit" class="btn btn-template"><i class="fa fa-sign-in"></i> Log in</button> -->
                            <!-- <button class="btn btn-success" onclick="send_subscribe()">Subscribe</button> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyrights">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <p>asi:79372 | sage:68975 | PPAI:112574 | UPIC: PPUSA</p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="footer-description">Lexar Global (Formerly PremiumPromoUSA) is a supplier in the
                            Advertising Specialty Industry (ASI) providing quality promotional products to ASI, Sage,
                            PPAI and UPI member distributors ONLY. Our goal is to continue the 34 year excellence in
                            product innovation, quality and reliability of New Products Int.
                            We strive for 5 star service with each and every order we process in our New York facility.
                            99.99% of all products are decorated in house.
                            Keep Lexar Global for all you future promotional products, promotional gifts, events
                            promotions and quality products.</p>
                    </div>
                </div>
                <div class="row mt-4 d-flex align-items-center">
                    <div class="col-12 text-center">
                        <p>&copy; 2021 <a href="#" target="_blank"> Lexar Global, LLC.</a> All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

  @if(((isset($popup_data)) && (count($popup_data)!=0)) && (((Session::get('popupPage')=='home') && (Session::get('popupHomeCount')==1)) || ((Session::get('popupPage')=='product') && (Session::get('popupProductCount')==1))))

    <div class="modal show" id="myModal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body" style="padding:0px;margin:0px">
                <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 6px;top: 6px;background: #000;color: #fff;border-radius: 50%;padding: 3px 8px;text-shadow: unset;opacity: 1;">&times;</button>
                <img style="width: 100%" src="{{ asset('public/upload/popup_images/'.$popup_data[0]['image']) }}">
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
          </div>
          
        </div>
    </div>
  @endif
    <!--<div class="modal show" id="myModal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <img style="width: 100%" src="{{ asset('public/upload/website-setting-images/modal_image.jpg') }}">
                }
            </div>
             <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
      </div>-->


    <script src="{{ asset('assets/user/js/modernizr.custom.79639.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/jquery/jquery.min.js') }}"></script>
    <script src="https://thdoan.github.io/magnify/js/jquery.magnify.js"></script>
    <script src="{{ asset('assets/user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/jquery-countdown/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/masonry-layout/masonry.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/front.js') }}"></script>
    <script>
        function see_all_brands() {
            window.location.href = "/user/brand";
        }

        function search_products(obj) {
            if(obj.val()){
                send_str = obj.val();
                if(send_str.includes("/")){
                    send_str = send_str.replace("/", "_lol_");
                }
                window.location.href = "/user/search_by_key/" + send_str;
            }
        }

        function send_subscribe() {
            var recaptcha = $("#g-recaptcha-response").val();
            if (recaptcha === "") {
                event.preventDefault();
                alert("Please check the recaptcha");
            }else{
                $.ajax({
                    url: "/user/send_subscribe",
                    method: "post",
                    dataType: "text",
                    data: {
                        subscribermail: $("#subscribermail").val(),
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
        }

    </script>
    <script type="text/javascript">
        setTimeout(function() {
            $('#myModal').modal();
        }, 4000);

        /*$(window).on('load', function() {
            $('#myModal').modal('show');
        });*/
    </script>
    @yield('script')
</body>

</html>
