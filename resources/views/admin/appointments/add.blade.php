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
      <h4 class="page-title">Add Appointment</h4>
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
      <form id="AddBlogForm" method="post" action="{{ route('appointment.store') }}" name="AddBlogForm" autocomplete="off" enctype="multipart/form-data">
        <div class="row">
          <div class="col-lg-11  mt-3">
            <label for="patient_id">Patient *</label>
            <select id="patient_id select2-dropdown" name="patient_id" required="" class="select2 form-select shadow-none form-control"  style="width: 100%; height: 36px">
              <option value="">Select</option>
              @if(!empty($patients))
              @foreach($patients as $p)
                @if($p->status == 1)
                <option value="{{ $p->id}}" data-id='{{$p->type_of_patient}}'>{{ $p->first_name}} {{$p->last_name}} - {{ $p->uhid}}</option>
                @endif
              @endforeach
              @endif
            </select>
            <span class="text-danger error-text cat_id_err"></span>
            </div>
            <div class="col-lg-1 mt-3">
              <a class="btn btn-info mt-3" href="{{route('patient.create')}}" target="_blank"><i class="fa fa-plus"></i> Add</a>
            </div>
          </div>
          <input type="hidden" name="type_of_patient" id="type_of_patient" />

        <div class="col-lg-12  mt-3">
          <label for="specification_id">Specification *</label>
          <select id="specification_id" name="specification_id" required="" class="select2 form-select shadow-none form-control"  onchange="getdoctorslist(this.value)" style="width: 100%; height: 36px">
            <option value="">Select</option>
            @if(!empty($getAllspecializations))
            @foreach($getAllspecializations as $category)
            <option value="{{ $category->id}}">{{ $category->specialization}}</option>
            @endforeach
            @endif
          </select>
          <span class="text-danger error-text cat_id_err"></span>
        </div>

        <div class="row">
          <div class="col-lg-12  mt-3">
            <label for="description">Mode *</label>
            <div class="row">
              <div class="col-md-1">
                <input type="radio" name="type" value="offline" onchange="getSlots();"> Offline
              </div>
              <div class="col-md-1">
                <input type="radio" name="type" value="online" onchange="getSlots();"> Online
              </div>
            </div>
            <span class="text-danger error-text description_err">
          </div>
          <div class="col-lg-6  mt-3">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12  mt-3">
            <label for="description">Choose *</label>
            <div class="row">
              <div class="col-md-2">
                <input type="radio" name="selecttype" value="date" onchange="getType('selectByDate');"> Select by Date 
              </div>
              <div class="col-md-2">
                <input type="radio" name="selecttype" value="doctor" onchange="getType('selectByDoctor');"> Select by Doctor
              </div>
            </div>
            <span class="text-danger error-text description_err">
          </div>
          <div class="col-lg-6  mt-3">
          </div>
        </div>
      <div class="selectByDate" style="display: none;">
        <div class="row">
          <div class="col-lg-12  mt-3">
            <label for="schedule_date">Appointment Date *</label>
            <input id="schedule_date" name="schedule_date" type="date" class="required form-control" onchange="getDoctor();" min="date('d-m-Y')" />
            <span class="text-danger error-text schedule_date_err"></span>
          </div>
          <div class="col-lg-6  mt-3 validation_msg">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12  mt-3">
            <label for="doctor_id">Doctors *</label>
            <select id="doctor_id" name="doctor_id"  class="select2 form-select shadow-none form-control" onchange="getSlots();" style="width: 100%; height: 36px" >
              <option value="">Select</option>
            </select>
            <span class="text-danger error-text cat_id_err"></span>
          </div>
        </div>
      </div>
      <div class="selectByDoctor" style="display: none;">
        <div class="row">
          <div class="col-lg-12  mt-3">
            <label for="doctor_id">Doctors *</label>
            <select id="doctor_ids" name="doctor_ids"  class="select2 form-select shadow-none form-control" onchange="getSlots();" style="width: 100%; height: 36px" >
              <option value="">Select</option>
            </select>
            <span class="text-danger error-text cat_id_err"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12  mt-3">
            <label for="schedule_date">Appointment Date *</label>
            <input id="schedule_dates" name="schedule_dates" type="date" class="required form-control" onchange="getSlots();" min="date('Y-m-d')" />
            <span class="text-danger error-text schedule_date_err"></span>
          </div>
          <div class="col-lg-6  mt-3 validation_msg">
          </div>
        </div>
      </div>
        <div class="row slot_div mt-3" style="display: none;">
          <label for="slot_timing">Select Time Slot *</label>
          <!-- <div class="col-lg-12  mt-3"> -->
            <div class="row" id="slots"></div>
          <!-- </div> -->
        </div>
        <div class="row">
          <div class="col-lg-12  mt-3">
            <label for="description">Description *</label>
            <textarea class="form-control" rows="7" cols="5"
              id="description" name="description" type="text" 
              required=""></textarea>
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
      });

     function getType(type){
        getSlots();
        if(type == 'selectByDate'){
          $('.'+type).css('display','block');
          $('.selectByDoctor').css('display','none');
        }
        if(type == 'selectByDoctor'){
          var id = $('#specification_id').val();
          getdoctorslist(id);
          $('.'+type).css('display','block');
          $('.selectByDate').css('display','none');

        }
     }

    function getdoctorslist(id){
      if(id != ''){
        getSlots();
        $.ajax({
          url : "{{url('doctorsBySpecification')}}/"+id,
          method : "GET",
          success : function (res){
            $("#doctor_ids").html(res);
          }
        })
      }
    }

     function getdoctorslistbydate(id,date){
      if(id != ''){
        getSlots();
        $.ajax({
          url : "{{url('doctorsByDate')}}/"+id+"/"+date,
          method : "GET",
          success : function (res){
            $("#doctor_id").html(res);
          }
        })
      }
    }

    function getDoctor(){
      var id = $('#specification_id').val();
      var schedule_date = $("#schedule_date").val();
      console.log(schedule_date);
      getdoctorslistbydate(id,schedule_date);
    }

    function getSlots(){
      var type = $("input[name=selecttype]:checked").val();
      if(type == 'date'){
        var schedule_date = $("#schedule_date").val();
        var doctor_id = $("#doctor_id").val();
      }
      console.log(type);
      if(type == 'doctor'){
        var schedule_date = $("#schedule_dates").val();
        var doctor_id = $("#doctor_ids").val();
      }
      var mode = $('input[name="type"]:checked').val();
      var date = new Date(Date.now());

      console.log("TODAY DATE"+formatDate(date));

      
      console.log(doctor_id+"-----------")
      if(doctor_id != '' && schedule_date != '' && mode != undefined && doctor_id != 'Select Doctor' && schedule_date != undefined){
        console.log("DATA:"+doctor_id+"-----"+schedule_date+"------"+mode)
        var did = doctor_id;
        console.log("current date"+Number(new Date()));
        console.log("selected Date"+ Number(new Date(schedule_date)));
         if(Number(new Date(formatDate(date))) <= Number(new Date(schedule_date))){
          $.ajax({
            url : "{{url('doctorSchedule')}}",
            method : "POST",
            data : {
              "_token": "{{ csrf_token() }}",
              "id" : did,
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

  function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
  }
 

  </script>
  @endsection
