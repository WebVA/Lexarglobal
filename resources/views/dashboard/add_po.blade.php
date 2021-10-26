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
              <h6 class="h2 d-inline-block mb-0">Create New PO</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links">
                  <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item">company PO Update</li>
                  <li class="breadcrumb-item active" aria-current="page">Create New PO</li>
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="po_number">PO Number</label>
                            <input type="text" class="form-control" id="po_number" name="po_number" placeholder="Enter PO Number" min=0>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="company_name">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter company Name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="exampleDatepicker">PO Date</label>
                            <input class="form-control datepicker" id="po_date" placeholder="Select date" type="text">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="last_action">Last Action Taken</label>
                            <select class="form-control" data-toggle="select" id="last_action">
                            @foreach($po_action as $temp)
                                <option value="{{$temp->id}}">{{$temp->action_name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="exampleDatepicker">Tracking Number</label>
                            <input type="text" class="form-control" id="tracking_number" name="tracking_number" placeholder="Enter Tracking Number">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="last_action">Add Tracking</label>
                            <select class="form-control" data-toggle="select" id="last_action">
                            <option value="ups">UPS</option>
                            <option value="fedex">FedEx</option>
                            <option value="trucking">Trucking</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                    <button class="btn btn-default" style="float:right;" onclick="add_po()">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="success_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-primary fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Success!</strong> You created a new company PO!</span>
  <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="fail_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-danger alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Fail!</strong> You failed to create a new company PO!</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="warn_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-warning alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Warning!</strong> You have to enter all fields!</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        function add_po() {
            if($("#po_number").val() && $("#company_name").val() && $("#po_date").val() && $("#last_action").val()){
                $.ajax({ 
                    method:'POST',
                    url:'/po/add_po',
                    data:{
                        po_number:$("#po_number").val(),
                        company_name:$("#company_name").val(),
                        po_date:$("#po_date").val(),
                        last_action:$("#last_action").val(),
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
        }
    </script>
@endsection