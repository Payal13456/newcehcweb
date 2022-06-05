@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Cancelled Appointments</h4>
      <div class="ms-auto text-end">
        @php $user = Session::get('user'); @endphp  
        @if($user->role_id != 1)
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('appointment.create') }}" class="btn btn-info">Add New Appointment</a></li>
            </ol>
          </nav>
        @else
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('appointment.index') }}" class="btn btn-info">Upcomming Appointment</a></li>
            </ol>
          </nav>
        @endif
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
                  <th>Patient Name</th>
                  <th>Doctor Name</th>
                  <th>Specification</th>
                  <th>Appointment date</th>
                  <th>Time</th>
                  <th>Appointment Type</th>
                  <th>Patient Type</th>
		  <th>Cancelled By</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php $user = Session::get('user'); @endphp  
                <?php  $i = 1; ?>
                @if (!empty($cancelled))
                  @foreach($cancelled as $key =>  $a)
                    @if($user->role_id == 1)
                      @if($a->status == 1)
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>@if($a->patient != NULL){{$a->patient->first_name}} {{$a->patient->last_name}} @else NA @endif</td>
                          <td>@if($a->doctor != NULL){{$a->doctor->first_name}} {{$a->doctor->last_name}} @else NA @endif</td>
                          <td>{{$a->specialization->specialization}}</td>
                          <td>{{date("d M Y", strtotime($a->schedule_date))}}</td>
                          <td>{{date("h:i A",strtotime($a->slot_timing))}}</td>
                          <td>{{$a->type}}</td>
                          <td>{{($a->patient->type_of_patient == 1) ? 'Free Patient' : 'Paid Patient'}}</td>
                          <td>@if($a->cancelled_by != null) {{$a->cancelled_by->role->name}} @else N\A @endif</td>
                          <td>
                            <a href="{{route('appointment.details', $a->id)}}" class="fa fa-info-circle fa-2x text-primary" title="Detais"></a> 
                          </td>
                        </tr>
                      @endif
                    @else
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>@if($a->patient != NULL){{$a->patient->first_name}} {{$a->patient->last_name}} @else NA @endif</td>
                        <td>@if($a->doctor != NULL){{$a->doctor->first_name}} {{$a->doctor->last_name}} @else NA @endif</td>
                        <td>{{$a->specialization->specialization}}</td>
                        <td>{{date("d M Y", strtotime($a->schedule_date))}}</td>
                        <td>{{date("h:i A",strtotime($a->slot_timing))}}</td>
                        <td>{{$a->type}}</td>
                        <td>{{($a->patient->type_of_patient == 1) ? 'Free Patient' : 'Paid Patient'}}</td>
                        <!-- <td>@if($a->cancelled_by != null) {{$a->cancelled_by->role->name}} @else N\A @endif</td> -->
                        <td>
                          <a href="{{route('appointment.details', $a->id)}}" class="fa fa-info-circle fa-2x text-primary" title="Detais"></a> &nbsp;
                          @if($a->status != 1)<a href="{{route('appointment.more', $a->id)}}" class="fas fa-prescription fa-2x text-info" title="Prescription"></a> &nbsp;
                            @if($a->payment_id  != NULL || $a->patient->type_of_patient == 1)
                              <a href="{{route('appointment.edit', $a->id)}}" class="fas fa-calendar-alt fa-2x text-success" title="Reschedule"></a> &nbsp;
                              <?php $statusColor = ($a->status == 1) ? 'text-success' : 'text-danger';
                               ?>
                              <span><a href="javascript:void(0)" class="change_userStatus cursor fa fa-ban fa-2x delete_random {{ $statusColor }}" data-type="status" data-toggle="tooltip" data-status="{{(($a->status == 1) ? '0' : '1')}}" data_userId='{{ $a->id }}' data-placement="top" title="Cancel Booking"></a>&nbsp;</span>
                            @endif
                            @if($user->role_id == 1 && date('Y-m-d') <= date('Y-m-d',strtotime($a->schedule_date)))
                              <a href="javascript:void(0);" class="fa fa-video fa-2x" title="Video Call" onClick=window.open("{{url('appointment-call')}}/{{$a->id}}","Ratting","width=1000,height=1000,left=0,top=0,toolbar=0,status=0,");></a>
                            @endif
                          @else
                            <a href="javascript:void(0);" class="text text-danger">Cancelled</a>
                          @endif
                         @if($user->role_id != 1 && $a->patient->type_of_patient != 1)<a href="{{route('payment.page', $a->id)}}" class="fa  fa-credit-card fa-2x" title="Payment"></a> &nbsp; @endif
                        </td>
                      </tr>
                    @endif
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
<div class="modal fade" role="dialog" style="" id="modal_remove_element_blog_status">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Confirm Message</h5>
        <button type="button" class="close" data-dismiss="modal" onclick="$('#modal_remove_element_blog_status').modal('hide');">&times;</button>
      </div>
      <div class="modal-body" id="detail" style="">
        <div class="row">
          <div class="col s12 m12">
            <div class="form-group col s12">
              <div id="remove_element_message_status" style="">Do you really want to Cancel Booking!!</div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary btn-fw" style="" id="remove_element_status" ><?php echo('Yes'); ?></button>
        <button class="btn btn-primary btn-fw" data-dismiss="modal" onclick="$('#modal_remove_element_blog_status').modal('hide');"><?php echo('NO'); ?></button>
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
         $("#modal_remove_element_blog_status").modal("show");

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
        sendRequest($(this), base_url+"/cancelBooking" ,'post', param);
     });
</script>
@endsection
