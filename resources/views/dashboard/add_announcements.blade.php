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
              <h6 class="h2 d-inline-block mb-0">Add Announcements</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links">
                  <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="/websetting/announcements_setting">Announcements</a></li>
                  <li class="breadcrumb-item"><a href="/websetting/announcements_setting">Manage Announcements</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add Announcements</li>
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
                        <h3 class="mb-0"></h3>
                    </div>
                    <a href="/websetting/announcements_setting" class="btn btn-sm btn-default">Back to List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="title">Title</label>
                            <input class="form-control" type="text" id="title">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="status">Status</label>
                            <select class="form-control" data-toggle="select" id="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="form-control-label" for="">Description</label>
                        <textarea class="form-control" id="description" rows="5"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                    <button type="button" class="btn btn-default" style="float:right;" onclick="add_announcements()">Save Announcements</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="success_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-primary fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Success!</strong> You added a new announcements!</span>
  <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="fail_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-danger alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Fail!</strong> You failed to add a new announcements!</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="warn_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-warning alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Warning!</strong> You have to enter required fields!</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        function add_announcements(){
            if($("#title").val() && $("#description").val()){
                $.ajax({ 
                    method:'POST',
                    url:'/websetting/add_announcements',
                    data:{
                        title:$("#title").val(),
                        status:$("#status").val(),
                        description:$("#description").val(),
                        "_token":"{{csrf_token()}}"
                    },
                    success: function(result) {
                        if(result){
                            $("#success_notify").show();
                            setTimeout(() => {
                            $("#success_notify").fadeOut(3000)
                            }, 3000);
                        }else{
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
            topFunction();
        }
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
@endsection