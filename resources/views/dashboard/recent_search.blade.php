@extends('layout.dash')

@section('style')
    <!-- Page plugins -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
<style>
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
              <h6 class="h2 d-inline-block mb-0">Recent Search List</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links">
                  <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="/report/recent_search">Report</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Recent Search List</li>
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
            <div class="card-header">
                <h3>Recent 1000 Search</h3> 
            </div>
            <div class="table-responsive py-4">
              <table class="table align-items-center table-flush" id="datatable-buttons">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Keyword</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Keyword</th>
                        <th>Date</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $count = 0;?>
                    @foreach($result as $temp)
                    <tr>
                        <td>{{++$count}}</td>
                        <td>
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="name mb-0 text-sm">{{$temp->keywords}}</span>
                                </div>
                            </div>
                        </td>
                        <td>{{$temp->created}}</td>
                        <!-- <td class="text-right">
                            <a href="/products/view_product" class="table-action" data-toggle="tooltip" data-original-title="Edit product">
                                <i style='font-size:20px' class='fas'>&#xf06e;</i>
                            </a>   
                        </td> -->
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
        </div>
    </div>
  </div>
@endsection

@section('script')

@endsection