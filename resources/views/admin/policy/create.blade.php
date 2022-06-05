@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Add Privacy</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
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
      <form id="AddPrivacyForm" method="post" action="{{ route('privacy.store') }}" name="AddPrivacyForm" autocomplete="off" enctype="multipart/form-data">
        <div class="row">
          <div class="col-lg-6  mt-3">
            <label for="title">Title *</label>
            <input id="title" name="title" type="text" class="required form-control" />
            <span class="text-danger error-text name_err">
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6  mt-3">
              <label for="description">Description *</label>
              <textarea id="description" name="description" type="text" class="required form-control" rows="7" cols="5"></textarea>
              <span class="text-danger error-text consultation_fees_err">
              </div>
            </div>
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
<script type="text/javascript">    
    $('#gst').keyup(function(){
        var consultation_fees = $('#consultation_fees').val();
        var gst = $('#gst').val();
        var cal = (consultation_fees*gst)/100;
        var total_amount = cal+parseInt(consultation_fees) ;
        $('#total_amount_after_gst').val(cal+parseInt(consultation_fees));
        $("#totalAmount").html("RS." + total_amount);
    });
</script>
@endsection