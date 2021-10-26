@extends('layout.dash')

@section('style')
<style>
.margin-row {
  margin-left: 30px;
  margin-right: 30px;
}
.container {
  display: contents;
  grid-template-columns: repeat(5, 1fr);
  gap: 10px;
}

.box {
  border: 1px solid #666;
  background-color: #ddd;
  border-radius: 1em;
  padding: 10px;
  cursor: move;
}
.box.over {
  border: 3px dotted #666;
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
              <h6 class="h2 d-inline-block mb-0">Add Product</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links">
                  <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item">Products</li>
                  <li class="breadcrumb-item">Manage Products</li>
                  <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="margin-row">
        <div class="card">
            <!-- Card header -->
            <div class="card-header flex">
                <div class="row align-items-center" style="width: -webkit-fill-available;">
                    <div class="col">
                        <h3 class="mb-0">Product Details</h3>
                    </div>
                    <a href="/products/products/0/0/0" class="btn btn-sm btn-default">Back to List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label">SKU</label>
                            <input type="text" class="form-control" id="sku" placeholder="SKU">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="Product_name">Product Name</label>
                            <input type="text" class="form-control" id="product_name" placeholder="Enter Product Name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">Bland</label>
                            <select class="form-control" id="bland">
                                @foreach($brand as $temp)
                                    <option value="{{$temp->brand_name}}">{{$temp->brand_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-control-label" for="Material">Material</label>
                        <select class="form-control" id="material">
                            @foreach($material as $temp)
                                <option value="{{$temp->name}}">{{$temp->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">Product Discount</label>
                            <select class="form-control" id="discount">
                                @foreach($discard as $temp)
                                    <option value="{{$temp->name}}">{{$temp->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-control-label">Featured</label>
                        <select class="form-control" id="featured">
                            <option value=1 selected>Yes</option>
                            <option value=0>No</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-control-label">On Sale</label>
                        <select class="form-control" id="on_sale">
                            <option value=1 selected>Yes</option>
                            <option value=0>No</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-control-label">Status</label>
                        <select class="form-control" id="status">
                            <option value=1 selected>Active</option>
                            <option value=0>Inactive</option>
                        </select>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-control-label" for="Main_category">Category</label>
                            <select multiple class="form-control" id="main_category" style="height:150px" onclick="set_sub_category($(this))">
                                @foreach($category as $temp)
                                    <option value="{{$temp->id}}">{{$temp->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-control-label" for="Sub_category">Sub Category</label>
                            <select multiple class="form-control" id="sub_category" style="height:150px"></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-control-label" for="Sub_category">Decoration Methods</label>
                            <select multiple class="form-control" id="decoration_method" style="height:150px">
                                @foreach($decoration_method as $temp)
                                    <option value="{{$temp->id}}">{{$temp->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <label class="form-control-label">Qty&Price</label>
                </div>
                <div class="row price_qty_row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label">Qty</label>
                            <input class="form-control qty_input" type="number" min=0 value="{{$temp->quantity}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label">Price</label>
                            <input class="form-control price_input" type="number" min=0 value="{{$temp->price}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <br><br>
                        <button type="button" class="btn btn-twitter btn-icon-only rounded-circle" onclick="del_price($(this))">
                            <span class="btn-inner--icon"><i class="fa fa-close"></i></span>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <button type="button" class="btn btn-twitter" onclick="add_price($(this))">
                        <span class="btn-inner--icon"><i class="fa fa-plus"></i>Add new Price</span>
                    </button>
                </div><br>
                <div class="row" id="onsale_div">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="onsale">On sale</label>
                            <select class="form-control" id="onsale">
                                @for($i=0; $i<=20; $i++)
                                    <option value={{$i*5}}>{{$i*5}}%</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">Retail Price</label>
                            <input id="retail_price" class="form-control price_input" type="number" min=0>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <label class="form-control-label">Color</label>
                </div>
                <div class="row">
                    <div style="display:flex;align-items: center;">
                        <select class="form-control" id="color_picker" onchange="add_color($(this))">
                            @foreach($color as $temp)
                                <option value="{{$temp->color_value}}">{{$temp->color_value}}</option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control">
                        <button type="button" class="btn btn-twitter" onclick="add_color_from_input($(this))">
                            <span class="btn-inner--icon"><i class="fa fa-plus">New</i></span>
                        </button>
                    </div>   
                </div><br>
                <div class="row">
                    <label class="form-control-label">Weight(lbs)</label>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">per unit lbs</label>
                            <input class="form-control" type="number" min=0 id="weight">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">per box lbs</label>
                            <input class="form-control" type="number" min=0 id="box_weight">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">No of items(per box pcs)</label>
                            <input class="form-control" type="number" min=0 id="item_no">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="form-control-label" for="">Product Dimensions(Inches)</label>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">width</label>
                            <input class="form-control" type="number" min=0 id="dim_width">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">height</label>
                            <input class="form-control" type="number" min=0 id="dim_height">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">depth</label>
                            <input class="form-control" type="number" min=0 id="dim_depth">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="form-control-label" for="">Master Box</label>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="master_dimention">dimensions</label>
                            <input class="form-control" type="text" id="master_dimention">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="master_qty">qty</label>
                            <input class="form-control" type="number" min=0 id="master_qty">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="master_weight">weight</label>
                            <input class="form-control" type="number" min=0 id="master_weight">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="form-control-label" for="">Imprint area size(Inches)</label>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">width</label>
                            <input class="form-control" type="number" min=0 id="imprint_width">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">height</label>
                            <input class="form-control" type="number" min=0 id="imprint_height">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-control-label">Description</label>
                        <form>
                            <div data-toggle="quill" data-quill-placeholder="" id="description_note"></div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Specifications</label>
                        <form>
                            <div data-toggle="quill" data-quill-placeholder="" id="specifications"></div>
                        </form>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-control-label">Product Info</label>
                        <form>
                            <div data-toggle="quill" data-quill-placeholder="" id="production_note"></div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Case Studies</label>
                        <form>
                            <div data-toggle="quill" data-quill-placeholder="" id="imprint_note"></div>
                        </form>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-control-label" for="">Office Notes Only</label>
                        <form>
                            <div data-toggle="quill" data-quill-placeholder="" id="note"></div>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <label class="form-control-label" for="">Image&Video</label>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="Product_name">Video Link</label>
                            <input type="url" class="form-control" id="video_link" placeholder="Enter Product video_link">
                        </div>
                    </div>
                </div>
                <div class="row" style="justify-content: center;">
                    <div class="container" id="preview_images">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFileLang" lang="en" onchange="preview(event)">
                            <label class="custom-file-label" for="customFileLang">Select file</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                    <button type="button" class="btn btn-default" style="float:right;" onclick="save_product()">Save Product</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="success_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-primary fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Success!</strong> You added a new product!</span>
  <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="fail_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-danger alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Fail!</strong> You failed to add a new product!</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="warn_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-warning alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Warning!</strong> You have to enter product name!</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endsection

@section('script')
<script>
    function handleDragStart(e) {
        this.style.opacity = '1';
        dragSrcEl = this;
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/html', this.innerHTML);
    }

    function handleDragEnd(e) {
        this.style.opacity = '1';
        items.forEach(function (item) {
            item.classList.remove('over');
        });
    }

    function handleDragOver(e) {
        if (e.preventDefault) {
            e.preventDefault();
        }
        return false;
    }

    function handleDragEnter(e) {
        this.classList.add('over');
    }

    function handleDragLeave(e) {
        this.classList.remove('over');
    }

    function handleDrop(e) {
        e.stopPropagation();
        if (dragSrcEl !== this) {
        dragSrcEl.innerHTML = this.innerHTML;
        this.innerHTML = e.dataTransfer.getData('text/html');
        }
        return false;
    }

    var upload_files = [];
    function preview(e){
        upload_files.push(e.target.files[0]);
        $("#preview_images").append("<div draggable='true' class='box' style='position:relative'><img style='width:300px;' src='"+URL.createObjectURL(e.target.files[0])+"' alt='Image placeholder'><button style='position: absolute;top:0px;right:0px;' type='button' class='btn btn-twitter btn-icon-only rounded-circle' onclick='del_image($(this))'><span class='btn-inner--icon'><i class='fa fa-close'></i></span></button></div>");

        let items = document.querySelectorAll('.container .box');
            
        items.forEach(function(item) {
            item.addEventListener('dragstart', handleDragStart, false);
            item.addEventListener('dragover', handleDragOver, false);
            item.addEventListener('dragenter', handleDragEnter, false);
            item.addEventListener('dragleave', handleDragLeave, false);
            item.addEventListener('dragend', handleDragEnd, false);
            item.addEventListener('drop', handleDrop, false);
        });
    }

    function del_price(obj){
        obj.parent().parent().remove();
    }

    function add_price(obj){
        text = "<div class='row price_qty_row'><div class='col-md-3'><div class='form-group'><label class='form-control-label'>Qty</label><input class='form-control qty_input' type='number' value=''></div></div><div class='col-md-3'><div class='form-group'><label class='form-control-label'>Price</label><input class='form-control price_input' type='number' value=''></div></div><div class='col-md-3'><br><br><button type='button' class='btn btn-twitter btn-icon-only rounded-circle' onclick='del_price($(this))'><span class='btn-inner-icon'><i class='fa fa-close'></i></span></button></div></div>";
        obj.parent().prev().after(text);
    }

    function add_color_from_input(obj){
        if(obj.prev().val()){
            text = "<div class='custom-control custom-checkbox mb-3 color_check' style='margin:10px;'><input  id='"+obj.prev().val()+"' class='custom-control-input' type='checkbox' checked onclick='change_state($(this))'><label class='custom-control-label' for='"+obj.prev().val()+"'>"+obj.prev().val()+"</label></div>";
            obj.prev().val('');
            obj.parent().before(text);
        }
    }

    function add_color(obj){
        text = "<div class='custom-control custom-checkbox mb-3 color_check' style='margin:10px;'><input  id='"+obj.val()+"' class='custom-control-input' type='checkbox' checked onclick='change_state($(this))'><label class='custom-control-label' for='"+obj.val()+"'>"+obj.val()+"</label></div>";
        obj.parent().before(text);
    }

    function del_image(obj){
        obj.parent().remove();
    }

    function change_state(obj){
        obj.val(obj.val()?"":"on");
    }

    function set_sub_category(obj){
        $.ajax({
            method:'POST',
            url:'/products/set_sub_category',
            data:{
                id:obj.val(),
                "_token":"{{csrf_token()}}"
            },
            success: function(result) {
                text = "";
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
    }

    // function toggle_sale(obj){
    //     if(obj.val()==1){
    //         $("#onsale_div").show();
    //     }else{
    //         $("#onsale_div").hide();
    //     }
    // }

    function save_product(){
        price_qty = [];
        $(".price_qty_row").each(function(){
            price_qty_val = {
                price:0,
                qty:0
            };
            price_qty_val.price = $(this).find(".price_input").val();
            price_qty_val.qty = $(this).find(".qty_input").val();
            price_qty.push(price_qty_val);
        });
        color_check = [];
        $(".color_check").each(function(){
            if($(this).find("input").val()=='on'){
                color_check.push($(this).find("label").html());
            }
        })
        if($("#product_name").val()){
            $.ajax({
                method:'POST',
                url:'/products/add_product',
                data:{
                    product_name:$("#product_name").val(),
                    main_category:$("#main_category").val().toString(),
                    sub_category:$("#sub_category").val().toString(),
                    bland:$("#bland").val(),
                    sku:$("#sku").val(),
                    material:$("#material").val(),
                    featured:$("#featured").val(),
                    on_sale:$("#on_sale").val(),
                    status:$("#status").val(),
                    price_qty:price_qty,
                    onsale:$("#onsale").val(),
                    discount:$("#discount").val(),
                    color_check:color_check.toString(),
                    video_link:$("#video_link").val(),
                    retail_price:$("#retail_price").val(),
                    dim_width:$("#dim_width").val(),
                    dim_height:$("#dim_height").val(),
                    dim_depth:$("#dim_depth").val(),
                    master_dimention:$("#master_dimention").val(),
                    master_qty:$("#master_qty").val(),
                    master_weight:$("#master_weight").val(),
                    imprint_width:$("#imprint_width").val(),
                    imprint_height:$("#imprint_height").val(),
                    weight:$("#weight").val(),
                    box_weight:$("#box_weight").val(),
                    item_no:$("#item_no").val(),
                    decoration_method:$("#decoration_method").val().toString(),
                    description_note:$("#description_note").html(),
                    specifications:$("#specifications").html(),
                    imprint_note:$("#imprint_note").html(),
                    note:$("#note").html(),
                    production_note:$("#production_note").html(),
                    "_token":"{{csrf_token()}}",
                },
                success: function(result) {
                    if(result){
                        $("#success_notify").show();
                        setTimeout(() => {
                        $("#success_notify").fadeOut(3000)
                        }, 3000);
                        save_image(result);
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
            });
        }else{
            $("#warn_notify").show();
            setTimeout(() => {
            $("#warn_notify").fadeOut(3000)
            }, 3000);
        }
        topFunction();
    }

    function save_image(id){
        for(i in upload_files){
            var formData = new FormData();
            formData.append('upload_files', upload_files[i]);
            formData.append('id',id);
            $.ajax({
                method:'POST',
                url:'/products/upload_product',
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log(result);
                },
                error:function(error){
                    console.log(error)
                }
            });
        }
    }

    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

</script>
@endsection