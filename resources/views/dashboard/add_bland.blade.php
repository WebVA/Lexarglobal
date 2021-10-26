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
              <h6 class="h2 d-inline-block mb-0">Add Brand</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links">
                  <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="/blands/blands">Brands</a></li>
                  <li class="breadcrumb-item"><a href="/blands/blands">Manage Brands</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add Brand</li>
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
                        <h3 class="mb-0">Bland Details</h3>
                    </div>
                    <a href="/blands/blands" class="btn btn-sm btn-default">Back to List</a>
                </div>
            </div>
            <form method="post" id="upload_form" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="card-body">
                    <div class="col"></div>
                    <div class="col"></div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="bland_name">Brand Name</label>
                                <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Enter Bland Name">
                            </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                              <label class="form-control-label" for="Bland">Status</label>
                              <select class="form-control" data-toggle="select" id="brand_status" name="brand_status">
                                <option value=1 selected>Enable</option>
                                <option value=0>Disable</option>
                              </select>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-control-label" for="">Description</label>
                            <div data-toggle="quill" data-quill-placeholder="" id="brand_description_div"></div>
                            <input type="text" id="brand_description" name="brand_description" style="display:none">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-control-label" for="">Brand Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="brand_image" name="brand_image">
                                <label class="custom-file-label" for="customFileLang">Select file</label>
                            </div>
                            <div id="uploaded_image"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <button type="submit" class="btn btn-default" style="float:right;">Save Brand</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="success_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-primary fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Success!</strong> You added a new brand!</span>
  <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="fail_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-danger alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Fail!</strong> You failed to add a new brand!</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="warn_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-warning alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Warning!</strong> You have to enter brand name!</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#upload_form').on('submit', function(event){
                event.preventDefault();
                if($("#brand_name").val()){
                    $("#brand_description").val($("#brand_description_div").html());
                    $.ajax({
                        url:"/blands/add_bland",
                        method:"POST",
                        data:new FormData(this),
                        dataType:'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(data){
                            if(data.message=='success'){
                                $("#success_notify").show();
                                setTimeout(() => {
                                $("#success_notify").fadeOut(3000)
                                }, 3000);
                                $('#uploaded_image').html(data.uploaded_image);
                            }else{
                                console.log(data.message);
                                $("#fail_notify").show();
                                setTimeout(() => {
                                $("#fail_notify").fadeOut(3000)
                                }, 3000);
                            }
                        },
                        error:function(error){
                            console.log(error)
                        }
                    })
                }else{
                    $("#warn_notify").show();
                    setTimeout(() => {
                    $("#warn_notify").fadeOut(3000)
                    }, 3000);
                }
            });
        });
    </script>
@endsection