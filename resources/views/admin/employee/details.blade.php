@extends('admin.layouts.admin_layouts')
@section('content')
<style>
	.profile-img{
		border-radius: 50%;
		border: 1px solid;
	}
</style>
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Employee Details</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Employee</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body " >
          @if(!empty($employee))
            <div class="container mt-3">
            @if($employee->user->is_approved != 2)
            	<div class="row">
			<div class="col-md-2">
				<img src="{{env('API_BASEURL')}}/{{$employee->picture}}" width="150" height="150" class="profile-img"/>
			</div>
			<div class="col-md-10">
				<h4>Name - {{$employee->first_name}} {{$employee->last_name}}</h4>
				<p class="mt-3">Phone Number - {{$employee->phonenumber}}</p>
				<p>Aadhar Number - {{$employee->aadharnumber}}</p>
				<p> Email - {{$employee->user->email}}</p>
			</div>
            	</div>
            	<hr>
		<div class="row">
			<div class="col-md-3"><p class="mt-3"> Date of birth</p></div><div class="col-md-9"><p class="mt-3">{{date('d M Y',strtotime($employee->month_dob))}}</p></div>
			<div class="col-md-3"><p> Role </p></div><div class="col-md-9"><p> {{$employee->user->role->name}}</p></div>
			<div class="col-md-3"><p> Gender </p></div><div class="col-md-9"><p> {{($employee->gender == 1) ? 'Male' : 'Female'}}</p></div>
			<div class="col-md-3"><p> Address </p></div><div class="col-md-9"><p> {{$employee->address}}</p></div>
			<div class="col-md-3"><p> City </p></div><div class="col-md-9"><p> {{$employee->city}}</p></div>
			<div class="col-md-3"><p> State </p></div><div class="col-md-9"><p>{{ ($employee->state != null) ? $employee->state->state_name : 'NA' }}</p></div>
			<div class="col-md-3"><p> Qualification </p></div><div class="col-md-9"><p> {{$employee->education_qulaification}}</p></div>
			<div class="col-md-3"><p> Description </p></div><div class="col-md-9"><p> {{$employee->description}}</p></div>
		</div>
		@if($employee->role_id == 1 && $employee->user->is_approved == 0)
				<a href="{{url('change-status')}}/{{$employee->user->id}}/1" class="btn btn-primary">Approve</a> <a href="{{url('change-status')}}/{{$employee->user->id}}/2" class="btn btn-danger">Reject</a>
		@endif
		@else
			<div class="row">
				<h3 class="text-center">This User is no longer available</h3>
			</div>
		@endif
			
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" role="dialog" style="" id="modal_remove_element_blog_status">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Confirm Message</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="detail" style="">
        <div class="row">
          <div class="col s12 m12">
            <div class="form-group col s12">
              <div id="remove_element_message_status" style="">Do you really want to Change Status</div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary btn-fw" style="" id="remove_element_status" ><?php echo('Yes'); ?></button>
        <button class="btn btn-primary btn-fw" data-dismiss="modal"><?php echo('NO'); ?></button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')

<script type="text/javascript">
    
    
</script>
@endsection
