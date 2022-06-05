@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Dashboard</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
           <!--  <li class="breadcrumb-item active" aria-current="page">
              Library
            </li> -->
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
   @php $user = Session::get('user'); @endphp  
          <div class="row">
            <div class="col-md-6 col-lg-3 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-cyan text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-view-dashboard">{{!empty($dashboardCount) ? $dashboardCount->appointmentCount : 0}}</i>
                  </h1>
                  <h6 class="text-white">Appointment Booked</h6>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-danger text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-border-outside">{{!empty($dashboardCount) ? $dashboardCount->cancelledAppointmentCount : 0}}</i>
                  </h1>
                  <h6 class="text-white">Appointment Cancelled</h6>
                </div>
              </div>
            </div>
            @if($user->role_id != 1)
            <div class="col-md-6 col-lg-3 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-success text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-chart-areaspline"> @if(!empty($dashboardCount)) {{$dashboardCount->amountCollected/100}} @else 0 @endif rs </i>
                  </h1>
                  <h6 class="text-white">Amount Collected</h6>
                </div>
              </div>
            </div>
            
            <div class="col-md-6 col-lg-3 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-warning text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-collage">  @if(!empty($dashboardCount)) {{$dashboardCount->amountRefund/100}} @else 0 @endif rs</i>
                  </h1>
                  <h6 class="text-white">Refund issued</h6>
                </div>
              </div>
            </div>
            @endif
            <!-- <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-info text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-arrow-all">100</i>
                  </h1>
                  <h6 class="text-white">Total User</h6>
                </div>
              </div>
            </div> -->
          </div>
          <div class="row">
            @if($user->role_id == 1)
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Upcomming Appointments</h4>
                </div>
                <div class="comment-widgets scrollable">
                  @if(count($appointments) > 0)
                    @foreach($appointments as $k=>$app)
                      @if($k <= 5 && $app->status != 1)
                        <div class="d-flex flex-row comment-row mt-0" onclick="redirect({{$app->id}})">
                          <div class="p-2">
                            @if(!empty($app->patient->upload_of_picture))
                              <img src="{{ env('API_BASEURL') }}/{{$app->patient->upload_of_picture}}" alt="user" class="rounded-circle" width="50" />
                            @else
                              <img src="../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="50"/>
                            @endif
                           <!--  <img
                              src="../assets/images/users/1.jpg"
                              alt="user"
                              width="50"
                              class="rounded-circle"
                            /> -->
                          </div>
                          <div class="comment-text w-100">
                            <h6 class="font-medium">@if($app->patient != NULL){{$app->patient->first_name}} {{$app->patient->last_name}} - {{$app->patient->uhid}} @else NA @endif</h6>
                            <span class="mb-3 d-block"
                              >{{$app->description}}
                            </span>
                            <div class="comment-footer">
                              <span class="text-muted float-end">{{date('M d, Y', strtotime($app->schedule_date))}} at {{date('H:i A', strtotime($app->slot_timing))}}</span>
                                <a href="{{route('appointment.details', $app->id)}}" class="fa fa-info-circle fa-2x text-primary" title="Detais"></a> &nbsp;
                                <a href="{{route('appointment.more', $app->id)}}" class="fas fa-prescription fa-2x text-info" title="Prescription"></a>&nbsp;
                                <a href="{{route('appointment.edit', $app->id)}}" class="fas fa-calendar-alt fa-2x text-success" title="Reschedule"></a> &nbsp;
                                @if($user->role_id == 1 && date('Y-m-d') == date('Y-m-d',strtotime($app->schedule_date))  && $app->type == 'online')
                                  <a href="javascript:void(0);" class="fa fa-video fa-2x" title="Video Call" onClick="videoCall({{$app->id}})"></a>
                                @endif
                            </div>
                          </div>
                        </div>
                      @endif
                    @endforeach
                  @endif
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Cancelled Appointments</h4>
                </div>
                <div class="comment-widgets scrollable">
                  @if(count($cancelled) > 0)
                    @foreach($cancelled as $k=>$app)
                      @if($k <= 5 )
                        <div class="d-flex flex-row comment-row mt-0">
                          <div class="p-2">
                            @if(!empty($app->patient->upload_of_picture))
                              <img src="{{ env('API_BASEURL') }}/{{$app->patient->upload_of_picture}}" alt="user" class="rounded-circle" width="50" />
                            @else
                              <img src="../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="50"/>
                            @endif
                          </div>
                          <div class="comment-text w-100">
                            <h6 class="font-medium">@if($app->patient != NULL){{$app->patient->first_name}} {{$app->patient->last_name}} - {{$app->patient->uhid}} @else NA @endif</h6>
                            <span class="mb-3 d-block"
                              >{{$app->description}}
                            </span>
                            <div class="comment-footer">
                            	<span class="text-muted float-start">@if($app->cancelled_by != null) Cancelled By {{$app->cancelled_by->role->name}} @endif</span>
                              <span class="text-muted float-end">{{date('M d, Y', strtotime($app->schedule_date))}} at {{date('H:i A', strtotime($app->slot_timing))}}</span>
                            </div>
                          </div>
                        </div>
                      @endif
                    @endforeach
                  @endif
                </div>
              </div>
            </div>
           
            <!-- <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Latest Posts</h4>
                </div>
                <div class="comment-widgets scrollable">
                  
                  <div class="d-flex flex-row comment-row mt-0">
                    <div class="p-2">
                      <img
                        src="../assets/images/users/1.jpg"
                        alt="user"
                        width="50"
                        class="rounded-circle"
                      />
                    </div>
                    <div class="comment-text w-100">
                      <h6 class="font-medium">James Anderson</h6>
                      <span class="mb-3 d-block"
                        >Lorem Ipsum is simply dummy text of the printing and
                        type setting industry.
                      </span>
                      <div class="comment-footer">
                        <span class="text-muted float-end">April 14, 2021</span>
                        <button
                          type="button"
                          class="btn btn-cyan btn-sm text-white"
                        >
                          Edit
                        </button>
                        <button
                          type="button"
                          class="btn btn-success btn-sm text-white"
                        >
                          Publish
                        </button>
                        <button
                          type="button"
                          class="btn btn-danger btn-sm text-white"
                        >
                          Delete
                        </button>
                      </div>
                    </div>
                  </div>
                  
                  <div class="d-flex flex-row comment-row">
                    <div class="p-2">
                      <img
                        src="../assets/images/users/4.jpg"
                        alt="user"
                        width="50"
                        class="rounded-circle"
                      />
                    </div>
                    <div class="comment-text active w-100">
                      <h6 class="font-medium">Michael Jorden</h6>
                      <span class="mb-3 d-block"
                        >Lorem Ipsum is simply dummy text of the printing and
                        type setting industry.
                      </span>
                      <div class="comment-footer">
                        <span class="text-muted float-end">May 10, 2021</span>
                        <button
                          type="button"
                          class="btn btn-cyan btn-sm text-white"
                        >
                          Edit
                        </button>
                        <button
                          type="button"
                          class="btn btn-success btn-sm text-white"
                        >
                          Publish
                        </button>
                        <button
                          type="button"
                          class="btn btn-danger btn-sm text-white"
                        >
                          Delete
                        </button>
                      </div>
                    </div>
                  </div>
                  
                  <div class="d-flex flex-row comment-row">
                    <div class="p-2">
                      <img
                        src="../assets/images/users/5.jpg"
                        alt="user"
                        width="50"
                        class="rounded-circle"
                      />
                    </div>
                    <div class="comment-text w-100">
                      <h6 class="font-medium">Johnathan Doeting</h6>
                      <span class="mb-3 d-block"
                        >Lorem Ipsum is simply dummy text of the printing and
                        type setting industry.
                      </span>
                      <div class="comment-footer">
                        <span class="text-muted float-end">August 1, 2021</span>
                        <button
                          type="button"
                          class="btn btn-cyan btn-sm text-white"
                        >
                          Edit
                        </button>
                        <button
                          type="button"
                          class="btn btn-success btn-sm text-white"
                        >
                          Publish
                        </button>
                        <button
                          type="button"
                          class="btn btn-danger btn-sm text-white"
                        >
                          Delete
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">To Do List</h4>
                  <div class="todo-widget scrollable" style="height: 450px">
                    <ul
                      class="list-task todo-list list-group mb-0"
                      data-role="tasklist">
                      <li class="list-group-item todo-item" data-role="task">
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input"
                            id="customCheck"/>
                          <label
                            class="form-check-label w-100 mb-0 todo-label"
                            for="customCheck">
                            <span class="todo-desc fw-normal"
                              >Lorem Ipsum is simply dummy text of the printing
                              and typesetting industry.</span>
                            <span class="badge rounded-pill bg-danger float-end">Today</span>
                          </label>
                        </div>
                        <ul class="list-style-none assignedto">
                          <li class="assignee">
                            <img
                              class="rounded-circle"
                              width="40"
                              src="../assets/images/users/1.jpg"
                              alt="user"
                              data-toggle="tooltip"
                              data-placement="top"
                              title=""
                              data-original-title="Steave"
                            />
                          </li>
                          <li class="assignee">
                            <img
                              class="rounded-circle"
                              width="40"
                              src="../assets/images/users/2.jpg"
                              alt="user"
                              data-toggle="tooltip"
                              data-placement="top"
                              title=""
                              data-original-title="Jessica"
                            />
                          </li>
                          <li class="assignee">
                            <img
                              class="rounded-circle"
                              width="40"
                              src="../assets/images/users/3.jpg"
                              alt="user"
                              data-toggle="tooltip"
                              data-placement="top"
                              title=""
                              data-original-title="Priyanka"
                            />
                          </li>
                          <li class="assignee">
                            <img
                              class="rounded-circle"
                              width="40"
                              src="../assets/images/users/4.jpg"
                              alt="user"
                              data-toggle="tooltip"
                              data-placement="top"
                              title=""
                              data-original-title="Selina"
                            />
                          </li>
                        </ul>
                      </li>
                      <li class="list-group-item todo-item" data-role="task">
                        <div class="form-check">
                          <input
                            type="checkbox"
                            class="form-check-input"
                            id="customCheck1"
                          />
                          <label
                            class="form-check-label w-100 mb-0 todo-label"
                            for="customCheck1"
                          >
                            <span class="todo-desc fw-normal"
                              >Lorem Ipsum is simply dummy text of the
                              printing</span
                            ><span
                              class="badge rounded-pill bg-primary float-end"
                              >1 week
                            </span>
                          </label>
                        </div>
                        <div class="item-date">26 jun 2021</div>
                      </li>
                      <li class="list-group-item todo-item" data-role="task">
                        <div class="form-check">
                          <input
                            type="checkbox"
                            class="form-check-input"
                            id="customCheck2"
                          />
                          <label
                            class="form-check-label w-100 mb-0 todo-label"
                            for="customCheck2"
                          >
                            <span class="todo-desc fw-normal"
                              >Give Purchase report to</span
                            >
                            <span class="badge rounded-pill bg-info float-end"
                              >Yesterday</span
                            >
                          </label>
                        </div>
                        <ul class="list-style-none assignedto">
                          <li class="assignee">
                            <img
                              class="rounded-circle"
                              width="40"
                              src="../assets/images/users/3.jpg"
                              alt="user"
                              data-toggle="tooltip"
                              data-placement="top"
                              title=""
                              data-original-title="Priyanka"
                            />
                          </li>
                          <li class="assignee">
                            <img
                              class="rounded-circle"
                              width="40"
                              src="../assets/images/users/4.jpg"
                              alt="user"
                              data-toggle="tooltip"
                              data-placement="top"
                              title=""
                              data-original-title="Selina"
                            />
                          </li>
                        </ul>
                      </li>
                      <li class="list-group-item todo-item" data-role="task">
                        <div class="form-check">
                          <input
                            type="checkbox"
                            class="form-check-input"
                            id="customCheck3"
                          />
                          <label
                            class="form-check-label w-100 mb-0 todo-label"
                            for="customCheck3"
                          >
                            <span class="todo-desc fw-normal"
                              >Lorem Ipsum is simply dummy text of the printing
                            </span>
                            <span
                              class="badge rounded-pill bg-warning float-end"
                              >2 weeks</span
                            >
                          </label>
                        </div>
                        <div class="item-date">26 jun 2021</div>
                      </li>
                      <li class="list-group-item todo-item" data-role="task">
                        <div class="form-check">
                          <input
                            type="checkbox"
                            class="form-check-input"
                            id="customCheck4"
                          />
                          <label
                            class="form-check-label w-100 mb-0 todo-label"
                            for="customCheck4"
                          >
                            <span class="todo-desc fw-normal"
                              >Give Purchase report to</span
                            >
                            <span class="badge rounded-pill bg-info float-end"
                              >Yesterday</span
                            >
                          </label>
                        </div>
                        <ul class="list-style-none assignedto">
                          <li class="assignee">
                            <img
                              class="rounded-circle"
                              width="40"
                              src="../assets/images/users/3.jpg"
                              alt="user"
                              data-toggle="tooltip"
                              data-placement="top"
                              title=""
                              data-original-title="Priyanka"
                            />
                          </li>
                          <li class="assignee">
                            <img
                              class="rounded-circle"
                              width="40"
                              src="../assets/images/users/4.jpg"
                              alt="user"
                              data-toggle="tooltip"
                              data-placement="top"
                              title=""
                              data-original-title="Selina"
                            />
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div> -->
            @endif

            <!-- <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Chat Option</h4>
                  <div class="chat-box scrollable" style="height: 475px">
                    
                    <ul class="chat-list">
                      
                      <li class="chat-item">
                        <div class="chat-img">
                          <img src="../assets/images/users/1.jpg" alt="user" />
                        </div>
                        <div class="chat-content">
                          <h6 class="font-medium">James Anderson</h6>
                          <div class="box bg-light-info">
                            Lorem Ipsum is simply dummy text of the printing
                            &amp; type setting industry.
                          </div>
                        </div>
                        <div class="chat-time">10:56 am</div>
                      </li>
                      
                      <li class="chat-item">
                        <div class="chat-img">
                          <img src="../assets/images/users/2.jpg" alt="user" />
                        </div>
                        <div class="chat-content">
                          <h6 class="font-medium">Bianca Doe</h6>
                          <div class="box bg-light-info">
                            It’s Great opportunity to work.
                          </div>
                        </div>
                        <div class="chat-time">10:57 am</div>
                      </li>
                      
                      <li class="odd chat-item">
                        <div class="chat-content">
                          <div class="box bg-light-inverse">
                            I would love to join the team.
                          </div>
                          <br />
                        </div>
                      </li>
                      
                      <li class="odd chat-item">
                        <div class="chat-content">
                          <div class="box bg-light-inverse">
                            Whats budget of the new project.
                          </div>
                          <br />
                        </div>
                        <div class="chat-time">10:59 am</div>
                      </li>
                      
                      <li class="chat-item">
                        <div class="chat-img">
                          <img src="../assets/images/users/3.jpg" alt="user" />
                        </div>
                        <div class="chat-content">
                          <h6 class="font-medium">Angelina Rhodes</h6>
                          <div class="box bg-light-info">
                            Well we have good budget for the project
                          </div>
                        </div>
                        <div class="chat-time">11:00 am</div>
                      </li>
                      
                    </ul>
                  </div>
                </div>
                <div class="card-body border-top">
                  <div class="row">
                    <div class="col-9">
                      <div class="input-field mt-0 mb-0">
                        <textarea
                          id="textarea1"
                          placeholder="Type and enter"
                          class="form-control border-0"
                        ></textarea>
                      </div>
                    </div>
                    <div class="col-3">
                      <a
                        class="btn-circle btn-lg btn-cyan float-end text-white"
                        href="javascript:void(0)"
                        ><i class="mdi mdi-send fs-3"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Our partner (Box with Fix height)</h4>
                </div>
                <div
                  class="comment-widgets scrollable"
                  style="max-height: 130px"
                >
                  
                  <div class="d-flex flex-row comment-row mt-0">
                    <div class="p-2">
                      <img
                        src="../assets/images/users/1.jpg"
                        alt="user"
                        width="50"
                        class="rounded-circle"
                      />
                    </div>
                    <div class="comment-text w-100">
                      <h6 class="font-medium">James Anderson</h6>
                      <span class="mb-3 d-block"
                        >Lorem Ipsum is simply dummy text of the printing and
                        type setting industry.
                      </span>
                      <div class="comment-footer">
                        <span class="text-muted float-end">April 14, 2021</span>
                        <button
                          type="button"
                          class="btn btn-cyan btn-sm text-white"
                        >
                          Edit
                        </button>
                        <button
                          type="button"
                          class="btn btn-success btn-sm text-white"
                        >
                          Publish
                        </button>
                        <button
                          type="button"
                          class="btn btn-danger btn-sm text-white"
                        >
                          Delete
                        </button>
                      </div>
                    </div>
                  </div>
                  
                  <div class="d-flex flex-row comment-row">
                    <div class="p-2">
                      <img
                        src="../assets/images/users/4.jpg"
                        alt="user"
                        width="50"
                        class="rounded-circle"
                      />
                    </div>
                    <div class="comment-text active w-100">
                      <h6 class="font-medium">Michael Jorden</h6>
                      <span class="mb-3 d-block"
                        >Lorem Ipsum is simply dummy text of the printing and
                        type setting industry.
                      </span>
                      <div class="comment-footer">
                        <span class="text-muted float-end">May 10, 2021</span>
                        <button
                          type="button"
                          class="btn btn-cyan btn-sm text-white"
                        >
                          Edit
                        </button>
                        <button
                          type="button"
                          class="btn btn-success btn-sm text-white"
                        >
                          Publish
                        </button>
                        <button
                          type="button"
                          class="btn btn-danger btn-sm text-white"
                        >
                          Delete
                        </button>
                      </div>
                    </div>
                  </div>
                  
                  <div class="d-flex flex-row comment-row">
                    <div class="p-2">
                      <img
                        src="../assets/images/users/5.jpg"
                        alt="user"
                        width="50"
                        class="rounded-circle"
                      />
                    </div>
                    <div class="comment-text w-100">
                      <h6 class="font-medium">Johnathan Doeting</h6>
                      <span class="mb-3 d-block"
                        >Lorem Ipsum is simply dummy text of the printing and
                        type setting industry.
                      </span>
                      <div class="comment-footer">
                        <span class="text-muted float-end">August 1, 2021</span>
                        <button
                          type="button"
                          class="btn btn-cyan btn-sm text-white"
                        >
                          Edit
                        </button>
                        <button
                          type="button"
                          class="btn btn-success btn-sm text-white"
                        >
                          Publish
                        </button>
                        <button
                          type="button"
                          class="btn btn-danger btn-sm text-white"
                        >
                          Delete
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
          </div>
        </div>
@endsection   
@section('script')
<script type="text/javascript">  
    function detectWebcam(callback) {
	  let md = navigator.mediaDevices;
	  if (!md || !md.enumerateDevices) return callback(false);
	  md.enumerateDevices().then(devices => {
	    callback(devices.some(device => 'videoinput' === device.kind));
	  })
    }
    function videoCall(id){
    	detectWebcam(function(hasWebcam) {
        	if(!hasWebcam){
        		alert("You need camera enabled device for video call");
        	}else{
        		window.open("{{url('appointment-call')}}/"+id,"Ratting","width=1000,height=1000,left=0,top=0,toolbar=0,status=0");
        	}
	})

    }
	function redirect(id){
		window.location.href = "{{url('appointment')}}";
	}
	
	$(document).ready(function(){
	
	})
</script>
@stop   
