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
                            <h6 class="h2 d-inline-block mb-0">Other Setting</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item">Website Setting</li>
                                    <li class="breadcrumb-item active" aria-current="page">Other Setting</li>
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
                        <div class="col">
                            <h3 class="mb-0">Other Details</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-6"></div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="hero_title1">ModalImage</label>
                                
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="modalimg_upload"
                                    name="modalimg_upload" onchange="modalimg_preview(event,$(this))">
                                <label class="custom-file-label" for="customFileLang">Select file</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class='box' style='position:relative'>
                                <img style='width:300px;'
                                    src="{{ asset('public/upload/website-setting-images/modal_image.jpg') }}"
                                    alt='Image placeholder'>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="success_notify" style="display:none;position:absolute;right:30px;top:70px;"
        class="alert alert-primary fade show" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>Success!</strong> You added a new material!</span>
        <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div id="fail_notify" style="display:none;position:absolute;right:30px;top:70px;"
        class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>Fail!</strong> You failed to add a new material!</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div id="warn_notify" style="display:none;position:absolute;right:30px;top:70px;"
        class="alert alert-warning alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>Warning!</strong> You have to enter material name!</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function preview(e, obj, id) {
            var formData = new FormData();
            formData.append('upload_files', e.target.files[0]);
            formData.append('id', 'imgbar_img' + id);
            $.ajax({
                method: 'POST',
                url: '/websetting/save_other_img',
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log(result);
                    if (result) {
                        obj.parent().parent().next().html("");
                        obj.parent().parent().next().append(
                            "<div class='box' style='position:relative'><img style='width:300px;' src='" +
                            URL.createObjectURL(e.target.files[0]) + "' alt='Image placeholder'></div>");
                    }
                },
                error: function(error) {
                    console.log(error)
                }
            });
        }

        function set_hero_title(obj, id) {
            $.ajax({
                method: 'POST',
                url: '/websetting/save_hero_title',
                data: {
                    hero_title: "imgbar_url" + id,
                    hero_title_val: obj.val(),
                    "_token": "{{ csrf_token() }}"
                },
                success: function(result) {
                    // alert(result);
                },
                error: function() {
                    console.log('error')
                }
            })
        }

        function modalimg_preview(e, obj) {
            var formData = new FormData();
            formData.append('upload_files', e.target.files[0]);
            formData.append('id', 'modalimg_img');
            $.ajax({
                method: 'POST',
                url: '/websetting/save_other_img',
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log(result);
                    if (result) {
                        obj.parent().parent().next().html("");
                        obj.parent().parent().next().append(
                            "<div class='box' style='position:relative'><img style='width:300px;' src='" +
                            URL.createObjectURL(e.target.files[0]) + "' alt='Image placeholder'></div>");
                    }
                },
                error: function(error) {
                    console.log(error)
                }
            });
        }

        // function set_modalimg_url(obj) {
        //     $.ajax({
        //         method: 'POST',
        //         url: '/websetting/save_hero_title',
        //         data: {
        //             hero_title: "modalimg_url",
        //             hero_title_val: obj.val(),
        //             "_token": "{{ csrf_token() }}"
        //         },
        //         success: function(result) {
        //             // alert(result);
        //         },
        //         error: function() {
        //             console.log('error')
        //         }
        //     })
        // }

    </script>
@endsection
