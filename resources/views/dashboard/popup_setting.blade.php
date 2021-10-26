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
.brand_img {
    width:150px;
    height:80px;
}
.brand_des {
    width:300px;
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
                  <li class="breadcrumb-item"><a href="/blands/blands">Popup</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Manage Popup</li>
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
                <a class="btn btn-default" href="/blands/add_bland">Add Brands</a>
            </div>
            <div class="table-responsive py-4">
              <table class="table align-items-center table-flush" id="datatable-buttons">
                <thead class="thead-light">
                  <tr>
                    <th>Id</th>
                    <th>Page</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th></th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th></th>
                  </tr>
                </tfoot>
                <tbody>
                    @foreach($getData as $temp)
                    <tr>
                        <td>{{$temp->id}}</td>
                        <td>
                          @if($temp->page_type == 1)
                              Home Page
                          @else
                              Product Detail Page
                          @endif
                        </td>
                        <td style="padding:0">
                            <img class="brand_img" src="{{asset('public/upload/popup_images/'.$temp->image)}}" alt="no image">
                        </td>
                        <td id="statusTxt_{{$temp->id}}">
                          @if($temp->status != 1)
                          <span class="text-warning">●</span>
                          <small>Inactive</small>
                          @else
                          <span class="text-success">●</span>
                          <small>Active</small>
                          @endif
                        </td>
                        <td class="text-right" style="display:flex;align-items: center;height: 80px;">
                            <a href="{{ url('websetting/edit-popup/' . $temp->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-original-title="Edit Popup">
                                Edit
                            </a>

                            <span id="statusBtn_{{$temp->id}}">
                                @if($temp->status != 1)
                                  <a onclick="statusToggle(1,{{$temp->id}})" class="btn btn-success btn-sm" style="color:white;cursor:pointer">Activate</a>
                                @else
                                  <a onclick="statusToggle(2,{{$temp->id}})" class="btn btn-danger btn-sm" style="color:white;cursor:pointer">Deactivate</a>
                                @endif
                            </span>

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
  <span class="alert-text"><strong>Success!</strong> You activated the Popup!</span>
  <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="fail_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-danger alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Fail!</strong> You deactivated the Popup!</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<input type="hidden" value="{{ url('') }}" id="base_url">
@endsection

@section('script')
    <script type="text/javascript">

        function statusToggle(typ,id){

            var bsUrl=$('#base_url').val();

            $.ajax({ 
                method:'POST',
                url:bsUrl +'/websetting/popup_status_toggle',
                data:{
                    act:typ,
                    id:id,
                    "_token":"{{csrf_token()}}"
                },
                success: function(result) {

                    switch(typ)
                    {
                        case 1:
                          var ntyp=2;
                          $('#statusBtn_' + id).html('<a onclick="statusToggle('+ ntyp +','+ id +')" class="btn btn-danger btn-sm" style="color:white;cursor:pointer">Deactivate</a>');
                          $('#statusTxt_' + id).html('<span class="text-success">●</span><small>Active</small>');
                        break;

                        case 2:
                          var ntyp=1;
                          $('#statusBtn_' + id).html('<a onclick="statusToggle('+ ntyp +','+ id +')" class="btn btn-success btn-sm" style="color:white;cursor:pointer">Activate</a>');
                          $('#statusTxt_' + id).html('<span class="text-warning">●</span><small>Inactive</small>');
                        break;
                    }
                    $("#success_notify").show();
                    setTimeout(() => {
                    $("#success_notify").fadeOut(3000)
                    }, 3000);
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