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
              <h6 class="h2 d-inline-block mb-0">Category Setting</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links">
                  <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item">Website Setting</li>
                  <li class="breadcrumb-item active" aria-current="page">Category Setting</li>
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
                        <h3 class="mb-0">Homepage Category</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <div class="col-md-6"></div>
                <div class="row">
                  <div class="col-md-6">
                    <form class="dropform">
                        <label class="form-control-label">Category1</label>
                        <select class="form-control" data-toggle="select" id="category1" onchange="set_category($(this),1)">
                            @foreach($category as $item)
                              @if($item->id == $homepage_setting->category1)
                              <option value="{{$item->id}}" selected>{{$item->category_name}}</option>
                              @else
                              <option value="{{$item->id}}">{{$item->category_name}}</option>
                              @endif
                            @endforeach
                        </select>
                    </form><br>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="category_image_upload1" name="category_image_upload1" onchange="preview(event,$(this),1)">
                      <label class="custom-file-label" for="customFileLang">Select file</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class='box' style='position:relative'>
                      <img style='width:300px;' src="{{asset('public/upload/website-setting-images/'.$homepage_setting->category_image1)}}" alt='Image placeholder'>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <form class="dropform">
                            <label class="form-control-label">Category2</label>
                            <select class="form-control" data-toggle="select" id="category2" onchange="set_category($(this),2)">
                                @foreach($category as $item)
                                  @if($item->id == $homepage_setting->category2)
                                  <option value="{{$item->id}}" selected>{{$item->category_name}}</option>
                                  @else
                                  <option value="{{$item->id}}">{{$item->category_name}}</option>
                                  @endif
                                @endforeach
                            </select>
                        </form><br>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="category_image_upload2" name="category_image_upload2" onchange="preview(event,$(this),2)">
                            <label class="custom-file-label" for="customFileLang">Select file</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class='box' style='position:relative'>
                        <img style='width:300px;' src="{{asset('public/upload/website-setting-images/'.$homepage_setting->category_image2)}}" alt='Image placeholder'>
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <form class="dropform">
                            <label class="form-control-label">Category3</label>
                            <select class="form-control" data-toggle="select" id="category3" onchange="set_category($(this),3)">
                                @foreach($category as $item)
                                  @if($item->id == $homepage_setting->category3)
                                  <option value="{{$item->id}}" selected>{{$item->category_name}}</option>
                                  @else
                                  <option value="{{$item->id}}">{{$item->category_name}}</option>
                                  @endif
                                @endforeach
                            </select>
                        </form><br>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="category_image_upload3" name="category_image_upload3" onchange="preview(event,$(this),3)">
                            <label class="custom-file-label" for="customFileLang">Select file</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class='box' style='position:relative'>
                        <img style='width:300px;' src="{{asset('public/upload/website-setting-images/'.$homepage_setting->category_image3)}}" alt='Image placeholder'>
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <form class="dropform">
                            <label class="form-control-label">Category4</label>
                            <select class="form-control" data-toggle="select" id="category4" onchange="set_category($(this),4)">
                                @foreach($category as $item)
                                  @if($item->id == $homepage_setting->category4)
                                  <option value="{{$item->id}}" selected>{{$item->category_name}}</option>
                                  @else
                                  <option value="{{$item->id}}">{{$item->category_name}}</option>
                                  @endif
                                @endforeach
                            </select>
                        </form><br>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="category_image_upload4" name="category_image_upload4" onchange="preview(event,$(this),4)">
                            <label class="custom-file-label" for="customFileLang">Select file</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class='box' style='position:relative'>
                        <img style='width:300px;' src="{{asset('public/upload/website-setting-images/'.$homepage_setting->category_image4)}}" alt='Image placeholder'>
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <form class="dropform">
                            <label class="form-control-label">Category5</label>
                            <select class="form-control" data-toggle="select" id="category5" onchange="set_category($(this),5)">
                                @foreach($category as $item)
                                  @if($item->id == $homepage_setting->category5)
                                  <option value="{{$item->id}}" selected>{{$item->category_name}}</option>
                                  @else
                                  <option value="{{$item->id}}">{{$item->category_name}}</option>
                                  @endif
                                @endforeach
                            </select>
                        </form><br>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="category_image_upload5" name="category_image_upload5" onchange="preview(event,$(this),5)">
                            <label class="custom-file-label" for="customFileLang">Select file</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class='box' style='position:relative'>
                      <img style='width:300px;' src="{{asset('public/upload/website-setting-images/'.$homepage_setting->category_image5)}}" alt='Image placeholder'>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <form class="dropform">
                            <label class="form-control-label">Category6</label>
                            <select class="form-control" data-toggle="select" id="category6" onchange="set_category($(this),6)">
                                @foreach($category as $item)
                                  @if($item->id == $homepage_setting->category6)
                                  <option value="{{$item->id}}" selected>{{$item->category_name}}</option>
                                  @else
                                  <option value="{{$item->id}}">{{$item->category_name}}</option>
                                  @endif
                                @endforeach
                            </select>
                        </form><br>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="category_image_upload6" name="category_image_upload6" onchange="preview(event,$(this),6)">
                            <label class="custom-file-label" for="customFileLang">Select file</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class='box' style='position:relative'>
                        <img style='width:300px;' src="{{asset('public/upload/website-setting-images/'.$homepage_setting->category_image6)}}" alt='Image placeholder'>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="success_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-primary fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Success!</strong> You updated setting!</span>
  <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="fail_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-danger alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Fail!</strong> You failed to update setting!</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="warn_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-warning alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Warning!</strong> You have to select category!</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endsection

@section('script')
  <script type="text/javascript">

    function preview(e,obj,id){
      var formData = new FormData();
        formData.append('upload_files', e.target.files[0]);
        formData.append('id','category_image'+id);
        $.ajax({
          method:'POST',
          url:'/websetting/save_category_image',
          data: formData,
          processData: false,
          contentType: false,
          success: function(result) {console.log(result);
            if(result){
              obj.parent().parent().next().html("");
              obj.parent().parent().next().append("<div class='box' style='position:relative'><img style='width:300px;' src='"+URL.createObjectURL(e.target.files[0])+"' alt='Image placeholder'></div>");
            }
          },
          error:function(error){
              console.log(error)
          }
      });
    }

    function set_category(obj, id){
      $.ajax({ 
        method:'POST',
        url:'/websetting/save_category_setting',
        data:{
          category:"category"+id,
          category_val:obj.val(),
          "_token":"{{csrf_token()}}"
        },
        success: function(result) {
            // alert(result);
        },
        error:function(){
            console.log('error')
        }
      })
    }

  </script>
@endsection