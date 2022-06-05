@extends('admin.layouts.admin_layouts')
@section('content')
 <div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Pending Employee</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('employee.index') }}" class="btn btn-info">Employee List</a>
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
                          <th>Email</th>
                          <td>Gender</td>
                          <th>Phone Number</th>
                          <th>Aadhar Number</th>
                          <th>Education Qulaification</th>
                          <th>Action</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                      <?php $i = 1; ?>
                      @if (!empty($employees))  
                      @foreach($employees as $key => $emp)
                        <tr>
                          <td>{{ $i++ }}</td>
                          @if(!empty($emp->user_info->picture))
                            <td><img src="{{ env('API_BASEURL') }}/{{$emp->user_info->picture}}" alt="homepage" class="light-logo" width="25" height="30" /></td>
                          @else
                            <td><img src="{{ asset('assets/images/logo-icon.png') }}" alt="homepage" class="light-logo" width="25" height="30" /></td>
                          @endif
                          <td>{{ ucfirst($emp->user_info->first_name) ." ".ucfirst($emp->user_info->last_name) }}</td>
                          <td>{{ $emp->email }}</td>
                          <td>{{($emp->user_info->gender == 1) ? 'Male' : 'Female'}}</td>
                          <td>{{ $emp->user_info->phonenumber }}</td>
                          <td>{{ $emp->user_info->aadharnumber }}</td>
                          <td>{{ $emp->user_info->education_qulaification }}</td>
                          <td><a href="{{route('employee.show',$emp->user_info->id)}}" class="fas fa-info-circle fa-2x text-primary" title="Employee Details"/></td>
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
                <button type="button" class="close" data-dismiss="modal" onclick="$('#modal_remove_element_user_status').modal('hide');">&times;</button>
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
                 <button class="btn btn-primary btn-fw" data-dismiss="modal" onclick="$('#modal_remove_element_user_status').modal('hide');"><?php echo('NO'); ?></button>
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
