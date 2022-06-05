@extends('admin.layouts.admin_layouts')
@section('content')
 <div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Patient History - {{ucfirst($patient->first_name)}} {{ucfirst($patient->last_name)}} ({{$patient->uhid}})</h4>
      <div class="ms-auto text-end">
        <!-- <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('patient.create') }}">Add New Patient</a></li>
          </ol>
        </nav> -->
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
            <!-- <div class="todo-widget scrollable" style="height: 450px"> -->
            <div class="table-responsive">
              <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <td>S.No.</td>
                    <td>Doctor Name</td>
                    <td>Specialization</td>
                    <td>Description</td>
                    <td>Appointment Type</td>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Payment Type</td>
                    <td>Status</td>
                    <td>Action</td>
                  </tr>
                </thead>
                <tbody>
                
                @if (count($history) > 0)
                  @foreach($history as $key =>  $hist)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$hist->doctor->first_name}} {{$hist->doctor->last_name}}</td>
                      <td>{{$hist->specialization->specialization}}</td>
                      <td>{{$hist->description}}</td>
                      <td>{{$hist->type}}</td>
                      <td>{{date("d M Y" , strtotime($hist->schedule_date))}}</td>
                      <td>{{date("H:i A",strtotime($hist->slot_timing))}}</td>
                      <td>{{!empty($hist->payment) ? $hist->payment->payment_mode : 'N\A' }} </td>
                      <td>@if($hist->status == 1) <span class="text-danger"><b>Cancelled</b></span> @elseif($patient->type_of_patient == 1) <span class="text-info"><b>Free</b></span> @elseif($hist->payment_id == 0) <span class="text-warning"><b>Unpaid</b></span> @else <span class="text-success"><b>Paid</b></span>@endif</td> 
                      <td><a href="{{route('appointment.details',$hist->id)}}" class="fas fa-info-circle fa-2x" title="Appointment Details"/></td>
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
