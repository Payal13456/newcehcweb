@extends('admin.layouts.admin_layouts')


@section('content')
	<div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Roles</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('roles.create') }}" class="btn btn-info">Add New Role</a></li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>

     <div class="container-fluid">
          <!-- ============================================================== -->
          <!-- Start Page Content -->
          <!-- ============================================================== -->
           <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <!-- <h5 class="card-title"></h5> -->
            <div class="table-responsive">
              <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Sr.no.</th>
                    <th>Name</th>
                    <th>Guard</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php  $i=1 ?>
                  @if(!empty($roles))
                  @foreach($roles as $key => $faq)
                  <tr>
                      <td>{{$i++}}</td>
                      <td>{{$faq->name}}</td>
                      <td>{{$faq->guard_name}}</td>
                      <td>
                        <a  href="{{ route('roles.edit',$faq->id) }}" data_id='' class="cursor fa fa-edit fa-2x delete_random" data-toggle="tooltip" data-placement="top" title="Edit Role">&nbsp;</a>
                        <a href="javascript:void(0)" data-parent="roleListTable" class="tdDeleteColumnData cursor fa fa-trash fa-2x text-danger delete_random"   data-placement="top" title="Delete Role" data-type="roleListDataType" data_id="{{ $faq->id }}" data-id="{{ $faq->id }}" data-row-remove-message="Do you really want to Delete ?" onclick="deleteRowDatatable($(this))"></a>
                    </td>
                    </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  <div class="modal fade" role="dialog" style="" id="modal_remove_element_promocode_status">
         <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="title">Confirm Message</h5>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
               <div class="modal-body" id="detail" style="">
                  <div class="row">
                      <div class="col s12 m12">
                          <div class="form-group col s12">
                               <div id="remove_element_message_status" style="">Do you really want to Change Status</div>
                         </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                   <button class="btn btn-primary btn-fw" style="" id="remove_element_status" ><?php echo('Yes'); ?></button>
                   <button class="btn btn-primary btn-fw" data-dismiss="modal"><?php echo('NO'); ?></button>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).on('click', '.change_promocodeStatus', function (e) {
         promocodeId= $(this).attr("data_promocodeId");
         status =$(this).attr("data-status");
         $("#remove_element_status").attr("data_promocodeId",promocodeId);
         $("#remove_element_status").attr("data-status",status);
         $("#modal_remove_element_promocode_status").modal("show");
     });
    
    $(document).on('click', '#remove_element_status', function (e) {
        promocodeId= $(this).attr("data_promocodeId");
        status =$(this).attr("data-status");
        param = {};
        param.promocodeId = promocodeId;
        param.status = status;
        $("#modal_remove_element_promocode_status").modal("hide");
        sendRequest($(this), base_url+"/changepromocodeStatus" ,'post', param);
     });
</script>
@endsection