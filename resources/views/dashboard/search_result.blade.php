@extends('layout.dash')

@section('style')
    <style>
        /* .fc-scrollgrid {
        display: none;
    } */
        .margin-row {
            margin-left: 30px;
            margin-right: 30px;
        }

    </style>

@endsection('style')
@section('content')

    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Header -->
        <div class="header">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 d-inline-block mb-0">Search PO Result</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item">company PO Update</li>
                                    <li class="breadcrumb-item"><a href="/po/search_po">Search PO</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Search PO Result</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table part -->
        <div class="margin-row">
            <div class="card">
                <!-- Card header -->
                <div class="card-header flex">
                    <div class="row align-items-center" style="width: -webkit-fill-available;">
                        <a href="/po/create_po" class="btn btn-sm btn-default">Create New PO</a>
                        <a href="/po/search_po" class="btn btn-sm btn-default">Search a PO</a>
                        <a href="/po/report_po" class="btn btn-sm btn-default">Reports</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <h3>Add Entries to PO</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-control-label">PO Number</label>
                                <input type="text" id="add_po_number" class="form-control"
                                    value="{{ $po_lists[0]->po_number }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-control-label" for="exampleDatepicker">Origin PO Date</label>
                                <input type="text" class="form-control" value="{{ $po_lists[0]->po_date }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-control-label">Company Name</label>
                                <input type="text" id="add_company_name" class="form-control"
                                    value="{{ $po_lists[0]->company_name }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h3>Previous Action History</h3>
                    </div>
                    @foreach ($action_lists as $item)
                        <div class="row showdiv">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label">Action Taken</label>
                                    <input type="text" class="form-control" value="{{ $item->action_name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label">PO Date</label>
                                    <input type="text" class="form-control" value="{{ $item->po_date }}" readonly>
                                </div>
                            </div>
                            <div style="display:none">{{ $item->id }}</div>
                            <div style="display: flex;align-items: center;">
                                <button type="button" class="btn btn-twitter btn-icon-only rounded-circle"
                                    onclick="toggle_show('edit',$(this))">
                                    <span class="btn-inner--icon"><i class="fa fa-edit"></i></span>
                                </button>
                                <button type="button" class="btn btn-twitter btn-icon-only rounded-circle"
                                    onclick="del_action($(this))">
                                    <span class="btn-inner--icon"><i class="fa fa-close"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="row editdiv" style="display:none">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label">Action Taken</label>
                                    <select class="form-control last_action" data-toggle="select">
                                        @foreach ($po_action as $temp)
                                            @if ($temp->id == $item->last_action)
                                                <option value="{{ $temp->id }}" selected>{{ $temp->action_name }}
                                                </option>
                                            @else
                                                <option value="{{ $temp->id }}">{{ $temp->action_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label">PO Date</label>
                                    <input class="form-control datepicker po_date" placeholder="Select date" type="text"
                                        value="{{ $item->po_date }}">
                                </div>
                            </div>
                            <div style="display:none">{{ $item->id }}</div>
                            <div style="display: flex;align-items: center;">
                                <button class="btn btn-sm btn-default" onclick="edit_action($(this))">Edit</a>
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <h3>Add New Action</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-control-label" for="add_last_action">Action Taken</label>
                                <select class="form-control" data-toggle="select" id="add_last_action"
                                    onchange="set_email()">
                                    @foreach ($po_action as $temp)
                                        <option value="{{ $temp->id }}">{{ $temp->action_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-control-label" for="exampleDatepicker">Date</label>
                                <input class="form-control datepicker" id="add_po_date" placeholder="Select date"
                                    type="text">
                            </div>
                        </div>
                        <div class="col"><br><br>
                            <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal">eMail
                                company</button>
                        </div>
                    </div>
                    <div class="row">
                        <div clas="col-md-6">
                            <div class="tracking_url"><a id="tracking_url_button" target="_blank"></a></div>
                        </div>
                        <div class="col-md-3" id="tracking1">
                            <div class="form-group">
                                <label class="form-control-label" for="exampleDatepicker">Tracking Number</label>
                                <input type="text" class="form-control" id="tracking_number" name="tracking_number" placeholder="Enter Tracking Number" required>
                            </div>
                        </div>
                        <div class="col-md-3" id="tracking2">
                            <div class="form-group">
                                <label class="form-control-label" for="last_action">Add Tracking</label>
                                <select class="form-control" data-toggle="select" id="tracking_action">
                                    <option value="ups">UPS</option>
                                    <option value="fedex">FedEx</option>
                                    <option value="trucking">Pickup</option>
                                    <option value="trucking">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <button class="btn btn-md btn-default" style="margin-top:8px;" onclick="tracking()">Save</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-default" style="float:right;" onclick="add_action()">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="margin-bottom:0px">
                    <h4 class="modal-title">New Message</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="margin-bottom:0px;padding-bottom:0px;margin-top:0px;padding-top:0px;">
                    <div class="form-group">
                        <input type="email" class="form-control" id="send_email" placeholder="Recipients" name="send_email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="send_title" placeholder="Enter subject"
                            name="send_title" value="PO# {{ $po_lists[0]->po_number }} Status Update">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="send_message" rows="5" placeholder="Type your message...">
                        </textarea>
                    </div>
                </div>
                <div class="modal-footer" style="margin-top:0px;padding-top:0px;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="send_mail()">Send</button>
                </div>
            </div>
        </div>
    </div>

    <div id="fail_notify" style="display:none;position:absolute;right:30px;top:70px;"
        class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>Fail!</strong> You failed to update an action!</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div id="success_notify" style="display:none;position:absolute;right:30px;top:70px;"
        class="alert alert-primary fade show" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>Success!</strong> You deleted an action!</span>
        <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div id="fail_notify" style="display:none;position:absolute;right:30px;top:70px;"
        class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>Fail!</strong> You failed to update an action!</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        set_email();

        function edit_action(obj) {
            $.ajax({
                method: 'POST',
                url: '/po/edit_action',
                data: {
                    id: obj.parent().prev().html(),
                    po_date: obj.parent().prev().prev().find(".po_date").val(),
                    last_action: obj.parent().prev().prev().prev().find(".last_action").val(),
                    "_token": "{{ csrf_token() }}"
                },
                success: function(result) {
                    if (result) {
                        toggle_show('updated', obj);
                        location.reload();
                    } else {
                        $("#fail_notify").show();
                        setTimeout(() => {
                            $("#fail_notify").fadeOut(3000)
                        }, 3000);
                    }
                    topFunction();
                },
                error: function() {
                    $("#fail_notify").show();
                    setTimeout(() => {
                        $("#fail_notify").fadeOut(3000)
                    }, 3000);
                }
            })
        }

        function toggle_show(type, obj) {
            if (type == 'edit') {
                obj.parent().parent().next().show();
                obj.parent().parent().hide();
            } else {
                obj.parent().parent().prev().show();
                obj.parent().parent().hide();
            }
        }

        function del_action(obj) {
            $.ajax({
                method: 'POST',
                url: '/po/del_action',
                data: {
                    id: obj.parent().prev().html(),
                    "_token": "{{ csrf_token() }}"
                },
                success: function(result) {
                    if (result) {
                        obj.parent().parent().remove();
                        obj.parent().parent().next().remove();
                        $("#success_notify").show();
                        setTimeout(() => {
                            $("#success_notify").fadeOut(3000)
                        }, 3000);
                    } else {
                        $("#fail_notify").show();
                        setTimeout(() => {
                            $("#fail_notify").fadeOut(3000)
                        }, 3000);
                    }
                    topFunction();
                },
                error: function() {
                    $("#fail_notify").show();
                    setTimeout(() => {
                        $("#fail_notify").fadeOut(3000)
                    }, 3000);
                }
            })
        }

        function add_action() {
            if ($("#add_last_action").val() && $("#add_po_date").val()) {
                $.ajax({
                    method: 'POST',
                    url: '/po/add_action',
                    data: {
                        po_number: $("#add_po_number").val(),
                        company_name: $("#add_company_name").val(),
                        po_date: $("#add_po_date").val(),
                        last_action: $("#add_last_action").val(),
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(result) {
                        if (result) {
                            location.reload();
                        } else {
                            $("#fail_notify").show();
                            setTimeout(() => {
                                $("#fail_notify").fadeOut(3000)
                            }, 3000);
                        }
                    },
                    error: function(error) {
                        console.log(error)
                    }
                })
            } else {
                $("#warn_notify").show();
                setTimeout(() => {
                    $("#warn_notify").fadeOut(3000)
                }, 3000);
            }
        }

        function set_email() {
            $("#send_message").empty();
            $("#send_message").val("Dear Customer,\n \n This is a status update on your order.\n Last update: " + $(
                "#add_last_action option:selected").html() + "\n \n Thank You.\n Lexar Global Customer Service ");
        }

        function send_mail() {
            $.ajax({
                method: 'POST',
                url: '/po/send_email',
                dataType: 'text',
                data: {
                    recipients: $("#send_email").val(),
                    subject: $("#send_title").val(),
                    content: $("#send_message").val(),
                    "_token": "{{ csrf_token() }}"
                },
                success: function(result) {
                    console.log(result);
                },
                error: function(error) {
                    console.log(error)
                }
            })
        }

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
        function tracking() {
            var number = $("#tracking_number").val();
            var action = $("#tracking_action").val();
            // console.log(number, action);

            if(action == "ups") {
                $("#tracking1").hide();
                $("#tracking2").hide();
                // $("#tracking_url_button").val = "https://www.fedex.com/fedextrack/?trknbr=" + number +"&trkqual=12022~282970460183~FDEG" 
                $("#tracking_url_button").html(`https://www.ups.com/upstrack/?trknbr=${number}&trkqual=12022~${number}~FDEG`);
                $("#tracking_url_button").attr('href', `https://www.ups.com/upstrack/?trknbr=${number}&trkqual=12022~${number}~FDEG`);
            }

            if(action == "fedex") {
                $("#tracking1").hide();
                $("#tracking2").hide();
                // $("#tracking_url_button").val = "https://www.fedex.com/fedextrack/?trknbr=" + number +"&trkqual=12022~282970460183~FDEG" 
                $("#tracking_url_button").html(`https://www.fedex.com/fedextrack/?trknbr=${number}&trkqual=12022~${number}~FDEG`);
                $("#tracking_url_button").attr('href', `https://www.fedex.com/fedextrack/?trknbr=${number}&trkqual=12022~${number}~FDEG`);
            }
        }

    </script>
@endsection
