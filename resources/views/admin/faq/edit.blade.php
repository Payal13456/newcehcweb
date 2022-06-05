@extends('admin.layouts.admin_layouts')
@section('content')
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 d-flex no-block align-items-center">
        <h4 class="page-title">Edit Faq Details</h4>
        <div class="ms-auto text-end">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
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
        <form  id="editFaqForm" method="post" action="{{ route('faq.update',$faq->id) }}" name="editFaqForm" autocomplete="off" enctype="multipart/form-data">
          @method('PUT') 
          <div class="row mt-3">
          <div class="col-lg-12 ">
            <label for="cat_id">Category *</label>
            <select id="cat_id" name="cat_id" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px">
              <option value="">Select</option>
              @if(!empty($categorys))
              @foreach($categorys as $category)
             <option value="{{ $category->id}}" {{ ( $category->id == $faq->cat_id) ? 'selected' : '' }}>{{ $category->category_name}}</option>
              @endforeach
              @endif
            </select>
            <span class="text-danger error-text cat_id_err"></span>
          </div>
        </div>
            <div class="row mt-3">
              <div class="col-lg-12  mt-3">
               <label for="title">Title *</label>
                <input
                  id="title" value="{{$faq->title}}" name="title" type="text" class="required form-control"/>
                  <span class="text-danger error-text title_err">
              </div>
              <div class="col-lg-6  mt-3">
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-lg-12">
                  <label for="description">Description *</label>
                  <textarea class="form-control" rows="7" cols="5" id="editor1" name="description" type="text"/>
                  {{$faq->description}}
                </textarea>
                <span class="text-danger error-text description_err">
              </div>
            </div>
          <div class="row">
            <div class="col-lg-6  mt-3">
              <a href="{{url('faq')}}" class="btn btn-danger" >Cancel</a>
               <button type="submit" class="btn btn-info" data-submit="submit">Submit</button>
            </div>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
  