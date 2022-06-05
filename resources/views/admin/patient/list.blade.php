@extends('admin.layouts.admin_layouts')
@section('content')
 <div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Family Members</h4>
    </div>
  </div>
</div>    
 <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <!-- <h5 class="card-title"></h5> -->
            <?php 
              $user = Session::get('user');
            ?>
            <!-- <div class="todo-widget scrollable" style="height: 450px"> -->
            <div class="table-responsive">
              <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Profile</th>
                    <th>UHID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Primary Number</th>
                    <th>Gender</th>
                    <th>Aadhar Number</th>
                    <th>Patient Type</th>
                    @if($user->role_id != 1)
                      <th>Status</th>
                    @endif
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                <?php  $i = 1; ?>
                @if (!empty($patients))
                  @foreach($patients as $key =>  $patient)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>
                      @if(!empty($patient->upload_of_picture))
                        <img src="{{ env('API_BASEURL') }}/{{$patient->upload_of_picture}}" alt="user" class="rounded-circle" width="30" />
                      @else
                        <img src="../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="30"/>
                      @endif</td>
                      <td>{{$patient->uhid}}</td>
                      <td>{{$patient->first_name}}</td>
                      <td>{{$patient->last_name}}</td>
                       <td>{{$patient->email_address}}</td>
                       <td>{{$patient->phone_number_primary}}</td>
                        <td>{{$patient->gender == 1 ? 'Male' : 'Female'}}</td>
                        <td>{{$patient->adhar_card}}</td>
                        <td><?php echo  ($patient->type_of_patient==1) ? "Free" : "Paid"; ?></td>
                      @if($user->role_id != 1)
                        <td>
                          <?php $statusColor = ($patient->status == 0) ? 'text-danger' : 'text-success';?>
                          <span><a href="javascript:void(0)" class="change_patientStatus cursor fa fa-toggle-on fa-2x delete_random {{ $statusColor }}" data-type="status" data-toggle="tooltip" data-status="{{(($patient->status == 1) ? '0' : '1')}}" data_patientId='{{ $patient->id }}' data-placement="top" title="Active/Inactive"></a></span>
                        </td>
                      @endif
                      <td>
                        <a  href="{{ route('patient.history',$patient->id) }}" data_id='' class=" fa fa-history fa-2x" data-toggle="tooltip" data-placement="top" title="Appointment History">&nbsp;</a>
                        
                        @if($user->role_id != 1)
                          <a  href="{{ route('patient.edit',$patient->id) }}" data_id='' class=" fa fa-edit fa-2x text-primary" data-toggle="tooltip" data-placement="top" title="Edit patient details">&nbsp;</a>
                          <a href="javascript:void(0)" data-parent="patientListTable" class="tdDeleteColumnData fa fa-trash fa-2x text-danger"  data-toggle="tooltip" data-placement="top" title="Delete Patient" 
                          data-type="patientListDataType" data_id="{{ $patient->id }}" data-id="{{ $patient->id }}" data-row-remove-message="Do you really want to Delete ?" onclick="deleteRowDatatable($(this))"></a>
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
          param = {};
        param.paitentId = paitentId;
        param.status = status;
         $("#modal_remove_element_patient_status").modal("hide");
        sendRequest($(this), base_url+"/changePatientStatus" ,'post', param);
     });
</script>

@endsection
