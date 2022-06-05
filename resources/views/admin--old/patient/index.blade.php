@extends('admin.layouts.admin_layouts')
@section('content')
 <div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Patient</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('patient.create') }}">Add New Patient</a></li>
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
            <!-- <h5 class="card-title"></h5> -->
            <div class="table-responsive">
              <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Primary Number</th>
                    <th>Gender</th>
                    <th>Aadhar Number</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>                  
                    <td>Pankaj</td>
                    <td>Yadav</td>
                    <td>py@gmail.com</td>
                    <td>9999999999</td>
                    <td>Male</td>
                    <td>4444 4444 44444</td>
                    <td>Paid</td>
                    <td>
                      <span><a href="javascript:void(0)" class="change_patientStatus cursor fa fa-toggle-on fa-2x delete_random" data-toggle="tooltip" data_patientId="1" data-status"1" data-placement="top" title="Active/Inactive"></a>&nbsp;</span>
                      <span><a href='' class="cursor fa fas fa-ban fa-2x delete_random" data-toggle="tooltip" data-placement="top" title="Block/Unblock"></a>&nbsp;</span>
                      </td>
                    <td>
                      <a  href="{{ route('patient.edit','1')}}" data_id='' class="cursor fa fa-edit fa-2x delete_random" data-toggle="tooltip" data-placement="top" title="Edit doctor details">&nbsp;</a>
                      <a data-parent="ReportListData" class="tdDeleteColumnData cursor fa fa-trash fa-2x delete_random"  data-toggle="tooltip" data-placement="top" title="Delete Doctor" data-type="ReportListDataType"  data-row-remove-message="Do you really want to Delete ?" onclick="deleteRowDatatable($(this))"></a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
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
@endsection
@section('script')
<script type="text/javascript">
    $(document).on('click', '.change_patientStatus', function (e) {
         paitentId= $(this).attr("data_patientId");
         status =$(this).attr("data-status");
         $("#remove_element_status").attr("data_patientId",paitentId);
         $("#remove_element_status").attr("data-status",status);
         $("#modal_remove_element_patient_status").modal("show");

     });
    $(document).on('click', '#remove_element_status', function (e) {
         paitentId= $(this).attr("data_patientId");
         status =$(this).attr("data-status");
         $("#modal_remove_element_patient_status").modal("hide");
        sendRequest($(this), base_url+"/changeEmpStatus?paitentId="+paitentId +"&status="+status +"&reload=userList" ,'GET', null);
     });
</script>
@endsection