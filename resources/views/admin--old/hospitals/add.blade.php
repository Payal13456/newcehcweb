@extends('admin.layouts.admin_layouts')
@section('content')
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 d-flex no-block align-items-center">
        <h4 class="page-title">Add New Hospital</h4>
        <div class="ms-auto text-end">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('home')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">
                Create
              </li>
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
                <label for="first_name">Hospital name *</label>
                <input id="first_name" name="first_name" type="text"
                  class="required form-control" />
              </div>
              <div class="col-lg-6  mt-3">
                <label for="last_name">Email *</label>
                <input id="last_name" name="last_name" type="text"
                  class="required form-control" />
              </div>
            </div>    
            <div class="row">
              <div class="col-lg-6  mt-3">
                 <label for="primary_number">Primary Phone *</label>
                <input id="primary_number" name="primary_number"
                  type="text" class="required primary_number form-control"/>
              </div>
              <div class="col-lg-6  mt-3">
                 <label for="secondary_number">Secondary Phone </label>
                <input id="secondary_number" name="secondary_number"
                  type="text" class="required secondary_number form-control" />
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6  mt-3">
               <label for="description">Select Employee Form Manage Hospital *</label>
                 <select name="role_id" class="required form-control">
                       <optgroup>Select</optgroup>
                       <option>Pankaj</option>
                       <option>Anjali</option>
                       <option>Ravi</option>
                     </select>
              </div>
              <div class="col-lg-6  mt-3">
                <label for="location">Map Location Link *</label>
                <input id="location" name="location"
                  type="text" class="required location form-control"/>
              </div>
            </div>
             <div class="row">
              <div class="col-lg-6  mt-3">
                <label for="address">Address *</label>
                <textarea class="form-control" rows="7" cols="5"
                  id="address" type="text"/></textarea>
              </div>
              <div class="col-lg-6  mt-3"></div>
            </div>
            <div class="row">
              <div class="col-lg-6  mt-3">
                  <button type="button" style="margin-top: 30px; width: 100px; color: #fff;" class="btn btn-success">Save</button>
              </div>
              <div class="col-lg-6  mt-3"></div>
            </div>
            <!-- </section> -->
            <section></section>
          <!-- </div> -->
        </form>
      </div>
    </div>
  </div>
@endsection