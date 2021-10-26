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
              <h6 class="h2 d-inline-block mb-0">Sample Order List</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links">
                  <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item">Report</li>
                  <li class="breadcrumb-item active" aria-current="page">Sample Order List</li>
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
          <div class="row">
              <form class="dropform col">
                  <label class="form-control-label">Main Category</label>
                  <select class="form-control" data-toggle="select" id="category" onchange="get_sub_category($(this))">
                      <option value='0'>All</option>
                      @foreach($category as $temp)
                        @if($temp->id == $setting['main_category'])
                        <option value="{{$temp->id}}" selected>{{$temp->category_name}}</option>
                        @else
                        <option value="{{$temp->id}}">{{$temp->category_name}}</option>
                        @endif
                      @endforeach
                  </select>
              </form>
              <form class="dropform col">
                  <label class="form-control-label">Sub Category</label>
                  <select class="form-control" data-toggle="select" id="sub_category">
                    <option value='0'>All</option>
                    @foreach($setting_sub_category as $temp)
                      @if($temp->id == $setting['sub_category'])
                      <option value="{{$temp->id}}" selected>{{$temp->subcategory_name}}</option>
                      @else
                      <option value="{{$temp->id}}">{{$temp->subcategory_name}}</option>
                      @endif
                    @endforeach
                  </select>
              </form>
              <form class="dropform col">
                  <label class="form-control-label">Brand</label>
                  <select class="form-control" data-toggle="select" id="brand">
                    <option value='0'>All</option>
                    @foreach($brand as $temp)
                      @if($temp->brand_name == $setting['brand'])
                      <option value="{{$temp->brand_name}}" selected>{{$temp->brand_name}}</option>
                      @else
                      <option value="{{$temp->brand_name}}">{{$temp->brand_name}}</option>
                      @endif
                    @endforeach
                  </select>
              </form>
              <form class="dropform col">
                  <label class="form-control-label">State</label>
                  <select class="form-control" data-toggle="select" id="state">
                    <option value='0'>All</option>
                    @foreach($state as $temp)
                      @if($temp->abbr == $setting['state'])
                      <option value="{{$temp->abbr}}" selected>{{$temp->name}}</option>
                      @else
                      <option value="{{$temp->abbr}}">{{$temp->name}}</option>
                      @endif
                    @endforeach
                  </select>
              </form>
          </div>
          <br>
          <div class="row">
              <div class="row col-9 input-daterange datepicker align-items-center">
                  <div class="form-group col">
                      <label class="form-control-label">From</label>
                      <input class="form-control" placeholder="Start date" type="text" id="start_date" value="{{$setting['start_date']?$setting['start_date']:''}}">
                  </div>
                  <div class="form-group col">
                      <label class="form-control-label">To</label>
                      <input class="form-control" placeholder="End date" type="text" id="end_date" value="{{$setting['end_date']?$setting['end_date']:''}}">
                  </div>
              </div>
              <div class="col-3">
                  <br>
                  <button class="btn btn-default" onclick="see_sameple_order()">See Sample Order</a>
              </div>
          </div>
        </div>
            <div class="table-responsive py-4">
              <table class="table align-items-center table-flush" id="datatable-buttons">
                <thead class="thead-light">
                  <tr>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Main Category</th>
                    <th>Sub Category</th>
                    <th>Brand</th>
                    <th>ASI/Sage Number</th>
                    <th>Address</th>
                    <th>QTY</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Main Category</th>
                    <th>Sub Category</th>
                    <th>Brand</th>
                    <th>ASI/Sage Number</th>
                    <th>Address</th>
                    <th>QTY</th>
                    <th>Date</th>
                  </tr>
                </tfoot>
                <tbody>
                    @foreach($result as $temp)
                    <tr>
                      <td>{{$temp['first_name']}} {{$temp['last_name']}}</td>
                      <td>
                          <div class="media align-items-center">
                              <a href="#" class="avatar rounded-circle mr-3">
                                  <img alt="Image placeholder" src="{{asset('public/upload/product-images/'.$temp['product_image'])}}">
                              </a>
                              <div class="media-body">
                                  <span class="name mb-0 text-sm">{{$temp['product_name']}}</span>
                              </div>
                          </div>
                      </td>
                      <td>{{$temp['sku']}}</td>
                      <td>{{$temp['category_name']}}</td>
                      <td>{{$temp['subcategory_name']}}</td>
                      <td>{{$temp['brand_name']}}</td>
                      <td>{{$temp['industry_number']}}</td>
                      <td>{{$temp['ship_address']}}</td>
                      <td>{{$temp['qty']}}</td>
                      <td>{{$temp['created']}}</td>
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
<script>
    function get_sub_category(obj) {
      $.ajax({
        method:'POST',
        url:'/products/get_sub_category',
        data:{
            id:obj.val(),
            "_token":"{{csrf_token()}}"
        },
        success: function(result) {          
          text = "<option value='0'>All</option>";
          for(i in result){
            text += "<option value='"+result[i].id+"'>"+ result[i].subcategory_name+"</option>";
          }
          $("#sub_category").html("");
          $("#sub_category").append(text);
        },
        error:function(error){
          console.log(error)
        }
      });
   };

   function see_sameple_order(){
    main_category = $("#category").val();
    sub_category  =$("#sub_category").val();
    brand = $("#brand").val();
    state = $("#state").val();
    if($("#start_date").val() && $("#end_date").val()){
      start_date_arry = $("#start_date").val().split('/');
      end_date_arry = $("#end_date").val().split('/');
      start_date = start_date_arry[2]+"-"+start_date_arry[0]+"-"+start_date_arry[1];
      end_date = end_date_arry[2]+"-"+end_date_arry[0]+"-"+end_date_arry[1];
    }else{
      start_date = 0;
      end_date = 0;
    }
    
    window.location.href = "/report/sample_order/"+main_category+"/"+sub_category+"/"+brand+"/"+state+"/"+start_date+"/"+end_date;
   }
</script>
@endsection