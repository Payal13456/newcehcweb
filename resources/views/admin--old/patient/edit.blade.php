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
        <form id="example-form" action="#" class="mt-5">          
            <div class="row">
              <div class="col-lg-6  mt-3">
                <label for="first_name">First name *</label>
                <input id="first_name" name="first_name" type="text"
                  class="required form-control"/>
              </div>
              <div class="col-lg-6  mt-3">
                <label for="last_name">Last name *</label>
                <input id="last_name" name="last_name" type="text"
                  class="required form-control"/>
              </div>
            </div>    
            <div class="row">
              <div class="col-lg-6  mt-3">
                 <label for="email">Email *</label>
                <input id="email" name="email" type="text"
                  class="required email form-control"/>
              </div>
              <div class="col-lg-6  mt-3">
                <label for="password">Password *</label>
                <input id="password" name="password" type="text"
                  class="required password form-control"/>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6  mt-3">
                <label for="phone_number_primary">Primary Phone *</label>
                <input id="phone_number_primary" name="phone_number_primary" type="text" class="required  form-control" />
              </div>
              <div class="col-lg-6  mt-3">
                <label for="phone_number_secondary">
                  Secondry Phone *
                </label>
                <input id="phone_number_secondary" name="phone_number_secondary" type="text" class="required  form-control" />
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6  mt-3">
                <label for="date_of_birth">DOB *</label>
                <input id="date_of_birth" name="date_of_birth" type="text"
                  class="required date_of_birth form-control"/>
              </div>
              <div class="col-lg-6  mt-3">
                <label for="blood_group">Blood Gropu *</label>
                <input id="blood_group" name="blood_group" type="text"
                  class="required blood_group form-control" />
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6  mt-3">
                <label for="gender" style="display: block;">
                  Gender *
                </label>
                <input type="radio" class="form-check-input"
                       id="gender" name="gender" required />
                <label class="form-check-label mb-0" for="customControlValidation2" >Male</label>
                <input type="radio" class="form-check-input"
                  id="customControlValidation2" name="radio-stacked"
                  required/>
                <label class="form-check-label mb-0" for="customControlValidation2" >Female</label>
                <input  type="radio" class="form-check-input" required
                  id="customControlValidation1" name="radio-stacked"/>
                <label class="form-check-label mb-0" for="customControlValidation1" >Others</label>
                <br />
              </div>
              <div class="col-lg-6  mt-3">
                <label for="adhar_card">Addhar No *</label>
                <input id="adhar_card" name="adhar_card" type="text"
                  class="required form-control"/>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6  mt-3">
                <label for="city">City *</label>
                <input id="city" name="city" type="text" class="required form-control"/>
              </div>
              <div class="col-lg-6  mt-3">
                <label for="pincode">Pincode *</label>
                <input id="pincode" name="pincode" type="text"
                  class="required form-control"/>
              </div>
            </div> 
            <div class="row">
              <div class="col-lg-6  mt-3">                
                <label for="address">Address *</label>
                <textarea  class="form-control" rows="7" cols="5"
                  id="address" name="address" type="text"/></textarea>
              </div>
              <div class="col-lg-6  mt-3">
                <label for="type_of_patient">Patient Type *</label>
                <select name="type_of_patient" class="required form-control">
                  <optgroup>Select</optgroup>
                  <option>Free</option>
                  <option>Paid</option>
                </select>
              </div>
            </div> 
            <div class="row">
              <div class="col-lg-6  mt-3"></div>
              <div class="col-lg-6  mt-3"></div>
            </div>
            <div class="row">
              <div class="col-lg-6  mt-3">
                <button type="button" style="margin-top: 30px; width: 100px; color: #fff;" class="btn btn-success">Update</button>
              </div>
            </div>
            <section></section>
        </form>
      </div>
    </div>
  </div>
@endsection