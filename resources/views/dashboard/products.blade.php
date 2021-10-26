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
#global_search {
  position: 'absolute';
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
              <h6 class="h2 d-inline-block mb-0">Products List</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links">
                  <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item">Products</li>
                  <li class="breadcrumb-item active" aria-current="page">Manage Products</li>
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
                <form class="dropform col-3" style="margin-right:20px">
                  <label class="form-control-label">Main category</label>
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
                <form class="dropform col-3" style="margin-right:20px">
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
                <form class="dropform col-3">
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
                <button class="btn btn-default" onclick="get_product()" style="margin-right:20px; margin-top:30px;">Search</button>
                <a class="btn btn-default" href="/products/add_product" style="margin-top:30px;">Add Product</a>
            </div>
            
            <div class="table-responsive py-4">
              <table class="table align-items-center table-flush" id="datatable-buttons">
                <thead class="thead-light">
                  <tr>
                    <!-- <th>Id</th> -->
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Info</th>
                    <th>Badges</th>
                    <th>Status</th>
                    <th>Modify Date</th>
                    <th></th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <!-- <th>Id</th> -->
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Info</th>
                    <th>Badges</th>
                    <th>Status</th>
                    <th>Modify Date</th>
                    <th></th>
                  </tr>
                </tfoot>
                <tbody id="tbl">
                  @foreach($product as $temp)
                  <tr>
                    <!-- <td>{{$temp['id']}}</td> -->
                    <td>
                        <div class="media align-items-center">
                            <a href="#" class="avatar rounded-circle mr-3">
                                <img src="{{asset('public/upload/product-images/'.$temp['product_image'])}}" alt="no image">
                            </a>
                            <div class="media-body">
                              <span class="name mb-0 text-sm">{{$temp['product_name']}}</span>
                            </div>
                        </div>
                    </td>
                    <td>{{$temp['sku']}}</td>
                    <td>{{$temp['category']}}</td>
                    <td>{{$temp['brand']}}</td>
                    <td width="100px;">
                      price: {{$temp['price']}}<br>
                      viewed: {{$temp['viewed']}}<br>
                      <span style="display:flex;">discount: {{$temp['discount']}} {{$temp['percents']}}%</span>
                      
                    </td>
                    <td>
                      <?php echo($temp['featured']?"<span class='badge badge-pill badge-primary'>Featured</span>":"")?>
                      <?php echo($temp['onsale']?"<span class='badge badge-pill badge-primary'>On Sale</span>":"")?>
                    </td>
                    <td>
                      <?php echo($temp['status']?"<span class='badge badge-dot mr-4'><i class='bg-success'></i><span class='status'>Active</span></span>":"<span class='badge badge-dot mr-4'><i class='bg-warning'></i><span class='status'>Inactive</span></span>")?>
                    </td>
                    <td>{{$temp['modified']}}</td>
                    <td class="text-right" style="display:flex;align-items: center;height: 80px;">
                        <a href="{{ url('products/edit_product/' . $temp['id']) }}" class="table-action" data-toggle="tooltip" data-original-title="Edit product">
                            <i class="fas fa-user-edit"></i>
                        </a>
                        <a href="javascript:void(0)" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="Delete product" onclick="del_product({{$temp['id']}})">
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
  <span class="alert-text"><strong>Success!</strong> You deleted a material!</span>
  <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="fail_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-danger alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Fail!</strong> You failed to delete a material!</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endsection

@section('script')
 <script>
//  $("#datatable-buttons_filter").css({"position": "absolute", "margin-left": "15px"});
$("#datatable-buttons_filter").css({"display": "none"});

$(".dt-buttons").after("<label style='margin-left: 20px;width:250px;'>Search: <input type='search' class='form-control form-control-sm' placeholder='Type Product, SKU, Brand...'  id='global_search' onchange='global_search()' value='{{$setting['search']}}'></label>");

  function global_search(){
    search_key = $("#global_search").val();
    if(search_key.includes("/")){
      search_key = search_key.replace("/", "_lol_");
    }
    if(search_key){
      window.location.href = '/products/search_product/'+search_key;
    }
  }

   function get_product() {
    main_category = $("#category").val();
    sub_category  =$("#sub_category").val();
    brand = $("#brand").val();
    window.location.href = '/products/products/'+main_category+"/"+sub_category+"/"+brand;
      
   };
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

   function del_product(id){
      $.ajax({
          method:'POST',
          url:'/products/del_product',
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
          error:function(){
              $("#fail_notify").show();
              setTimeout(() => {
              $("#fail_notify").fadeOut(3000)
              }, 3000);
          }
      })
  }
 </script>
@endsection