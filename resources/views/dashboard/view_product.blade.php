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
              <h6 class="h2 d-inline-block mb-0">Edit Product</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links">
                  <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="/products/products">Products</a></li>
                  <li class="breadcrumb-item"><a href="/products/products">Manage Products</a></li>
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
                    <a href="/products/products" class="btn btn-sm btn-default">Back to List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3" style="display:none;">
                        <div class="form-group">
                            <label class="form-control-label" for="Product_id">Product Id</label>
                            <input type="text" class="form-control" id="Product_id" readonly placeholder="Can't input id">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-control-label" for="Product_name">Product Name</label>
                            <input type="text" class="form-control" id="Product_name" placeholder="Enter Product Name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="Main_category">Category</label>
                            <select multiple class="form-control" id="Main_category" style="height:150px">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="Sub_category">Sub Category</label>
                            <select multiple class="form-control" id="Sub_category" style="height:150px">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">Bland</label>
                            <select class="form-control" id="Bland">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Product_id">SKU</label>
                            <input type="text" class="form-control" id="SKU" placeholder="SKU">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-control-label" for="Material">Material</label>
                            <select class="form-control" id="Material">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                    </div>
                </div>
                <div class="row">
                    <label class="form-control-label" for="">Qty&Price</label>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">Qty</label>
                            <input class="form-control" type="number" value="" id="Qty">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">Price</label>
                            <input class="form-control" type="number" value="" id="Price">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <br><br>
                        <button type="button" class="btn btn-twitter btn-icon-only rounded-circle">
                            <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
                        </button>
                        <button type="button" class="btn btn-twitter btn-icon-only rounded-circle">
                            <span class="btn-inner--icon"><i class="fa fa-close"></i></span>
                        </button>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="onsale">On sale</label>
                            <select class="form-control" id="onsale">
                                <option>0%</option>
                                <option>5%</option>
                                <option>10%</option>
                                <option>15%</option>
                                <option>20%</option>
                                <option>25%</option>
                                <option>30%</option>
                                <option>35%</option>
                                <option>40%</option>
                                <option>45%</option>
                                <option>50%</option>
                                <option>55%</option>
                                <option>60%</option>
                                <option>65%</option>
                                <option>70%</option>
                                <option>75%</option>
                                <option>80%</option>
                                <option>85%</option>
                                <option>90%</option>
                                <option>95%</option>
                                <option>100%</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">Product Discount</label>
                            <select class="form-control" id="discount">
                                <option>P</option>
                                <option>Q</option>
                                <option>R</option>
                                <option>S</option>
                                <option>T</option>
                                <option>U</option>
                                <option>V</option>
                                <option>W</option>
                                <option>X</option>
                                <option>Y</option>
                                <option>Z</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">Setup Charge Per Product</label>
                            <input class="form-control" type="number" value="" id="setup_charge">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">Run Charge Per Product</label>
                            <input class="form-control" type="number" value="" id="run_charge">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="form-control-label" for="">Weight(lbs)</label>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">per unit lbs</label>
                            <input class="form-control" type="number" value="" id="width">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">per box lbs</label>
                            <input class="form-control" type="number" value="" id="height">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">No of items(per box pcs)</label>
                            <input class="form-control" type="number" value="" id="height">
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
                            <input class="form-control" type="number" value="" id="width">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">height</label>
                            <input class="form-control" type="number" value="" id="height">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">depth</label>
                            <input class="form-control" type="number" value="" id="depth">
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
                            <input class="form-control" type="number" value="" id="width">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="Bland">height</label>
                            <input class="form-control" type="number" value="" id="height">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-control-label" for="">Description</label>
                        <form>
                            <div data-toggle="quill" data-quill-placeholder=""></div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label" for="">Specifications</label>
                        <form>
                            <div data-toggle="quill" data-quill-placeholder=""></div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-control-label" for="">Product Info</label>
                        <form>
                            <div data-toggle="quill" data-quill-placeholder=""></div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label" for="">Case Studies</label>
                        <form>
                            <div data-toggle="quill" data-quill-placeholder=""></div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-control-label" for="">Office Notes Only</label>
                        <form>
                            <div data-toggle="quill" data-quill-placeholder=""></div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <label class="form-control-label" for="">Product Image</label>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <!-- <div class="dropzone dropzone-single mb-3" data-toggle="dropzone" data-dropzone-url="http://">
                            <div class="fallback">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="projectCoverUploads">
                                    <label class="custom-file-label" for="projectCoverUploads">Choose file</label>
                                </div>
                            </div>
                            <div class="dz-preview dz-preview-single">
                                <div class="dz-preview-cover">
                                    <img class="dz-preview-img" src="..." alt="..." data-dz-thumbnail>
                                </div>
                            </div>
                        </div> -->
                        <div class="dropzone dropzone-multiple" data-toggle="dropzone" data-dropzone-multiple data-dropzone-url="http://">
                        <div class="fallback">
                            <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFileUploadMultiple" multiple>
                            <label class="custom-file-label" for="customFileUploadMultiple">Choose file</label>
                            </div>
                        </div>
                        <ul class="dz-preview dz-preview-multiple list-group list-group-lg list-group-flush">
                            <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                <div class="avatar">
                                    <img class="avatar-img rounded" src="..." alt="..." data-dz-thumbnail>
                                </div>
                                </div>
                                <div class="col ml--3">
                                <h4 class="mb-1" data-dz-name>...</h4>
                                <p class="small text-muted mb-0" data-dz-size>...</p>
                                </div>
                                <div class="col-auto">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fe fe-more-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#" class="dropdown-item" data-dz-remove>
                                        Remove
                                    </a>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </li>
                        </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                    <button type="button" class="btn btn-default" style="float:right;">Save Product</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection