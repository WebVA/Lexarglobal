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
              <h6 class="h2 d-inline-block mb-0">Decorations List</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links">
                  <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="/decorations/decorations">Decorations</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Manage Decorations</li>
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
                <a class="btn btn-default" href="/decorations/add_decoration">Add decoration</a>
            </div>
            <div class="table-responsive py-4">
              <table class="table align-items-center table-flush" id="datatable-buttons">
                <thead class="thead-light">
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th></th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th></th>
                  </tr>
                </tfoot>
                <tbody>
                    @foreach($result as $temp)
                    <tr>
                        <td>{{$temp->id}}</td>
                        <td>
                            <span class="name mb-0 text-sm">{{$temp->name}}</span>
                        </td>
                        <td>{{$temp->description}}</td>
                        <td class="text-right" style="display:flex;align-items: center;height: 80px;">
                            <a href="{{ url('decorations/edit_decoration/' . $temp->id) }}" class="table-action" data-toggle="tooltip" data-original-title="Edit decoration">
                                <i class="fas fa-user-edit"></i>
                            </a>
                            <a href="javascript:void(0)" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="Delete decoration" onclick="del_decoration({{$temp->id}})">
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
  <span class="alert-text"><strong>Success!</strong> You deleted a decoration!</span>
  <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="fail_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-danger alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Fail!</strong> You failed to delete a decoration!</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        function del_decoration(id){
            $.ajax({ 
                method:'POST',
                url:'/decorations/del_decoration',
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
                    topFunction();
                },
                error:function(){
                    $("#fail_notify").show();
                    setTimeout(() => {
                    $("#fail_notify").fadeOut(3000)
                    }, 3000);
                    topFunction();
                }
            })
        }

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
@endsection