@extends('layout.dash')

@section('style')
    <!-- Page plugins -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
<style>
/* .fc-scrollgrid {
    display: none;
} */
.margin-row {
  margin-left: 30px;
  margin-right: 30px;
}
.dropform {
    width: 250px;
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
              <h6 class="h2 d-inline-block mb-0">Testimonials List</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links">
                  <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="/websetting/testimonials_setting">Testimonials</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Manage Testimonials</li>
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
                <div class="col-10"></div>
                <a class="btn btn-default" href="/websetting/add_testimonials">Add Testimonials</a>
            </div>
            <div class="table-responsive py-4">
              <table class="table align-items-center table-flush" id="datatable-buttons">
                <thead class="thead-light">
                  <tr>
                    <th>Id</th>
                    <th>Testimonials Title</th>
                    <th>Created Date</th>
                    <th>Testimonials Description</th>
                    <th>Status</th>
                    <th></th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Testimonials Title</th>
                    <th>Created Date</th>
                    <th>Testimonials Description</th>
                    <th>Status</th>
                    <th></th>
                  </tr>
                </tfoot>
                <tbody>
                    @foreach($testimonials as $temp)
                    <tr>
                        <td>{{$temp->id}}</td>
                        <td>{{$temp->title}}</td>
                        <td>{{$temp->created}}</td>
                        <td>{{$temp->description}}</td>
                        <td>
                          @if($temp->status != 0)
                          <span class="text-success">●</span>
                          <small>Active</small>
                          @else
                          <span class="text-warning">●</span>
                          <small>Inactive</small>
                          @endif
                        </td>
                        <td class="text-right" style="display:flex;align-items: center;height: 80px;">
                            <a href="{{ url('websetting/edit_testimonials/' . $temp->id) }}/" class="table-action" data-toggle="tooltip" data-original-title="Edit testimonials">
                                <i class="fas fa-user-edit"></i>
                            </a>
                            <a href="javascript:void(0)" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="Delete testimonials" onclick="del_testimonials({{$temp->id}})">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
        </div>
    </div>
  </div>

<div id="success_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-primary fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Success!</strong> You deleted a testimonials!</span>
  <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="fail_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-danger alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Fail!</strong> You failed to delete a testimonials!</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endsection

@section('script')
<script type="text/javascript">
    function del_testimonials(id){
      if(confirm("Are you sure delete this testimonials?")){
        $.ajax({ 
            method:'POST',
            url:'/websetting/del_testimonials',
            data:{
                id:id,
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
            error:function(error){console.log(error);
                // $("#fail_notify").show();
                // setTimeout(() => {
                // $("#fail_notify").fadeOut(3000)
                // }, 3000);
            }
        })
      }
    }

    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>
@endsection