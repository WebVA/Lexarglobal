@extends('layout.dash')

@section('style')
<style>
.margin-row {
  margin-left: 30px;
  margin-right: 30px;
}
.chart-cnt {
  display:flex;
}
.chart-header {
  display:flex;
}
</style>

@endsection('style')
@section('content')

  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Header -->
    <div class="header pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 d-inline-block mb-0">Dashboard</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links">
                  <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Header Card -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-3 col-md-6">
          <div class="card bg-gradient-info border-0">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total Products</h5>
                  <span class="h2 font-weight-bold mb-0 text-white">{{$product}}</span>
                </div>
              </div>
              <p class="mt-3 mb-0 text-sm">
                <a href="/products/products/0/0/0" class="text-nowrap text-white font-weight-600">See details</a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-gradient-primary border-0">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total Customers</h5>
                  <span class="h2 font-weight-bold mb-0 text-white">{{$customer}}</span>
                </div>
              </div>
              <p class="mt-3 mb-0 text-sm">
                <a href="/customers/customers" class="text-nowrap text-white font-weight-600">See details</a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-gradient-danger border-0">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">Most viewed product</h5>
                  <span class="h2 font-weight-bold mb-0 text-white">{{$most_viewed_product[0]['sku']}}</span>
                </div>
              </div>
              <p class="mt-3 mb-0 text-sm">
                <a href="/products/edit_product/{{$most_viewed_product[0]['product_id']}}" class="text-nowrap text-white font-weight-600">See details</a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-gradient-default border-0">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">Most viewed customer</h5>
                  <span class="h2 font-weight-bold mb-0 text-white">{{$top_customer[0]->firstname}} {{$top_customer[0]->lastname}}</span>
                </div>
              </div>
              <p class="mt-3 mb-0 text-sm">
                <a href="/customers/edit_customer/{{$top_customer[0]->customer_id}}" class="text-nowrap text-white font-weight-600">See details</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Most Ordered Customer -->
    <div class="margin-row">
      <div class="card-deck flex-column flex-xl-row">
        <div class="card col-12">
          <div class="card-header bg-transparent border-0">
            <div class="chart-header">
              <div class="row align-items-center" style="width: -webkit-fill-available;">
                <div class="col">
                  <h3 class="mb-0">Most Viewed Products Report</h3>
                </div>
                <!-- <div class="chart-cnt">
                  <button type="button" class="btn btn-sm btn-default" onclick="chartview(1)">Year</button>
                  <button type="button" class="btn btn-sm btn-success" onclick="chartview(2)">Month</button>
                </div> -->
              </div>
            </div>
          </div>
          <canvas id="viewChart" width="" height="200px;"></canvas>
        </div>
      </div>
    </div>

    <div class="margin-row">
      <div class="card-deck flex-column flex-xl-row">
        <div class="card col-xl-9">
          <!-- Card header -->
          <div class="card-header bg-transparent border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">Most Viewed Products</h3>
              </div>
              <div class="col text-right">
                <a href="/report/most_viewed_products/0/0/0/0/0/0" class="btn btn-sm btn-success">See all</a>
              </div>
            </div>
          </div>
          <!-- Translucent table -->
          <div class="table-responsive" data-toggle="list" data-list-values='["name", "sku" "view"]'>
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="sort" data-sort="name">Product Name</th>
                  <th scope="col" class="sort" data-sort="sku">SKU</th>
                  <th scope="col" class="sort" data-sort="view">View</th>
                </tr>
              </thead>
              <tbody class="list">
                @foreach($most_viewed_product as $item)
                <tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <a href="#" class="avatar rounded-circle mr-3">
                      <img alt="Image placeholder" src="{{asset('public/upload/product-images/'.$item['product_image'])}}">
                      </a>
                      <a href="/products/edit_product/{{$item['product_id']}}">
                      <div class="media-body">
                        <span class="name mb-0 text-sm">{{$item['product_name']}}</span>
                      </div>
                      </a>
                    </div>
                  </th>
                  <td class="sku">{{$item['sku']}}</td>
                  <td class="view">{{$item['view_count']}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- search view -->
        <div class="card-deck flex-column flex-xl-row col-xl-3">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Recent Search</h3>
                </div>
                <div class="col text-right">
                <a href="/report/recent_search" class="btn btn-sm btn-success">See all</a>
              </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Key words</th>
                    <th scope="col">Count</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($search_data as $item)
                  <tr>
                    <th scope="row">
                      {{$item->keywords}}
                    </th>
                    <th scope="row">
                      {{$item->num}}
                    </th>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- sample order -->
    <div class="margin-row">
      <div class="card-deck flex-column flex-xl-row">
        <div class="card col-xl-12">
          <!-- Card header -->
          <div class="card-header bg-transparent border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">Recent Sample Orders</h3>
              </div>
              <div class="col text-right">
                <a href="/report/sample_order/0/0/0/0/0/0" class="btn btn-sm btn-success">See all</a>
              </div>
            </div>
          </div>
          <!-- Translucent table -->
          <div class="table-responsive" data-toggle="list" data-list-values='["customer", "product", "sku", "maincategory", "subcategory", "brand", "asi", "address", "qty", "date"]'>
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="sort" data-sort="customer">Customer</th>
                  <th scope="col" class="sort" data-sort="product">Product</th>
                  <th scope="col" class="sort" data-sort="sku">SKU</th>
                  <th scope="col" class="sort" data-sort="maincategory">Main Category</th>
                  <th scope="col" class="sort" data-sort="subcategory">Sub Category</th>
                  <th scope="col" class="sort" data-sort="brand">Brand</th>
                  <th scope="col" class="sort" data-sort="asi">ASI/Sage Number</th>
                  <th scope="col" class="sort" data-sort="address">Address</th>
                  <th scope="col" class="sort" data-sort="qty">QTY</th>
                  <th scope="col" class="sort" data-sort="date">Date</th>
                </tr>
              </thead>
              <tbody class="list">
                @foreach($sample_order as $item)
                <tr>
                  <td class="customer">{{$item['first_name']}} {{$item['first_name']}}</td>
                  <td>
                    <div class="media align-items-center">
                        <a href="#" class="avatar rounded-circle mr-3">
                            <img alt="Image placeholder" src="{{asset('public/upload/product-images/'.$temp['product_image'])}}">
                        </a>
                        <div class="media-body">
                            <span class="name mb-0 text-sm">{{$item['product_name']}}</span>
                        </div>
                    </div>
                  </td>
                  <td class="sku">{{$item['sku']}}</td>
                  <td class="maincategory">{{$item['category_name']}}</td>
                  <td class="subcategory">{{$item['subcategory_name']}}</td>
                  <td class="brand">{{$item['brand_name']}}</td>
                  <td class="asi">{{$item['industry_number']}}</td>
                  <td class="address">{{$item['ship_address']}}</td>
                  <td class="qty">{{$item['qty']}}</td>
                  <td class="date">{{$item['created']}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- table1 part -->
    <div class="margin-row">
      <div class="card-deck flex-column flex-xl-row">
        <div class="card">
          <!-- Card header -->
          <div class="card-header bg-transparent border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">New Customers</h3>
              </div>
              <div class="col text-right">
                <a href="/customers/customers" class="btn btn-sm btn-success">See all</a>
              </div>
            </div>
          </div>
          <!-- Card body -->
          <div class="card-body">
            <!-- List group -->
            <ul class="list-group list-group-flush list my--3">
            @foreach($new_customer as $item)
              <li class="list-group-item px-0">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <!-- Avatar -->
                    <!-- <a href="#" class="avatar rounded-circle">
                      <img alt="Image placeholder" src="../../assets/img/theme/team-1.jpg">
                    </a> -->
                  </div>
                  <div class="col ml--2">
                    <h4 class="mb-0">
                      <a href="/customers/edit_customer/{{$item->id}}">{{$item->firstname}} {{$item->lastname}}</a>
                    </h4>
                    <span class="text-success">●</span>
                    <small>Join: {{$item->created}}</small><br>
                    <span class="text-success">●</span>
                    <small>State: {{$item->state}}</small>
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
        </div>

        <div class="card">
          <!-- Card header -->
          <div class="card-header bg-transparent border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">Top Customers</h3>
              </div>
              <div class="col text-right">
                <a href="/customers/customers" class="btn btn-sm btn-success">See all</a>
              </div>
            </div>
          </div>
          <!-- Card body -->
          <div class="card-body">
            <!-- List group -->
            <ul class="list-group list-group-flush list my--3">
            @foreach($top_customer as $item)
              <li class="list-group-item px-0">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <!-- Avatar -->
                    <!-- <a href="#" class="avatar rounded-circle">
                      <img alt="Image placeholder" src="../../assets/img/theme/team-1.jpg">
                    </a> -->
                  </div>
                  <div class="col ml--2">
                    <h4 class="mb-0">
                      <a href="/customers/edit_customer/{{$item->customer_id}}">{{$item->firstname}} {{$item->lastname}}</a>
                    </h4>
                    <span class="text-success">●</span>
                    <small>Total View Numbers: {{$item->view_count}}</small><br>
                    <span class="text-success">●</span>
                    <small>state: {{$item->state}}</small>
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
        </div>

        <div class="card">
          <!-- Card header -->
          <div class="card-header bg-transparent border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">New Products</h3>
              </div>
              <div class="col text-right">
                <a href="/products/products/0/0/0" class="btn btn-sm btn-success">See all</a>
              </div>
            </div>
          </div>
          <!-- Card body -->
          <div class="card-body">
            <!-- List group -->
            <ul class="list-group list-group-flush list my--3">
            @foreach($new_product as $item)
              <li class="list-group-item px-0">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <!-- Avatar -->
                    <a href="#" class="avatar rounded-circle">
                      <img alt="Image placeholder" src="{{asset('public/upload/product-images/'.$item['product_image'])}}">
                    </a>
                  </div>
                  <div class="col ml--2">
                    <h4 class="mb-0">
                      <a href="/products/edit_product/{{$item['id']}}">{{$item['product_name']}}</a>
                    </h4>
                    <span class="text-success">●</span>
                    <small>{{$item['created']}}</small>
                    <span class="badge badge-lg badge-warning">${{$item['price']}}</span>
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script src="{{ asset('js/chart.min.js') }}"></script>
  <!-- <script src="{{ asset('js/utils.js') }}"></script> -->
  <script >
  $(document).ready(function () {
    month_arry = ["Jan","Feb","Mar","Apr","May","Jun","Junly","Aug","Sep","Oct","Nev","Dec"];
    color_arry = ["#ff0080","#40ff00","#0080ff","#bfff00","#8000ff"];
    // date_arry = ["1th","2th","3th","4th","5th","6th","7th","8th","9th","10th","11th","12th","13th","14th","15th","16th","17th","18th","19th","20th","21th","22th","23th","24th","25th","26th","28th","29th","30th","31th"];
    label_arry = [];
    current_date = <?php echo date('m')?>;
    for(i=0;i<12;i++){
      if(current_date==12)current_date=0;
      label_arry.push(month_arry[current_date++])
    }
    var rowdata = <?php echo json_encode($most_viewed_product); ?>;
    var datasets = [];
    for(i in rowdata){
      data = {};
      data.label = rowdata[i].sku;
      data.data = rowdata[i].m_view_arry;
      data.borderColor = color_arry[i];
      data.backgroundColor = color_arry[i];
      datasets.push(data);
    };
    // console.log(rowdata);
    viewdata = {
      labels: label_arry,
      datasets: datasets
    };

    viewconfig = {
      type: 'line',
      data: viewdata,
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'right',
          },
          title: {
            display: false,
            text: 'Chart.js Line Chart'
          }
        }
      },
    };

    var ctx2 = document.getElementById('viewChart').getContext('2d');
    var viewChart = new Chart(ctx2, viewconfig);
  });
    
  </script>
@endsection