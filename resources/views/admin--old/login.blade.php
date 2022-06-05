@extends('admin.layouts.login_layout')
@section('content')
  <div class="main-wrapper">   
    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>   
    <div  class="  auth-wrapper d-flex no-block justify-content-center align-items-center  bg-dark " style="padding: 180px;" >
      <div class="auth-box bg-dark border" style="padding: 30px;">
        <div id="loginform">
          <div class="text-center pt-3 pb-3">
             <span class="db"><img src="{{ asset('assets/images/doctor_admin_logo.png')}}" alt="logo" width="30%" height="40%"></span>
          </div>
          <div class="text-center pt-3 pb-3">
            <span class="logo-text ms-1 text-center" style="font-size: 24px; font-weight: bold; color: #DC5324;">
              <!-- dark Logo text -->
              ADMIN PANEL
            </span>
          </div>  
          </div>
          <!-- Form -->
          <form class="form-horizontal mt-3" id="loginform" name="authenticateForm" autocomplete="off"
          action="{{ route('authenticate')}}" method="post">
            <div class="row pb-4">
              <div class="col-12">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-success  text-white h-100" id="basic-addon1" >
                    <i class="mdi mdi-account fs-4"></i></span>
                  </div>
                  <input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Username" name="emailAddress" aria-describedby="basic-addon1" value=""/>
                </div>  
                <div class="input-group mb-3 ">
                    <span class="text-danger error-text emailAddress_err"></span>
                </div>
                

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-warning text-white h-100" id="basic-addon2">
                    <i class="mdi mdi-lock fs-4"></i></span>
                  </div>
                  <input type="password" class="form-control form-control-lg" placeholder="Password"
                  aria-label="Password" aria-describedby="basic-addon1" name="password" id="password" value=""/>                 
                </div>
                <div class="input-group mb-3">
                  <span class="text-danger error-text password_err"></span>
                </div>
              </div>
            </div>
            <div class="row border-top border-secondary">
              <div class="col-12">
                <div class="form-group">
                  <div class="pt-3">
                    <button class="btn btn-success text-white" type="submit" data-submit="submit">Login</button>
                     <a href="{{ URL('forget_password')}}" class="btn btn-info float-end" id="to-recover">
                      <i class="mdi mdi-lock fs-6 me-1"></i> Lost password?
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="row border-top border-secondary">
               <div class="col-12">
                  <div class="form-group">
                    <div class="pt-3">
                      <a href="/recoverpass" class="btn btn-info" id="to-recover">
                        <i class="mdi mdi-lock fs-6 me-1"></i>  
                          Don’t have a doctor-online-video-consultation account? <b>SING UP</b>
                      </a>
                    </div>
                  </div>
               </div>
            </div>
          </form>
      </div>
    </div>
  </div>          
@endsection

