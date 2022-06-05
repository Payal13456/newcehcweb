@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Change Password</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="card">
    <div class="card-body wizard-content">
      <form  id="UpdatePasswordForm" method="post" action="{{ url('changePassword') }}" name="UpdatePasswordForm" autocomplete="off" enctype="multipart/form-data">
        <div class="row mt-3">
          <div class="col-lg-6 ">
            <label for="oldPassword">OLD Password *</label>
            <input id="oldPassword" name="oldPassword" type="password" class="required form-control" />
             <span class="text-danger error-text oldPassword_err"></span>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-lg-6">
            <label for="newPassword">New Password *</label>
            <input id="newPassword" name="newPassword" type="password" class="required form-control" />
             <span class="text-danger error-text newPassword_err"></span>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-lg-6">
            <label for="confirmPassword">Confirm Password *</label>
            <input id="confirmPassword" name="confirmPassword" type="password" class="required form-control" />
               <span class="pass_check error-text"></span>
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
<script>
     $(document).ready(function () {
      $()
       $("#confirmPassword").keyup(function(){
        $('.pass_check').text("Yessss");
        pass1 = $("#newPassword").val();
        pass2 = $("#confirmPassword").val();
       if(pass1 == pass2){
        $('.pass_check').css("color","green");
        $(".pass_check").text('New Password & Confirm Password is match....');
       }else{
        $('.pass_check').css("color","red");
        $(".pass_check").text('New Password & Confirm Password Not match....');
       }
       });
        $(document).on('click', '.change_blogStatus', function (e) {
        
         $("#modal_remove_element_change_password").modal("show");

     });
       
    });
</script>

@endsection