@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Specialization</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('specialization.create') }}" class="btn btn-info">Add New Specialization</a></li>
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
                  <th>Specialization</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
               <?php  $i = 1; ?>
                @if (!empty($specializations))
                  @foreach($specializations as $key =>  $specialization)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$specialization->specialization}}</td>
                      <td>
                        <a  href="{{ route('specialization.edit',$specialization->id) }}" data_id='' class="cursor fa fa-edit fa-2x delete_random" data-toggle="tooltip" data-placement="top" title="Edit specialization details">&nbsp;</a>
                        @if(count($specialization->user) > 0)
                        	<a href="javascript:void(0)" class=" fa fa-trash fa-2x text-danger"  data-toggle="tooltip" data-placement="top" title="Delete specialization" onclick="checkCount({{$specialization->id}})"></a>
                        @else
                        	<a href="javascript:void(0)" data-parent="specializationListTable" class="tdDeleteColumnData cursor fa fa-trash fa-2x text-danger delete_random"  data-toggle="tooltip" data-placement="top" title="Delete specialization" data-type="specializationListDataType" data_id="{{ $specialization->id }}" data-id="{{ $specialization->id }}" data-row-remove-message="Do you really want to Delete ?" onclick="deleteRowDatatable(event);"></a>
                        @endif
                    </td>
                    </tr>

                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
          <!-- </div> -->
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" role="dialog" style="" id="modal_remove_element_specialization_status">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Confirm Message</h5>
        <button type="button" class="close" data-dismiss="modal" onclick="$('#modal_remove_element_specialization_status').modal('hide');">&times;</button>
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
        <button class="btn btn-primary btn-fw" data-dismiss="modal" onclick="$('#modal_remove_element_specialization_status').modal('hide');"><?php echo('NO'); ?></button>
      </div>
    </div>
  </div>
</div>

<div class="modal modal_warning_element_face fade" role="dialog" style="" id="modal_warning_element_face">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Warning</h5>
        <button type="button" class="close" data-dismiss="modal" onclick="close_popup('warning_element')">&times;</button>
      </div>
      <div class="modal-body" id="detail" style="">
        <div class="row">
          <div class="col s12 m12">
            <div class="form-group col s12">
              <div id="remove_element_message_status" style="">If you are deleting specialization, then doctor details will get error, so please change the selected specialization for all the doctor and then delete</div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary btn-fw"  onclick="close_popup('warning_element')"><?php echo('NO'); ?></button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')

<script type="text/javascript">
    
    function checkCount(id){
  	$("#modal_warning_element_face").modal('show');	
    }
    
    function close_popup_div(div_name){
	    var redirect = $(".modal_" + div_name + "_face").find("#btnErrorMessage").attr("data-redirect");
	    if ($(".modal_" + div_name + "_face").length) {
		visitDelete = false;
		$(".modal_" + div_name + "_face").modal("hide");
		if(typeof redirect !="undefined"){
		      window.location.href = redirect;
		      return false;
		}
	    }

	}
    
    $(document).on('click', '.change_specializationStatus', function (e) {
         specializationId= $(this).attr("data_specializationId");
         status =$(this).attr("data-status");
         $("#remove_element_status").attr("data_specializationId",specializationId);
         $("#remove_element_status").attr("data-status",status);
         $("#modal_remove_element_specialization_status").modal("show");

     });
    $(document).on('click', '#remove_element_status', function (e) {
         specializationId= $(this).attr("data_specializationId");
         status =$(this).attr("data-status");
        param = {};
        param.specializationId = specializationId;
        param.status = status;
        $("#modal_remove_element_specialization_status").modal("hide");
        sendRequest($(this), base_url+"/changespecializationStatus" ,'post', param);
     });
</script>
@endsection
