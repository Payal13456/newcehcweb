@extends('admin.layouts.admin_layouts')
@section('content')
<style type="text/css">
  input.razorpay-payment-button {
    background: #2255a4;
    color: white;
    border-radius: 2px;
    padding: 5px;
    border: 2px solid #2255a4;
  }
</style>
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Reschedule Appointment</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="card">
    <div class="card-body wizard-content">
      <form id="AddBlogForm" method="post" action="{{ route('appointment.update',$id) }}" name="AddBlogForm" autocomplete="off" enctype="multipart/form-data">
        @method('PUT')
        <div class="row">
          <div class="col-lg-11  mt-3">
            <input type="hidden" name="appointment_id" value="{{$id}}">
            <label for="patient_id">Patient *</label>
            <select id="patient_id select2-dropdown" name="" required="" class="select2 form-select shadow-none form-control"  style="width: 100%; height: 36px">
              <option value="">Select</option>
              @if(!empty($patients))
              @foreach($patients as $p)
                <option value="{{ $p->id}}" @if($appointment->patient_id == $p->id) selected @endif>{{ $p->first_name}} {{$p->last_name}}</option>
              @endforeach
              @endif
            </select>
            <input type="hidden" name="patient_id" value="{{$appointment->patient_id}}">
            <span class="text-danger error-text cat_id_err"></span>
            </div>
            <div class="col-lg-1 mt-3">
              <a class="btn btn-info mt-3" href="{{route('patient.create')}}" target="_blank"><i class="fa fa-plus"></i> Add</a>
            </div>
          </div>
          <div class="col-lg-12  mt-3">
            <label for="specification_id">Specification *</label>
            <select id="specification_id" name="" required="" class="select2 form-select shadow-none form-control" onchange="getdoctorslist(this.value);" style="width: 100%; height: 36px">
              <option value="">Select</option>
              @if(!empty($getAllspecializations))
              @foreach($getAllspecializations as $category)
              <option value="{{ $category->id}}" @if($appointment->specification_id == $category->id) selected @endif>{{ $category->specialization}}</option>
              @endforeach
              @endif
            </select>
            <input type="hidden" name="specification_id" value="{{$appointment->specification_id}}">
            <span class="text-danger error-text cat_id_err"></span>
            </div>
          @php $user = Session::get('user'); @endphp  
          @if($user->role_id != 1)
            <div class="row">
            <div class="col-lg-12  mt-3">
            <input type="hidden" name="doctor_id" value="{{$appointment->doctor_id}}">
              <label for="doctor_id">Doctors *</label>
              <select id="doctor_id" name="doctor_id" required="" class="select2 form-select shadow-none form-control" onchange="getSlots();" style="width: 100%; height: 36px" >
                <option value="">Select</option>
                @if(!empty($doctors))
                @foreach($doctors as $p)
                  <option value="{{ $p->user_id}}" @if($appointment->doctor_id == $p->user_id) selected @endif>{{ $p->first_name}} {{$p->last_name}}</option>
                @endforeach
                @endif
              </select>
              <span class="text-danger error-text cat_id_err"></span>
            </div>
            
          @else
            <input type="hidden" name="doctor_id" id="doctor_id" value="{{$user->id}}">
          @endif

          <div class="row">
          <div class="col-lg-12  mt-3">
            <label for="description">Mode *</label>
            <div class="row">
              <div class="col-md-1">
                <input type="radio" name="type" value="offline" @if($appointment->type == 'offline') checked @endif> Offline
              </div>
              <div class="col-md-1">
                <input type="radio" name="type" value="online" @if($appointment->type == 'online') checked @endif> Online
              </div>
            </div>
            <span class="text-danger error-text description_err">
          </div>
          <div class="col-lg-6  mt-3">
          </div>
        </div>
        <!-- </div> -->
        <div class="row">
          <div class="col-lg-12  mt-3">
            <label for="schedule_date">Appointment Date *</label>
            <input id="schedule_date" name="schedule_date" type="date" class="required form-control" onchange="getSlots();" value="{{$appointment->schedule_date}}" />
            <span class="text-danger error-text schedule_date_err">
          </div>
          <div class="col-lg-6  mt-3 validation_msg">
          </div>
        </div>
        <div class="row slot_div">
          <label for="slot_timing">Select Time Slot *</label>
          <!-- <div class="col-lg-12  mt-3"> -->
            <div class="row" id="slots">
              {!! $slot !!}
            </div>
          <!-- </div> -->
        </div>
        <div class="row">
          <div class="col-lg-12  mt-3">
            <label for="description">Description *</label>
            <textarea class="form-control" rows="7" cols="5"
              id="description" name="description" type="text" 
              required="">{{$appointment->description}}</textarea>
            <span class="text-danger error-text description_err">
          </div>
          <div class="col-lg-6  mt-3">
          </div>
        </div>
        <!-- <hr>
        <div class="row">
          <div class="col-md-12">
            <button class="btn btn-info" type="button" onclick="paymentForm();">Online Payment</button>
            <button class="btn btn-danger" type="button">Offline Payment</button>
          </div>
          <div class="col-lg-6  mt-3">
          </div>
        </div> -->
        <div class="row">
          <div class="col-lg-6  mt-3">
            <a href="{{url('appointment')}}" class="btn btn-danger" >Cancel</a>
           <button type="submit" class="btn btn-info" data-submit="submit">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" role="dialog" style="" id="payment_modal">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
     <!--  <div class="modal-header">
        <h5 class="modal-title" id="title">Confirm Message</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div> -->
      <div class="modal-body" id="detail" style="">
        <div class="row">
          <div class="col-lg-12  mt-3">
            <label for="description">Bill Details *</label>
            <div class="row">
              <div class="col-md-3">
                <p>Consultation Fee</p>
                <p>Booking Fee</p>
              </div>
              <div class="col-md-9" >
                <p >Rs. 600</p>
                <p> Rs. 50</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-3">
               <h4>Total</h4>
              </div>
              <div class="col-md-9" >
                <p>Rs. 650 /-</p>
              </div>
            </div>
          <form action="{!!route('payment')!!}" method="POST" >
              <script src="https://checkout.razorpay.com/v1/checkout.js"
                  data-key="{{ env('RAZORPAY_KEY') }}"
                  data-amount="65000"
                  data-buttontext="Pay Online"
                  data-class="btn btn-info"
                  data-name="Laravelcode"
                  data-description="Order Value"
                  data-image="https://www.laravelcode.com/upload/logo.svg"
                  data-prefill.name="name"
                  data-prefill.email="email"
                  data-theme.color="#ff7529">
              </script>
              <input type="hidden" name="_token" value="{!!csrf_token()!!}">
          </form>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button class="btn btn-primary btn-fw" style="" id="remove_element_status" ><?php echo('Yes'); ?></button>
        <button class="btn btn-primary btn-fw" data-dismiss="modal"><?php echo('NO'); ?></button>
      </div> -->
    </div>
  </div>
</div>

@endsection
@section('script')
  <script type="text/javascript">
     $(document).ready(function() {
        var $disabledResults = $(".select2");
        $disabledResults.select2();
        $("select").prop("disabled", true); // instead of $("select").enable(false);

      });
    function getdoctorslist(id){
      if(id != ''){
        getSlots();
        $.ajax({
          url : "{{url('doctorsBySpecification')}}/"+id,
          method : "GET",
          success : function (res){
            $("#doctor_id").html(res);
          }
        })
      }
    }

    function getSlots(){
      var mode = $('input[name="type"]:checked').val();
      var schedule_date = $("#schedule_date").val();
      var doctor_id = $("#doctor_id").val();
      
      if(doctor_id != '' && schedule_date != '' && mode != undefined){
        if(new Date() <= new Date(schedule_date)){
          $.ajax({
            url : "{{url('doctorSchedule')}}",
            method : "POST",
            data : {
              "_token": "{{ csrf_token() }}",
              "id" : doctor_id,
              "date" : schedule_date,
              "type" : mode
            },
            success : function (res){
              $(".validation_msg").html('');
              $(".slot_div").css("display",'block');
              $("#slots").html(res);
            }
          })
        }else{
          $(".slot_div").css("display",'none');
          $("#slots").html('');
          $(".validation_msg").html("<p class='text-danger'>Appointment Date should be any future date</p>");
        }
      }
    }

    function paymentForm(){
      $("#payment_modal").modal('show');
    }
  </script>
  @endsection
