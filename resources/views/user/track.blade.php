@extends('layout.home')

@section('style')
    <style>
        .hero {
            /* background: linear-gradient(45deg, #262262, #9ec9ff); */
            background-color: #262262;
        }

        .po_tbl {
            padding: 10px 10px 10px 10px;
            border: 1px solid #262262;
        }

        .lead-bottom {
            margin-top: 20px;
        }

    </style>

@section('content')
    <!-- Hero Section-->
    <section class="hero hero-page">
        <div class="container">
            <div class="row d-flex">
                <div class="col-lg-9 order-2 order-lg-1" style="display: flex;align-self: center;">
                    <h4 style="color:white;margin: 0;">Your Order</h4>
                </div>
                <div class="col-lg-3 text-right order-1 order-lg-2">
                    <ul class="breadcrumb justify-content-lg-end">
                        <li class="breadcrumb-item"><a href="/" style="color:white">Home</a></li>
                        <li class="breadcrumb-item active" style="color:white">Your Order</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="padding-small">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 pl-lg-3">
                    <p class="lead lead_search">
                        Dear Customer,<br><br>
                        Lexar Global provides this section to help you find latest updates for your order.<br><br>
                        Please enter PO number and Date as it apeares on the PO sent to Lexar Global.<br><br>
                        Thank you,<br>
                        Customer service
                    </p><br>
                    <div class="row" style="align-items: flex-end;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="po_num">PO Number <span class="required">*</span></label>
                                <input id="po_num" type="text" min=0; class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="exampleDatepicker">PO Date</label>
                                <input class="form-control datepicker" type="date" name="po_date" id="po_date"
                                    placeholder="Select date" type="text" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <button class="btn btn-template" onclick="search_order()"><i class="fa fa-search"></i>Search
                                    your order</button>
                            </div>
                        </div>
                    </div>
                    <p class="lead-bottom">
                        All updates are posted at the close of business day (EST).<br>
                        Please email: support@lexarglobal.com with any questions or concerns.<br>
                    </p>
                </div>
                <div class="col-lg-5 po_tbl">
                    <h5>Latest Status Updates:</h5>
                    <h5 id="company_name"></h5>
                    <table class="table table-hover table-responsive-md">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="tbl">

                        </tbody>
                    </table>
                    <div class="row">
                        <button class="btn btn-template print_btn" style="display: none;"><i
                                class="fa fa-print"></i>Print</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(function() {
            var $grid = $('.masonry-wrapper').masonry({
                itemSelector: '.item',
                columnWidth: '.item',
                percentPosition: true,
                transitionDuration: 0,
            });

            $grid.imagesLoaded().progress(function() {
                $grid.masonry();
            });
        })

        function search_order() {
            if ($("#po_date").val() && $("#po_num").val()) {
                $.ajax({
                    url: "/user/search_po",
                    method: "post",
                    dataType: "json",
                    data: {
                        num: $("#po_num").val(),
                        date: format($("#po_date").val()),
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(result) {
                        $("#company_name").html(result['company']);
                        $("#tbl").html('');
                        txt = "";
                        result = result['action_lists'];
                        for (i in result) {
                            txt += "<tr><th># " + result[i].action_name + "</th><td>" + result[i].po_date +
                                "</td></tr>";
                        }
                        $("#tbl").append(txt);
                        
                    },
                    error: function(error) {
                        $("#tbl").html('');
                    }
                });
            }else{
            //   alert("enter all fields.")
            }
        }

        function format(inputDate) {
            date_str = inputDate.split('-');
            return date_str[1] + "/" + date_str[2]+ "/" + date_str[0];
        }

    </script>
@endsection
