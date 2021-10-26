<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Lexar Global</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">

        <link rel="stylesheet" href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">

        <link rel="stylesheet" href="{{ asset('assets/vendor/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/quill/dist/quill.core.css') }}">     
        <!-- <link rel="stylesheet" href="{{ asset('css/chosen.css') }}"> -->

        <!-- Argon CSS -->
        <link rel="stylesheet" href="{{ asset('css/argon.css?v=1.1.0') }}">

        <!-- Custome CSS -->
        <link rel="stylesheet" href="{{ asset('css/dashstyle.css') }}">
        <!-- <link rel="stylesheet" href="{{ asset('css/dashrwd.css') }}"> -->
        <!-- <link rel="stylesheet" href="{{ asset('css/rwd.css') }}"> -->

        @yield('style')
    </head>
    <body>
        
        <!-- Sidenav -->
        <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light" id="sidenav-main" style="background-color: #03090a">
            <div class="scrollbar-inner">
                <!-- Brand -->
                <div style="height: 56px;" class="sidenav-header d-flex align-items-center">
                    <!-- <a class="navbar-brand" href="#">
                    <img style="position: absolute;top: -25px;left: 29px; max-height: 3.5rem;" src="{{ asset('image/logo.png') }}" class="navbar-brand-img" alt="LOGO">
                    </a> -->
                    
                    <div class="ml-auto">
                        <!-- Sidenav toggler -->
                        <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="navbar-inner">
                    <!-- Collapse -->
                    <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                        <!-- Nav items -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" href="/dashboard">
                                    <i class="ni ni-palette"></i>
                                    <span class="nav-link-text">Dashboard</span>
                                </a>
                            </li>  
                            <li class="nav-item">
                                <a class="nav-link" href="#navbar-products" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-products">
                                    <i class="ni ni-app"></i>
                                    <span class="nav-link-text">Products</span>
                                </a>
                                <div class="collapse" id="navbar-products">
                                    <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="/products/products/0/0/0" class="nav-link">Manage Products</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/categories/categories" class="nav-link">Manage Categories</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/blands/blands" class="nav-link">Manage Brand</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/materials/materials" class="nav-link">Manage Meterial</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/decorations/decorations" class="nav-link">Manage Decoration</a>
                                    </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#navbar-customers" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-customers">
                                    <i class="ni ni-single-02"></i>
                                    <span class="nav-link-text">Customers</span>
                                </a>
                                <div class="collapse" id="navbar-customers">
                                    <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="/customers/customers" class="nav-link">Customers List</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/customers/subscribers" class="nav-link">Subscribers List</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/customers/contacts" class="nav-link">Contacts List</a>
                                    </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#navbar-reports" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-reports">
                                    <i class="ni ni-calendar-grid-58"></i>
                                    <span class="nav-link-text">Reports</span>
                                </a>
                                <div class="collapse" id="navbar-reports">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="/report/most_viewed_products/0/0/0/0/0/0" class="nav-link">Most Viewed Products</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/report/sample_order/0/0/0/0/0/0" class="nav-link">Sample Order</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/report/product_rating/0/0/0/0/0/0" class="nav-link">Product Rating</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/report/recent_search" class="nav-link">Recent Search</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#navbar-banners" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-banners">
                                    <i class="ni ni-image"></i>
                                    <span class="nav-link-text">Website Setting</span>
                                </a>
                                <div class="collapse" id="navbar-banners">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="/websetting/hero_setting" class="nav-link">Hero Setting</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/websetting/category_setting" class="nav-link">Home Category</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/websetting/modal_setting" class="nav-link">Home Modal Image</a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="{{ url('/websetting/popup-setting')}}" class="nav-link">Home/Product PopUp</a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="/websetting/imgbar_setting" class="nav-link">Image Bar Setting</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/websetting/news_setting" class="nav-link">News</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/websetting/testimonials_setting" class="nav-link">Testimonials</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/websetting/announcements_setting" class="nav-link">Announcements</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#navbar-po" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-po">
                                    <i class="ni ni-badge"></i>
                                    <span class="nav-link-text">Customer PO</span>
                                </a>
                                <div class="collapse" id="navbar-po">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="/po/create_po" class="nav-link">Customer PO Update</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/po_actions/po_actions" class="nav-link">Manage PO Action</a>
                                        </li>
                                    </ul>
                                </div>
                            </li> 
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('log_out') }}">
                                    <i class="fa fa-share-square"></i>
                                    <span class="nav-link-text">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Main content -->
        <div class="main-content" id="panel">
            <!-- Topnav -->
            <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Navbar links -->
                        <ul class="navbar-nav align-items-center ml-md-auto">
                            <li class="nav-item d-xl-none">
                                <!-- Sidenav toggler -->
                                <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main" id="sidebar-toggler">
                                    <div class="sidenav-toggler-inner">
                                        <i class="sidenav-toggler-line"></i>
                                        <i class="sidenav-toggler-line"></i>
                                        <i class="sidenav-toggler-line"></i>
                                        <i class="fa fa-angle-double-left"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item d-sm-none">
                                <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                                    <i class="ni ni-zoom-split-in"></i>
                                </a>
                            </li>
                            <!-- <li class="nav-item dropdown">
                                <a class="nav-link" href="/reminder">
                                    <i class="ni ni-bell-55 txt-dark"></i>
                                </a>
                            </li> -->
                        </ul>
                        <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link pr-0" href="/profile" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- <a class="nav-link pr-0" href="#"> -->
                                    <div class="media align-items-center">
                                        {{-- <span class="avatar avatar-sm rounded-circle">
                                            <img alt="Image placeholder" src="{{asset('assets/user/img/logo.png')}}" />
                                        </span>  --}}
                                        <div class="media-body ml-2 d-none d-lg-block">
                                            <span class="mb-0 text-sm font-weight-bold txt-dark">Admin</span>
                                        </div>
                                    </div>
                                <!-- </a> -->
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">Welcome!</h6>
                                    </div>
                                    <a href="/change_pwd" class="dropdown-item">
                                        <i class="ni ni-settings-gear-65"></i>
                                        <span>Settings</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('log_out') }}" class="dropdown-item">
                                        <i class="ni ni-user-run"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            @yield('content')
            <div class="fog"></div>
        </div>
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
        <script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
        <!-- <script src="{{ asset('assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/chart.js/dist/Chart.extension.js') }}"></script> -->
        <script src="{{ asset('assets/vendor/moment/min/moment.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/fullcalendar/dist/fullcalendar.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/nouislider/distribute/nouislider.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/quill/dist/quill.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/dropzone/dist/min/dropzone.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>

        <!-- Sorttable -->
        <script src="{{ asset('assets/vendor/list.js/dist/list.min.js') }}"></script>

        

        <!-- Datatable -->
        <script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>

        <!-- Alert & notify -->
        <!-- <script src="../../assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
        <script src="../../assets/vendor/bootstrap-notify/bootstrap-notify.min.js"></script> -->

        <script src="{{ asset('assets/js/argon.js?v=1.1.0') }}"></script>
        <script src="{{ asset('assets/js/demo.min.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
        </script>
        @yield('script')
    </body>  
</html>
