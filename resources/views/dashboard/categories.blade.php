@extends('layout.dash')

@section('style')
    <!-- Page plugins -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-treeview.css') }}">
<style>
/* .fc-scrollgrid {
    display: none;
} */
.margin-row {
  margin-left: 30px;
  margin-right: 30px;
  display: flex;
}
.dropform {
    width: 250px;
}
ul, #myUL {
  list-style-type: none;
}

#myUL {
  margin: 0;
  padding: 0;
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
  
}
.sub-caret {
  cursor: pointer;
}

.caret::before {
  content: "\25B6";
  color: #2869a6;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);  
}

.nested {
  display: none;
}

.active {
  display: block;
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
              <h6 class="h2 d-inline-block mb-0">Categories List</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links">
                  <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="/categories/categories">Categories</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Manage Categories</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Table part -->
    <div class="margin-row">
        <div class="card col-4" style="margin-right: 20px;">
            <!-- Card header -->
            <div class="card-header flex">
                <h3>Categories</h3>
            </div>
            <div class="card-body">
              <ul id="myUL">
                @foreach($result as $item)
                <li onclick="click_category({{$item['id']}},'{{$item['category_name']}}')"><span class="caret">{{$item['category_name']}}</span>
                  <ul class="nested">
                    @foreach($item['subcategory'] as $subitem)
                    <li class="sub-caret" onclick="click_subcategory({{$item['id']}},{{$subitem['id']}},'{{$item['category_name']}}','{{$subitem['subcategory_name']}}',event)">{{$subitem['subcategory_name']}}</li>
                    @endforeach
                  </ul>
                </li>
                @endforeach
              </ul>
            </div>
        </div>
        <div class="card col-8">
            <!-- Card header -->
            <div class="card-header flex">
                <h3>Manage Categories</h3>
                <div style="position: absolute;right: 10px;">
                  <button class="btn btn-sm btn-default" onclick="add_category()">Add Category</button>
                  <button class="btn btn-sm btn-default" onclick="add_subcategory()">Add Subcategory</button>
                  <a class="btn btn-sm btn-default" href="/categories/categories">Reload</a>
                </div>
                
            </div>
            <div class="card-body">
              <div class="row" id="category_title"></div>
              <br>
              <div class="row" id="category_content"></div>
              <div class="row" id="btn_div"></div>
            </div>
        </div>
    </div>
  </div>

<div id="success_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-primary fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Success!</strong> You updated a category!</span>
  <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="fail_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-danger alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Fail!</strong> You failed to update a category!</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="warn_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-warning alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Warning!</strong> You have to enter category name!</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="str" style="display:none;"><?php echo $str?></div>
@endsection

@section('script')
<script>
  var toggler = document.getElementsByClassName("caret");
  var i;

  for (i = 0; i < toggler.length; i++) {
    toggler[i].addEventListener("click", function() {
      this.parentElement.querySelector(".nested").classList.toggle("active");
      this.classList.toggle("caret-down");
    });
  }

  function click_category(id,title){
    $("#category_title").html("");
    $("#category_title").append("<nav aria-label='breadcrumb' class='d-none d-md-inline-block ml-md-4'><ol class='breadcrumb breadcrumb-links'><li class='breadcrumb-item'><i class='fas fa-home'></i></li><li class='breadcrumb-item'>"+title+"</li></ol></nav><button style='position:absolute;right:10px;' class='btn btn-sm btn-danger' onclick='del_category("+id+")'>Delete "+title+"</button>");
    $("#category_content").html("");
    $("#category_content").append("<div class='form-group col-6'><label class='form-control-label'>Category Name</label><input type='text' class='form-control' id='category_name_edit' placeholder='Enter Category Name' value='"+title+"'></div>");
    $("#btn_div").html("");
    $("#btn_div").append("<button style='margin-left:20px;' class='btn btn-sm btn-default' onclick='edit_category("+id+")'>Edit</button>");
  }

  function click_subcategory(id,sid,title,stitle,event){
    $("#category_title").html("");
    $("#category_title").append("<nav aria-label='breadcrumb' class='d-none d-md-inline-block ml-md-4'><ol class='breadcrumb breadcrumb-links'><li class='breadcrumb-item'><i class='fas fa-home'></i></li><li class='breadcrumb-item'>"+title+"</li><li class='breadcrumb-item active' aria-current='page'>"+stitle+"</li></ol></nav><button style='position:absolute;right:10px;' class='btn btn-sm btn-danger' onclick='del_subcategory("+sid+")'>Delete "+stitle+"</button>");
    $("#category_content").html("");
    $("#category_content").append("<div class='form-group col-6'><label class='form-control-label'>Category Name</label><input type='text' class='form-control' id='category_name_edit' placeholder='Enter Category Name' value='"+title+"' readonly></div><div class='form-group col-6'><label class='form-control-label'>Subcategory Name</label><input type='text' class='form-control' id='subcategory_name_edit' placeholder='Enter Subcategory Name' value='"+stitle+"'></div>");
    $("#btn_div").html("");
    $("#btn_div").append("<button style='margin-left:20px;' class='btn btn-sm btn-default' onclick='edit_subcategory("+sid+")'>Edit</button>");
    event.cancelBubble = true;
  }

  function add_category(){
    $("#category_title").html("");
    $("#category_title").append("<nav aria-label='breadcrumb' class='d-none d-md-inline-block ml-md-4'><ol class='breadcrumb breadcrumb-links'><li class='breadcrumb-item'><i class='fas fa-home'></i></li><li class='breadcrumb-item'>Add New Category</li></ol></nav>");
    $("#category_content").html("");
    $("#category_content").append("<div class='form-group col-6'><label class='form-control-label'>Category Name</label><input type='text' class='form-control' id='category_name_add' placeholder='Enter Category Name' value=''></div>");
    $("#btn_div").html("");
    $("#btn_div").append("<button style='margin-left:20px;' class='btn btn-sm btn-default' onclick='save_category()'>Add</button>");
  }

  function add_subcategory(){
    $("#category_title").html("");
    $("#category_title").append("<nav aria-label='breadcrumb' class='d-none d-md-inline-block ml-md-4'><ol class='breadcrumb breadcrumb-links'><li class='breadcrumb-item'><i class='fas fa-home'></i></li><li class='breadcrumb-item'>Add New Subcategory</li></ol></nav>");
    $("#category_content").html("");
    $("#category_content").append("<div class='form-group col-6'><label class='form-control-label'>Category Name</label><select class='form-control' id='category_name_select'>"+$("#str").html()+"</select></div><div class='form-group col-6'><label class='form-control-label'>Subcategory Name</label><input type='text' class='form-control' id='subcategory_name_add' placeholder='Enter Subcategory Name' value=''></div>");
    $("#btn_div").html("");
    $("#btn_div").append("<button style='margin-left:20px;' class='btn btn-sm btn-default' onclick='save_subcategory()'>Add</button>");
  }

  function save_category(){
      $.ajax({
        url:"/categories/add_category",
        method:"POST",
        data:{
          name:$("#category_name_add").val()
        },
        success:function(data){
            if(data){
                $("#success_notify").show();
                setTimeout(() => {
                $("#success_notify").fadeOut(3000)
                }, 3000);
                $('#uploaded_image').html(data.uploaded_image);
            }else{
                console.log(data.message);
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
  }

  function save_subcategory(){
    $.ajax({
      url:"/categories/add_subcategory",
      method:"POST",
      data:{
        category:$("#category_name_select").val(),
        subcategory:$("#subcategory_name_add").val()
      },
      success:function(data){
          if(data){
              $("#success_notify").show();
              setTimeout(() => {
              $("#success_notify").fadeOut(3000)
              }, 3000);
              $('#uploaded_image').html(data.uploaded_image);
          }else{
              console.log(data.message);
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
  }

  function edit_category(id){
    $.ajax({ 
      method:'POST',
      url:'/categories/edit_category',
      data:{
        id:id,
        name:$("#category_name_edit").val(),
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
          console.log('error')
      }
    })
  }

  function edit_subcategory(id){
    $.ajax({ 
      method:'POST',
      url:'/categories/edit_subcategory',
      data:{
        id:id,
        name:$("#subcategory_name_edit").val(),
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
          console.log('error')
      }
    })
  }

  function del_category(id){
    if(confirm("Are you really delete this category?")){
      $.ajax({
        method:'POST',
        url:'/categories/del_category',
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
  }

  function del_subcategory(id){
    if(confirm("Are you really delete this category?")){
      $.ajax({
        method:'POST',
        url:'/categories/del_subcategory',
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
  }
</script>
@endsection