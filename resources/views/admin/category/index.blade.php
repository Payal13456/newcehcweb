@extends('admin.layouts.admin_layouts')
@section('content')
 <div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Category</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('category.create') }}" class="btn btn-info">Add New Category</a></li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
 <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
           <!-- <div class="todo-widget scrollable" style="height: 450px"> -->
            <div class="table-responsive">
              <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Category Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                   <?php $i = 1; ?>
                <?php 
                  if(!empty($categorys)){
                    foreach ($categorys as $key => $category) { ?>
                      <tr>
                        <td>{{$i++}}</td>
                        <td><?php print_r($category->category_name); ?> </td>
                        <td>
                          <a  href="{{ route('category.edit',$category->id) }}" data_id='' class="cursor fa fa-edit fa-2x delete_random" data-toggle="tooltip" data-placement="top" title="Edit category details">&nbsp;</a>
                          <a href="javascript:void(0)" data-parent="categoryListTable" class="tdDeleteColumnData cursor fa fa-trash fa-2x text-danger delete_random"  data-toggle="tooltip" data-placement="top" title="Delete Category" data-type="categoryListDataType" data_id="{{ $category->id }}" data-id="{{ $category->id }}" data-row-remove-message="Do you really want to Delete ?" onclick="deleteRowDatatable($(this))"></a>
                        </td>
                      </tr>
                <?php } } ?>   
                </tbody>
              </table>
            </div>
            <!-- </div> -->
          </div>
        </div>
      </div>
    </div>
</div>
<div class="modal fade" role="dialog" style="" id="modal_remove_element_patient_status">
       <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Confirm Message</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="$('#modal_remove_element_patient_status').modal('hide');">&times;</button>
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
                 <button class="btn btn-primary btn-fw" data-dismiss="modal" onclick="$('#modal_remove_element_patient_status').modal('hide');"><?php echo('NO'); ?></button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).on('click', '.change_userStatus', function (e) {
         userId= $(this).attr("data_userId");
         status =$(this).attr("data-status");
         $("#remove_element_status").attr("data_userId",userId);
         $("#remove_element_status").attr("data-status",status);
         $("#modal_remove_element_user_status").modal("show");

     });
    $(document).on('click', '#remove_element_status', function (e) {
         userId= $(this).attr("data_userId");
         status =$(this).attr("data-status");
        param = {};
        param.userId = userId;
        param.status = status;
        $("#modal_remove_element_user_status").modal("hide");
        sendRequest($(this), base_url+"/changeEmpStatus" ,'post', param);
     });
</script>
@endsection