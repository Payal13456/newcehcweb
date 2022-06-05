@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Upgrade Appointment</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('print-prescription')}}/{{$id}}" id="exportButton" class="btn btn-info"><i class="fa fa-print"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ url('end-consultation')}}/{{$id}}" class="btn btn-info">End Consultation</a></li>

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
        <div class="card-header" data-bs-toggle="collapse" data-bs-target="#caseSummaryDiv" >
          <h6>Case Summary</h6>
        </div>
        <div class="card-body collapse show"  id="caseSummaryDiv">
          <form method="post" action="{{route('casestudy.add')}}">
            @csrf
            <div class="row">
              <div class="col-lg-12  mt-3">
                <input type="hidden" name="appointment_id" value="{{$id}}">
                <label for="case_summary">Case Summary *</label>
                <textarea class="form-control" rows="7" cols="5" id="case_summary" name="case_summary" type="text">@if(!empty($summary)) {{$summary->case_summary}} @endif</textarea>
              </div>
              <div class="col-lg-6  mt-3">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6  mt-3">
               <button type="submit" class="btn btn-primary" data-submit="submit">Add Case Summary</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-12">
      <div class="card">
        <div class="card-header" data-bs-toggle="collapse" data-bs-target="#diagnosisDiv">
          <h6>Diagnosis</h6>
        </div>
        <div class="card-body collapse show"  id="diagnosisDiv">
          <a href="javascript:void(0);" class="btn btn-primary" onclick="openDiagnosis({{$id}});">Add New Diagnosis</a>
          <div class="row mt-3">
            <!-- <table id="zero_config" class="table table-striped table-bordered">
             <tr>
              <td>S.No.</td>
              <td>Name</td>
              <td>Instruction</td>
              <td>Action</td>
            </tr> -->
            @if(count($diagnosis) > 0)      
              @foreach($diagnosis as $k=>$d)
                <div class="col-lg-12 p-2">
                  <div class="row"><div class=" col-lg-11 "> <h5 class="text-info">{{$k+1}}. {{ucfirst($d->name)}}</h5></div><div class="col-lg-1"><a href="javascript:void(0);" class="fa fa-edit " title="Edit Diagnosis" onclick="editDiagnosis({{$d->id}})"> &nbsp;<a href="javascript:void(0);" class="fa fa-trash " title="Delete Diagnosis" ></a></div></div>
                  <p>{{$d->instruction}}</p>
                </div>
                @if($k+1 < count($diagnosis))
                  <hr>
                @endif
              @endforeach
            @endif
          <!-- </table> -->
        </div>
        </div>
      </div>
    </div>
    <div class="col-12">
      <div class="card">
        <div class="card-header" data-bs-toggle="collapse" data-bs-target="#prescriptionDiv">
          <h6>Prescription</h6>
        </div>
        <div class="card-body collapse show"  id="prescriptionDiv">
          <a href="javascript:void(0);" class="btn btn-primary" onclick="addPrescription({{$id}});">Add New Tablet / Syrup</a>
          <div class="row">
            @if(count($prescription) > 0)   
              @foreach($prescription as $k=>$d)
              <div class="col-lg-1 p-3">{{$k+1}}.</div>
              <div class="col-lg-11 p-2">
                <div class="row p-2"><div class=" col-lg-11 "> <h5 class="text-danger">{{ucfirst($d->medicine_type)}} - {{ucfirst($d->medicine->medicine_name)}} </h5></div><div class="col-lg-1"><a href="javascript:void(0);" class="fa fa-edit" title="Edit Diagnosis" onclick="editPrescription({{$d->id}})"> &nbsp;<a href="javascript:void(0);" class="fa fa-trash text-danger" title="Delete Diagnosis" ></a></div></div>
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
          <h6>Optical Details</h6>
        </div>
        <div class="card-body collapse show"  id="opticsDiv">
          <a href="javascript:void(0);" class="btn btn-primary" onclick="addOptics({{$id}});">Add Optical details</a>
          <div class="row">
              <div class="col-lg-8" style="margin: 0 auto;padding: 0;">
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
<div class="modal fade" id="prescriptionModal" tabindex="-1" aria-labelledby="prescriptionModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="prescription_body">
      
    </div>
  </div>
</div>
<div class="modal fade" id="opticsModal" tabindex="-1" aria-labelledby="opticsModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="optics_body">
      
    </div>
  </div>
</div>
<div class="modal fade" id="diagnosisModal" tabindex="-1" aria-labelledby="diagnosisModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="diagnosis_body">
      
    </div>
  </div>
</div>
<div class="modal fade" role="dialog" style="" id="modal_remove_element_blog_status">
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
    $(document).on('click', '.change_blogStatus', function (e) {
         blogId= $(this).attr("data_blogId");
         status =$(this).attr("data-status");
         $("#remove_element_status").attr("data_blogId",blogId);
         $("#remove_element_status").attr("data-status",status);
         $("#modal_remove_element_blog_status").modal("show");

     });
    $(document).on('click', '#remove_element_status', function (e) {
         blogId= $(this).attr("data_blogId");
         status =$(this).attr("data-status");
        param = {};
        param.blogId = blogId;
        param.status = status;
        $("#modal_remove_element_blog_status").modal("hide");
        sendRequest($(this), base_url+"/changeBlogStatus" ,'post', param);
     });

    function openDiagnosis(id){
      $.ajax({
        url : "{{url('diagnosis-create')}}/"+id,
        type : "GET",
        success : function(res){
          console.log(res);
          $("#diagnosis_body").html(res);
          $("#diagnosisModal").modal("show");
        }
      })
    }

    function editDiagnosis(id){
      $.ajax({
        url : "{{url('diagnosis-edit')}}/"+id,
        type : "GET",
        success : function(res){
          console.log(res);
          $("#diagnosis_body").html(res);
          $("#diagnosisModal").modal("show");
        }
      })
    }

    function addPrescription(id){
      $.ajax({
        url : "{{url('prescription-create')}}/"+id,
        type : "GET",
        success : function(res){
          console.log(res);
          $("#prescription_body").html(res);
          $("#prescriptionModal").modal("show");
        }
      })
    }

    function addOptics(id){
      $.ajax({
        url : "{{url('optics-create')}}/"+id,
        type : "GET",
        success : function(res){
          console.log(res);
          $("#optics_body").html(res);
          $("#opticsModal").modal("show");
        }
      })
    }

    function editPrescription(id){
      $.ajax({
        url : "{{url('prescription-edit')}}/"+id,
        type : "GET",
        success : function(res){
          console.log(res);
          $("#prescription_body").html(res);
          $("#prescriptionModal").modal("show");
        }
      })
    }

    
</script>
@endsection
