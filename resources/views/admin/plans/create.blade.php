@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Add Plan</h4>
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
      <form id="AddPlanForm" method="post" action="{{ route('plan.store') }}" name="AddPlanForm" autocomplete="off" enctype="multipart/form-data">
        <div class="row">
          <div class="col-lg-6  mt-3">
            <label for="name">Plan Name *</label>
            <input id="name" name="name" type="text" class="required form-control" />
            <span class="text-danger error-text name_err">
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6  mt-3">
              <label for="consultation_fees">Consultation Fees *</label>
              <input id="consultation_fees" name="consultation_fees" type="text" class="required form-control" />
              <span class="text-danger error-text consultation_fees_err">
            </div>
            <div class="col-lg-6  mt-3">
              <label for="booking_fees">Booking Fees *</label>
              <input id="booking_fees" name="booking_fees" type="text" class="required form-control" />
              <span class="text-danger error-text booking_fees_err">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6  mt-3">
                <label for="gst">GST *</label>
                <div class="input-group">
                    <input id="gst" name="gst" type="text" class="form-control" aria-describedby="basic-addon2"/>
                    <div class="input-group-append">
                      <span class="input-group-text" id="basic-addon2">%</span>
                    </div>
                  </div>
                <span class="text-danger error-text gst_err">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6  mt-3">
                   <label for="gst">Total Amount:&nbsp;&nbsp;</label>
                   <button type="button" class="btn btn-lg btn-outline-info" id="totalAmount">RS.</button>
                  <input id="total_amount_after_gst" name="total_amount_after_gst" type="hidden" class="required form-control btn btn-info" />
                </div>
                <div class="col-lg-6  mt-3">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6  mt-3">
                  <label for="number_of_consultation">Number Of Consultation *</label>
                  <input class="form-control" id="number_of_consultation" name="number_of_consultation" type="text" />
                </div>
              </div>
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
        var booking_fees = $('#booking_fees').val();
        var total = parseInt(booking_fees) + parseInt(consultation_fees);
        var gst = $('#gst').val();
        var cal = (total*gst)/100;
        var total_amount = cal+parseInt(total) ;
        $('#total_amount_after_gst').val(cal+parseInt(total));
        $("#totalAmount").html("RS." + total_amount);
    });
</script>
@endsection
