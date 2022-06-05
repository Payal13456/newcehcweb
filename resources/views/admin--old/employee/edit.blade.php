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
                  class="required form-control" />
              </div>
            </div>    
            <div class="row">
              <div class="col-lg-6  mt-3">
                <label for="email">Email *</label>
                <input id="email" name="email" type="text"
                  class="required email form-control"/>
              </div>
              <div class="col-lg-6  mt-3">
                <label for="phonenumber">Phone Number *</label>
                <input id="phonenumber" name="phonenumber" type="text"
                  class="required phonenumber form-control"/>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6  mt-3">
                 <label for="email">Aadhar Number *</label>
                <input id="email" name="email" type="text"
                  class="required email form-control"/>
              </div>
              <div class="col-lg-6  mt-3">                
                <label for="customControlValidation2" style="display: block;">Gender *</label>
                <input type="radio" class="form-check-input"  required
                  id="customControlValidation2" name="radio-stacked"/>
                <label class="form-check-label mb-0" for="customControlValidation2">Male</label>
                <input type="radio" class="form-check-input" required
                  id="customControlValidation2" name="radio-stacked"/>
                <label class="form-check-label mb-0" 
                       for="customControlValidation2">Female</label>
                <input type="radio" class="form-check-input" required
                  id="customControlValidation1" name="radio-stacked"/>
                <label class="form-check-label mb-0" for="customControlValidation1">Others</label><br />
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6  mt-3">
                <label for="name">DOB *</label>
                <input id="month_dob" name="month_dob" type="date"
                  class="required form-control"/>
              </div>
              <div class="col-lg-6  mt-3">
                <label for="role_id">Role *</label>
                <select name="role_id" class="required form-control">
                       <optgroup>Select</optgroup>
                       <option>Doctor</option>
                       <option>Sub Admin</option>
                       <option>Receptionist</option>
                       <option>Optometric</option>
                       <option>Manager</option>
                     </select>
              </div>
            </div> 
            <div class="row">
              <div class="col-lg-6  mt-3"></div>
              <div class="col-lg-6  mt-3"></div>
            </div>             
            <div class="row">
              <div class="col-lg-6  mt-3">
                <label for="email">Education Qualification *</label>
                <input id="qualification" name="qualification" type="text"
                  class="required form-control"/>
              </div>
              <div class="col-lg-6  mt-3">
                     <label for="specialization_id">Seclilzation Details Here if Dr *</label>
                     <select name="specialization_id" class="required form-control">
                       <optgroup>Select</optgroup>
                       <option>MMBS</option>
                       <option>MMBS</option>
                       <option>MMBS</option>
                       <option>MMBS</option>
                     </select>
              <br/>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6  mt-3">
                <label for="description">Description *</label>
                <textarea class="form-control" rows="7" cols="5"
                  id="description" name="description" type="text"/>
                </textarea>
              </div>
              <div class="col-lg-6  mt-3">
                <label for="address">Address *</label>
                <textarea class="form-control" rows="7" cols="5"
                  id="address" name="address" type="text"/>
                </textarea>        
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6  mt-3">
                 <label for="validatedCustomFile">Profile Picture</label>
                  <input type="file" class="custom-file-input form-control" id="validatedCustomFile" required/>
              </div>
              <div class="col-lg-6  mt-3">              
                <button type="button" style="margin-top: 25px; width: 100px;color: #fff;" class="btn btn-success"> Save </button>
              </div>
            </div> 
          <section></section>
        </form>
      </div>
    </div>
  </div>
@endsection