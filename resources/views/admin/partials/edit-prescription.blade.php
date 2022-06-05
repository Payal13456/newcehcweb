<style type="text/css">
.eye_details td, .eye_details th { padding: 0;
  }
</style>
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Edit prescription</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="AddBlogForm" method="post" action="{{ route('prescription.update',$id) }}" name="AddBlogForm" autocomplete="off" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="modal-body">
    <div class="row">
      <div class="col-lg-12  mt-3">
        <label for="medicine_type">Medicine Type *</label>
        <select class="form-control" name="medicine_type" id="medicine_type">
          <option value="">Select Medicine Type</option>
          <option value="syrup" @if($prescription->medicine_type == 'syrup') selected @endif>Syrup</option>
          <option value="tablet" @if($prescription->medicine_type == 'tablet') selected @endif>Tablet</option>
        </select>
        <span class="text-danger error-text name_err"></span>
      </div>
      <div class="col-lg-6  mt-3">
      </div>
    </div>
    <div class="row">
      <div class="col-lg-5  mt-3">
        <input type="hidden" name="appointment_id" value="{{$prescription->appointment_id}}" />
        <label for="medicine_name">Medicine Name *</label>
        <input list="medicineName" id="medicine_name" name="medicine_name" class="form-control" placeholder="" value="{{$prescription->medicine->medicine_name}}" />
        <datalist id="medicineName">
          @if(count($medicine) > 0) 
            @foreach($medicine as $m)
              <option value="{{$m->medicine_name}}">
            @endforeach
          @endif
        </datalist>
      </div>

      <div class="col-lg-5  mt-3">
        <label for="generic_medicine_name">Generic Medicine Name *</label>
        <!-- <input id="medicine_name" name="medicine_name" type="text" onkeyup="getmedicinelist(this.value)" class="required form-control" required />
        <span class="text-danger error-text name_err"></span> -->
        <input list="genericName" id="generic_medicine_name" name="generic_medicine_name" class="form-control" placeholder="" value="{{$prescription->medicine->generic_name}}"/>
        <datalist id="genericName">
           @if(count($medicine) > 0) 
            @foreach($medicine as $m)
              <option value="{{$m->generic_name}}">
            @endforeach
          @endif
        </datalist>
      </div>
      <div class="col-lg-2  mt-3">
        <label for="mg_ml">Mg / Ml *</label>
        <input id="mg_ml" name="mg_ml" type="text" class="required form-control" required value="{{$prescription->mg_ml}}"/>
        <span class="text-danger error-text name_err"></span>
        
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3  mt-3">
        <label for="duration">Duration</label>
        <input id="duration" name="duration" type="number" class="required form-control" required value="{{$prescription->duration}}"/>
        <span class="text-danger error-text name_err"></span>
      </div>
    
      <div class="col-lg-3  mt-3">
        <label for="dose">No of dose *</label>
        <select class="form-control" name="dose">
          <option>Select dose</option>
          <option value="1/2" @if($prescription->dose == 1/2) selected @endif>1/2</option>
          <option value="1" @if($prescription->dose == 1) selected @endif>1</option>
          <option value="2" @if($prescription->dose == 2) selected @endif>2</option>
          <option value="3" @if($prescription->dose == 3) selected @endif>3</option>
          <option value="4" @if($prescription->dose == 4) selected @endif>4</option>
          <option value="5" @if($prescription->dose == 5) selected @endif>5</option>
        </select>
        <span class="text-danger error-text name_err"></span>
      </div>
      <div class="col-lg-6  mt-3">
        <label for="food">Food *</label>
        <div class="row">
          <div class="col-md-6">
            <input id="food" name="food[]" type="checkbox" class="required" value="Before Food" @if(str_contains($prescription->food,'Before Food')) checked @endif/> Before Food 
          </div>
          <div class="col-md-6">
            <input id="food" name="food[]" type="checkbox" class="required" value="After Food" @if(str_contains($prescription->food,'After Food')) checked @endif/> After Food
          </div>
        </div>
        <span class="text-danger error-text name_err"></span>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12  mt-3">
        <label for="timing">Timing *</label>
        <div class="row">
          <div class="col-md-3">
            <input id="timing" name="time[]" type="checkbox" class="required" value="morning" @if(str_contains($prescription->timing,'morning')) checked @endif/> Morning 
          </div>
          <div class="col-md-3">
            <input id="timing" name="time[]" type="checkbox" class="required" value="afternoon" @if(str_contains($prescription->timing,'afternoon')) checked @endif/> After Noon
          </div>
          <div class="col-md-3">
            <input id="timing" name="time[]" type="checkbox" class="required" value="evening" @if(str_contains($prescription->timing,'evening')) checked @endif/> Evening
          </div>
          <div class="col-md-3">
            <input id="timing" name="time[]" type="checkbox" class="required" value="night" @if(str_contains($prescription->timing,'night')) checked @endif/> Night
          </div>
        </div>
      <div class="col-lg-6  mt-3">
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12  mt-3">
        <label for="instruction">Instruction *</label>
        <textarea  class="form-control" rows="7" cols="5" id="instruction" name="instruction" required type="text" >{{$prescription->instruction}}
        </textarea>
        <span class="text-danger error-text instruction_err"></span>
      </div>
      <div class="col-lg-6 mt-3">
      </div>
    </div>
  </div>
 
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-info" data-submit="submit">Submit</button>
  </div>
</form>

<script type="text/javascript">
  function getmedicinelist(keyword){
    console.log("keyword------"+keyword);
      $.ajax({
        url : "{{url('medicines')}}/"+keyword,
        type : "GET",
        success : function(res){
          $("#medicine_div").html(res);
        }
      })
    }

    function medicine(value){
      console.log($(value).html());
       $("#medicine_name").val($(value).html());
       $('#medicine_div') .html('');
    }
</script>