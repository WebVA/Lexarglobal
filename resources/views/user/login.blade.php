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
              <h4 style="color:white;margin: 0;">Login</h4>
            </div>
            <div class="col-lg-3 text-right order-1 order-lg-2">
              <ul class="breadcrumb justify-content-lg-end">
                <li class="breadcrumb-item"><a href="index.html" style="color:white">Home</a></li>
                <li class="breadcrumb-item active" style="color:white">Login</li>
              </ul>
            </div>
          </div>
        </div>
    </section>

    <!-- text page-->
    <section class="padding-small">
      <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Welcome, Please Login or Register</h3><br>
                <p class="text-muted">
                    Create your own online account today and enjoy all the benefits our "Wish List" feature has to offer!<br>
                    Save items to your Wish List so you can easily go back to them later without searching.
                </p>
                <p>
                    <li class="text-muted">Add and delete items from your Wish List as your project becomes more focused</li>
                    <li class="text-muted">Create a presentation from your Wish List to review with team members and management</li>
                </p>
                <p class="text-muted">
                    We are here to make your job easier and faster !
                </p>
            </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="block" style="border: 1px solid #707070;">
              <div class="" style="background: #262262;">
                <h5 style="padding: 10px 15px 10px 35px; margin: 0px; color: white;">Login</h5>
              </div>
              <div class="" style="height: 300px; padding: 25px 35px; background: #F2F2F3;"> 
                <p class="lead">I am a returning distributor.</p>
                <form action="/user/login_check" method="get">
                @csrf
                  <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" name="email" type="text" class="form-control" style="background-color: white">
                  </div>
                  <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" name="password" type="password" class="form-control" style="background-color: white">
                  </div>
                  <button type="submit" class="btn btn-template"><i class="fa fa-sign-in"></i> Log in</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="block" style="border: 1px solid #707070;">
              <div class="" style="background: #262262;">
                <h5 style="padding: 10px 15px 10px 35px; margin: 0px; color: white;">New account</h5>
              </div>
              <div class="" style="height: 300px; padding: 25px 35px; background: #F2F2F3;"> 
                <p class="lead">I am a new distributor.</p>
                <p>By creating an account with Lexar Global you will be able to manage you lists, history and get products updates,
                    be up to date on an orders status, and keep track of the orders you have previously made.
                    </p>
                    <br>
                <button class="btn btn-template" onclick="go_register()"><i class="icon-profile"></i> Register</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@section('script')
<script>
    function go_register(){
        window.location.href = "/user/register";
    }
    $(function(){
        var $grid = $('.masonry-wrapper').masonry({
            itemSelector: '.item',
            columnWidth: '.item',
            percentPosition: true,
            transitionDuration: 0,
        });
    
        $grid.imagesLoaded().progress( function() {
            $grid.masonry();
        });
    })
</script>
@endsection