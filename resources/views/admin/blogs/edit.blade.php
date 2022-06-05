@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Edit Blog Details</h4>
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
      <form  id="editBlogForm" method="post" action="{{ route('blog.update',$blog->id) }}" name="editBlogForm" autocomplete="off" enctype="multipart/form-data">
          @method('PUT')   
        <div class="row">
          <div class="col-lg-12  mt-3">
           <label for="cat_id">Category *</label>
            <select id="cat_id" name="cat_id" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px">
                     <option value="">Select</option>
                     @if(!empty($categorys))
                     @foreach($categorys as $category)
                      <option value="{{ $category->id}}" {{ ( $category->id == $blog->cat_id) ? 'selected' : '' }}>{{ $category->category_name}}</option>
                       
                     @endforeach
                     @endif
              </select>
              <span class="text-danger error-text cat_id_err">
        </div>
        </div>
        <div class="row">
          <div class="col-lg-12  mt-3">
            <label for="title">Title *</label>
            <input id="title" value="{{$blog->title}}" name="title" type="text" class="required form-control" />
             <span class="text-danger error-text title_err">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12  mt-3">
            <label for="description">Description *</label>
            <textarea  class="form-control" rows="7" cols="5" id="description" name="description" type="text" />{{$blog->description}}</textarea>
             <span class="text-danger error-text description_err">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12  mt-3">
            <label for="images">Blog Images </label>
            <input type="file" name="images"  class="custom-file-input form-control" id="customfile" onchange="encodeImageFileAsURL();">
            <input type="hidden" name="image" id="imgTest">
          </div>
        </div>
        <!-- <div class="row">
          <div class="col-lg-12  mt-3">
            <label for="pdf">PDF </label>
            <input  type="file" name="pdf" class="custom-file-input form-control" id="validatedCustomFile" />
          </div>
        </div> -->
        <div class="row">
          <div class="col-lg-6  mt-3">
             <a href="{{url('blog')}}" class="btn btn-danger" >Cancel</a>
             <button type="submit" class="btn btn-info" data-submit="submit">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('script')
<script type='text/javascript'>
  function encodeImageFileAsURL() {

    var filesSelected = document.getElementById("customfile").files;
    if (filesSelected.length > 0) {
      var fileToLoad = filesSelected[0];

      var fileReader = new FileReader();

      fileReader.onload = function(fileLoadedEvent) {
        var srcData = fileLoadedEvent.target.result; // <--- data: base64
        $("#imgTest").attr('value',srcData);
        // alert("Converted Base64 version is " + document.getElementById("imgTest").innerHTML);
        console.log($("#imgTest").val());
      }
      fileReader.readAsDataURL(fileToLoad);
    }
  }
</script>
@endsection