@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Edit Patient Details</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home')}} ">Home</a></li>
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
      <form id="editPatientForm" method="post" action="{{ route('patient.update',$patient->id) }}" name="editPatientForm" autocomplete="off" enctype="multipart/form-data"> 
         @method('PUT')         
        <div class="row">
          <div class="col-lg-6  mt-3">
            <label for="first_name">First Name *</label>
            <input id="first_name" value="{{$patient->first_name}}" name="first_name" type="text"
            class="required form-control"/>
          </div>
          <div class="col-lg-6  mt-3">
            <label for="last_name">Last Name *</label>
            <input id="last_name" value="{{$patient->last_name}}" name="last_name" type="text"
            class="required form-control"/>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6  mt-3">
            <label for="email">Email *</label>
            <input id="email" value="{{$patient->email_address}}" name="email_address" type="text"
            class="required email form-control"/>
             <input id="password" value="{{$patient->password}}" name="password" type="hidden"
            class="required password form-control"/>
          </div>
         
          <div class="col-lg-6  mt-3">
             <label for="phone_number_primary">Primary Phone Number *
              <small class="text-muted">9999999999</small>
              </label>
              <input id="phone_number_primary" value="{{$patient->phone_number_primary}}" name="phone_number_primary" type="tel" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required value="" required>
              <span class="text-danger error-text phonenumber_err">
              </span>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6  mt-3">
            <label for="date_of_birth">DOB *
                <small class="text-muted">dd/mm/yyyy</small>
              </label>
              <input id="date_of_birth"  value="{{$patient->date_of_birth}}" name="date_of_birth" type="date" required class=" form-control" value=""/>
              <span class="text-danger error-text date_of_birth_err"></span>
          </div>
          <div class="col-lg-6  mt-3">
            <label for="blood_group">Blood Group *</label>
            <!-- <input id="blood_group" value="{{$patient->blood_group}}" name="blood_group" type="text"
            class="required blood_group form-control" /> -->
            <select class="form-control" name="blood_group" id="blood_group">
              <option value="A+" @if($patient->blood_group == 'A+') selected @endif>A+</option>
              <option value="A-" @if($patient->blood_group == 'A-') selected @endif>A-</option>
              <option value="B+" @if($patient->blood_group == 'B+') selected @endif>B+</option>
              <option value="B-" @if($patient->blood_group == 'B-') selected @endif>B-</option>
              <option value="O+" @if($patient->blood_group == 'O+') selected @endif>O+</option>
              <option value="O-" @if($patient->blood_group == 'O-') selected @endif>O-</option>
              <option value="AB+" @if($patient->blood_group == 'AB+') selected @endif>AB+</option>
              <option value="AB-" @if($patient->blood_group == 'AB-') selected @endif>AB-</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6  mt-3">
            <label for="gender" style="display: block;">
              Gender *
            </label>
            <input type="radio" value="1" class="form-check-input" id="gender" name="gender" required {{ ($patient->gender =="1")? "checked" : "" }} />
            <label class="form-check-label mb-0"  for="customControlValidation2" >Male</label>
            <input type="radio" class="form-check-input"
            id="customControlValidation2" name="gender" value="2" id="gender2" required {{ ($patient->gender =="2")? "checked" : "" }}/>
            <label class="form-check-label mb-0" name="gender" for="customControlValidation2" >Female</label>
            <input  type="radio" class="form-check-input" required id="gender3" name="gender" value="3" id="customControlValidation1"  {{ ($patient->gender =="3")? "checked" : "" }}/>
            <label class="form-check-label mb-0" for="customControlValidation1" >Others</label>
            <br />
          </div>
          <div class="col-lg-6  mt-3">
            <label for="adhar_card">Aadhar Number *</label>
            <input id="adhar_card" value="{{$patient->adhar_card}}" name="adhar_card" type="text"  required onkeypress="return event.charCode >= 48 && event.charCode <= 57"
            class="required form-control"/>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 mt-3">
            <label for="address">Address *</label>
            <textarea  class="form-control" rows="7" cols="5"
            id="address" name="address" type="text"/>{{str_replace(' ','',$patient->address)}}</textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6  mt-3">
            <label for="city">City *</label>
            <input id="city" name="city" value="{{$patient->city}}" type="text" class="required form-control"/>
          </div>
          <div class="col-lg-6  mt-3">
            <label for="pincode">Pincode *</label>
            <input id="pincode" value="{{$patient->pincode}}" name="pincode" type="text"
            class="required form-control"/>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6  mt-3">
              <label for="state_id">State *</label>
              <select name="state_id" id="state_id" class=" form-control" required>
                <option value="">Select</option>
                  @if(!empty($getAllState))
                    @foreach($getAllState as $state)
                      <option value="{{ $state->id}}" <?php echo ($patient->state_id==$state->id)?"selected":""; ?>>{{ $state->state_name}}</option>
                    @endforeach
                  @endif
             </select>
              <span class="text-danger error-text state_id_err">
             </span>
          </div>
          <div class="col-lg-6  mt-3">
            <label for="type_of_patient">Patient Type *</label>
            <select name="type_of_patient" class="required form-control">
            <option value="">Select</option>
            <option value="1" <?php  echo ($patient->type_of_patient==1) ? "selected" : "" ?>>Free</option>
            <option value="2" <?php  echo ($patient->type_of_patient==2) ?  "selected" : "" ?>>Paid</option>
          </select>
        </div>
        
        <div class="row">
          <div class="col-lg-6  mt-3">
            <a href="{{url('patient')}}" class="btn btn-danger" >Cancel</a>
            <button type="submit" class="btn btn-info" data-submit="submit">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
