@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Edit Privacy Details</h4>
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
      <form  id="editPlanForm" method="post" action="{{ route('privacy.update',$privacy->id) }}" name="editPlanForm" autocomplete="off" enctype="multipart/form-data">
          @method('PUT')   
        <div class="row">
          <div class="col-lg-6  mt-3">
            <label for="title">Title *</label>
            <input id="title" name="title" value="{{$privacy->title}}" type="text" class="required form-control" />
            <span class="text-danger error-text name_err">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6  mt-3">
            <label for="description">Description *</label>
            <textarea id="description" name="description" type="text" class="required form-control" rows="7" cols="5">{{$privacy->description}}</textarea>
            <span class="text-danger error-text consultation_fees_err">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6  mt-3">
            <a href="{{url('privacy')}}" class="btn btn-danger" >Cancel</a>
          <button type="submit" class="btn btn-info" data-submit="submit">Submit</button>
        </div>
      </form>
    </div>  
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    
    $('#gst').keyup(function(){
        $('#total_amount_after_gst').val("");
        var cal = 0;
        var consultation_fees = $('#consultation_fees').val();
        var gst = $('#gst').val();
        var cal = (consultation_fees*gst)/100;
         var total_amount = cal+parseInt(consultation_fees) ;
        $('#total_amount_after_gst').val(cal+parseInt(consultation_fees));
        $("#totalAmount").html("RS." + total_amount);
    });
</script>
@endsection