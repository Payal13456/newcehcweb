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
      <form  id="AddFaqForm" method="post" action="{{ route('schedule.update',$id) }}" name="AddFaqForm" autocomplete="off" enctype="multipart/form-data">
        @method('PUT')
       <input type="hidden" name="doctor_id" value="{{$id}}">
        <div class="row">
          <div class="col-md-12 mt-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="sunday" name="day0" onchange="showform(this.value,0);" value="sunday" @if(count($schedule) > 0) @foreach($schedule as $s) @if($s->day == 'sunday') @if(count($s->details) > 0) checked @endif @endif @endforeach @endif>
              <label class="form-check-label" for="day">Sunday</label>
            </div>
          </div>
        </div>

        @php $sunday = 0; @endphp
        @if(count($schedule) > 0) 
        @php $sunday = 0; @endphp
          @foreach($schedule as $s) 
            @if($s->day == 'sunday')

              @php $sunday = 1; $count1 = 0;@endphp
              <div class="sunday_div" @if(count($s->details) == 0 && count($s->disabled) > 0) style="display:none;" @endif>
                @if(count($s->details) > 0)
                  @foreach($s->details as $k=>$details)
                  
                    <div class="row">
                      <div class="col-lg-2 mt-3">
                        <input type="hidden" name="ids0[]" value="{{$details->id}}">
                        <label for="type">Type *</label>
                        <select id="type" name="type0[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                          <option value="morning" @if($details->type == 'morning') selected @endif>Morning</option>
                          <option value="aftrenoon" @if($details->type == 'aftrenoon') selected @endif>After Noon</option>
                          <option value="evening" @if($details->type == 'evening') selected @endif>Evening</option>
                          <option value="night" @if($details->type == 'night') selected @endif>Night</option>
                        </select>
                      </div>
                      <div class="col-lg-2 mt-3">
                        <label for="appointment_mode">Mode *</label><br>
                        <input type="checkbox" name="appointment_mode0[{{$count1}}][]" value="online" @if(str_contains($details->appointment_mode,'online')) checked @endif/> Online <br>
                        <input type="checkbox" name="appointment_mode0[{{$count1}}][]" value="offline" @if(str_contains($details->appointment_mode,'offline')) checked @endif/> Offline 
                      </div>
                      <!-- <div class="col-lg-2 mt-3">
                        <label for="appointment_mode">Mode *</label>
                        <select id="appointment_mode" name="appointment_mode0[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                          <option value="offline"  @if(str_contains($details->appointment_mode,'offline')) checked @endif>Offline</option>
                          <option value="online"  @if(str_contains($details->appointment_mode,'online')) checked @endif>Online</option>
                        </select>
                      </div> -->
                      <div class="col-lg-2 mt-3">
                        <label for="start_time">Start Time *</label>
                        <input id="start_time" name="start_time0[]" type="time" class=" form-control"  value="{{$details->start_time}}"/>
                      </div>
                      <div class="col-lg-2 mt-3">
                        <label for="end_time">End Time *</label>
                        <input id="end_time" name="end_time0[]" type="time" class=" form-control" value="{{$details->end_time}}"/>
                      </div>
                      <div class="col-lg-2 mt-3">
                        <label for="break">Break *</label>
                        <select id="break" name="break0[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                          <option>Select Break</option>
                          <option value="5" @if($details->break == 5) selected @endif>5 Minute</option>
                          <option value="10" @if($details->break == 10) selected @endif>10 Minute</option>
                          <option value="15" @if($details->break == 15) selected @endif>15 Minute</option>
                          <option value="20" @if($details->break == 20) selected @endif>20 Minute</option>
                          <option value="25" @if($details->break == 25) selected @endif>25 Minute</option>
                          <option value="30" @if($details->break == 30) selected @endif>30 Minute</option>
                          <option value="35" @if($details->break == 35) selected @endif>35 Minute</option>
                          <option value="40" @if($details->break == 40) selected @endif>40 Minute</option>
                          <option value="45" @if($details->break == 45) selected @endif>45 Minute</option>
                          <option value="50" @if($details->break == 50) selected @endif>50 Minute</option>
                          <option value="55" >55 Minute</option>
                        </select>
                      </div>
                      <div class="col-lg-1 mt-3">
                        <label for="is_disable" class="mt-3" >Disable <input type="checkbox" value="1" id="is_disable" onclick="checkbox(this);"  @if($details->is_disable == 1) checked @endif><input type="hidden" name="is_disable0[]" value="{{$details->is_disable}}"></label>
                      </div>
                      <div class="col-lg-1 mt-3">
                        @if($k == 0)
                          <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="0" id="sunday_div" onclick="addMore('sunday_div',0);"><i class="fa fa-plus"></i></a>
                        @else
                          <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="0" onclick="removeMore(this);"><i class="fa fa-trash"></i></a>
                        @endif
                      </div>
                    </div>
                    @php $count1++; @endphp
                  @endforeach
                @elseif(count($s->disabled) > 0)
                  @foreach($s->disabled as $k=>$details)
                    <div class="row">
                      <div class="col-lg-2 mt-3">
                        <input type="hidden" name="ids0[]" value="{{$details->id}}">
                        <label for="type">Type *</label>
                        <select id="type" name="type0[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                          <option value="morning" @if($details->type == 'morning') selected @endif>Morning</option>
                          <option value="aftrenoon" @if($details->type == 'aftrenoon') selected @endif>After Noon</option>
                          <option value="evening" @if($details->type == 'evening') selected @endif>Evening</option>
                          <option value="night" @if($details->type == 'night') selected @endif>Night</option>
                        </select>
                      </div>
                      <!-- <div class="col-lg-2 mt-3">
                        <label for="appointment_mode">Mode *</label>
                        <select id="appointment_mode" name="appointment_mode0[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                          <option value="offline"  @if($details->appointment_mode == 'offline') selected @endif>Offline</option>
                          <option value="online"  @if($details->appointment_mode == 'online') selected @endif>Online</option>
                        </select>
                      </div> -->
                      <div class="col-lg-2 mt-3">
                        <label for="appointment_mode">Mode *</label><br>
                        <input type="checkbox" name="appointment_mode0[{{$count1}}][]" value="online" @if(str_contains($details->appointment_mode,'online')) checked @endif/> Online <br>
                        <input type="checkbox" name="appointment_mode0[{{$count1}}][]" value="offline" @if(str_contains($details->appointment_mode,'offline')) checked @endif/> Offline 
                      </div>
                      <div class="col-lg-2 mt-3">
                        <label for="start_time">Start Time *</label>
                        <input id="start_time" name="start_time0[]" type="time" class=" form-control"  value="{{$details->start_time}}"/>
                      </div>
                      <div class="col-lg-2 mt-3">
                        <label for="end_time">End Time *</label>
                        <input id="end_time" name="end_time0[]" type="time" class=" form-control" value="{{$details->end_time}}"/>
                      </div>
                      <div class="col-lg-2 mt-3">
                        <label for="break">Break *</label>
                        <select id="break" name="break0[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                          <option>Select Break</option>
                          <option value="5" @if($details->break == 5) selected @endif>5 Minute</option>
                          <option value="10" @if($details->break == 10) selected @endif>10 Minute</option>
                          <option value="15" @if($details->break == 15) selected @endif>15 Minute</option>
                          <option value="20" @if($details->break == 20) selected @endif>20 Minute</option>
                          <option value="25" @if($details->break == 25) selected @endif>25 Minute</option>
                          <option value="30" @if($details->break == 30) selected @endif>30 Minute</option>
                          <option value="35" @if($details->break == 35) selected @endif>35 Minute</option>
                          <option value="40" @if($details->break == 40) selected @endif>40 Minute</option>
                          <option value="45" @if($details->break == 45) selected @endif>45 Minute</option>
                          <option value="50" @if($details->break == 50) selected @endif>50 Minute</option>
                          <option value="55" >55 Minute</option>
                        </select>
                      </div>
                      <div class="col-lg-1 mt-3">
                        <label for="is_disable" class="mt-3" >Disable <input type="checkbox" value="1" id="is_disable" onclick="checkbox(this);"  @if($details->is_disable == 1) checked @endif><input type="hidden" name="is_disable0[]" value="{{$details->is_disable}}"></label>
                      </div>
                      <div class="col-lg-1 mt-3">
                        @if($k == 0)
                          <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="0" id="sunday_div" onclick="addMore('sunday_div',0);"><i class="fa fa-plus"></i></a>
                        @else
                          <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="0" onclick="removeMore(this);"><i class="fa fa-trash"></i></a>
                        @endif
                      </div>
                    </div>
                    @php $count1++; @endphp
                  @endforeach
                @endif
              </div>
            @endif 
          @endforeach 
        @endif
        @if($sunday == 0)
          <div class="sunday_div" style="display: none;">
          </div>
        @endif  
        <div class="row">
          <div class="col-md-12  mt-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="monday" name="day1" id="sunday_0" onchange="showform(this.value,1);" value="monday" @if(count($schedule) > 0) @foreach($schedule as $s) @if($s->day == 'monday') @if(count($s->details) > 0) checked @endif @endif @endforeach @endif>
              <label class="form-check-label" for="day">Monday</label>
            </div>
          </div>  
        </div>
        @php $monday = 0; @endphp
        @if(count($schedule) > 0) 
        @php $monday = 0; @endphp
          @foreach($schedule as $s) 
            @if($s->day == 'monday')
            @php $monday = 1;$count2 = 0; @endphp
            <div class="monday_div" @if(count($s->details) == 0 && count($s->disabled) > 0) style="display:none;" @endif>
              @if(count($s->details) > 0)
                @foreach($s->details as $k=>$details)
                  <div class="row">
                    <div class="col-lg-2 mt-3">
                      <input type="hidden" name="ids1[]" value="{{$details->id}}">
                      <label for="type">Type *</label>
                      <select id="type" name="type1[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                        <option value="morning" @if($details->type == 'morning') selected @endif>Morning</option>
                        <option value="aftrenoon" @if($details->type == 'aftrenoon') selected @endif>After Noon</option>
                        <option value="evening" @if($details->type == 'evening') selected @endif>Evening</option>
                        <option value="night" @if($details->type == 'night') selected @endif>Night</option>
                      </select>
                    </div>
                    <div class="col-lg-2 mt-3">
                      <label for="appointment_mode">Mode *</label><br>
                      <input type="checkbox" name="appointment_mode1[{{$count2}}][]" value="online" @if(str_contains($details->appointment_mode,'online')) checked @endif/> Online <br>
                      <input type="checkbox" name="appointment_mode1[{{$count2}}][]" value="offline" @if(str_contains($details->appointment_mode,'offline')) checked @endif/> Offline 
                    </div>
                    <div class="col-lg-2 mt-3">
                      <label for="start_time">Start Time *</label>
                      <input id="start_time" name="start_time1[]" type="time" class=" form-control"  value="{{$details->start_time}}"/>
                    </div>
                    <div class="col-lg-2 mt-3">
                      <label for="end_time">End Time *</label>
                      <input id="end_time" name="end_time1[]" type="time" class=" form-control" value="{{$details->end_time}}"/>
                    </div>
                    <div class="col-lg-2 mt-3">
                      <label for="break">Break *</label>
                      <select id="break" name="break1[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                        <option>Select Break</option>
                        <option value="5" @if($details->break == 5) selected @endif>5 Minute</option>
                        <option value="10" @if($details->break == 10) selected @endif>10 Minute</option>
                        <option value="15" @if($details->break == 15) selected @endif>15 Minute</option>
                        <option value="20" @if($details->break == 20) selected @endif>20 Minute</option>
                        <option value="25" @if($details->break == 25) selected @endif>25 Minute</option>
                        <option value="30" @if($details->break == 30) selected @endif>30 Minute</option>
                        <option value="35" @if($details->break == 35) selected @endif>35 Minute</option>
                        <option value="40" @if($details->break == 40) selected @endif>40 Minute</option>
                        <option value="45" @if($details->break == 45) selected @endif>45 Minute</option>
                        <option value="50" @if($details->break == 50) selected @endif>50 Minute</option>
                        <option value="55" >55 Minute</option>
                      </select>
                    </div>
                    <div class="col-lg-1 mt-3">
                      <label for="is_disable" class="mt-3" >Disable <input type="checkbox" value="1" id="is_disable" onclick="checkbox(this);"  @if($details->is_disable == 1) checked @endif><input type="hidden" name="is_disable1[]" value="{{$details->is_disable}}"></label>
                    </div>
                    <div class="col-lg-1 mt-3">
                      @if($k == 0)
                        <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="2" id="monday_div" onclick="addMore('monday_div',1);"><i class="fa fa-plus"></i></a>
                      @else
                        <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="2" onclick="removeMore(this);"><i class="fa fa-trash"></i></a>
                      @endif
                    </div>
                  </div>
                  @php $count2++; @endphp
                @endforeach
              @elseif(count($s->disabled) > 0)
                @foreach($s->disabled as $k=>$details)
                  <div class="row">
                    <div class="col-lg-2 mt-3">
                      <input type="hidden" name="ids1[]" value="{{$details->id}}">
                      <label for="type">Type *</label>
                      <select id="type" name="type1[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                        <option value="morning" @if($details->type == 'morning') selected @endif>Morning</option>
                        <option value="aftrenoon" @if($details->type == 'aftrenoon') selected @endif>After Noon</option>
                        <option value="evening" @if($details->type == 'evening') selected @endif>Evening</option>
                        <option value="night" @if($details->type == 'night') selected @endif>Night</option>
                      </select>
                    </div>
                    <div class="col-lg-2 mt-3">
                      <label for="appointment_mode">Mode *</label><br>
                      <input type="checkbox" name="appointment_mode1[{{$count2}}][]" value="online" @if(str_contains($details->appointment_mode,'online')) checked @endif/> Online <br>
                      <input type="checkbox" name="appointment_mode1[{{$count2}}][]" value="offline" @if(str_contains($details->appointment_mode,'offline')) checked @endif/> Offline 
                    </div>
                    <div class="col-lg-2 mt-3">
                      <label for="start_time">Start Time *</label>
                      <input id="start_time" name="start_time1[]" type="time" class=" form-control"  value="{{$details->start_time}}"/>
                    </div>
                    <div class="col-lg-2 mt-3">
                      <label for="end_time">End Time *</label>
                      <input id="end_time" name="end_time1[]" type="time" class=" form-control" value="{{$details->end_time}}"/>
                    </div>
                    <div class="col-lg-2 mt-3">
                      <label for="break">Break *</label>
                      <select id="break" name="break1[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                        <option>Select Break</option>
                        <option value="5" @if($details->break == 5) selected @endif>5 Minute</option>
                        <option value="10" @if($details->break == 10) selected @endif>10 Minute</option>
                        <option value="15" @if($details->break == 15) selected @endif>15 Minute</option>
                        <option value="20" @if($details->break == 20) selected @endif>20 Minute</option>
                        <option value="25" @if($details->break == 25) selected @endif>25 Minute</option>
                        <option value="30" @if($details->break == 30) selected @endif>30 Minute</option>
                        <option value="35" @if($details->break == 35) selected @endif>35 Minute</option>
                        <option value="40" @if($details->break == 40) selected @endif>40 Minute</option>
                        <option value="45" @if($details->break == 45) selected @endif>45 Minute</option>
                        <option value="50" @if($details->break == 50) selected @endif>50 Minute</option>
                        <option value="55" >55 Minute</option>
                      </select>
                    </div>
                    <div class="col-lg-1 mt-3">
                      <label for="is_disable" class="mt-3" >Disable <input type="checkbox" value="1" id="is_disable" onclick="checkbox(this);"  @if($details->is_disable == 1) checked @endif><input type="hidden" name="is_disable1[]" value="{{$details->is_disable}}"></label>
                    </div>
                    <div class="col-lg-1 mt-3">
                      @if($k == 0)
                        <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="2" id="monday_div" onclick="addMore('monday_div',1);"><i class="fa fa-plus"></i></a>
                      @else
                        <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="2" onclick="removeMore(this);"><i class="fa fa-trash"></i></a>
                      @endif
                    </div>
                  </div>
                  @php $count2++; @endphp
                @endforeach
              @endif
            </div>
            @endif 
          @endforeach 
        @endif
        @if($monday == 0)
          <div class="monday_div" style="display: none;">
          </div>
        @endif  

        <div class="row">
          <div class="col-md-12  mt-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="tuesday" name="day2" onchange="showform(this.value,2);" value="tuesday" @if(count($schedule) > 0) @foreach($schedule as $s) @if($s->day == 'tuesday') @if(count($s->details) > 0) checked @endif @endif @endforeach @endif>
              <label class="form-check-label" for="day" >Tuesday</label>
            </div>
          </div>
        </div>
        @php $tuesday = 0; @endphp
        @if(count($schedule) > 0) 
        @php $tuesday = 0; @endphp
          @foreach($schedule as $s) 
            @if($s->day == 'tuesday')
            @php $tuesday = 1;$count3 = 0; @endphp
            <div class="tuesday_div" @if(count($s->details) == 0 && count($s->disabled) > 0) style="display:none;" @endif>
              @if(count($s->details) > 0)
              @foreach($s->details as $k=>$details)
                <div class="row">
                  <div class="col-lg-2 mt-3">
                      <input type="hidden" name="ids2[]" value="{{$details->id}}">
                      <label for="type">Type *</label>
                      <select id="type" name="type2[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                        <option value="morning" @if($details->type == 'morning') selected @endif>Morning</option>
                        <option value="aftrenoon" @if($details->type == 'aftrenoon') selected @endif>After Noon</option>
                        <option value="evening" @if($details->type == 'evening') selected @endif>Evening</option>
                        <option value="night" @if($details->type == 'night') selected @endif>Night</option>
                      </select>
                    </div>
                    <div class="col-lg-2 mt-3">
                      <label for="appointment_mode">Mode *</label><br>
                      <input type="checkbox" name="appointment_mode2[{{$count3}}][]" value="online" @if(str_contains($details->appointment_mode,'online')) checked @endif/> Online <br>
                      <input type="checkbox" name="appointment_mode2[{{$count3}}][]" value="offline" @if(str_contains($details->appointment_mode,'offline')) checked @endif/> Offline 
                    </div>
                  <div class="col-lg-2 mt-3">
                    <label for="start_time">Start Time *</label>
                    <input id="start_time" name="start_time2[]" type="time" class=" form-control"  value="{{$details->start_time}}"/>
                  </div>
                  <div class="col-lg-2 mt-3">
                    <label for="end_time">End Time *</label>
                    <input id="end_time" name="end_time2[]" type="time" class=" form-control" value="{{$details->end_time}}"/>
                  </div>
                  <div class="col-lg-2 mt-3">
                    <label for="break">Break *</label>
                    <select id="break" name="break2[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                      <option>Select Break</option>
                      <option value="5" @if($details->break == 5) selected @endif>5 Minute</option>
                      <option value="10" @if($details->break == 10) selected @endif>10 Minute</option>
                      <option value="15" @if($details->break == 15) selected @endif>15 Minute</option>
                      <option value="20" @if($details->break == 20) selected @endif>20 Minute</option>
                      <option value="25" @if($details->break == 25) selected @endif>25 Minute</option>
                      <option value="30" @if($details->break == 30) selected @endif>30 Minute</option>
                      <option value="35" @if($details->break == 35) selected @endif>35 Minute</option>
                      <option value="40" @if($details->break == 40) selected @endif>40 Minute</option>
                      <option value="45" @if($details->break == 45) selected @endif>45 Minute</option>
                      <option value="50" @if($details->break == 50) selected @endif>50 Minute</option>
                      <option value="55" @if($details->break == 55) selected @endif>55 Minute</option>
                    </select>
                  </div>
                  <div class="col-lg-1 mt-3">
                    <label for="is_disable" class="mt-3" >Disable <input type="checkbox" value="1" id="is_disable" onclick="checkbox(this);"  @if($details->is_disable == 1) checked @endif><input type="hidden" name="is_disable2[]" value="{{$details->is_disable}}"></label>
                  </div>
                  <div class="col-lg-1 mt-3">
                    @if($k == 0)
                      <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="2" id="tuesday_div" onclick="addMore('tuesday_div',2);"><i class="fa fa-plus"></i></a>
                    @else
                      <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="2" onclick="removeMore(this);"><i class="fa fa-trash"></i></a>
                    @endif
                  </div>
                </div>
                @php $count3++; @endphp
              @endforeach
              @elseif(count($s->disabled) > 0)
              @foreach($s->disabled as $k=>$details)
                <div class="row">
                  <div class="col-lg-2 mt-3">
                      <input type="hidden" name="ids2[]" value="{{$details->id}}">
                      <label for="type">Type *</label>
                      <select id="type" name="type2[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                        <option value="morning" @if($details->type == 'morning') selected @endif>Morning</option>
                        <option value="aftrenoon" @if($details->type == 'aftrenoon') selected @endif>After Noon</option>
                        <option value="evening" @if($details->type == 'evening') selected @endif>Evening</option>
                        <option value="night" @if($details->type == 'night') selected @endif>Night</option>
                      </select>
                    </div>
                   <div class="col-lg-2 mt-3">
                      <label for="appointment_mode">Mode *</label><br>
                      <input type="checkbox" name="appointment_mode2[{{$count3}}][]" value="online" @if(str_contains($details->appointment_mode,'online')) checked @endif/> Online <br>
                      <input type="checkbox" name="appointment_mode2[{{$count3}}][]" value="offline" @if(str_contains($details->appointment_mode,'offline')) checked @endif/> Offline 
                    </div>
                  <div class="col-lg-2 mt-3">
                    <label for="start_time">Start Time *</label>
                    <input id="start_time" name="start_time2[]" type="time" class=" form-control"  value="{{$details->start_time}}"/>
                  </div>
                  <div class="col-lg-2 mt-3">
                    <label for="end_time">End Time *</label>
                    <input id="end_time" name="end_time2[]" type="time" class=" form-control" value="{{$details->end_time}}"/>
                  </div>
                  <div class="col-lg-2 mt-3">
                    <label for="break">Break *</label>
                    <select id="break" name="break2[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                      <option>Select Break</option>
                      <option value="5" @if($details->break == 5) selected @endif>5 Minute</option>
                      <option value="10" @if($details->break == 10) selected @endif>10 Minute</option>
                      <option value="15" @if($details->break == 15) selected @endif>15 Minute</option>
                      <option value="20" @if($details->break == 20) selected @endif>20 Minute</option>
                      <option value="25" @if($details->break == 25) selected @endif>25 Minute</option>
                      <option value="30" @if($details->break == 30) selected @endif>30 Minute</option>
                      <option value="35" @if($details->break == 35) selected @endif>35 Minute</option>
                      <option value="40" @if($details->break == 40) selected @endif>40 Minute</option>
                      <option value="45" @if($details->break == 45) selected @endif>45 Minute</option>
                      <option value="50" @if($details->break == 50) selected @endif>50 Minute</option>
                      <option value="55" @if($details->break == 55) selected @endif>55 Minute</option>
                    </select>
                  </div>
                  <div class="col-lg-1 mt-3">
                    <label for="is_disable" class="mt-3" >Disable <input type="checkbox" value="1" id="is_disable" onclick="checkbox(this);"  @if($details->is_disable == 1) checked @endif><input type="hidden" name="is_disable2[]" value="{{$details->is_disable}}"></label>
                  </div>
                  <div class="col-lg-1 mt-3">
                    @if($k == 0)
                      <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="2" id="tuesday_div" onclick="addMore('tuesday_div',2);"><i class="fa fa-plus"></i></a>
                    @else
                      <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="2" onclick="removeMore(this);"><i class="fa fa-trash"></i></a>
                    @endif
                  </div>
                </div>
                @php $count3++; @endphp
              @endforeach
              @endif
            </div>
            @endif 
          @endforeach 
        @endif
        @if($tuesday == 0)
          <div class="tuesday_div" style="display: none;">
          </div>
        @endif  
        <div class="row">
          <div class="col-md-12  mt-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="wednesday" name="day3" onchange="showform(this.value,3);" value="wednesday" @if(count($schedule) > 0) @foreach($schedule as $s) @if($s->day == 'wednesday') @if(count($s->details) > 0) checked @endif @endif @endforeach @endif>
              <label class="form-check-label" for="day">Wednesday</label>
            </div>
          </div>
        </div>
        @php $wednesday = 0; @endphp
          @if(count($schedule) > 0) 
          @php $wednesday = 0; @endphp
          @foreach($schedule as $s) 
            @if($s->day == 'wednesday')
            @php $wednesday = 1;$count4 = 0; @endphp
            <div class="wednesday_div" @if(count($s->details) == 0 && count($s->disabled) > 0) style="display:none;" @endif>
              @if(count($s->details) > 0)
              @foreach($s->details as $k=>$details)
                <div class="row">
                  <div class="col-lg-2 mt-3">
                      <input type="hidden" name="ids3[]" value="{{$details->id}}">
                      <label for="type">Type *</label>
                      <select id="type" name="type3[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                        <option value="morning" @if($details->type == 'morning') selected @endif>Morning</option>
                        <option value="aftrenoon" @if($details->type == 'aftrenoon') selected @endif>After Noon</option>
                        <option value="evening" @if($details->type == 'evening') selected @endif>Evening</option>
                        <option value="night" @if($details->type == 'night') selected @endif>Night</option>
                      </select>
                    </div>
                    <div class="col-lg-2 mt-3">
                      <label for="appointment_mode">Mode *</label><br>
                      <input type="checkbox" name="appointment_mode3[{{$count4}}][]" value="online" @if(str_contains($details->appointment_mode,'online')) checked @endif/> Online <br>
                      <input type="checkbox" name="appointment_mode3[{{$count4}}][]" value="offline" @if(str_contains($details->appointment_mode,'offline')) checked @endif/> Offline 
                    </div>
                  <div class="col-lg-2 mt-3">
                    <label for="start_time">Start Time *</label>
                    <input id="start_time" name="start_time3[]" type="time" class=" form-control"  value="{{$details->start_time}}"/>
                  </div>
                  <div class="col-lg-2 mt-3">
                    <label for="end_time">End Time *</label>
                    <input id="end_time" name="end_time3[]" type="time" class=" form-control" value="{{$details->end_time}}"/>
                  </div>
                  <div class="col-lg-2 mt-3">
                    <label for="break">Break *</label>
                    <select id="break" name="break3[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                      <option>Select Break</option>
                      <option value="5" @if($details->break == 5) selected @endif>5 Minute</option>
                      <option value="10" @if($details->break == 10) selected @endif>10 Minute</option>
                      <option value="15" @if($details->break == 15) selected @endif>15 Minute</option>
                      <option value="20" @if($details->break == 20) selected @endif>20 Minute</option>
                      <option value="25" @if($details->break == 25) selected @endif>25 Minute</option>
                      <option value="30" @if($details->break == 30) selected @endif>30 Minute</option>
                      <option value="35" @if($details->break == 35) selected @endif>35 Minute</option>
                      <option value="40" @if($details->break == 40) selected @endif>40 Minute</option>
                      <option value="45" @if($details->break == 45) selected @endif>45 Minute</option>
                      <option value="50" @if($details->break == 50) selected @endif>50 Minute</option>
                      <option value="55" >55 Minute</option>
                    </select>
                  </div>
                  <div class="col-lg-1 mt-3">
                    <label for="is_disable" class="mt-3" >Disable <input type="checkbox" value="1" id="is_disable" onclick="checkbox(this);"  @if($details->is_disable == 1) checked @endif><input type="hidden" name="is_disable3[]" value="{{$details->is_disable}}"></label>
                  </div>
                  <div class="col-lg-1 mt-3">
                    @if($k == 0)
                      <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="3" id="wednesday_div" onclick="addMore('wednesday_div',3);"><i class="fa fa-plus"></i></a>
                    @else
                      <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="3" onclick="removeMore(this);"><i class="fa fa-trash"></i></a>
                    @endif
                  </div>
                </div>
                @php $count4++; @endphp
              @endforeach
              @elseif(count($s->disabled) > 0)
              @foreach($s->disabled as $k=>$details)
                <div class="row">
                  <div class="col-lg-2 mt-3">
                      <input type="hidden" name="ids3[]" value="{{$details->id}}">
                      <label for="type">Type *</label>
                      <select id="type" name="type3[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                        <option value="morning" @if($details->type == 'morning') selected @endif>Morning</option>
                        <option value="aftrenoon" @if($details->type == 'aftrenoon') selected @endif>After Noon</option>
                        <option value="evening" @if($details->type == 'evening') selected @endif>Evening</option>
                        <option value="night" @if($details->type == 'night') selected @endif>Night</option>
                      </select>
                    </div>
                    <div class="col-lg-2 mt-3">
                      <label for="appointment_mode">Mode *</label><br>
                      <input type="checkbox" name="appointment_mode3[{{$count4}}][]" value="online" @if(str_contains($details->appointment_mode,'online')) checked @endif/> Online <br>
                      <input type="checkbox" name="appointment_mode3[{{$count4}}][]" value="offline" @if(str_contains($details->appointment_mode,'offline')) checked @endif/> Offline 
                    </div>
                  <div class="col-lg-2 mt-3">
                    <label for="start_time">Start Time *</label>
                    <input id="start_time" name="start_time3[]" type="time" class=" form-control"  value="{{$details->start_time}}"/>
                  </div>
                  <div class="col-lg-2 mt-3">
                    <label for="end_time">End Time *</label>
                    <input id="end_time" name="end_time3[]" type="time" class=" form-control" value="{{$details->end_time}}"/>
                  </div>
                  <div class="col-lg-2 mt-3">
                    <label for="break">Break *</label>
                    <select id="break" name="break3[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                      <option>Select Break</option>
                      <option value="5" @if($details->break == 5) selected @endif>5 Minute</option>
                      <option value="10" @if($details->break == 10) selected @endif>10 Minute</option>
                      <option value="15" @if($details->break == 15) selected @endif>15 Minute</option>
                      <option value="20" @if($details->break == 20) selected @endif>20 Minute</option>
                      <option value="25" @if($details->break == 25) selected @endif>25 Minute</option>
                      <option value="30" @if($details->break == 30) selected @endif>30 Minute</option>
                      <option value="35" @if($details->break == 35) selected @endif>35 Minute</option>
                      <option value="40" @if($details->break == 40) selected @endif>40 Minute</option>
                      <option value="45" @if($details->break == 45) selected @endif>45 Minute</option>
                      <option value="50" @if($details->break == 50) selected @endif>50 Minute</option>
                      <option value="55" >55 Minute</option>
                    </select>
                  </div>
                  <div class="col-lg-1 mt-3">
                    <label for="is_disable" class="mt-3" >Disable <input type="checkbox" value="1" id="is_disable" onclick="checkbox(this);"  @if($details->is_disable == 1) checked @endif><input type="hidden" name="is_disable3[]" value="{{$details->is_disable}}"></label>
                  </div>
                  <div class="col-lg-1 mt-3">
                    @if($k == 0)
                      <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="3" id="wednesday_div" onclick="addMore('wednesday_div',3);"><i class="fa fa-plus"></i></a>
                    @else
                      <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="3" onclick="removeMore(this);"><i class="fa fa-trash"></i></a>
                    @endif
                  </div>
                </div>
                @php $count4++; @endphp
              @endforeach
              @endif
            </div>
            @endif 
          @endforeach 
        @endif
        @if($wednesday == 0)
          <div class="wednesday_div" style="display: none;">
          </div>
        @endif  
        <div class="row">
          <div class="col-md-12  mt-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="thursday" name="day4" onchange="showform(this.value,4);" value="thursday" @if(count($schedule) > 0) @foreach($schedule as $s) @if($s->day == 'thursday') @if(count($s->details) > 0) checked @endif @endif @endforeach @endif>
              <label class="form-check-label" for="day">Thursday</label>
            </div>
          </div>
        </div>
        @php $thursday = 0; @endphp
        @if(count($schedule) > 0) 
        @php $thursday = 0; @endphp
          @foreach($schedule as $s) 
            @if($s->day == 'thursday')
            @php $thursday = 1;$count5 = 0; @endphp
            <div class="thursday_div" @if(count($s->details) == 0 && count($s->disabled) > 0) style="display:none;" @endif>
              @if(count($s->details) > 0)
              @foreach($s->details as $k=>$details)
                <div class="row">
                  <div class="col-lg-2 mt-3">
                      <input type="hidden" name="ids4[]" value="{{$details->id}}">
                      <label for="type">Type *</label>
                      <select id="type" name="type4[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                        <option value="morning" @if($details->type == 'morning') selected @endif>Morning</option>
                        <option value="aftrenoon" @if($details->type == 'aftrenoon') selected @endif>After Noon</option>
                        <option value="evening" @if($details->type == 'evening') selected @endif>Evening</option>
                        <option value="night" @if($details->type == 'night') selected @endif>Night</option>
                      </select>
                    </div>
                    <div class="col-lg-2 mt-3">
                      <label for="appointment_mode">Mode *</label><br>
                      <input type="checkbox" name="appointment_mode4[{{$count5}}][]" value="online" @if(str_contains($details->appointment_mode,'online')) checked @endif/> Online <br>
                      <input type="checkbox" name="appointment_mode4[{{$count5}}][]" value="offline" @if(str_contains($details->appointment_mode,'offline')) checked @endif/> Offline 
                    </div>
                  <div class="col-lg-2 mt-3">
                    <label for="start_time">Start Time *</label>
                    <input id="start_time" name="start_time4[]" type="time" class=" form-control"  value="{{$details->start_time}}"/>
                  </div>
                  <div class="col-lg-2 mt-3">
                    <label for="end_time">End Time *</label>
                    <input id="end_time" name="end_time4[]" type="time" class=" form-control" value="{{$details->end_time}}"/>
                  </div>
                  <div class="col-lg-2 mt-3">
                    <label for="break">Break *</label>
                    <select id="break" name="break4[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                      <option>Select Break</option>
                      <option value="5" @if($details->break == 5) selected @endif>5 Minute</option>
                      <option value="10" @if($details->break == 10) selected @endif>10 Minute</option>
                      <option value="15" @if($details->break == 15) selected @endif>15 Minute</option>
                      <option value="20" @if($details->break == 20) selected @endif>20 Minute</option>
                      <option value="25" @if($details->break == 25) selected @endif>25 Minute</option>
                      <option value="30" @if($details->break == 30) selected @endif>30 Minute</option>
                      <option value="35" @if($details->break == 35) selected @endif>35 Minute</option>
                      <option value="40" @if($details->break == 40) selected @endif>40 Minute</option>
                      <option value="45" @if($details->break == 45) selected @endif>45 Minute</option>
                      <option value="50" @if($details->break == 50) selected @endif>50 Minute</option>
                      <option value="55" >55 Minute</option>
                    </select>
                  </div>
                  <div class="col-lg-1 mt-3">
                    <label for="is_disable" class="mt-3" >Disable <input type="checkbox" value="1" id="is_disable" onclick="checkbox(this);"  @if($details->is_disable == 1) checked @endif><input type="hidden" name="is_disable4[]" value="{{$details->is_disable}}"></label>
                  </div>
                  <div class="col-lg-1 mt-3">
                    @if($k == 0)
                      <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="2" id="thursday_div" onclick="addMore('thursday_div',4);"><i class="fa fa-plus"></i></a>
                    @else
                      <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="2" onclick="removeMore(this);"><i class="fa fa-trash"></i></a>
                    @endif
                  </div>
                </div>
                @php $count5++; @endphp
              @endforeach
              @elseif(count($s->disabled) > 0)
              @foreach($s->disabled as $k=>$details)
                <div class="row">
                  <div class="col-lg-2 mt-3">
                      <input type="hidden" name="ids4[]" value="{{$details->id}}">
                      <label for="type">Type *</label>
                      <select id="type" name="type4[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                        <option value="morning" @if($details->type == 'morning') selected @endif>Morning</option>
                        <option value="aftrenoon" @if($details->type == 'aftrenoon') selected @endif>After Noon</option>
                        <option value="evening" @if($details->type == 'evening') selected @endif>Evening</option>
                        <option value="night" @if($details->type == 'night') selected @endif>Night</option>
                      </select>
                    </div>
                    <div class="col-lg-2 mt-3">
                      <label for="appointment_mode">Mode *</label><br>
                      <input type="checkbox" name="appointment_mode4[{{$count5}}][]" value="online" @if(str_contains($details->appointment_mode,'online')) checked @endif/> Online <br>
                      <input type="checkbox" name="appointment_mode4[{{$count5}}][]" value="offline" @if(str_contains($details->appointment_mode,'offline')) checked @endif/> Offline 
                    </div>
                  <div class="col-lg-2 mt-3">
                    <label for="start_time">Start Time *</label>
                    <input id="start_time" name="start_time4[]" type="time" class=" form-control"  value="{{$details->start_time}}"/>
                  </div>
                  <div class="col-lg-2 mt-3">
                    <label for="end_time">End Time *</label>
                    <input id="end_time" name="end_time4[]" type="time" class=" form-control" value="{{$details->end_time}}"/>
                  </div>
                  <div class="col-lg-2 mt-3">
                    <label for="break">Break *</label>
                    <select id="break" name="break4[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                      <option>Select Break</option>
                      <option value="5" @if($details->break == 5) selected @endif>5 Minute</option>
                      <option value="10" @if($details->break == 10) selected @endif>10 Minute</option>
                      <option value="15" @if($details->break == 15) selected @endif>15 Minute</option>
                      <option value="20" @if($details->break == 20) selected @endif>20 Minute</option>
                      <option value="25" @if($details->break == 25) selected @endif>25 Minute</option>
                      <option value="30" @if($details->break == 30) selected @endif>30 Minute</option>
                      <option value="35" @if($details->break == 35) selected @endif>35 Minute</option>
                      <option value="40" @if($details->break == 40) selected @endif>40 Minute</option>
                      <option value="45" @if($details->break == 45) selected @endif>45 Minute</option>
                      <option value="50" @if($details->break == 50) selected @endif>50 Minute</option>
                      <option value="55" >55 Minute</option>
                    </select>
                  </div>
                  <div class="col-lg-1 mt-3">
                    <label for="is_disable" class="mt-3" >Disable <input type="checkbox" value="1" id="is_disable" onclick="checkbox(this);"  @if($details->is_disable == 1) checked @endif><input type="hidden" name="is_disable4[]" value="{{$details->is_disable}}"></label>
                  </div>
                  <div class="col-lg-1 mt-3">
                    @if($k == 0)
                      <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="2" id="thursday_div" onclick="addMore('thursday_div',4);"><i class="fa fa-plus"></i></a>
                    @else
                      <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="2" onclick="removeMore(this);"><i class="fa fa-trash"></i></a>
                    @endif
                  </div>
                </div>
                @php $count5++; @endphp
              @endforeach
              @endif
            </div>
            @endif 
          @endforeach 
        @endif
        @if($thursday == 0)
          <div class="thursday_div" style="display: none;">
          </div>
        @endif  
        <div class="row">
          <div class="col-md-12  mt-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="friday" name="day5" onchange="showform(this.value,5);" value="friday" @if(count($schedule) > 0) @foreach($schedule as $s) @if($s->day == 'friday') @if(count($s->details) > 0) checked @endif @endif @endforeach @endif>
              <label class="form-check-label" for="day">Friday</label>
            </div>
          </div>
        </div>
        @php $friday = 0; @endphp
        @if(count($schedule) > 0) 
        @php $friday = 0; @endphp
          @foreach($schedule as $s) 
            @if($s->day == 'friday')
            @php $friday = 1; $count6 = 0; @endphp
            <div class="friday_div" @if(count($s->details) == 0 && count($s->disabled) > 0) style="display:none;" @endif>
              @if(count($s->details) > 0)
              @foreach($s->details as $k=>$details)
                <div class="row">
                  <div class="col-lg-2 mt-3">
                      <input type="hidden" name="ids5[]" value="{{$details->id}}">
                      <label for="type">Type *</label>
                      <select id="type" name="type5[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                        <option value="morning" @if($details->type == 'morning') selected @endif>Morning</option>
                        <option value="aftrenoon" @if($details->type == 'aftrenoon') selected @endif>After Noon</option>
                        <option value="evening" @if($details->type == 'evening') selected @endif>Evening</option>
                        <option value="night" @if($details->type == 'night') selected @endif>Night</option>
                      </select>
                    </div>
                    <div class="col-lg-2 mt-3">
                      <label for="appointment_mode">Mode *</label><br>
                      <input type="checkbox" name="appointment_mode5[{{$count6}}][]" value="online" @if(str_contains($details->appointment_mode,'online')) checked @endif/> Online <br>
                      <input type="checkbox" name="appointment_mode5[{{$count6}}][]" value="offline" @if(str_contains($details->appointment_mode,'offline')) checked @endif/> Offline 
                    </div>
                  <div class="col-lg-2 mt-3">
                    <label for="start_time">Start Time *</label>
                    <input id="start_time" name="start_time5[]" type="time" class=" form-control"  value="{{$details->start_time}}"/>
                  </div>
                  <div class="col-lg-2 mt-3">
                    <label for="end_time">End Time *</label>
                    <input id="end_time" name="end_time5[]" type="time" class=" form-control" value="{{$details->end_time}}"/>
                  </div>
                  <div class="col-lg-2 mt-3">
                    <label for="break">Break *</label>
                    <select id="break" name="break5[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                      <option>Select Break</option>
                      <option value="5" @if($details->break == 5) selected @endif>5 Minute</option>
                      <option value="10" @if($details->break == 10) selected @endif>10 Minute</option>
                      <option value="15" @if($details->break == 15) selected @endif>15 Minute</option>
                      <option value="20" @if($details->break == 20) selected @endif>20 Minute</option>
                      <option value="25" @if($details->break == 25) selected @endif>25 Minute</option>
                      <option value="30" @if($details->break == 30) selected @endif>30 Minute</option>
                      <option value="35" @if($details->break == 35) selected @endif>35 Minute</option>
                      <option value="40" @if($details->break == 40) selected @endif>40 Minute</option>
                      <option value="45" @if($details->break == 45) selected @endif>45 Minute</option>
                      <option value="50" @if($details->break == 50) selected @endif>50 Minute</option>
                      <option value="55" >55 Minute</option>
                    </select>
                  </div>
                  <div class="col-lg-1 mt-3">
                    <label for="is_disable" class="mt-3" >Disable <input type="checkbox" value="1" id="is_disable" onclick="checkbox(this);"  @if($details->is_disable == 1) checked @endif><input type="hidden" name="is_disable5[]" value="{{$details->is_disable}}"></label>
                  </div>
                  <div class="col-lg-1 mt-3">
                    @if($k == 0)
                      <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="5" id="'friday_div" onclick="addMore('friday_div',5);"><i class="fa fa-plus"></i></a>
                    @else
                      <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="5" onclick="removeMore(this);"><i class="fa fa-trash"></i></a>
                    @endif
                  </div>
                </div>
                @php $count6++; @endphp
              @endforeach
              @elseif(count($s->disabled) > 0)
              @foreach($s->disabled as $k=>$details)
                <div class="row">
                  <div class="col-lg-2 mt-3">
                      <input type="hidden" name="ids5[]" value="{{$details->id}}">
                      <label for="type">Type *</label>
                      <select id="type" name="type5[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                        <option value="morning" @if($details->type == 'morning') selected @endif>Morning</option>
                        <option value="aftrenoon" @if($details->type == 'aftrenoon') selected @endif>After Noon</option>
                        <option value="evening" @if($details->type == 'evening') selected @endif>Evening</option>
                        <option value="night" @if($details->type == 'night') selected @endif>Night</option>
                      </select>
                    </div>
                    <div class="col-lg-2 mt-3">
                      <label for="appointment_mode">Mode *</label><br>
                      <input type="checkbox" name="appointment_mode5[{{$count6}}][]" value="online" @if(str_contains($details->appointment_mode,'online')) checked @endif/> Online <br>
                      <input type="checkbox" name="appointment_mode5[{{$count6}}][]" value="offline" @if(str_contains($details->appointment_mode,'offline')) checked @endif/> Offline 
                    </div>
                  <div class="col-lg-2 mt-3">
                    <label for="start_time">Start Time *</label>
                    <input id="start_time" name="start_time5[]" type="time" class=" form-control"  value="{{$details->start_time}}"/>
                  </div>
                  <div class="col-lg-2 mt-3">
                    <label for="end_time">End Time *</label>
                    <input id="end_time" name="end_time5[]" type="time" class=" form-control" value="{{$details->end_time}}"/>
                  </div>
                  <div class="col-lg-2 mt-3">
                    <label for="break">Break *</label>
                    <select id="break" name="break5[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                      <option>Select Break</option>
                      <option value="5" @if($details->break == 5) selected @endif>5 Minute</option>
                      <option value="10" @if($details->break == 10) selected @endif>10 Minute</option>
                      <option value="15" @if($details->break == 15) selected @endif>15 Minute</option>
                      <option value="20" @if($details->break == 20) selected @endif>20 Minute</option>
                      <option value="25" @if($details->break == 25) selected @endif>25 Minute</option>
                      <option value="30" @if($details->break == 30) selected @endif>30 Minute</option>
                      <option value="35" @if($details->break == 35) selected @endif>35 Minute</option>
                      <option value="40" @if($details->break == 40) selected @endif>40 Minute</option>
                      <option value="45" @if($details->break == 45) selected @endif>45 Minute</option>
                      <option value="50" @if($details->break == 50) selected @endif>50 Minute</option>
                      <option value="55" >55 Minute</option>
                    </select>
                  </div>
                  <div class="col-lg-1 mt-3">
                    <label for="is_disable" class="mt-3" >Disable <input type="checkbox" value="1" id="is_disable" onclick="checkbox(this);"  @if($details->is_disable == 1) checked @endif><input type="hidden" name="is_disable5[]" value="{{$details->is_disable}}"></label>
                  </div>
                  <div class="col-lg-1 mt-3">
                    @if($k == 0)
                      <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="5" id="'friday_div" onclick="addMore('friday_div',5);"><i class="fa fa-plus"></i></a>
                    @else
                      <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="5" onclick="removeMore(this);"><i class="fa fa-trash"></i></a>
                    @endif
                  </div>
                </div>
                @php $count6++; @endphp
              @endforeach
              @endif
            </div>
            @endif 
          @endforeach 
        @endif
        @if($friday == 0)
          <div class="friday_div" style="display: none;">
          </div>
        @endif  
        <div class="row">
          <div class="col-md-12  mt-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="saturday" name="day6"  onchange="showform(this.value,6);" value="saturday" @if(count($schedule) > 0) @foreach($schedule as $s) @if($s->day == 'saturday') @if(count($s->details) > 0) checked @endif @endif @endforeach @endif> 
              <label class="form-check-label" for="day" >Saturday</label>
            </div>
          </div>
        </div>
        @php $saturday = 0; @endphp
        @if(count($schedule) > 0) 
        @php $saturday = 0; @endphp
          @foreach($schedule as $s) 
            @if($s->day == 'saturday')
            @php $saturday = 1; $count7 = 0;@endphp
            <div class="saturday_div" @if(count($s->details) == 0 && count($s->disabled) > 0) style="display:none;" @endif>
              @if(count($s->details) > 0)
              @foreach($s->details as $k=>$details)
                <div class="row">
                  <div class="col-lg-2 mt-3">
                      <input type="hidden" name="ids6[]" value="{{$details->id}}">
                      <label for="type">Type *</label>
                      <select id="type" name="type6[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                        <option value="morning" @if($details->type == 'morning') selected @endif>Morning</option>
                        <option value="aftrenoon" @if($details->type == 'aftrenoon') selected @endif>After Noon</option>
                        <option value="evening" @if($details->type == 'evening') selected @endif>Evening</option>
                        <option value="night" @if($details->type == 'night') selected @endif>Night</option>
                      </select>
                    </div>
                    <div class="col-lg-2 mt-3">
                      <label for="appointment_mode">Mode *</label><br>
                      <input type="checkbox" name="appointment_mode6[{{$count7}}][]" value="online" @if(str_contains($details->appointment_mode,'online')) checked @endif/> Online <br>
                      <input type="checkbox" name="appointment_mode6[{{$count7}}][]" value="offline" @if(str_contains($details->appointment_mode,'offline')) checked @endif/> Offline 
                    </div>
                  <div class="col-lg-2 mt-3">
                    <label for="start_time">Start Time *</label>
                    <input id="start_time" name="start_time6[]" type="time" class=" form-control"  value="{{$details->start_time}}"/>
                  </div>
                  <div class="col-lg-2 mt-3">
                    <label for="end_time">End Time *</label>
                    <input id="end_time" name="end_time6[]" type="time" class=" form-control" value="{{$details->end_time}}"/>
                  </div>
                  <div class="col-lg-2 mt-3">
                    <label for="break">Break *</label>
                    <select id="break" name="break6[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                      <option>Select Break</option>
                      <option value="5" @if($details->break == 5) selected @endif>5 Minute</option>
                      <option value="10" @if($details->break == 10) selected @endif>10 Minute</option>
                      <option value="15" @if($details->break == 15) selected @endif>15 Minute</option>
                      <option value="20" @if($details->break == 20) selected @endif>20 Minute</option>
                      <option value="25" @if($details->break == 25) selected @endif>25 Minute</option>
                      <option value="30" @if($details->break == 30) selected @endif>30 Minute</option>
                      <option value="35" @if($details->break == 35) selected @endif>35 Minute</option>
                      <option value="40" @if($details->break == 40) selected @endif>40 Minute</option>
                      <option value="45" @if($details->break == 45) selected @endif>45 Minute</option>
                      <option value="50" @if($details->break == 50) selected @endif>50 Minute</option>
                      <option value="55" >55 Minute</option>
                    </select>
                  </div>
                  <div class="col-lg-1 mt-3">
                    <label for="is_disable" class="mt-3" >Disable <input type="checkbox" value="1" id="is_disable" onclick="checkbox(this);"  @if($details->is_disable == 1) checked @endif><input type="hidden" name="is_disable6[]" value="{{$details->is_disable}}"></label>
                  </div>
                  <div class="col-lg-1 mt-3">
                    @if($k == 0)
                      <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="6" id="'saturday_div" onclick="addMore('saturday_div',6);"><i class="fa fa-plus"></i></a>
                    @else
                      <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="6" onclick="removeMore(this);"><i class="fa fa-trash"></i></a>
                    @endif
                  </div>
                </div>
                @php $count7++; @endphp
              @endforeach
              @elseif(count($s->disabled) > 0)
              @foreach($s->disabled as $k=>$details)
                <div class="row">
                 <div class="col-lg-2 mt-3">
                      <input type="hidden" name="ids6[]" value="{{$details->id}}">
                      <label for="type">Type *</label>
                      <select id="type" name="type6[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                        <option value="morning" @if($details->type == 'morning') selected @endif>Morning</option>
                        <option value="aftrenoon" @if($details->type == 'aftrenoon') selected @endif>After Noon</option>
                        <option value="evening" @if($details->type == 'evening') selected @endif>Evening</option>
                        <option value="night" @if($details->type == 'night') selected @endif>Night</option>
                      </select>
                    </div>
                    <div class="col-lg-2 mt-3">
                      <label for="appointment_mode">Mode *</label><br>
                      <input type="checkbox" name="appointment_mode6[{{$count7}}][]" value="online" @if(str_contains($details->appointment_mode,'online')) checked @endif/> Online <br>
                      <input type="checkbox" name="appointment_mode6[{{$count7}}][]" value="offline" @if(str_contains($details->appointment_mode,'offline')) checked @endif/> Offline 
                    </div>
                  <div class="col-lg-2 mt-3">
                    <label for="start_time">Start Time *</label>
                    <input id="start_time" name="start_time6[]" type="time" class=" form-control"  value="{{$details->start_time}}"/>
                  </div>
                  <div class="col-lg-2 mt-3">
                    <label for="end_time">End Time *</label>
                    <input id="end_time" name="end_time6[]" type="time" class=" form-control" value="{{$details->end_time}}"/>
                  </div>
                  <div class="col-lg-2 mt-3">
                    <label for="break">Break *</label>
                    <select id="break" name="break6[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required>
                      <option>Select Break</option>
                      <option value="5" @if($details->break == 5) selected @endif>5 Minute</option>
                      <option value="10" @if($details->break == 10) selected @endif>10 Minute</option>
                      <option value="15" @if($details->break == 15) selected @endif>15 Minute</option>
                      <option value="20" @if($details->break == 20) selected @endif>20 Minute</option>
                      <option value="25" @if($details->break == 25) selected @endif>25 Minute</option>
                      <option value="30" @if($details->break == 30) selected @endif>30 Minute</option>
                      <option value="35" @if($details->break == 35) selected @endif>35 Minute</option>
                      <option value="40" @if($details->break == 40) selected @endif>40 Minute</option>
                      <option value="45" @if($details->break == 45) selected @endif>45 Minute</option>
                      <option value="50" @if($details->break == 50) selected @endif>50 Minute</option>
                      <option value="55" >55 Minute</option>
                    </select>
                  </div>
                  <div class="col-lg-1 mt-3">
                    <label for="is_disable" class="mt-3" >Disable <input type="checkbox" value="1" id="is_disable" onclick="checkbox(this);"  @if($details->is_disable == 1) checked @endif><input type="hidden" name="is_disable6[]" value="{{$details->is_disable}}"></label>
                  </div>
                  <div class="col-lg-1 mt-3">
                    @if($k == 0)
                      <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="6" id="'saturday_div" onclick="addMore('saturday_div',6);"><i class="fa fa-plus"></i></a>
                    @else
                      <a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="6" onclick="removeMore(this);"><i class="fa fa-trash"></i></a>
                    @endif
                  </div>
                </div>
                @php $count7++; @endphp
              @endforeach
              @endif
            </div>
            @endif 
          @endforeach 
        @endif
        @if($saturday == 0)
          <div class="saturday_div" style="display: none;">
          </div>
        @endif  
        <div class="row">
          <div class="col-lg-6  mt-3">
            <!-- <button type="button" class="btn btn-danger" >Cancel</button> -->
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
    // var name = $(name).attr('id');
  
    console.log(name+"-----------------"+id);
    var count = $("."+name).children().length;
    if(count < 4){
      $("#"+name).css('display','inline-block');
     $("."+name).append('<div class="row"><div class="col-lg-2 mt-3"><label for="type">Type *</label><select id="type" name="type'+id+'[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required><option value="morning">Morning</option><option value="aftrenoon">Aftre Noon</option><option value="evening">Evening</option><option value="night">Night</option></select></div><div class="col-lg-2 mt-3"><label for="appointment_mode">Mode *</label><br><input type="checkbox" name="appointment_mode'+id+'['+count+'][]" value="online" /> Online <br><input type="checkbox" name="appointment_mode'+id+'['+count+'][]" value="offline" /> Offline </div><div class="col-lg-2 mt-3"><label for="start_time">Start Time *</label><input id="start_time" name="start_time'+id+'[]" type="time" class=" form-control" /></div><div class="col-lg-2 mt-3"><label for="end_time">End Time *</label><input id="end_time" name="end_time'+id+'[]" type="time" class=" form-control" /></div><div class="col-lg-2 mt-3"><label for="break">Break *</label><select id="break" name="break'+id+'[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required><option>Select Break</option><option value="5">5 Minute</option><option value="10">10 Minute</option><option value="15">15 Minute</option><option value="20">20 Minute</option><option value="30">30 Minute</option><option value="35">35 Minute</option><option value="40">40 Minute</option><option value="45">45 Minute</option><option value="50">50 Minute</option></select></div><div class="col-lg-1 mt-3"><label for="is_disable" class="mt-3" >Disable<input type="checkbox" value="1" id="is_disable" onclick="checkbox(this);"><input type="hidden" name="is_disable'+id+'[]" value="0"></label></div><div class="col-lg-1 mt-3"><a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="'+id+'" onclick="removeMore(this,\''+name+'\');"><i class="fa fa-trash"></i></a></div></div>');
    }else{

      $("#"+name).css('display','none');
      console.log("REMOVE"+""+$("#"+name).html());
    }
    this.g = this.g+1;
  }

  function addFirst(name,id){
    var variable = $("."+name+"_div").html();
    console.log(jQuery.trim(variable));
    if(jQuery.trim(variable) == ''){
      console.log("Here in if1----------"+name);
      $("."+name+'_div').html('<div class="row"><div class="col-lg-2 mt-3"><label for="type">Type *</label><select id="type" name="type'+id+'[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required><option value="morning">Morning</option><option value="aftrenoon">Aftre Noon</option><option value="evening">Evening</option><option value="night">Night</option></select></div><div class="col-lg-2 mt-3"><label for="appointment_mode">Mode *</label><br><input type="checkbox" name="appointment_mode'+id+'[0][]" value="online"/> Online <br><input type="checkbox" name="appointment_mode'+id+'[0][]" value="offline"/> Offline </div><div class="col-lg-2 mt-3"><label for="start_time">Start Time *</label><input id="start_time" name="start_time'+id+'[]" type="time" class=" form-control" /></div><div class="col-lg-2 mt-3"><label for="end_time">End Time *</label><input id="end_time" name="end_time'+id+'[]" type="time" class=" form-control" /></div><div class="col-lg-2 mt-3"><label for="break">Break *</label><select id="break" name="break'+id+'[]" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px" required><option>Select Break</option><option value="5">5 Minute</option><option value="10">10 Minute</option><option value="15">15 Minute</option><option value="20">20 Minute</option><option value="30">30 Minute</option><option value="35">35 Minute</option><option value="40">40 Minute</option><option value="45">45 Minute</option><option value="50">50 Minute</option></select></div><div class="col-lg-1 mt-3"><label for="is_disable" class="mt-3" >Disable<input type="checkbox" value="1" id="is_disable" onclick="checkbox(this);"><input type="hidden" name="is_disable'+id+'[]" value="0"></label></div><div class="col-lg-1 mt-3"><a href="javascript:void(0);" class="btn btn-danger mt-3" data-id="3" id="'+name+'_div" onclick="addMore(\''+name+'_div\','+id+');"><i class="fa fa-plus"></i></a></div></div>');
      this.g = this.g+1;
    }else{
      console.log("Here in else1");
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
      console.log("Here in if");
      $("."+value+'_div').css('display','block');
      addFirst(value,id);
    }else{
      console.log("Here in else");
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