@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Add Roles</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
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
      <form  id="AddFaqForm" method="post" action="{{ route('roles.store') }}" name="AddFaqForm" autocomplete="off" enctype="multipart/form-data">
        <div class="row mt-3">
          <div class="col-lg-12 ">
            <label for="notification_type">Name *</label>
            <input id="name" name="name" type="text" class="required form-control" />
             <span class="text-danger error-text name_err">
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-lg-12 ">
            <label for="title">Guard Name *</label>
            <input id="guard_name" name="guard_name" type="text" class="required form-control" />
             <span class="text-danger error-text guard_name_err">
          </div>
        </div>
        <div class="row mt-3">
          <label for="title">Permissions *</label>
          @if(!empty($permissions) > 0)
            @foreach($permissions as $k=>$p)
                <div class="col-lg-3 ">
                  <label for="permission_{{$k}}"> <input type="checkbox" name="permissions[]" value="{{ $p->id }}" id="permission_{{$k}}"> {{$p->name}} 
                  </label>
                </div>
            @endforeach
          @endif
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