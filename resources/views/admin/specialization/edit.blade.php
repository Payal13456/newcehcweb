@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Edit Specialization Details</h4>
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
      <form  id="editSpecilizationForm" method="post" action="{{ route('specialization.update',$specialization->id) }}" name="editSpecilizationForm" autocomplete="off" enctype="multipart/form-data">
          @method('PUT')   
      
        <div class="row">
          <div class="col-lg-12  mt-3">
            <label for="specialization">Specialization *</label>
            <input id="specialization" value="{{$specialization->specialization}}" name="specialization" type="text" class="required form-control" />
             <span class="text-danger error-text specialization_err">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6  mt-3">
            <a href="{{url('specialization')}}" class="btn btn-danger" >Cancel</a>
             <button type="submit" class="btn btn-info" data-submit="submit">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection