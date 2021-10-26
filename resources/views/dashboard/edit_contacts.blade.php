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
              <h6 class="h2 d-inline-block mb-0">Contacts Deatails</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links">
                  <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="/customers/contacts">Customers</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Contacts Deatails</li>
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
                    <a href="/customers/contacts" class="btn btn-sm btn-default">Back to List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3" style="display:none">
                        <div class="form-group">
                            <label class="form-control-label" for="Product_name">Contacts Id</label>
                            <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input class="form-control" placeholder="Your name" type="text" id="id" value="{{$result->id}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="first_name">Name</label>
                            <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input class="form-control" placeholder="Your name" type="text" id="first_name" value="{{$result->customer_name}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="compony_name">Company Name</label>
                            <input class="form-control" type="text" id="compony_name" value="{{$result->company_name}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="industry_number">ASI,SAGE,PPAI</label>
                            <input class="form-control" type="text" id="industry_number" value="{{$result->industry_num}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="company_pos">Company Position</label>
                            <input class="form-control" type="text" id="company_pos" value="{{$result->company_position}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="email1">Email1:</label>
                            <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input class="form-control" type="email" id="email1" value="{{$result->email1}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="email2">Email2:</label>
                            <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input class="form-control" type="email" id="email2" value="{{$result->email2}}">
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="office_number">Office Phone:</label>
                            <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                            </div>
                            <input class="form-control" type="text" id="office_number" value="{{$result->office_phone}}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
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
                            <input class="form-control" type="text" id="mobile_number" value="{{$result->mobile_phone}}">
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
                            <label class="form-control-label" for="address1">Address1</label>
                            <input class="form-control" type="text" id="address1" value="{{$result->address1}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="address2">Address2</label>
                            <input class="form-control" type="text" id="address2" value="{{$result->address2}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="city">City</label>
                            <input class="form-control" type="text" id="city" value="{{$result->city}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="state">State</label>
                            <input class="form-control" type="text" id="state" value="{{$result->state}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="zip">Zip</label>
                            <input class="form-control" type="text" id="zip" value="{{$result->zip}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="method">Preffered Contact Method</label>
                            <input class="form-control" type="text" id="method" value="{{$result->preffered_method}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label class="form-control-label" for="comment">Comment</label>
                            <textarea class="form-control" id="comment">{{$result->comment}}</textarea>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col">
                    <button type="button" class="btn btn-default" style="float:right;" onclick="edit_customer()">Save Product</button>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<div id="success_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-primary fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Success!</strong> You edited a new customer!</span>
  <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="fail_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-danger alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Fail!</strong> You failed to edit a new customer!</span>
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

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
@endsection