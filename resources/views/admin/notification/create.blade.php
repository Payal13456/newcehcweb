@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Add Notification</h4>
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
      <form  id="AddFaqForm" method="post" action="{{ route('notifications.store') }}" name="AddFaqForm" autocomplete="off" enctype="multipart/form-data">
        <div class="row mt-3">
          <div class="col-lg-12 ">
            <label for="notification_type">Notification Type *</label>
            <input id="notification_type" name="notification_type" type="text" class="required form-control" />
             <span class="text-danger error-text notification_type_err">
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-lg-12 ">
            <label for="title">Title *</label>
            <input id="title" name="title" type="text" class="required form-control" />
             <span class="text-danger error-text title_err">
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-lg-12">
            <label for="description">Description *</label>
            <textarea name="description" class="form-control" rows="7" cols="5" id="editor1" type="text" />
            </textarea>
             <span class="text-danger error-text description_err">
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