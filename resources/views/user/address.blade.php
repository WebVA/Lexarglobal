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

        .btn-template {
            margin-bottom: 20px;
        }

        .row {
            margin-right: 0px;
            margin-left: 0px;
        }

    </style>
@endsection('style')

@section('content')
    <!-- Hero Section-->
    <section class="hero hero-page">
        <div class="container">
            <div class="row d-flex">
                <div class="col-lg-9 order-2 order-lg-1" style="display: flex;align-self: center;">
                    <h4 style="color:white;margin: 0;">Address</h4>
                </div>
                <div class="col-lg-3 text-right order-1 order-lg-2">
                    <ul class="breadcrumb justify-content-lg-end">
                        <li class="breadcrumb-item"><a href="/" style="color:white">Home</a></li>
                        <li class="breadcrumb-item active" style="color:white">Address</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="padding-small">
        <div class="container">
            <div class="row col-12">
                <!-- Customer Sidebar-->
                <div class="col-lg-8 col-xl-9 pl-lg-3" style="margin: auto;">
                    <div class="box">
                        <form action="#">
                            <!-- Invoice Address-->
                            <div class="block-header mb-5">
                                <h5>Shipping&Billing address</h5>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="ship_address1" class="form-label">Ship To Address1</label>
                                    <input id="ship_address1" type="text" name="ship_address1" placeholder=""
                                        class="form-control" value="{{ $customer_data->shipping_address1 }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="ship_address2" class="form-label">Ship To Address2</label>
                                    <input id="ship_address2" type="text" name="ship_address2" placeholder=""
                                        class="form-control" value="{{ $customer_data->shipping_address2 }}">
                                </div>
                                <div class="form-group col-sm-4">
                                    <div class="form-group">
                                        <label for="ship_city" class="form-label">Ship To City</label>
                                        <input id="ship_city" type="text" class="form-control"  value="{{ $customer_data->shipping_city }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label for="ship_state" class="form-label">Ship To State</label>
                                        <select id="ship_state" class="form-control">
                                            <option value="">Select State</option>
                                            @foreach ($state as $item)
                                                @if ($item->abbr == $customer_data->shipping_state)
                                                    <option value="{{ $item->abbr }}" selected>{{ $item->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item->abbr }}">{{ $item->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label for="ship_zip" class="form-label">Ship To Zip</label>
                                        <input id="ship_zip" type="text" class="form-control" value="{{ $customer_data->shipping_zip }}">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="bill_address1" class="form-label">Bill To Address1</label>
                                    <input id="bill_address1" type="text" name="bill_address1" placeholder=""
                                        class="form-control" value="{{ $customer_data->bill_address1 }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="bill_address2" class="form-label">Bill To Address2</label>
                                    <input id="bill_address2" type="text" name="bill_address2" placeholder=""
                                        class="form-control" value="{{ $customer_data->bill_address2 }}">
                                </div>
                                <div class="form-group col-sm-4">
                                    <div class="form-group">
                                        <label for="bill_city" class="form-label">Bill To City</label>
                                        <input id="bill_city" type="text" class="form-control" value="{{ $customer_data->bill_city }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label for="bill_state" class="form-label">Bill To State</label>
                                        <select id="bill_state" class="form-control">
                                            <option value="">Select State</option>
                                            @foreach ($state as $item)
                                                @if ($item->abbr == $customer_data->bill_state)
                                                    <option value="{{ $item->abbr }}" selected>{{ $item->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item->abbr }}">{{ $item->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label for="bill_zip" class="form-label">Bill To Zip</label>
                                        <input id="bill_zip" type="text" class="form-control" value="{{ $customer_data->bill_zip }}">
                                    </div>
                                </div>
                            </div>
                            <!-- /Invoice Address-->
                            <div class="row">
                                <div class="form-group col-12 mt-3 text-center">
                                    <button type="submit" class="btn btn-template wide" onclick="change_address()"><i
                                            class="fa fa-save"></i>Save changes</button>
                                </div>
                                <div class="col-sm-12 notification text-center" id="address_noty"></div>
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
        function change_address() {
            event.preventDefault();
            $.ajax({
                url: "/user/change_address_api",
                method: "post",
                dataType: "text",
                data: {
                    ship_address1: $("#ship_address1").val(),
                    ship_address2: $("#ship_address2").val(),
                    ship_city: $("#ship_city").val(),
                    ship_state: $("#ship_state").val(),
                    ship_zip: $("#ship_zip").val(),
                    bill_address1: $("#bill_address1").val(),
                    bill_address2: $("#bill_address2").val(),
                    bill_city: $("#bill_city").val(),
                    bill_state: $("#bill_state").val(),
                    bill_zip: $("#bill_zip").val(),
                    "_token": "{{ csrf_token() }}"
                },
                success: function(result) {
                    if (result == 1) {
                        $("#address_noty").html("Address updated.");
                        $("#address_noty").css("color", "green");
                    } else if (result == 2) {
                        $("#address_noty").html("Fail to update address.");
                        $("#address_noty").css("color", "red");
                    } else {
                        $("#address_noty").html("Doesn't match old address.");
                        $("#address_noty").css("color", "red");
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

    </script>
@endsection
