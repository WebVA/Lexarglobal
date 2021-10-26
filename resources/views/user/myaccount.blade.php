@extends('layout.home')

@section('style')
    <style>
        .hero {
            /* background: linear-gradient(45deg, #262262, #9ec9ff); */
            background-color: #262262;
        }

        .box {
            /* border: 1px solid #262262; */
        }

        .lead-title {
            margin-left: 15px;
            margin-bottom: 15px;
        }

    </style>
@endsection('style')

@section('content')
    <!-- Hero Section-->
    <section class="hero hero-page">
        <div class="container">
            <div class="row d-flex">
                <div class="col-lg-9 order-2 order-lg-1" style="display: flex;align-self: center;">
                    <h4 style="color:white;margin: 0;">My Account</h4>
                </div>
                <div class="col-lg-3 text-right order-1 order-lg-2">
                    <ul class="breadcrumb justify-content-lg-end">
                        <li class="breadcrumb-item"><a href="index.html" style="color:white">Home</a></li>
                        <li class="breadcrumb-item active" style="color:white">My Account</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="padding-small">
        <div class="container">
            <div class="row col-8" style="margin: auto; margin-top: 100px; margin-bottom: 100px;">
                <div class="row col-12 lead-title">
                    <p class="lead">
                        Dear Distributor<br>
                        Manage your accounts setting and information
                    </p>
                </div>
                <div class="row col-12 box">
                    <!-- Customer Sidebar-->
                    <div class="customer-sidebar col-6">
                        <nav class="list-group customer-nav">
                            <a href="/user/profile"
                                class="active list-group-item d-flex justify-content-between align-items-center"><span><span
                                        class="icon icon-profile"></span>Profile</span></a>
                            <a href="/user/wishlist"
                                class="active list-group-item d-flex justify-content-between align-items-center"><span><span
                                        class="icon icon-bag"></span>Wish Lists</span></a>
                            <a href="/user/logout"
                                class="active list-group-item d-flex justify-content-between align-items-center"><span><span
                                        class="fa fa-sign-out"></span>Log out</span></a>
                        </nav>
                    </div>
                    <div class="customer-sidebar col-6">
                        <nav class="list-group customer-nav">
                            <a href="/user/address"
                                class="active list-group-item d-flex justify-content-between align-items-center"><span><span
                                        class="icon icon-map"></span>Shipping&billing Addresses</span></a>
                            <a href="/user/trackorder"
                                class="active list-group-item d-flex justify-content-between align-items-center"><span><span
                                        class="icon icon-bag"></span>Track your Orders</span></a>

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
    </script>
@endsection
