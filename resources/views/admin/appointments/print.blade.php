<!DOCTYPE html>
<html>
<head>
	<title>Prescription details</title>
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png')}}" />
     <link href="{{ asset('assets/libs/jquery-steps/steps.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/select2/dist/css/select2.min.css')}}"/>
    <link href="{{ asset('dist/css/style.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/lib.css')}}" rel="stylesheet" />
    <script src="https://cdn.agora.io/sdk/release/AgoraRTCSDK-3.6.8.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src='{{asset("assets/js/fontawesome.js")}}' crossorigin='anonymous'></script>


</head>
<!-- <body onload="window.print()"> -->
<body>
<div class="container mt-3 mb-3">
  
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body " >
        	<table class="table">
        		<tr>
        		<td>
        			<span class="db"><img src="{{ asset('assets/images/icon-logo.png')}}" alt="logo" width="100px" height="70px"></span>
        		</td>
			  	<td class="text-center" style="padding:0 20px;">
			  		<h2 >CEHC Chennai</h2>
			  		<p>3rd Floor, Ramaniyam Isha,11, Old Mahabalipuram Road,
			Thoraipakkam, Chennai - 600097</p>
					<p>Email: cehcchennai@gmail.com</p>
			  	</td>
			  	<td style="text-align: right;">
			  		<h6 > Contact - </h6>
			  		<p><b>Phone: 044 24961414 | </b></p>
			  		<p><b>9445261414</b></p>
			  	</td>
			</table>
          @if(!empty($appointment))
            <!-- <div class="row mt-3">
              <div class="col-md-12"> -->
              <table class="table">
              	<tr>	
              		@if($appointment->cancelled_by != null)<h3 class="text-danger"> Cancelled By {{$appointment->cancelled_by->role->name}}</h3> @endif
                	<h6 class="text-info">Appointment On - {{date("d M Y", strtotime($appointment->schedule_date))}} at {{date("H:i A", strtotime($appointment->slot_timing))}}</h6>
                
	            </tr>
              	<tr>
              		<td>
                		<p>UHID - {{$appointment->patient->uhid}}</p>
                		<p>Email Address - {{$appointment->patient->email_address}}</p>
                		<p>Age - {{(date('Y') - date('Y',strtotime($appointment->patient->date_of_birth)))}}</p>
                		<p>Aadhar Card No. - {{$appointment->patient->adhar_card}}</p>
                		<p>Phone Number - {{$appointment->doctor->phonenumber}}</p>
                	</td>
                	<td>
                		<p>Patient Name - {{$appointment->patient->first_name}} {{$appointment->patient->last_name}}</p>
                		<p>Phone Number - {{$appointment->patient->phone_number_primary}}</p>
                		<p>Address - {{$appointment->patient->address}}, {{$appointment->patient->city}}, {{$appointment->patient->pincode}}</p>
                		<p>Doctor - {{$appointment->doctor->first_name}} {{$appointment->doctor->last_name}}</p>
                	</td>
              	</tr>
             </table>
          @endif
        </div>
      </div>
    </div>
    <!-- <div class="col-12">
      <div class="card">
        <div class="card-header" data-bs-toggle="collapse" data-bs-target="#caseSummaryDiv" >
          <h6 class="text-info">Case Summary</h6>
        </div>
        <div class="card-body collapse show"  id="caseSummaryDiv">
          <p>@if(!empty($summary)) {{$summary->case_summary}} @else No Summary Found @endif</p>
        </div>
      </div>
    </div> -->
    <div class="col-12">
      <div class="card">
        <div class="card-header" data-bs-toggle="collapse" data-bs-target="#diagnosisDiv">
          <h6 class="text-info">Diagnosis</h6>
        </div>
        <div class="card-body collapse show"  id="diagnosisDiv">
          <div class="row mt-3">
            <!-- <table id="zero_config" class="table table-striped table-bordered">
             <tr>
              <td>S.No.</td>
              <td>Name</td>
              <td>Instruction</td>
              <td>Action</td>
            </tr> -->
            @if(count($diagnosis) > 0)      
            	<table class="table">
	              @foreach($diagnosis as $k=>$d)
	              	<tr>
	              		<td>
	                 		<h5 class="text-success">{{$k+1}}. {{ucfirst($d->name)}}</h5>
	                  		<p>{{$d->instruction}}</p>
	                  	</td>
	                 </tr>
	              @endforeach
	            </table>
            @endif
          <!-- </table> -->
        </div>
        </div>
      </div>
    </div>
    <div class="col-12">
      <div class="card">
        <div class="card-header" data-bs-toggle="collapse" data-bs-target="#prescriptionDiv">
          <h6 class="text-info">Prescription</h6>
        </div>
        <div class="card-body collapse show"  id="prescriptionDiv">
          <div class="row">
            @if(count($prescription) > 0)      
              @foreach($prescription as $k=>$d)
              <div class="col-lg-1 p-3">{{$k+1}}.</div>
              <div class="col-lg-11 p-2">
                <div class="row p-2"><div class=" col-lg-11 "> <h5 class="text-danger">{{ucfirst($d->medicine_type)}} - {{ucfirst($d->medicine->medicine_name)}} </h5></div><div class="col-lg-1"></div></div>
                <div class="row p-2"><div class="col-lg-2"><b>Duration </b>-@if($d->duration == '') 0 days @else @if(strpos($d->duration,'day')) {{$d->duration}} @else {{$d->duration}} days @endif @endif</div></div>
                <div class="row p-2"><div class="col-lg-2"><b>MG / ML </b>- {{$d->mg_ml}}</div> <div class="col-lg-3"><b>Food </b>- {{ str_replace(',' , ' or ', $d->food)}}</div>
                <div  class="col-lg-3"><b>Time </b>- {{join(' | ', array_map('ucfirst', explode(',', $d->timing)))}}</div>
                <div  class="col-lg-3"><b>Dose </b>- {{$d->dose}}</div></div>
                <div class="p-2"><b>Instruction / Comment </b>- {{$d->instruction}}</div>
              </div>
              @if($k+1 < count($prescription))
                <hr>
              @endif
              @endforeach
            @endif
          </div>
        </div>
        </div>
      </div>
    <div class="col-12">
      <div class="card">
        <div class="card-header" data-bs-toggle="collapse" data-bs-target="#opticsDiv">
          <h6 class="text-info">Optical Details</h6>
        </div>
        <div class="card-body collapse show"  id="opticsDiv">
          <div class="row">
              <div class="col-lg-12">
                <div class="row">
                  <strong class="col-lg-6 text-center">Remark - @if(count($optics) > 0) {{$optics[0]->remark}} @endif</strong> <strong class="col-lg-6 text-center">IPD (in mm) - @if(count($optics) > 0) {{$optics[0]->ipd}} @endif</strong>
                </div>
                <table class="table eye_details" style="padding: 0;margin: 0;border: 1px solid lightgray;">
                 <tr>
                   <td></td>
                   <td colspan="4" class="text-center">Right Eye</td>
                   <td colspan="4" class="text-center">Left Eye</td>
                 </tr>
                 <tr>
                   <td></td>
                   <td>Dsph</td>
                   <td>Dcyl</td>
                   <td>Axis</td>
                   <td>V/A</td>
                   <td>Dsph</td>
                   <td>Dcyl</td>
                   <td>Axis</td>
                   <td>V/A</td>
                 </tr>
                 @php $count1 = 0; $count2 = 0; $count3 = 0; $count4 = 0; @endphp
                 @if(count($optics) > 0 )
                   <tr>
                     <td>Dist.</td>
                     
                     @foreach($optics as $eye_details)
                      @if($eye_details->type == 'dist' && $eye_details->eye_details == 'right')
                       <td>{{$eye_details->dsph}}</td>
                       <td>{{$eye_details->dcyl}}</td>
                       <td>{{$eye_details->axis}}</td>
                       <td>{{$eye_details->va}}</td>
                       @php $count2 = 1; break; @endphp
                      @else
                        @php $count2 = 0; @endphp
                      @endif
                     @endforeach
                     @if($count2 == 0)
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                     @endif
                     @foreach($optics as $eye_details)
                      @if($eye_details->type == 'dist' && $eye_details->eye_details == 'left')
                       <td>{{$eye_details->dsph}}</td>
                       <td>{{$eye_details->dcyl}}</td>
                       <td>{{$eye_details->axis}}</td>
                       <td>{{$eye_details->va}}</td>
                       @php $count1 = 1; break; @endphp
                      @else
                        $count1 = 0;
                      @endif
                     @endforeach
                     @if($count1 == 0)
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                     @endif
                   </tr>
                   <tr>
                     <td>Near</td>
                     @foreach($optics as $eye_details)
                      @if($eye_details->type == 'near' && $eye_details->eye_details == 'right')
                       <td>{{$eye_details->dsph}}</td>
                       <td>{{$eye_details->dcyl}}</td>
                       <td>{{$eye_details->axis}}</td>
                       <td>{{$eye_details->va}}</td>
                       @php $count4 = 1; break; @endphp
                      @else
                        @php $count4 = 0; @endphp
                      @endif
                     @endforeach
                     @if($count4 == 0)
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                     @endif
                     @foreach($optics as $eye_details)
                      @if($eye_details->type == 'near' && $eye_details->eye_details == 'left')
                       <td>{{$eye_details->dsph}}</td>
                       <td>{{$eye_details->dcyl}}</td>
                       <td>{{$eye_details->axis}}</td>
                       <td>{{$eye_details->va}}</td>
                       @php $count3 = 1; break; @endphp
                      @else
                        @php $count3 = 0; @endphp
                      @endif
                     @endforeach
                     @if($count3 == 0)
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                     @endif
                   </tr>
                 @else
                   <tr>
                     <td>Dist.</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                   </tr>
                   <tr>
                     <td><input type="hidden" name="type[]" value="near">Near</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                   </tr>
                  @endif
               </table> 
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{ asset('assets/extra-libs/sparkline/sparkline.js')}}"></script>
<!--Wave Effects -->
<script src="{{ asset('dist/js/waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{ asset('dist/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('assets/libs/jquery-steps/build/jquery.steps.min.js')}}"></script>
<script src="{{ asset('dist/js/custom.min.js')}}"></script>
<script src="{{ asset('assets/libs/flot/excanvas.js')}}"></script>
<script src="{{ asset('assets/libs/flot/jquery.flot.js')}}"></script>
<script src="{{ asset('assets/libs/flot/jquery.flot.pie.js')}}"></script>
<script src="{{ asset('assets/libs/flot/jquery.flot.time.js')}}"></script>
<script src="{{ asset('assets/libs/flot/jquery.flot.stack.js')}}"></script>
<script src="{{ asset('assets/libs/flot/jquery.flot.crosshair.js')}}"></script>
<script src="{{ asset('assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>
<script src="{{ asset('dist/js/pages/chart/chart-page-init.js')}}"></script>
<script src="{{ asset('assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{ asset('/dist/js/pages/mask/mask.init.js')}}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
<script src="{{ asset('assets/js/lib.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js"></script>
</body>
</html>