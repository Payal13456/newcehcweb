@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Add Blog</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home')}}">Home</a></li>
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
      <form id="AddBlogForm" method="post" action="{{ route('blog.store') }}" name="AddBlogForm" autocomplete="off" enctype="multipart/form-data">
        <div class="row">
          <div class="col-lg-12  mt-3">
            <label for="cat_id">Category *</label>
            <select id="cat_id" name="cat_id" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px">
              <option value="">Select</option>
              @if(!empty($categorys))
              @foreach($categorys as $category)
              <option value="{{ $category->id}}">{{ $category->category_name}}</option>
              @endforeach
              @endif
            </select>
            <span class="text-danger error-text cat_id_err">
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12  mt-3">
              <label for="title">Title *</label>
              <input id="title" name="title" type="text" class="required form-control"/>
              <span class="text-danger error-text title_err">
            </div>
            <div class="col-lg-6  mt-3">
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12  mt-3">
              <label for="description">Description *</label>
              <textarea  class="form-control" rows="7" cols="5" id="description" name="description" type="text" />
              </textarea>
              <span class="text-danger error-text description_err">
            </div>
            <div class="col-lg-6  mt-3">
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12  mt-3">
              <label for="images">Blog Images </label>
              <input type="file" name="images"  class="custom-file-input form-control" id="customfile" onchange="encodeImageFileAsURL();" accept="image/*" multiple>
                <input type="hidden" name="image[]" id="imgTest">
            </div>
            <div class="col-lg-6 mt-3" id="extra_div">
            </div>
          </div>
          <!-- <div class="row">
            <div class="col-lg-12  mt-3">
              <label for="pdf">PDF </label>
              <input type="file" name="pdf" class="custom-file-input form-control" id="validatedCustomFile" />
            </div>
            <div class="col-lg-6  mt-3">
            </div>
          </div> -->
          <div class="row">
            <div class="col-lg-6  mt-3">
             <button type="submit" class="btn btn-info" data-submit="submit">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    @endsection

    @section('script')
    <script type='text/javascript'>
    var imagebase64 = "";  
    var array = [];
      function encodeImageFileAsURL() {
	var array = [];
	 $("#extra_div").html("");
        var filesSelected = document.getElementById("customfile").files;
           if (filesSelected.length > 0) {
           $("#extra_div").append("<input type='hidden' name='imgcount' value='"+filesSelected.length+"'>");
		 for(i=0;i<filesSelected.length;i++){
		  var fileToLoad = filesSelected[i];
		 	upload(fileToLoad,i); 
		  }
		}
		
           }
      
      function upload(file,i){
      	    var reader = new FileReader();  
	    reader.onloadend = function() {  
		imagebase64 = reader.result;  
		array.push(imagebase64);
		 $("#extra_div").append("<input type='hidden' name='imgfile_"+i+"' value='"+imagebase64+"'>");
	    }  
	    reader.readAsDataURL(file); 
      }
    </script>
    @endsection
