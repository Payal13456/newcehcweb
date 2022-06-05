@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Add Schedule</h4>
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
      <form  id="AddFaqForm" method="post" action="{{ route('schedule.store') }}" name="AddFaqForm" autocomplete="off" enctype="multipart/form-data">
        <div class="row mt-3">
          <div class="col-lg-12">
            <label for="doctor_id">Doctor *</label>
            <select id="doctor_id" name="doctor_id" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
              <option>Select Doctor</option>
              @if(count($getEmployees) > 0)
                @foreach($getEmployees as $emp)
                  <option value="{{$emp->user_id}}">{{$emp->first_name}} {{$emp->last_name}}</option>
                @endforeach
              @endif
            </select>
          </div>
        </div>
        <div class="row" >
          <div class="col-lg-12 mt-3">
            <label for="day">Available Day *</label>
            <select id="day" name="day[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
              <option>Select Day</option>
              <option value="monday">Monday</option>
              <option value="tuesday">Tuesday</option>
              <option value="wednesday">Wednesday</option>
              <option value="thursday">Thursday</option>
              <option value="friday">Friday</option>
              <option value="saturday">Saturday</option>
              <option value="sunday">Sunday</option>
            </select>
          </div>
          <div class="col-lg-3 mt-3">
            <label for="type">Type *</label>
            <select id="type" name="type[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
              <option>Select Type</option>
              <option value="morning">Morning</option>
              <option value="afternoon">After Noon</option>
              <option value="evening">Evening</option>
              <option value="night">Night</option>
            </select>
          </div>
          <div class="col-lg-3 mt-3">
            <label for="start_time">Start Time *</label>
                <input
                  id="start_time"
                  name="start_time[]"
                  type="time"
                  class="required form-control"
                  required
                />
          </div>
          <div class="col-lg-3 mt-3">
            <label for="end_time">End Time *</label>
                <input
                  id="end_time"
                  name="end_time[]"
                  type="time"
                  class="required form-control"
                  required
                />
          </div>
          <div class="col-lg-2 mt-3">
            <label for="break">Break Time *</label>
            <select id="break" name="break[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
              <option>Select Break</option>
              <option value="5">5 Minute</option>
              <option value="10">10 Minute</option>
              <option value="15">15 Minute</option>
              <option value="20">20 Minute</option>
              <option value="30">30 Minute</option>
            </select>
          </div>
          <div class="col-lg-1 mt-3">
            <label for="is_disable" class="mt-3">Disable
            <input type="checkbox" name="is_disable[]" value="1" id="is_disable">
             </label>
          </div>
        </div>
        <div class="add-more">
        </div>
        <div class="row">
          <div class="col-lg-3 mt-3">
            <a href="javascript:void(0);" onclick="addMore();">Add More</a>
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
@section('script')
<script type="text/javascript">
  var g = 1;
  function addMore(){
    $(".add-more").append('<div id="add_skill_'+this.g+'"><i class="fa fa-trash text-danger" aria-hidden="true" style="float:right;pointer:cursor;" onclick="removeMore(this)"></i><div class="row"><div class="col-lg-12 mt-3"><label for="day">Available Day *</label><select id="day" name="day[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required><option>Select Day</option><option value="monday">Monday</option><option value="tuesday">Tuesday</option><option value="wednesday">Wednesday</option><option value="thursday">Thursday</option><option value="friday">Friday</option><option value="saturday">Saturday</option><option value="sunday">Sunday</option></select></div><div class="col-lg-3 mt-3"><label for="type">Type *</label><select id="type" name="type[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required><option>Select Type</option><option value="morning">Morning</option><option value="afternoon">After Noon</option><option value="evening">Evening</option><option value="night">Night</option></select></div><div class="col-lg-3 mt-3"><label for="start_time">Start Time *</label><input id="start_time" name="start_time[]" type="time" class="required form-control" required/></div><div class="col-lg-3 mt-3"><label for="end_time">End Time *</label><input id="end_time" name="end_time[]" type="time" class="required form-control" required /></div><div class="col-lg-2 mt-3"><label for="break">Break Time *</label><select id="break" name="break[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required><option>Select Break</option><option value="5">5 Minute</option><option value="10">10 Minute</option><option value="15">15 Minute</option><option value="20">20 Minute</option><option value="30">30 Minute</option></select></div><div class="col-lg-1 mt-3"><label for="is_disable" class="mt-3"><input type="checkbox" name="is_disable[]" value="1" id="is_disable"> Disable</label></div></div></div>');
    this.g = this.g+1;
  }

  function removeMore(el){
      console.log(el.parentNode);
      el.parentNode.remove();
  }
</script>
@endsection