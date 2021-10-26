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
                            <h6 class="h2 d-inline-block mb-0">Popup Setting</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item">Website Setting</li>
                                    <li class="breadcrumb-item active" aria-current="page">Popup Setting</li>
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
                            <h3 class="mb-0">Pop Up Setting</h3>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="col-md-6"></div>
                    <form action="{{ url('/websetting/save-popup-img') }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="hero_title1">Image</label>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="upload_files"
                                    name="upload_files" >
                                <label class="custom-file-label" for="customFileLang">Select file</label>
                            </div>
                        </div>
                        <input type="hidden" name="row_id" id="row_id" value="<?php echo $getData->id; ?>">
                        <div class="col-md-6">
                            <div class='box' style='position:relative'>
                                <img id="proimage" style='width:300px;'
                                    src="{{ asset('public/upload/popup_images/'.$getData->image) }}"
                                    alt='Image placeholder'>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" name="submit" value="Save" class="btn btn-primary pull-right">
                    </div>

                  </form>

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
     

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#proimage').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#upload_files").change(function(){
    readURL(this);
});

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
