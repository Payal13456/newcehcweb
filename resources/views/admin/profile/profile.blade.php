@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Edit Profile 
</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home')}}">Home</a></li>
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
      <form id="editProfileeForm" method="post" action="{{route('profile.update',$getprofile->user_info->user_id)}}" name="editProfileeForm" autocomplete="off" enctype="multipart/form-data">
        @method('PUT')
        <div class="row">
          <div class="col-lg-6 mt-3 ">
            <label for="first_name">First name *</label>
            <input id="first_name" name="first_name" type="text"
            class="form-control" value="{{ $getprofile->user_info->first_name}}" required/>
            <span class="text-danger error-text first_name_err">
            </span>
          </div>
          <div class="col-lg-6 mt-3">
            <label for="last_name">Last name *</label>
            <input id="last_name" name="last_name" type="text"
            class="form-control" value="{{ $getprofile->user_info->last_name}}" required/>
            <span class="text-danger error-text last_name_err"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 mt-3">
            <label for="emailAddress">Email *</label>
            <input disabled id="emailAddress" name="emailAddress" type="email" class=" form-control" value="{{$getprofile->email}}" readonly/>
            <span class="text-danger error-text emailAddress_err">
            </span>
          </div>
          <div class="col-lg-6 mt-3">
            <label for="phonenumber">Phone Number *
              <small class="text-muted">9999999999</small>
            </label>
            <input id="phonenumber" name="phonenumber" type="tel" class="form-control" value="{{ $getprofile->user_info->phonenumber }}" readonly>
            <span class="text-danger error-text phonenumber_err">
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 mt-3">
            <label for="adharNumber">Aadhar Number *
              <small class="text-muted">1212-1212-1212</small>
            </label>
            <input disabled id="adharNumber" name="adharNumber" type="text" class="form-control adhar-inputmask" value="{{$getprofile->user_info->aadharnumber}}" required/>
            <span class="text-danger error-text adharNumber_err">
            </span>
          </div>
          <div class="col-lg-6 mt-3">
            <label for="gender" style="display: block;">Gender *</label>
            <input type="radio" class="form-check-input customControlValidation2 radio-stacked" id="gender"
            name="gender" value="0"  required {{ ($getprofile->user_info->gender =="0")? "checked" : "" }}/>
            <label class="form-check-label mb-0" for="customControlValidation2" >Male</label>
            <input type="radio" class="form-check-input customControlValidation2 radio-stacked" id="gender1"
            name="gender" value="1"  required {{ ($getprofile->user_info->gender =="1")? "checked" : "" }}/>
            <label class="form-check-label mb-0" for="customControlValidation2" >Female</label>
            <input type="radio" class="form-check-input customControlValidation2 radio-stacked" id="gender2"
            name="gender" value="2"  required {{ ($getprofile->user_info->gender =="2")? "checked" : "" }}/>
            <label class="form-check-label mb-0" for="customControlValidation2" >Other</label>
            <span class="text-danger error-text gender_err"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 mt-3">
            <label for="name">DOB *
              <small class="text-muted">dd/mm/yyyy</small>
            </label>
            <input id="dob" name="dob" type="date" required class=" form-control" value="{{ $getprofile->user_info->month_dob }}"/>
            <span class="text-danger error-text dob_err"></span>
          </div>
          <div class="col-lg-6 mt-3">
            <label for="role">Role *</label>
            <select id="role" name="role" required="" class="select2 form-select shadow-none form-control" style="width: 100%; height: 36px;" disabled="true">
              <option value="">Select</option>
              @if(!empty($getAllRoles))
              @foreach($getAllRoles as $role)
              <option value="{{ $role->id}}" {{ ( $role->id == $getprofile->user_info->role_id) ? 'selected' : '' }}>{{ $role->name}}</option>
              @endforeach
              @endif
            </select>
            <span class="text-danger error-text role_err"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 mt-3"></div>
          <div class="col-lg-6 mt-3"></div>
        </div>
        <div class="row">
          <div class="col-lg-6 mt-3">
            <label for="email">Education Qualification *</label>
            <input id="qualification" name="qualification" type="text" class="form-control" required value="{{ $getprofile->user_info->education_qulaification }}" />
            <span class="text-danger error-text qualification_err">
            </span>
          </div>
          <div class="col-lg-6 mt-3">
            <label for="specialization">Specialization *</label>
            <select name="specialization" id="specialization" class=" form-control" required>
              <option value="">Select</option>
              @if(!empty($getAllspecializations))
              @foreach($getAllspecializations as $spec)
              <option value="{{ $spec->id}}"  {{ ( $spec->id == $getprofile->user_info->specialization_id) ? 'selected' : '' }}  >{{$spec->id }}{{ $spec->specialization}}</option>
              @endforeach
              @endif
            </select>
            <span class="text-danger error-text specialization_err">
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 mt-3">
            <label for="description">Description *</label>
            <textarea  class="form-control" rows="7" cols="5"
            id="description" name="description" type="text"
            required=""/>{{ $getprofile->user_info->description }}</textarea>
            <span class="text-danger error-text description_err">
            </span>
          </div>
          <div class="col-lg-6 mt-3">
            <label for="address">Address *</label>
            <textarea class="form-control" rows="7" cols="5" id="address" name="address" type="text" required="" />{{ $getprofile->user_info->address }}</textarea>
            <span class="text-danger error-text address_err">
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 mt-3">
            <label for="profilePic">Profile Picture</label>
            <input type="file" class="custom-file-input form-control" id="customfile" name="customfile" onchange="encodeImageFileAsURL();">
                <input type="hidden" name="image" id="imgTest">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 mt-3">
            <button type="submit" class="btn btn-info" data-submit="submit">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" role="dialog" style="" id="modal_remove_element_change_password">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="detail" style="">
        <form  id="UpdatePasswordForm" method="post" action="{{ url('changePassword') }}" name="UpdatePasswordForm" autocomplete="off" enctype="multipart/form-data">
      <div class="row mt-3">
        <div class="col-lg-12 ">
          <label for="oldPassword">OLD Password *</label>
          <input id="oldPassword" name="oldPassword" type="password" class="required form-control" />
           <span class="text-danger error-text oldPassword_err">
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-lg-12">
          <label for="newPassword">New Password *</label>
          <input id="newPassword" name="newPassword" type="password" class="required form-control" />
           <span class="text-danger error-text newPassword_err">
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-lg-12">
          <label for="newPassword">Confirm Password *</label>
          <input id="confirmPassword" name="confirmPassword" type="password" class="required form-control" />
           <span class="pass_check error-text">
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12  mt-3">
          <p id="CheckPasswordMatch"></p>
         <button type="submit" class="btn btn-info" data-submit="submit">Submit</button>
        </div>
      </div>
      </div>
       </form>
    </div>
  </div>
</div>
@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function () {
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
<script type='text/javascript'>
  function encodeImageFileAsURL() {

    var filesSelected = document.getElementById("customfile").files;
    if (filesSelected.length > 0) {
      var fileToLoad = filesSelected[0];

      var fileReader = new FileReader();

      fileReader.onload = function(fileLoadedEvent) {
        var srcData = fileLoadedEvent.target.result; // <--- data: base64
        $("#imgTest").attr('value',srcData);
        // alert("Converted Base64 version is " + document.getElementById("imgTest").innerHTML);
        console.log($("#imgTest").val());
      }
      fileReader.readAsDataURL(fileToLoad);
    }
  }
</script>
@endsection
