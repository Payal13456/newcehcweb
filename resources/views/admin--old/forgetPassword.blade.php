@extends('admin.layouts.login_layout')
@section('content')
   <body class="bg-dark">
    <div class="main-wrapper">
      <div class="preloader">
        <div class="lds-ripple">
          <div class="lds-pos"></div>
          <div class="lds-pos"></div>
        </div>
      </div>
      <div class=" auth-wrapper d-flex no-block  justify-content-center align-items-center
       bg-dark " style="padding: 180px;">
        <div class="auth-box bg-dark border" style="padding: 30px;">
          <div id="loginform">
            <div class="text-center pt-3 pb-3">
              <span class="db"
                ><img src="../assets/images/logo.png" alt="logo"
              /></span>
            </div>
            <!-- Form -->
          </div>
          <div id="recoverform">
            <div class="text-center">
              <span class="text-white"
                >Enter your e-mail address below and we will send you
                instructions how to recover a password.</span
              >
            </div>
            <div class="row mt-3">
              <!-- Form -->
              <form class="col-12" action="index.html">
                <!-- email -->
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-danger text-white h-100" id="basic-addon1">
                      <i class="mdi mdi-email fs-4"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control form-control-lg" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1"/>
                </div>
                <!-- pwd -->
                <div class="row mt-3 pt-3 border-top border-secondary">
                  <div class="col-12">
                    <a class="btn btn-success text-white"  href="/login" id="to-login" name="action"
                     >Back To Login</a>
                    <button class="btn btn-info float-end" type="button" name="action" >
                      Recover
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>    
@endsection
