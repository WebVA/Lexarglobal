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
              <h6 class="h2 d-inline-block mb-0">Edit Product</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links">
                  <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item">Products</li>
                  <li class="breadcrumb-item">Manage Products</li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
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
                        <h3 class="mb-0">Product Details</h3>
                    </div>
                    <a href="/products/products/0/0/0" class="btn btn-sm btn-default">Back to List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Product_id">SKU</label>
                            <input type="text" class="form-control" id="sku" placeholder="SKU" value="{{$product[0]->sku}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3" style="display:none;">
                        <div class="form-group">
                            <label class="form-control-label" for="Product_id">Product Id</label>
                            <input type="text" class="form-control" id="product_id" readonly placeholder="Can't input id" value="{{$product[0]->id}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="Product_name">Product Name</label>
                            <input type="text" class="form-control" id="product_name" placeholder="Enter Product Name" value="{{$product[0]->product_name}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">Brand</label>
                            <select class="form-control" id="bland">
                                @foreach($brand as $temp)
                                    @if($temp->brand_name == $product[0]->brand_name)
                                        <option value="{{$temp->brand_name}}" selected>{{$temp->brand_name}}</option>
                                    @else
                                        <option value="{{$temp->brand_name}}">{{$temp->brand_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-control-label" for="Material">Material</label>
                        <select class="form-control" id="material">
                            @foreach($material as $temp)
                                @if($temp->name == $product[0]->manufacturar)
                                    <option value="{{$temp->name}}" selected>{{$temp->name}}</option>
                                @else
                                    <option value="{{$temp->name}}">{{$temp->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">Product Discount</label>
                            <select class="form-control" id="discount">
                                @foreach($discard as $temp)
                                    @if($temp->name == $product[0]->discount)
                                        <option value="{{$temp->name}}" selected>{{$temp->name}}</option>
                                    @else
                                        <option value="{{$temp->name}}">{{$temp->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-control-label">Featured</label>
                        <select class="form-control" id="featured">
                            @if($product[0]->featured)
                                <option value=1 selected>Yes</option>
                                <option value=0>No</option>
                            @else
                                <option value=1>Yes</option>
                                <option value=0 selected>No</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-control-label">On Sale</label>
                        <select class="form-control" id="on_sale">
                            @if($product[0]->onsale)
                                <option value=1 selected>Yes</option>
                                <option value=0>No</option>
                            @else
                                <option value=1>Yes</option>
                                <option value=0 selected>No</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-control-label">Status</label>
                        <select class="form-control" id="status">
                            @if($product[0]->status)
                                <option value=1 selected>Active</option>
                                <option value=0>Inactive</option>
                            @else
                                <option value=1>Active</option>
                                <option value=0 selected>Inactive</option>
                            @endif
                        </select>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-control-label" for="Main_category">Category</label>
                            <select multiple class="form-control" id="main_category" style="height:150px" onclick="set_sub_category($(this))">
                                <option value='0'>All</option>
                                <?php $str = $product[0]->category_id; $str_arry = explode(',',$str);?>
                                @foreach($category as $temp)
                                    @if(in_array($temp->id,$str_arry))
                                        <option value="{{$temp->id}}" selected>{{$temp->category_name}}</option>
                                    @else
                                        <option value="{{$temp->id}}">{{$temp->category_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-control-label" for="Sub_category">Sub Category</label>
                            <select multiple class="form-control" id="sub_category" style="height:150px">
                                <?php $str = $product[0]->subcategory_id; $str_arry = explode(',',$str);?>
                                @foreach($sub_category as $temp)
                                    @if (!$temp)
                                        
                                    @elseif (in_array($temp->id,$str_arry))
                                        <option value="{{$temp->id}}" selected>{{$temp->subcategory_name}}</option>
                                    @else
                                        <option value="{{$temp->id}}">{{$temp->subcategory_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-control-label" for="Sub_category">Decoration Methods</label>
                            <select multiple class="form-control" id="decoration_method" style="height:150px">
                                <?php $str = $product[0]->decoration_method; $str_arry = explode(',',$str);?>
                                @foreach($decoration_method as $temp)
                                    @if (in_array($temp->id,$str_arry))
                                        <option value="{{$temp->id}}" selected>{{$temp->name}}</option>
                                    @else
                                        <option value="{{$temp->id}}">{{$temp->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <label class="form-control-label">Qty&Price</label>
                </div>
                @foreach($price_list as $temp)
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
                @endforeach
                <div class="row">
                    <button type="button" class="btn btn-twitter" onclick="add_price($(this))">
                        <span class="btn-inner--icon"><i class="fa fa-plus"></i>Add new Price</span>
                    </button>
                </div><br>
                <div class="row" id="onsale_div" style="display:<?php echo $product[0]->onsale?'flex':'none'?>">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="onsale">On sale</label>
                            <select class="form-control" id="onsale">
                                @for($i=0; $i<=20; $i++)
                                    @if($product[0]->percents == $i*5)
                                    <option value={{$i*5}} selected>{{$i*5}}%</option>
                                    @else
                                    <option value={{$i*5}}>{{$i*5}}%</option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">Retail Price</label>
                            <input id="retail_price" class="form-control price_input" type="number" min=0 value="{{$product[0]->price}}">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <label class="form-control-label" for="">Color</label>
                </div>
                <div class="row">
                    <?php $str = $product[0]->colors; $str_arry = (explode(',',$str))?>
                    @foreach($str_arry as $temp)
                        <div class="custom-control custom-checkbox mb-3 color_check" style="margin:10px;">
                            <input class="custom-control-input" id="{{$temp}}" type="checkbox" checked onclick="change_state($(this))">
                            <label class="custom-control-label" for="{{$temp}}">{{$temp}}</label>
                        </div>
                    @endforeach
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
                            <input class="form-control" type="number" min=0  value="{{$product[0]->weight}}" id="weight">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">per box lbs</label>
                            <input class="form-control" type="number" min=0  value="{{$product[0]->box_weight}}" id="box_weight">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">No of items(per box pcs)</label>
                            <input class="form-control" type="number" min=0  value="{{$product[0]->item_no}}" id="item_no">
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
                            <input class="form-control" type="number" min=0  value="{{$product[0]->dim_width}}" id="dim_width">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">height</label>
                            <input class="form-control" type="number" min=0  value="{{$product[0]->dim_height}}" id="dim_height">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">depth</label>
                            <input class="form-control" type="number" min=0 value="{{$product[0]->dim_depth}}" id="dim_depth">
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
                            <input class="form-control" type="text" id="master_dimention" value="{{$product[0]->master_dimention}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="master_qty">qty</label>
                            <input class="form-control" type="number" min=0 id="master_qty" value="{{$product[0]->master_qty}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="master_weight">weight</label>
                            <input class="form-control" type="number" min=0 id="master_weight" value="{{$product[0]->master_weight}}">
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
                            <input class="form-control" type="number" min=0  value="{{$product[0]->imprint_width}}" id="imprint_width">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">height</label>
                            <input class="form-control" type="number" min=0  value="{{$product[0]->imprint_height}}" id="imprint_height">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-control-label" for="">Description</label>
                        <form>
                            <div data-toggle="quill" data-quill-placeholder="" id="description_note"><?php echo $product[0]->description ?></div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label" for="">Specifications</label>
                        <form>
                            <div data-toggle="quill" data-quill-placeholder="" id="specifications"><?php echo $product[0]->specification ?></div>
                        </form>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-control-label" for="">Product Info</label>
                        <form>
                            <div data-toggle="quill" data-quill-placeholder="" id="production_note"><?php echo $product[0]->production_note ?></div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label" for="">Case Studies</label>
                        <form>
                            <div data-toggle="quill" data-quill-placeholder="" id="imprint_note"><?php echo $product[0]->imprint_note ?></div>
                        </form>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-control-label" for="">Office Notes Only</label>
                        <form>
                            <div data-toggle="quill" data-quill-placeholder="" id="note"><?php echo $product[0]->note ?></div>
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
                            <input type="url" class="form-control" id="video_link" placeholder="Enter Product video_link" value="{{$product[0]->youtube}}">
                        </div>
                    </div>
                </div>
                <div class="row" style="justify-content: center;">
                    <div class="container" id="preview_images">
                    @foreach($image as $temp)
                        <div draggable="true" class="box" style="position:relative">
                            <img style="width:300px;" src="{{asset('public/upload/product-images/'.  $temp->product_image)}}" alt="Image placeholder">
                            <span class="img_id" style="display:none;">{{$temp->id}}</span>
                            <button style="position: absolute;top:0px;right:0px;" type="button" class="btn btn-twitter btn-icon-only rounded-circle" onclick="del_image($(this))">
                            <span class="btn-inner--icon"><i class="fa fa-close"></i></span>
                            </button>
                        </div>
                    @endforeach
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
                    <button type="button" class="btn btn-default" style="float:right;" onclick="update_product()">Update Product</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="success_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-primary fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Success!</strong> You updated a product!</span>
  <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="fail_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-danger alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Fail!</strong> You failed to update a product!</span>
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
        set_img_order();
        return false;
    }
    document.addEventListener('DOMContentLoaded', (event) => {
        let items = document.querySelectorAll('.container .box');

        items.forEach(function(item) {
            item.addEventListener('dragstart', handleDragStart, false);
            item.addEventListener('dragover', handleDragOver, false);
            item.addEventListener('dragenter', handleDragEnter, false);
            item.addEventListener('dragleave', handleDragLeave, false);
            item.addEventListener('dragend', handleDragEnd, false);
            item.addEventListener('drop', handleDrop, false);
        });
    });
    

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
            obj.parent().prev().after(text);
        }
    }

    function add_color(obj){
        text = "<div class='custom-control custom-checkbox mb-3 color_check' style='margin:10px;'><input  id='"+obj.val()+"' class='custom-control-input' type='checkbox' checked onclick='change_state($(this))'><label class='custom-control-label' for='"+obj.val()+"'>"+obj.val()+"</label></div>";
        obj.parent().before(text);
    }

    function del_image(obj){
        $.ajax({
            method:'POST',
            url:'/products/remove_image',
            data:{
                id:obj.parent().find(".img_id").html(),
                "_token":"{{csrf_token()}}"
            },
            success: function(result) {
                obj.parent().remove();
                set_img_order();
            },
            error:function(error){
                console.log(error)
            }
        });
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
            success: function(result) {console.log(result);  
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
    }

    // function toggle_sale(obj){
    //     if(obj.val()==1){
    //         $("#onsale_div").show();
    //     }else{
    //         $("#onsale_div").hide();
    //     }
    // }

    function preview(e){
        var formData = new FormData();
        formData.append('upload_files', e.target.files[0]);
        formData.append('id',$("#product_id").val());
        $.ajax({
            method:'POST',
            url:'/products/edit_product_image',
            data: formData,
            processData: false,
            contentType: false,
            success: function(result) {
                console.log(result);
                $("#preview_images").append("<div draggable='true' class='box' style='position:relative'><img style='width:300px;' src='"+URL.createObjectURL(e.target.files[0])+"' alt='Image placeholder'><span class='img_id' style='display:none;'>"+result.message+"</span><button style='position: absolute;top:0px;right:0px;' type='button' class='btn btn-twitter btn-icon-only rounded-circle' onclick='del_image($(this))'><span class='btn-inner--icon'><i class='fa fa-close'></i></span></button></div>");
                set_img_order();

                let items = document.querySelectorAll('.container .box');

                items.forEach(function(item) {
                    item.addEventListener('dragstart', handleDragStart, false);
                    item.addEventListener('dragover', handleDragOver, false);
                    item.addEventListener('dragenter', handleDragEnter, false);
                    item.addEventListener('dragleave', handleDragLeave, false);
                    item.addEventListener('dragend', handleDragEnd, false);
                    item.addEventListener('drop', handleDrop, false);
                });
            },
            error:function(error){
                console.log(error)
            }
        });
        
    }

    function set_img_order(){
        img_order = [];
        i = 0;
        $(".img_id").each(function(){
            i++;
            img_order_val = {
                id:'',
                order:''
            }
            img_order_val.id = $(this).html();
            img_order_val.order = i;
            img_order.push(img_order_val);
        });
        $.ajax({
            method:'POST',
            url:'/products/set_img_order',
            data: {
                img_order:img_order
            },
            success: function(result) {
                console.log(result);
            },
            error:function(error){
                console.log(error)
            }
        });
    }
    var upload_files = [];
    function update_product(){
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
        // console.log(price_qty);
        color_check = [];
        $(".color_check").each(function(){
            if($(this).find("input").val()=='on'){
                color_check.push($(this).find("label").html());
            }
        });
        // if(upload_files.length){
        //     can_upload = 1;
        // }else{
        //     can_upload =0;
        // }
        if($("#product_name").val()){
            $.ajax({
                method:'POST',
                url:'/products/edit_product',
                data:{
                    product_id:$("#product_id").val(),
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
                    // can_upload:can_upload,
                    "_token":"{{csrf_token()}}",
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
            });
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