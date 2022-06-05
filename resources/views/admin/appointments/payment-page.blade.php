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
      <h4 class="page-title">Payment</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="card">
    <div class="card-body wizard-content">
      <div class="row">
          <div class="col-lg-12  mt-3">
            <h5>Billing Details - </h5>
            <div class="row mt-3">
              <div class="col-md-12">
                <h6>Appointment On - {{date("d M Y", strtotime($appointment->schedule_date))}} at {{date("H:i A", strtotime($appointment->slot_timing))}}</h6>
                <hr>
              </div>
              <div class="col-md-6">
                <p>Patient Name - {{$appointment->patient->first_name}} {{$appointment->patient->last_name}}</p>
              </div>
              <div class="col-md-6">
                <p>Email Address - {{$appointment->patient->email_address}}</p>
              </div>
              <div class="col-md-6">
                <p>Phone Number - {{$appointment->patient->phone_number_primary}}</p>
              </div>
              <div class="col-md-6">
                <p>Age - {{(date('Y') - date('Y',strtotime($appointment->patient->date_of_birth)))}}</p>
              </div>
              <div class="col-md-6">
                <p>Address - {{$appointment->patient->address}}, {{$appointment->patient->city}}, {{$appointment->patient->pincode}}</p>
              </div>
              <div class="col-md-6">
                <p>Aadhar Card No. - {{$appointment->patient->adhar_card}}</p>
              </div>
                <hr>
              <div class="col-md-6">
                <p>Doctor - @if($appointment->doctor != NULL){{$appointment->doctor->first_name}} {{$appointment->doctor->last_name}} @else NA @endif</p>
              </div>
              <div class="col-md-6">
                <p>Phone Number - {{$appointment->doctor->phonenumber}}</p>
              </div>
              <hr>
              </div>
              <div class="col-md-6"></div>
            </div>
            
            @if($appointment->payment_id != 0)
            <div class="row mt-3">

              <div class="col-md-3">
                <p>Consultation Fee</p>
                <p>Booking Fee</p>
              </div>
              <div class="col-md-9" >
                <p >Rs. {{$appointment->payment->consultation_fees}}</p>
                <p> Rs. {{$appointment->payment->booking_fees}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-3">
               <h4>Total</h4>
              </div>
              <div class="col-md-9" >
                <p>Rs. {{$appointment->payment->total_amount}} /-</p>
              </div>
            </div>
            @else
            	
              <div class="col-md-3">
                <p>Consultation Fee</p>
                <p>Booking Fee</p>
              </div>
              <div class="col-md-9" >
                <p >Rs. {{$payment->consultation_fees}}</p>
                <p> Rs. {{$payment->booking_fees}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-3">
               <h4>Total</h4>
              </div>
              <div class="col-md-9" >
                <p>Rs. {{$payment->total}} /-</p>
              </div>
            </div>
            @endif
            @if($appointment->payment_id == 0)
            	@php 
            		$amount = intval($payment->total)*100;
            	@endphp
              <div class="row">
                <div class="col-md-2">
                   <form action="{!!route('payment')!!}" method="POST" >
                      <script src="https://checkout.razorpay.com/v1/checkout.js"
                          data-key="rzp_live_lRU6KX64RykLIM"
                          data-amount="{{$amount}}"
                          data-buttontext="Pay Online"
                          data-class="btn btn-info"
                          data-name="Payment"
                          data-description="Patient Appointment"
                          data-image="https://www.laravelcode.com/upload/logo.svg"
                          data-prefill.name="name"
                          data-prefill.email="email"
                          data-theme.color="#ff7529">
                      </script>
                      <input type="hidden" name="type" value="online">
                      <input type="hidden" name="appointment_id" value="{{$appointment->id}}">
                      <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                  </form>
                </div>
                <div class="col-md-2">
                  <button class="btn btn-info" onclick="OfflinePay({{$appointment->id}},'offline');">Pay Offline</button>
                </div>
              </div>  
            @else
              @if($appointment->payment->status  == 0)
                <p class="text-success"><b>Paid on {{\Carbon\Carbon::parse($appointment->payment->created_at)->timezone('Asia/Kolkata')->format('d M Y , H:i A')}}</b></p>
                <!-- <p class="text-success"><b>Paid on {{date("d M Y, H:i A",strtotime($appointment->payment->created_at))}}</b></p> -->
              @endif
              @if($appointment->payment->status  == 1)
                <p class="text-success"><b>Refund Processed on {{\Carbon\Carbon::parse($appointment->payment->updated_at)->timezone('Asia/Kolkata')->format('d M Y , H:i A')}}</b></p>
              @endif
            @endif
        </div>
    </div>
  </div>
</div>

@endsection
@section('script')
  <script type="text/javascript">
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
      var schedule_date = $("#schedule_date").val();
      var doctor_id = $("#doctor_id").val();
      if(doctor_id != '' && schedule_date != ''){
        $.ajax({
          url : "{{url('doctorSchedule')}}",
          method : "POST",
          data : {
            "_token": "{{ csrf_token() }}",
            "id" : doctor_id,
            "date" : schedule_date
          },
          success : function (res){
            $(".slot_div").css("display",'block');
            $("#slots").html(res);
          }
        })
      }
    }

    function paymentForm(){
      $("#payment_modal").modal('show');
    }

    function OfflinePay(id, type){
      $.ajax({
          url : "{{url('payment')}}",
          method : "POST",
          data : {
            "_token": "{{ csrf_token() }}",
            "appointment_id" : id,
            "type" : type,
            "amount" : 65000,
            "razorpay_payment_id" : "test"
          },
          success : function (res){
            console.log(res);
            window.location.href = "{{url('appointment')}}";
          }
      });
    }
  </script>
  @endsection
