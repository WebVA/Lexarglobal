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
              <h6 class="h2 d-inline-block mb-0">Recent POs</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links">
                  <li class="breadcrumb-item"><a href="/dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item">company PO Update</li>
                  <li class="breadcrumb-item active" aria-current="page">Recent POs</li>
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
                    <a href="/po/create_po" class="btn btn-sm btn-default">Create New PO</a>
                    <a href="/po/search_po" class="btn btn-sm btn-default">Search a PO</a>
                    <a href="/po/report_po" class="btn btn-sm btn-default">Reports</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive py-4">
                <table class="table align-items-center table-flush" id="datatable-buttons">
                    <thead class="thead-light">
                        <tr>
                          <th>PO Number</th>
                          <th>Company Name</th>
                          <th>Original PO Date</th>
                          <th>Last Action Taken</th>
                          <th>Last Action Date</th>
                          <th>Edit/Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>PO Number</th>
                            <th>Company Name</th>
                            <th>Original PO Date</th>
                            <th>Last Action Taken</th>
                            <th>Last Action Date</th>
                            <th>Edit/Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($result as $temp)
                        <tr>
                          <td>{{$temp->po_number}}</td>
                          <td>{{$temp->company_name}}</td>
                          <td>{{$temp->origin_date}}</td>
                          <td>{{$temp->action_name}}</td>
                          <td>{{$temp->po_date}}</td>
                          <td class="text-right" style="display:flex;align-items: center;height: 80px;">
                            <a href="{{ url('po/edit_po/' . $temp->po_number . '/' . $temp->company_name) }}" class="table-action" data-toggle="tooltip" data-original-title="Edit po">
                                <i class="fas fa-user-edit"></i>
                            </a>
                            <a href="javascript:void(0)" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="Delete po" onclick="del_po('{{$temp->company_name}}')">
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
</div>

<div id="success_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-primary fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Success!</strong> You deleted a po!</span>
  <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="fail_notify" style="display:none;position:absolute;right:30px;top:70px;" class="alert alert-danger alert-dismissible fade show" role="alert">
  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-text"><strong>Fail!</strong> You failed to delete a po!</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function del_po(id){
            $.ajax({ 
                method:'POST',
                url:'/po/del_po',
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
                    topFunction();
                },
                error:function(){
                    $("#fail_notify").show();
                    setTimeout(() => {
                    $("#fail_notify").fadeOut(3000)
                    }, 3000);
                    topFunction();
                }
            })
        }

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
@endsection