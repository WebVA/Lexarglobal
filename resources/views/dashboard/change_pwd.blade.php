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
                            <h6 class="h2 d-inline-block mb-0">Admin Setting</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Admin Setting</li>
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

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-control-label" for="">Old Password:</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" placeholder="Enter Old Password" type="text" id="oldpwd">
                                    {{-- <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-control-label" for="">New Password:</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" placeholder="Enter New Password" type="password"
                                        id="newpwd">
                                    {{-- <div class="input-group-append">
                                      <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                  </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-control-label" for="">Confirm Password:</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" placeholder="Retype Password" type="password"
                                        id="confirmpwd">
                                    {{-- <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-default" style="float:right;" onclick="update_pwd()">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="success_notify" style="display:none;position:absolute;right:30px;top:70px;"
        class="alert alert-primary fade show" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>Success!</strong> You Updated Password!</span>
        <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div id="fail_notify" style="display:none;position:absolute;right:30px;top:70px;"
        class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>Fail!</strong> Type correct Old password!</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div id="warn_notify" style="display:none;position:absolute;right:30px;top:70px;"
        class="alert alert-warning alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>Warning!</strong> Type correctly all fields!</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function update_pwd() {
            if (verify()) {
                $.ajax({
                    method: 'POST',
                    url: '/change_pwd',
                    dataType: 'text',
                    data: {
                        oldpwd: $("#oldpwd").val(),
                        newpwd: $("#newpwd").val(),
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(result) {
                        if (result != 0) {
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
        
        function verify(){
          if($("#oldpwd").val() && $("#newpwd").val() && $("#confirmpwd").val()){
            if($("#newpwd").val() == $("#confirmpwd").val()){
              return true;
            }
          }
          return false;
        }

    </script>
@endsection
