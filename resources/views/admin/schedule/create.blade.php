@extends('admin.layouts.admin_layouts')
@section('content')
<style type="text/css">
  .form-check-input[type=checkbox]{
    border-radius: 2rem;
  }
</style>
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
            <div class="col-lg-11">
              <label for="doctor_id">Doctor *</label>
              <select id="doctor_id" name="doctor_id"  class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
               <option value="">Select Doctor</option>
               @if(count($employee) > 0)
                  @foreach($employee as $emp)
                    <option value="{{$emp->user_id}}">{{$emp->first_name}} {{$emp->last_name}}</option>
                  @endforeach
                @endif
              </select>
            </div>
            <div class="col-lg-1 mt-3">
              <a href="{{ route('employee.create') }}" target="_blank" title="Add New Employee" class="btn btn-info  "><i class="fa fa-plus"> Add</i></a>
            </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12 mt-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="sunday" name="day0" onchange="showform(this.value,0);" value="sunday">
              <label class="form-check-label" for="day">Sunday</label>
            </div>
          </div>
        </div>
        <div class="sunday_div" style="display: none;">
        </div>
        <div class="row">
          <div class="col-md-12  mt-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="monday" name="day1" id="sunday_0" onchange="showform(this.value,1);" value="monday">
              <label class="form-check-label" for="day">Monday</label>
            </div>
          </div>
        </div>
        <div class="monday_div" style="display: none;">
        </div>
        <div class="row">
          <div class="col-md-12  mt-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="tuesday" name="day2" onchange="showform(this.value,2);" value="tuesday">
              <label class="form-check-label" for="day">Tuesday</label>
            </div>
          </div>
        </div>
        <div class="tuesday_div" style="display: none;">
        </div>
        <div class="row">
          <div class="col-md-12  mt-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="wednesday" name="day3" onchange="showform(this.value,3);" value="wednesday">
              <label class="form-check-label" for="day">Wednesday</label>
            </div>
          </div>
        </div>
        <div class="wednesday_div" style="display: none;">
        </div>
        <div class="row">
          <div class="col-md-12  mt-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="thursday" name="day4" onchange="showform(this.value,4);" value="thursday">
              <label class="form-check-label" for="day">Thursday</label>
            </div>
          </div>
        </div>
        <div class="thursday_div" style="display: none;">
        </div>
        <div class="row">
          <div class="col-md-12  mt-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="friday" name="day5" onchange="showform(this.value,5);" value="friday">
              <label class="form-check-label" for="day">Friday</label>
            </div>
          </div>
        </div>
        <div class="friday_div" style="display: none;">
        </div>
        <div class="row">
          <div class="col-md-12  mt-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="saturday" name="day6"  onchange="showform(this.value,6);" value="saturday">
              <label class="form-check-label" for="day">Saturday</label>
            </div>
          </div>
        </div>
        <div class="saturday_div" style="display: none;">
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
  function addMore(name,id){
    var name = $(name).attr('id');
    var count = $("."+name).children().length;
    if(count < 4){
      $("#"+name).css('display','inline-block');
      console.log(this);
      $("."+name).append('<div class="row"><div class="col-lg-2 mt-3"><label for="type">Type *</label><select id="type" name="type'+id+'[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required><option value="morning">Morning</option><option value="aftrenoon">Aftre Noon</option><option value="evening">Evening</option><option value="night">Night</option></select></div><div class="col-lg-2 mt-3"><label for="appointment_mode">Mode *</label><br><input type="checkbox" name="appointment_mode'+id+'['+count+'][]" value="online" /> Online <br><input type="checkbox" name="appointment_mode'+id+'['+count+'][]" value="offline" /> Offline </div><div class="col-lg-2 mt-3"><label for="start_time">Start Time *</label><input id="start_time" name="start_time'+id+'[]" type="time" class=" form-control" /></div><div class="col-lg-2 mt-3"><label for="end_time">End Time *</label><input id="end_time" name="end_time'+id+'[]" type="time" class=" form-control" /></div><div class="col-lg-2 mt-3"><label for="break">Break *</label><select id="break" name="break'+id+'[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required><option>Select Break</option><option value="5">5 Minute</option><option value="10">10 Minute</option><option value="15">15 Minute</option><option value="20">20 Minute</option><option value="30">30 Minute</option><option value="35">35 Minute</option><option value="40">40 Minute</option><option value="45">45 Minute</option><option value="50">50 Minute</option></select></div><div class="col-lg-1 mt-3"><label for="is_disable" class="mt-3" >Disable<input type="checkbox" value="1" id="is_disable" onclick="checkbox(this);"><input type="hidden" name="is_disable'+id+'[]" value="0"></label></div><div class="col-lg-1 mt-3"><a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="'+id+'" onclick="removeMore(this,\''+name+'\');"><i class="fa fa-trash"></i></a></div></div>');
    }else{
      $("#"+name).css('display','none');
      console.log(this);
    }
    this.g = this.g+1;
  }

  function addFirst(name,id){
    var variable = $("."+name+"_div").html();

    console.log(jQuery.trim(variable));
    if(jQuery.trim(variable) == ''){
      $("."+name+'_div').html('<div class="row"><div class="col-lg-2 mt-3"><label for="type">Type *</label><select id="type" name="type'+id+'[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required><option value="morning">Morning</option><option value="aftrenoon">Aftre Noon</option><option value="evening">Evening</option><option value="night">Night</option></select></div><div class="col-lg-2 mt-3"><label for="appointment_mode">Mode *</label><br><input type="checkbox" name="appointment_mode'+id+'[0][]" value="online"/> Online <br><input type="checkbox" name="appointment_mode'+id+'[0][]" value="offline"/> Offline </div><div class="col-lg-2 mt-3"><label for="start_time">Start Time *</label><input id="start_time" name="start_time'+id+'[]" type="time" class=" form-control" /></div><div class="col-lg-2 mt-3"><label for="end_time">End Time *</label><input id="end_time" name="end_time'+id+'[]" type="time" class=" form-control" /></div><div class="col-lg-2 mt-3"><label for="break">Break *</label><select id="break" name="break'+id+'[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required><option>Select Break</option><option value="5">5 Minute</option><option value="10">10 Minute</option><option value="15">15 Minute</option><option value="20">20 Minute</option><option value="30">30 Minute</option><option value="35">35 Minute</option><option value="40">40 Minute</option><option value="45">45 Minute</option><option value="50">50 Minute</option></select></div><div class="col-lg-1 mt-3"><label for="is_disable" class="mt-3" >Disable<input type="checkbox" value="1" id="is_disable" onclick="checkbox(this);"><input type="hidden" name="is_disable'+id+'[]" value="0"></label></div><div class="col-lg-1 mt-3"><a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="3" id="'+name+'_div" onclick="addMore('+name+'_div,'+id+');"><i class="fa fa-plus"></i></a></div></div>');
      this.g = this.g+1;
    }
  }

  function removeMore(el,name){
    var count = $("."+name).children().length;
    if(count < 4){
      $("#"+name).css('display','inline-block');
    }else{
      $("#"+name).css('display','inline-block');
    }
      var parentElement = el.closest('.row');
      parentElement.remove();
  }

 function showform(value,id){
    if($('#' + value).is(":checked")){
      $("."+value+'_div').css('display','block');
      addFirst(value,id);
    }else{
      $("."+value+'_div').css('display','none');
    }
 }

 function checkbox(el){
  console.log(el.nextSibling);
  if (el.checked == true){
    el.nextSibling.value = 1;
    console.log(el.nextSibling.value);
  }else{
    el.nextSibling.value = 0;
    console.log(el.nextSibling.value);
  }
 }

</script>
@endsection