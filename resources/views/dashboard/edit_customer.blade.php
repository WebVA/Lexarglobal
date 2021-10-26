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
.del_btn_style {
    display: flex;
    align-items: center;
    margin-left: auto;
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
              <h6 class="h2 d-inline-block mb-0">Edit Customer</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links">
                  <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="/customers/customers">Customers</a></li>
                  <li class="breadcrumb-item"><a href="/customers/customers">Manage Customers</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Customer</li>
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
                    <a href="/customers/customers" class="btn btn-sm btn-default">Back to List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3" style="display:none">
                        <div class="form-group">
                            <label class="form-control-label" for="Product_name">Customer Id</label>
                            <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input class="form-control" placeholder="Your name" type="text" id="id" value="{{$result[0]->id}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="first_name">First Name</label>
                            <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input class="form-control" placeholder="Your name" type="text" id="first_name" value="{{$result[0]->firstname}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="last_name">Last Name</label>
                            <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input class="form-control" placeholder="Your name" type="text" id="last_name" value="{{$result[0]->lastname}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="status">Status</label>
                            <select class="form-control" data-toggle="select" id="status">
                                @if($result[0]->status == 1)
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                @else
                                    <option value="1">Active</option>
                                    <option value="0" selected>Inactive</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="del_btn_style">
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger" style="height: fit-content;font-size:medium" onclick="del_customer({{$result[0]->id}})">Delete</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="compony_name">Company Name</label>
                            <input class="form-control" type="text" id="compony_name" value="{{$result[0]->company_name}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="industry_number">ASI</label>
                            <input class="form-control" type="text" id="industry_number" value="{{$result[0]->industry_number}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="sage">SAGE</label>
                            <input class="form-control" type="text" id="sage" value="{{$result[0]->sage_number}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="email">Email:</label>
                            <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input class="form-control" placeholder="Email address" type="email" id="email" value="{{$result[0]->email}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="password">Password:</label>
                            <div class="input-group input-group-merge">
                            <input class="form-control" type="text" id="password" value="{{$result[0]->password}}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-eye"></i></span>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="mobile_number">Mobile Phone:</label>
                            <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                            </div>
                            <input class="form-control" type="text" id="mobile_number" value="{{$result[0]->mobile_phone}}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="fax_number">Fax Number:</label>
                            <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                            </div>
                            <input class="form-control" placeholder="Phone number" type="text" id="fax_number" value="{{$result[0]->fax_number}}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="landphone_number">Land Phone:</label>
                            <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                            </div>
                            <input class="form-control" type="text" id="landphone_number" value="{{$result[0]->land_phone}}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="office_number">Office number:</label>
                            <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                            </div>
                            <input class="form-control" type="text" id="office_number" value="{{$result[0]->land_phone}}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="address">Address</label>
                            <input class="form-control" type="text" id="address" value="{{$result[0]->address}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="city">City</label>
                            <input class="form-control" type="text" id="city" value="{{$result[0]->city}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="country">Country</label>
                            <select class="form-control" data-toggle="select" id="country">
                                @foreach($country as $temp)
                                    @if($temp->abbr == $result[0]->country)
                                        <option value="{{$temp->abbr}}" selected>{{$temp->name}}</option>
                                    @else
                                        <option value="{{$temp->abbr}}">{{$temp->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="state">State</label>
                            <select class="form-control" data-toggle="select" id="state">
                                @foreach($state as $temp)
                                    @if($temp->abbr == $result[0]->state)
                                        <option value="{{$temp->abbr}}" selected>{{$temp->name}}</option>
                                    @else
                                        <option value="{{$temp->abbr}}">{{$temp->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="zip">Zip</label>
                            <input class="form-control" type="text" id="zip" value="{{$result[0]->zip}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="form-control-label" for="">Billing Address</label>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="bill_address1">Address1</label>
                            <input class="form-control" type="text" id="bill_address1" value="{{$result[0]->bill_address1}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="bill_address2">Address2</label>
                            <input class="form-control" type="text" id="bill_address2" value="{{$result[0]->bill_address2}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="bill_city">City</label>
                            <input class="form-control" type="text" id="bill_city" value="{{$result[0]->bill_city}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="bill_state">State</label>
                            <select class="form-control" data-toggle="select" id="bill_state">
                                @foreach($state as $temp)
                                    @if($temp->abbr == $result[0]->bill_state)
                                        <option value="{{$temp->abbr}}" selected>{{$temp->name}}</option>
                                    @else
                                        <option value="{{$temp->abbr}}">{{$temp->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="bill_zip">Zip</label>
                            <input class="form-control" type="text" value="{{$result[0]->bill_zip}}" id="bill_zip">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="form-control-label" for="">Shipping Address</label>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">Address1</label>
                            <input class="form-control" type="text" id="shipping_address1" value="{{$result[0]->shipping_address1}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">Address2</label>
                            <input class="form-control" type="text" id="shipping_address2" value="{{$result[0]->shipping_address2}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="shipping_city">City</label>
                            <input class="form-control" type="text" id="shipping_city" value="{{$result[0]->shipping_city}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="shipping_state">State</label>
                            <select class="form-control" data-toggle="select" id="shipping_state">
                                @foreach($state as $temp)
                                    @if($temp->abbr == $result[0]->shipping_state)
                                        <option value="{{$temp->abbr}}" selected>{{$temp->name}}</option>
                                    @else
                                        <option value="{{$temp->abbr}}">{{$temp->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="shipping_zip">Zip</label>
                            <input class="form-control" type="text" value="{{$result[0]->shipping_zip}}" id="shipping_zip">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                    <button type="button" class="btn btn-default" style="float:right;" onclick="edit_customer()">Save Product</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="success_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-primary fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Success!</strong> You edited a this customer!</span>
  <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="fail_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-danger alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Fail!</strong> You failed to edit a this customer!</span>
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
<div id="success_del_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-primary fade show" role="alert">
    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
    <span class="alert-text"><strong>Success!</strong> You deleted a this customer!</span>
    <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        function edit_customer(){
            if($("#first_name").val()&&$("#last_name").val()&&$("#email").val()&&$("#password").val()&&$("#industry_number").val()){
                $.ajax({ 
                    method:'POST',
                    url:'/customers/edit_customer',
                    data:{
                        id:$("#id").val(),
                        first_name:$("#first_name").val(),
                        last_name:$("#last_name").val(),
                        status:$("#status").val(),
                        compony_name:$("#compony_name").val(),
                        industry_number:$("#industry_number").val(),
                        sage:$("#sage").val(),
                        email:$("#email").val(),
                        password:$("#password").val(),
                        mobile_number:$("#mobile_number").val(),
                        fax_number:$("#fax_number").val(),
                        landphone_number:$("#landphone_number").val(),
                        office_number:$("#office_number").val(),
                        address:$("#address").val(),
                        city:$("#city").val(),
                        country:$("#country").val(),
                        state:$("#state").val(),
                        zip:$("#zip").val(),
                        bill_address1:$("#bill_address1").val(),
                        bill_address2:$("#bill_address2").val(),
                        bill_city:$("#bill_city").val(),
                        bill_state:$("#bill_state").val(),
                        bill_zip:$("#bill_zip").val(),
                        shipping_address1:$("#shipping_address1").val(),
                        shipping_address2:$("#shipping_address2").val(),
                        shipping_city:$("#shipping_city").val(),
                        shipping_state:$("#shipping_state").val(),
                        shipping_zip:$("#shipping_zip").val(),
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

        function del_customer(id){
      if(confirm("Are you sure delete this customer?")){
        $.ajax({ 
            method:'POST',
            url:'/customers/del_customer',
            data:{
                id:id,
                "_token":"{{csrf_token()}}"
            },
            success: function(result) {
                if(result){
                    $("#success_del_notify").show();
                    setTimeout(() => {
                    $("#success_del_notify").fadeOut(3000)
                    }, 3000);
                    setTimeout(() => {
                        window.location.href = "/customers/customers";
                    }, 1000);
                    
                }
            },
            error:function(error){console.log(error);
                // $("#fail_notify").show();
                // setTimeout(() => {
                // $("#fail_notify").fadeOut(3000)
                // }, 3000);
            }
        })
        topFunction();
      }
    }

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
@endsection