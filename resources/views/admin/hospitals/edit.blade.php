@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Edit Hospital Details</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">
              Hospital
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
      <form id="editHospitalForm" method="post" action="{{ route('hospital.update',$getHospital->id) }}" name="editHospitalForm" autocomplete="off" enctype="multipart/form-data">
         @method('PUT')
        <div class="row">
          <div class="col-lg-6  mt-3">
            <label for="name">Hospital Name *</label>
            <input id="name" value="{{ucfirst($getHospital->name)}}" name="name" type="text"
            class="required form-control">
            <span class="text-danger error-text name_err">
          </div>
          <div class="col-lg-6  mt-3">
            <label for="email">Email *</label>
            <input id="email" value="{{$getHospital->email}}" name="email" type="text"
            class="required form-control"/>
            <span class="text-danger error-text email_err">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6  mt-3">
            <label for="primary_number">Primary Phone Number *
              <small class="text-muted">9999999999</small>
            </label>
            <input id="primary_number"  value="{{$getHospital->primary_number}}"  name="primary_number" type="text" class="required primary_number  form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required/>
            <span class="text-danger error-text primary_number_err">
          </div>
          <div class="col-lg-6  mt-3">
            <label for="secondary_number">Secondary Phone Number 
              <small class="text-muted">9999999999</small>
            </label>
            <input id="secondary_number"  value="{{$getHospital->secondary_number}}"  name="secondary_number"type="text" class="required  secondary_number form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
             <span class="text-danger error-text secondary_number_err">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6  mt-3">
            <label for="description">Select Employee For Manage Hospital *</label>
               <select id="user_id" name="user_id" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px">
                     <option value="">Select</option>
                     @if(!empty($getEmployees))
                     @foreach($getEmployees as $employee)
                        <option value="{{ $employee->id}}" {{ ( $employee->id == $getHospital->user_id) ? 'selected' : '' }}>{{ ucfirst($employee->first_name)}}  {{ucfirst($employee->last_name)}} | <?php echo ucfirst($employee->user->email);  ?> | <?php echo ucfirst($employee->roles->name);  ?> </option>
                     @endforeach
                     @endif
              </select>
              <span class="text-danger error-text user_id_err"></span>
          </div>
          <div class="col-lg-6  mt-3">
            <label for="location">Map Location Link </label>
            <input id="location"   value="{{$getHospital->location}}" name="location" type="text"
            class="required location form-control"/>
            <span class="text-danger error-text location_err"></span>
          </div>
        </div>
        <div class="row">
        <div class="col-lg-6  mt-3">
          <label for="address">Address *</label>
          <textarea class="form-control" rows="7" cols="5"
          id="address" name="address" type="text"/>
           {{$getHospital->address}}  
          </textarea>
          <span class="text-danger error-text address_err"></span>
        </div>
        <div class="col-lg-6  mt-3"></div>
      </div>
        <div class="row">
            <div class="col-lg-6 mt-3 ">
              <label for="city">City *</label>
              <input id="city" value="{{$getHospital->city}}" name="city" type="text"
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
                  <option value="{{ $state->id}}" <?php echo ($getHospital->state_id==$state->id)?"selected":""; ?>>{{ $state->state_name}}</option>
                @endforeach
                @endif
             </select>
              <span class="text-danger error-text state_id_err">
             </span>
            </div>
          </div> 
      
      <div class="row">
        <div class="col-lg-6  mt-3">
          <a href="{{url('hospital')}}" class="btn btn-danger" >Cancel</a>
          <button type="submit" class="btn btn-info" data-submit="submit">Submit</button>
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