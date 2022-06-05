@extends('admin.layouts.admin_layouts')

@section('content')
  <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Edit Promocode</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Update
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
  <div class="container-fluid">      
    <div class="card">
      <div class="card-body wizard-content">
        <form id="example-form" action="{{route('promocode.update',$promocode->id)}}" method="post">
          @method('PUT') 
            <div class="row">
              <div class="col-lg-6  mt-3">
                <label for="name">Name of the promocode *</label>
                <input
                  id="name"
                  name="name"
                  type="text"
                  class="required form-control"
                  required
                  value="{{$promocode->name}}"
                />
              </div>
              <div class="col-lg-6  mt-3">
                <label for="discount_by" style="display: block;">Discount by Percentage or Amount *</label>
                <input type="radio" class="form-check-input customControlValidation2 radio-stacked" id="discount_by" name="discount_by" value="percentage" required="" @if($promocode->discount_by == 'percentage') checked @endif>
                <label class="form-check-label mb-0" for="customControlValidation2">Percentage</label>
                <input type="radio" class="form-check-input customControlValidation2 radio-stacked" id="discount_by" name="discount_by" value="amount" required="" @if($promocode->discount_by == 'amount') checked @endif>
                <label class="form-check-label mb-0" for="customControlValidation2">Amount</label>
              </div>
            </div>    

            <div class="row">
              <div class="col-lg-6  mt-3">
                 <label for="discount_amount">Discount Amount *</label>
                <input
                  id="discount_amount"
                  name="discount_amount"
                  type="number"
                  class="required form-control"
                  value="{{$promocode->discount_amount}}"
                />
              </div>
              <div class="col-lg-6  mt-3">
                <label for="send_to" style="display: block;">Send Offers to everyone or Select a user *</label>
                <input type="radio" class="form-check-input customControlValidation2 radio-stacked" id="send_to" name="send_to" value="all" required="" @if($promocode->send_to == 'all') checked @endif onchange="sendto(this.value);">
                <label class="form-check-label mb-0" for="customControlValidation2">Send to everyone</label>
                <input type="radio" class="form-check-input customControlValidation2 radio-stacked" id="send_to" name="send_to" value="specific" required="" @if($promocode->send_to == 'specific') checked @endif onchange="sendto(this.value);">
                <label class="form-check-label mb-0"  for="customControlValidation2">Select a user</label>
              </div>
            </div>
             <div class="row">
              <div class="col-lg-6  mt-3" @if($promocode->send_to != 'specific') style="display: none;" @endif id="phone_number">
               <label for="phone_number">Select a user by entering their phone number *</label>
                 <input
                  id="phone_number"
                  name="phone_number"
                  type="text"
                  class="required form-control"
                  value="{{$promocode->phone_number}}"
                />
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6  mt-3">
                <button type="button" class="btn btn-danger" >Cancel</button>
                  <button type="submit" style="margin-top: 30px; width: 100px; color: #fff;" class="btn btn-success">
                Save
              </button>
              </div>
              </div>
            </section>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
@section('script')
<script type="text/javascript">
    function sendto(value){
      if(value == 'specific'){
        $("#phone_number").css('display','block');
      }else{
        $("#phone_number").css('display','none');
      }
    }
</script>
@endsection