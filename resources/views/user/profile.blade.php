@extends('layout.home')

@section('style')
    <style>
        .hero {
            /* background: linear-gradient(45deg, #262262, #9ec9ff); */
            background-color: #262262;
        }

        .box {
          border: 1px solid #262262;
          margin-bottom: 50px;
        }

        .block-header {
          background-color: #262262;
          border-radius: 0;
        }

        .block-header h5 {
          color: white;
        }

        .row {
            margin-right: 0px;
            margin-left: 0px;
        }

        .btn-template {
            margin-bottom: 20px;
        }

    </style>
@endsection('style')

@section('content')
    <!-- Hero Section-->
    <section class="hero hero-page">
        <div class="container">
            <div class="row d-flex">
                <div class="col-lg-9 order-2 order-lg-1" style="display: flex;align-self: center;">
                    <h4 style="color:white;margin: 0;">Profile</h4>
                </div>
                <div class="col-lg-3 text-right order-1 order-lg-2">
                    <ul class="breadcrumb justify-content-lg-end">
                        <li class="breadcrumb-item"><a href="index.html" style="color:white">Home</a></li>
                        <li class="breadcrumb-item active" style="color:white">Profile</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="padding-small">
        <div class="container">
            <div class="row col-12" >
                <!-- Customer Sidebar-->
                <div class="col-lg-8 col-xl-9 pl-lg-3" style="margin: auto;">
                  <div class="box">
                    <div class="block-header mb-5">
                        <h5>Change password </h5>
                    </div>
                    <!-- <form class="content-block" onSubmit="return validation()"> -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password_old" class="form-label">Old password</label>
                                <input id="password_old" name="password_old" type="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password" class="form-label">New password</label>
                                <input id="password" name="password" type="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" style="possition:relative;">
                                <label for="confirm_password" class="form-label">Retype new password</label>
                                <input id="confirm_password" name="confirm_password" type="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <!-- /.row-->
                    <div class="text-center">
                        <button class="btn btn-template" onclick="validate()"><i class="fa fa-save"></i>Change
                            password</button>
                    </div>
                    <div class="notification text-center" id="pwd_noty"></div>
                  </div>
                  <div class="box">
                    <!-- </form> -->
                    <div class="block-header mb-5">
                        <h5>Personal details</h5>
                    </div>
                    <form class="content-block">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="firstname" class="form-label">Firstname</label>
                                    <input id="firstname" type="text" class="form-control" value="{{$customer_data->firstname}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="lastname" class="form-label">Lastname</label>
                                    <input id="lastname" type="text" class="form-control" value="{{$customer_data->lastname}}">
                                </div>
                            </div>
                        </div>
                        <!-- /.row-->
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="company" class="form-label">Company</label>
                                    <input id="company" type="text" class="form-control" value="{{$customer_data->company_name}}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="asi_num" class="form-label">ASI</label>
                                    <input id="asi_num" type="text" class="form-control" value="{{$customer_data->industry_number}}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="sage_num" class="form-label">Sage</label>
                                    <input id="sage_num" type="text" class="form-control" value="{{$customer_data->sage_number}}">
                                </div>
                            </div>
                        </div>
                        <!-- /.row-->
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="mobile_num" class="form-label">Mobile Phone</label>
                                    <input id="mobile_num" type="text" class="form-control" value="{{$customer_data->mobile_phone}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="fax_num" class="form-label">Fax Number</label>
                                    <input id="fax_num" type="text" class="form-control" value="{{$customer_data->fax_number}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="office_num" class="form-label">Office phone</label>
                                    <input id="office_num" type="text" class="form-control" value="{{$customer_data->office_number}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="land_num" class="form-label">Land Phone</label>
                                    <input id="land_num" type="text" class="form-control" value="{{$customer_data->land_phone}}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="address" class="form-label">Address</label>
                                    <input id="address" type="text" class="form-control" value="{{$customer_data->address}}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="city" class="form-label">City</label>
                                    <input id="city" type="text" class="form-control" value="{{$customer_data->city}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="zip" class="form-label">Zip</label>
                                    <input id="zip" type="text" class="form-control" value="{{$customer_data->zip}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="state" class="form-label">State</label>
                                    <select id="state" class="form-control">
                                        @foreach ($state as $item)
                                            @if ($item->abbr == $customer_data->state)
                                                <option value="{{ $item->abbr }}" selected>{{ $item->name }}</option>
                                            @else
                                                <option value="{{ $item->abbr }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="country" class="form-label">Country</label>
                                    <select id="country" class="form-control">
                                        @foreach ($country as $item)
                                            @if ($item->abbr == $customer_data->country)
                                                <option value="{{ $item->abbr }}" selected>{{ $item->name }}</option>
                                            @else
                                                <option value="{{ $item->abbr }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-template" onclick="change_profile()"><i class="fa fa-save"></i>Save changes</button>
                            </div>
                            <div class="col-sm-12 notification text-center" id="profile_noty"></div>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        function validate() {
            if($("#password").val() && $("#confirm_password").val() && $("#password_old").val()){
                if($("#password").val() == $("#confirm_password").val()){
                    event.preventDefault();
                    change_pwd();
                }else{
                    $("#confirm_password").val('');
                    $("#pwd_noty").html("Does't match cofirm password.");
                    $("#pwd_noty").css("color","red");
                    return false;
                }
            }else{
                $("#pwd_noty").html("Enter all fields.");
                $("#pwd_noty").css("color","red");
                return false;
            }
        }

        function change_pwd() {
            $.ajax({
                url: "/user/change_pwd_api",
                method: "post",
                dataType: "text",
                data: {
                    id: {{ Session::get('logged_customer')->id }},
                    oldpwd: $("#password_old").val(),
                    newpwd: $("#password").val(),
                    "_token": "{{ csrf_token() }}"
                },
                success: function(result) {
                    if(result == 1){
                        $("#pwd_noty").html("Password updated.");
                        $("#pwd_noty").css("color","green");
                    }else if(result == 2){
                        $("#pwd_noty").html("Fail to update password.");
                        $("#pwd_noty").css("color","red");
                    }else{
                        $("#pwd_noty").html("Doesn't match old password.");
                        $("#pwd_noty").css("color","red");
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function change_profile() {
            event.preventDefault();
            $.ajax({
                url: "/user/change_profile_api",
                method: "post",
                dataType: "text",
                data: {
                    firstname: $("#firstname").val(),
                    lastname: $("#lastname").val(),
                    company: $("#company").val(),
                    asi_num: $("#asi_num").val(),
                    sage_num: $("#sage_num").val(),
                    mobile_num: $("#mobile_num").val(),
                    fax_num: $("#fax_num").val(),
                    land_num: $("#land_num").val(),
                    office_num: $("#office_num").val(),
                    city: $("#city").val(),
                    zip: $("#zip").val(),
                    state: $("#state").val(),
                    "_token": "{{ csrf_token() }}"
                },
                success: function(result) {
                    if(result == 1){
                        $("#profile_noty").html("Profile updated.");
                        $("#profile_noty").css("color","green");
                    }else if(result == 2){
                        $("#profile_noty").html("Fail to update profile.");
                        $("#profile_noty").css("color","red");
                    }else{
                        $("#profile_noty").html("Doesn't match old profile.");
                        $("#profile_noty").css("color","red");
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection
