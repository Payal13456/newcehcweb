@extends('admin.layouts.admin_layouts')
@section('content')

 <div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Employee</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('employee.pending') }}" class="btn btn-danger">Pending Employee</a>
              <a href="{{ route('employee.create') }}" class="btn btn-info">Add New Employee</a>
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
              <!-- <div class="todo-widget scrollable" style="height: 450px"> -->
                <div class="table-responsive">
                    <table id="employeeListTable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Sr.no</th>
                          <th>Picture</th>
                          <th>Name</th>
                          <th>Role</th>
                          <th>Email</th>
                          <td>Gender</td>
                          <th>Phone Number</th>
                          <th>Aadhar Number</th>
                          <th>Education Qulaification</th>
                          <th>Specialization</th>
                          <th>Description</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $i = 1; ?>
                      @if (!empty($employees))  
                      @foreach($employees as $key => $emp)
                        <tr>
                          <td>{{ $i++ }}</td>
                          @if(!empty($emp->picture))
                            <td><img src="{{ env('API_BASEURL') }}/{{$emp->picture}}" alt="homepage" class="light-logo" width="50"  /></td>
                          @else
                            <td><img src="{{ asset('assets/images/logo-icon.png') }}" alt="homepage" class="light-logo" width="50"  /></td>
                          @endif
                          <td>{{ ucfirst($emp->first_name) ." ".ucfirst($emp->last_name) }}</td>
                          <td>{{$emp->roles->name}}</td>
                          <td>{{ $emp->user->email }}</td>
                          <td>{{($emp->gender == 1) ? 'Male' : 'Female'}}</td>
                          <td>{{ $emp->phonenumber }}</td>
                          <td>{{ $emp->aadharnumber }}</td>
                          <td>{{ $emp->education_qulaification }}</td>
                          <td><?php if(!empty($emp->specilization)){
                              echo $emp->specilization->specialization; 
                          }  ?></td>
                          <td>{{$emp->description}}</td>
                          <td>

                            <?php $statusColor = ($emp->status == 1) ? 'text-success' : 'text-danger';
                            $blockColor = ($emp->is_block == 2) ? 'text-success' : 'text-danger' 
                             ?>
                            <span><a href="javascript:void(0)" class="change_userStatus cursor fa fa-toggle-on fa-2x delete_random {{ $statusColor }}" data-type="status" data-toggle="tooltip" data-status="{{(($emp->status == 1) ? '0' : '1')}}" data_userId='{{ $emp->id }}' data-placement="top" title="Active/Inactive"></a>&nbsp;</span>
                            <!-- <span><a href='javascript:void(0)' class="cursor fa fas fa-ban  delete_random change_userStatus {{ $blockColor }}" data-type="block" data-toggle="tooltip" data-placement="top" title="Block/Unblock" data-status="{{(($emp->is_block == 1) ? '2' : '1')}}" data_userId='{{ $emp->id }}'></a>&nbsp;</span> -->
                            </td>
                          <td>
                          <a href="{{route('employee.show',$emp->id)}}" class="fas fa-info-circle fa-2x text-primary" title="Employee Details"/>
                            <a  href="{{ route('employee.edit',$emp->id) }}" data_id='' class="cursor fa fa-edit fa-2x delete_random" data-toggle="tooltip" data-placement="top" title="Edit employee details">&nbsp;</a>
                            <a href="javascript:void(0)" data-parent="employeeListTable" class=" tdDeleteColumnData cursor fa fa-trash fa-2x text-danger delete_random" data-toggle="tooltip" data-placement="top" title="Delete Employee" data-type="employeeListDataType" data_id="{{ $emp->id }}" data-id="{{ $emp->id }}" data-row-remove-message="Do you really want to Delete ?" onclick="deleteRowDatatable($(this))"></a>
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
<div class="modal fade" role="dialog" style="" id="modal_remove_element_user_status">
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

$(document).on('click', '.change_userStatus', function (e) {
   userId= $(this).attr("data_userId");
   status =$(this).attr("data-status");
   type = $(this).attr("data-type");
    $("#remove_element_status").attr("data-type",type);
   $("#remove_element_status").attr("data_userId",userId);
   $("#remove_element_status").attr("data-status",status);
   $("#modal_remove_element_user_status").modal("show");
});
$(document).on('click', '#remove_element_status', function (e) {
  userId= $(this).attr("data_userId");
  status =$(this).attr("data-status");
  type  = $(this).attr('data-type');
  param = {};
  param.userId = userId;
  param.status = status;
  param.type = type;
  $("#modal_remove_element_user_status").modal("hide");
  sendRequest($(this), base_url+"/changeEmpStatus" ,'post', param);
});
</script>
@endsection
