@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Add New Patient</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
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
      <form id="AddPatientForm" method="post" action="{{ route('patient.store') }}" name="AddPatientForm" autocomplete="off" enctype="multipart/form-data">
        <div class="row">
          <div class="col-lg-6  mt-3">
            <label for="first_name">First Name *</label>
            <input id="first_name" name="first_name" type="text"
            class="required form-control"/>
            <span class="text-danger error-text first_name_err">
            </div>
            <div class="col-lg-6  mt-3">
              <label for="last_name">Last Name *</label>
              <input  id="last_name" name="last_name" type="text"
              class="required form-control"/>
              <span class="text-danger error-text last_name_err">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6  mt-3">
                <label for="email">Email *</label>
                <input id="email" name="email_address" type="text" class="required email form-control"/>
                <span class="text-danger error-text email_err">
                <input id="password"  name="password" type="hidden" class="required password form-control" value="test1234"/>
                </div>
                  <div class="col-lg-6  mt-3">
                    <label for="phone_number_primary">Primary Phone Number *<small class="text-muted">9999999999</small></label>
                    <input id="phone_number_primary" name="phone_number_primary"
                    type="text" class="required form-control"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" required />
                    <span class="text-danger  error-text phone_number_primary_err">
                    </div>
                   
                  </div>
                  <div class="row">
                    <div class="col-lg-6  mt-3">
                      <label for="date_of_birth">DOB *</label>
                      <input id="date_of_birth" name="date_of_birth" type="date"
                      class="required date_of_birth form-control"/>
                      <span class="text-danger error-text date_of_birth_err">
                      </div>
                      <div class="col-lg-6  mt-3">
                        <label for="blood_group">Blood Group *</label>
                        <select class="form-control" name="blood_group" id="blood_group">
                          <option value="A+">A+</option>
                          <option value="A-">A-</option>
                          <option value="B+">B+</option>
                          <option value="B-">B-</option>
                          <option value="O+">O+</option>
                          <option value="O-">O-</option>
                          <option value="AB+">AB+</option>
                          <option value="AB-">AB-</option>
                        </select>
                        <!-- <input id="blood_group" name="blood_group" type="text"
                        class="required blood_group form-control"/>
                         --><span class="text-danger error-text blood_group_err">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6  mt-3">
                          <label for="gender" style="display: block;">Gender *</label>
                          <input type="radio" class="form-check-input" checked id="gender" value="1" name="gender" required/>
                          <label class="form-check-label mb-0" for="customControlValidation2">Male</label>
                          <input type="radio" class="form-check-input" required id="customControlValidation2" id="gender2" value="2" name="gender"/>
                          <label class="form-check-label mb-0" for="customControlValidation2">Female</label>
                          <input type="radio" class="form-check-input" required
                          id="customControlValidation1" name="gender" value="3" id="gender3"/>
                          <label class="form-check-label mb-0" for="customControlValidation1">Others</label>
                        </div>
                        <div class="col-lg-6  mt-3">
                          <label for="adhar_card">Aadhar Number *</label>
                          <input id="adhar_card" name="adhar_card" type="text" class="required form-control"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" required  />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6  mt-3">
                          
                          <label for="address">Address *</label>
                          <textarea class="form-control" rows="7" cols="5"
                          id="address" name="address" type="text"/></textarea>
                        </div>
                        <div class="col-lg-6  mt-3"> 
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6  mt-3">
                          <label for="city">City *</label>
                          <input id="city" name="city" type="text" class="required form-control" />
                        </div>
                        <div class="col-lg-6  mt-3">
                          <label for="pincode">Pin-Code *</label>
                          <input id="pincode" name="pincode" type="text"
                          class="required form-control"/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6 mt-3 ">
                          <label for="state_id">State *</label>
                          <select name="state_id" id="state_id" class=" form-control" required>
                            <option value="">Select</option>
                            @if(!empty($getAllState))
                            @foreach($getAllState as $state)
                            <option value="{{ $state->id}}">{{ $state->state_name}}</option>
                            @endforeach
                            @endif
                          </select>
                          <span class="text-danger error-text state_id_err">
                          </span>
                        </div>
                        <div class="col-lg-6 mt-3">
                          <label for="type_of_patient">Patient Type *</label>
                          <select name="type_of_patient" class="required form-control" required>
                            <option value="">Select</option>
                            <option value="1">Free</option>
                            <option value="2">Paid</option>
                          </select>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-lg-6  mt-3">
                          <button type="submit" class="btn btn-info" data-submit="submit">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              @endsection
