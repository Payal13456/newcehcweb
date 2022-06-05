@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Edit Category Details</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
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
      <form id="editCategoryForm" method="post" action="{{ route('category.update',$getCategory->id) }}" name="editCategoryForm" autocomplete="off" enctype="multipart/form-data">
         @method('PUT')  
        <div class="row mt-3">
          <div class="col-lg-6 ">
            <label for="title">Category Name *</label>
            <input id="title" value="{{$getCategory->category_name}}" name="category_name" type="text" class="required form-control" />
            <span class="text-danger error-text category_name_err">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6  mt-3">
            <a href="{{url('category')}}" class="btn btn-danger" >Cancel</a>
            <button type="submit" class="btn btn-info" data-submit="submit">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection