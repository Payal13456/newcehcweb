@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Edit Employee Details</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="card">
    <div class="card-body wizard-content">
      <form id="editEmployeeForm" method="post" action="{{ route('employee.update',$getAllEmp->id) }}" name="editEmployeeForm" autocomplete="off" enctype="multipart/form-data">
        @method('PUT')
        <div class="row">
          <div class="col-lg-6 mt-3 ">
            <label for="first_name">First name *</label>
            <input id="first_name" name="first_name" type="text"
            class="form-control" value="{{ $getAllEmp->first_name}}" required/>
            <span class="text-danger error-text first_name_err">
            </span>
          </div>
          <div class="col-lg-6 mt-3">
            <label for="last_name">Last name *</label>
            <input id="last_name" name="last_name" type="text"
            class="form-control" value="{{ $getAllEmp->last_name}}" required/>
            <span class="text-danger error-text last_name_err"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 mt-3">
            <label for="emailAddress">Email *</label>
            <input id="emailAddress" name="emailAddress" type="email" class=" form-control" value="<?php echo $getAllEmp->user->email; ?>" required=""/>
            <span class="text-danger error-text emailAddress_err">
            </span>
          </div>
          <div class="col-lg-6 mt-3">
            <label for="phonenumber">Phone Number *
              <small class="text-muted">9999999999</small>
            </label>
            <input id="phonenumber" name="phonenumber" type="tel" class="form-control " value="{{ $getAllEmp->phonenumber }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
            <span class="text-danger error-text phonenumber_err">
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 mt-3">
            <label for="adharNumber">Aadhar Number *
              <small class="text-muted">121212121212</small>
            </label>
            <input id="adharNumber" name="adharNumber" type="text" class="form-control "  value="{{ $getAllEmp->aadharnumber }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required />
            <span class="text-danger error-text adharNumber_err">
            </span>
          </div>
          <div class="col-lg-6 mt-3">
            <label for="gender" style="display: block;">Gender *</label>
            <input type="radio" class="form-check-input customControlValidation2 radio-stacked" id="gender"
            name="gender" value="0"  required {{ ($getAllEmp->gender =="0")? "checked" : "" }}/>
            <label class="form-check-label mb-0" for="customControlValidation2" >Male</label>
            <input type="radio" class="form-check-input customControlValidation2 radio-stacked" id="gender1"
            name="gender" value="1"  required {{ ($getAllEmp->gender =="1")? "checked" : "" }}/>
            <label class="form-check-label mb-0" for="customControlValidation2" >Female</label>
            <input type="radio" class="form-check-input customControlValidation2 radio-stacked" id="gender2"
            name="gender" value="2"  required {{ ($getAllEmp->gender =="2")? "checked" : "" }}/>
            <label class="form-check-label mb-0" for="customControlValidation2" >Other</label>
            <span class="text-danger error-text gender_err"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 mt-3">
            <label for="name">DOB *
              <small class="text-muted">dd/mm/yyyy</small>
            </label>
            <input id="dob" name="dob" type="date" required class=" form-control" value="{{ $getAllEmp->month_dob }}"/>
            <span class="text-danger error-text dob_err"></span>
          </div>
          <div class="col-lg-6 mt-3">
            <label for="role">Role *</label>
            <select id="role" name="role" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px">
              <option value="">Select</option>
              @if(!empty($getAllRoles))
              @foreach($getAllRoles as $role)
              <option value="{{ $role->id}}" {{ ( $role->id == $getAllEmp->role_id) ? 'selected' : '' }}>{{ $role->name}}</option>
              @endforeach
              @endif
            </select>
            <span class="text-danger error-text role_err"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 mt-3">
            <label for="email">Education Qualification *</label>
            <input id="qualification" name="qualification" type="text" class="form-control" required value="{{ $getAllEmp->education_qulaification }}" />
            <span class="text-danger error-text qualification_err">
            </span>
          </div>
          <div class="col-lg-6 mt-3">
            <label for="specialization">Specialization *</label>
            <select name="specialization" id="specialization" class=" form-control" required>
              <option value="">Select</option>
              @if(!empty($getAllspecializations))
              @foreach($getAllspecializations as $spec)
              <option value="{{ $spec->id}}"  {{ ( $spec->id == $getAllEmp->specialization_id) ? 'selected' : '' }}>{{ $spec->specialization}}</option>
              @endforeach
              @endif
            </select>
            <span class="text-danger error-text specialization_err">
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 mt-3">
            <label for="description">Description *</label>
            <textarea  class="form-control" rows="7" cols="5"
            id="description" name="description" type="text"
            required=""/>{{ $getAllEmp->description }}</textarea>
            <span class="text-danger error-text description_err">
            </span>
          </div>
          <div class="col-lg-6 mt-3">
            <label for="address">Address *</label>
            <textarea class="form-control" rows="7" cols="5" id="address" name="address" type="text" required="" />{{ $getAllEmp->address }}</textarea>
            <span class="text-danger error-text address_err">
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 mt-3 ">
            <label for="city">City *</label>
            <input id="city" value="{{$getAllEmp->city}}" name="city" type="text"
            class="form-control" value="" required/>
            <span class="text-danger error-text city_err">
            </span>
          </div>
          <div class="col-lg-6 mt-3">
            <label for="state_id">State *</label>
            <select name="state_id" id="state_id" class=" form-control" required>
              <option value="">Select</option>
              @if(!empty($getAllState))
              @foreach($getAllState as $state)
              <option value="{{ $state->id}}" <?php echo ($getAllEmp->state_id==$state->id)?"selected":""; ?>>{{ $state->state_name}}</option>
              @endforeach
              @endif
            </select>
            <span class="text-danger error-text state_id_err">
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 mt-3">
            <label for="profilePic">Profile Picture</label>
            <input type="file" class="custom-file-input form-control" id="customfile" name="customfile" onchange="encodeImageFileAsURL();" accept="image/*">
            <input type="hidden" name="profilePic" id="imgTest">
          </div>
        </div>
         <div class="row">
          <div class="col-lg-6 mt-3">
            <a href="{{url('employee')}}" class="btn btn-danger" >Cancel</a>
           <button type="submit" class="btn btn-info" data-submit="submit">Submit</button>
          </div>
          <div class="col-lg-6 mt-3">
            
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
<script type='text/javascript'>
  function encodeImageFileAsURL() {

    var filesSelected = document.getElementById("customfile").files;
    if (filesSelected.length > 0) {
      var fileToLoad = filesSelected[0];

      var fileReader = new FileReader();

      fileReader.onload = function(fileLoadedEvent) {
        var srcData = fileLoadedEvent.target.result; // <--- data: base64
        $("#imgTest").attr('value',srcData);
        // alert("Converted Base64 version is " + document.getElementById("imgTest").innerHTML);
        console.log($("#imgTest").val());
      }
      fileReader.readAsDataURL(fileToLoad);
    }
  }
</script>