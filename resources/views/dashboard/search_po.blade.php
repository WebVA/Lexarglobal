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
              <h6 class="h2 d-inline-block mb-0">Search PO</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links">
                  <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item">company PO Update</li>
                  <li class="breadcrumb-item active" aria-current="page">Search PO</li>
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
                    <h3>Enter one of the following</h3>
                </div>
                <form action="/po/search_result" method="post" onsubmit="return validateForm()">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="po_number">PO Number</label>
                            <input type="text" class="form-control" name="po_number" id="po_number" name="po_number" placeholder="Enter PO Number" min=0 require>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="exampleDatepicker">PO Date</label>
                            <input class="form-control datepicker" name="po_date" id="po_date" placeholder="Select date" type="text" require>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="company_name">Company Name</label>
                            <select class="form-control" data-toggle="select" name="company_name" id="company_name">
                              <option value="0" readonly>Select company name</option>
                              @foreach($company_name as $temp)
                                  <option value="{{$temp->company_name}}">{{$temp->company_name}}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                    <button type="submit" class="btn btn-default" style="float:right;">Search</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="warn_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-warning alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Warning!</strong> You have to enter at least one of the fields!</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<div id="no_result_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-warning alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Warning!</strong> There is no result!</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        function validateForm(){
            if($("#po_number").val() || $("#po_date").val() || $("#company_name")) {
                return true;
            }else{
                $("#warn_notify").show();
                setTimeout(() => {
                $("#warn_notify").fadeOut(3000)
                }, 3000);
                return false;
            }
        }
    </script>
@endsection