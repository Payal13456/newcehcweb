@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Hospital</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('hospital.create') }}" class="btn btn-info">Add New Hospital</a></li>
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
                  <th>User</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Primary Phone</th>
                  <th>Secondary Phone</th>
                  <th>Address</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php 
                  if(!empty($hospitals)){
                    foreach ($hospitals as $key => $hospital) { ?>
                        <tr>
                          <td>{{$i++}}</td>
                          <td><?php print_r($hospital->user->first_name); ?> </td>
                          <td>{{$hospital->name}}</td>
                          <td>{{$hospital->email}}</td>
                          <td>{{$hospital->primary_number}}</td>
                          <td>{{$hospital->secondary_number}}</td>
                          <td>{{$hospital->address}}</td>
                          <td>
                          <?php $statusColor = ($hospital->status == 1) ? 'text-danger' : 'text-success';
                          $blockColor = ($hospital->is_block == 1) ? 'text-danger' : 'text-success' 
                           ?>
                           <span><a href="javascript:void(0)" class="change_hospitalStatus cursor fa fa-toggle-on fa-2x delete_random {{ $statusColor }}" data-type="status" data-toggle="tooltip" data-status="{{(($hospital->status == 1) ? '0' : '1')}}" data_hospitalId='{{ $hospital->id }}' data-placement="top" title="Active/Inactive"></a>&nbsp;</span>
                          <!-- <span><a href='javascript:void(0)'  data-type="block" class="cursor fa fas fa-ban fa-2x delete_random change_hospitalStatus {{ $blockColor }}" data-toggle="tooltip" data-placement="top" title="Block/Unblock" data-status="{{(($hospital->is_block == 1) ? '2' : '1')}}" data_hospitalId='{{ $hospital->id }}'></a>&nbsp;</span> -->
                          </td>
                          <td>
                          <a  href="{{ route('hospital.edit',$hospital->id) }}" data_id='' class="cursor fa fa-edit fa-2x delete_random" data-toggle="tooltip" data-placement="top" title="Edit hospital details">&nbsp;</a>
                          <a href="javascript:void(0)" data-parent="hospitalListTable" class="tdDeleteColumnData cursor fa fa-trash fa-2x text-danger delete_random"  data-toggle="tooltip" data-placement="top" title="Delete Employee" data-type="hospitalListDataType" data_id="{{ $hospital->id }}" data-id="{{ $hospital->id }}" data-row-remove-message="Do you really want to Delete ?" onclick="deleteRowDatatable($(this))"></a>
                        </td>
                      </tr>

                    <?php }
                  }
                 ?>
              </tbody>
            </table>
          </div>
          <!-- </div> -->
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" role="dialog" style="" id="modal_remove_element_hospital_status">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="title">Confirm Message</h5>
          <button type="button" class="close" data-dismiss="modal" onclick="$('#modal_remove_element_hospital_status').modal('hide');">&times;</button>
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
          <button class="btn btn-primary btn-fw" data-dismiss="modal" onclick="$('#modal_remove_element_hospital_status').modal('hide');"><?php echo('NO'); ?></button>
        </div>
      </div>
    </div>
  </div>
  
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).on('click', '.change_hospitalStatus', function (e) {
         hospitalId= $(this).attr("data_hospitalId");
         status =$(this).attr("data-status");
           type = $(this).attr("data-type");
            $("#remove_element_status").attr("data-type",type);
         $("#remove_element_status").attr("data_hospitalId",hospitalId);
         $("#remove_element_status").attr("data-status",status);
         $("#modal_remove_element_hospital_status").modal("show");

     });
    $(document).on('click', '#remove_element_status', function (e) {
         hospitalId= $(this).attr("data_hospitalId");
         status =$(this).attr("data-status");
           type  = $(this).attr('data-type');
        param = {};
        param.hospitalId = hospitalId;
        param.status = status;
        param.type = type;
        $("#modal_remove_element_hospital_status").modal("hide");
        sendRequest($(this), base_url+"/changeHospStatus" ,'post', param);
     });
</script>
@endsection