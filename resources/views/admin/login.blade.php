@extends('admin.layouts.login_layout')
@section('content')
  <div class="main-wrapper">   
    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>   
    <div  class="  auth-wrapper d-flex no-block justify-content-center align-items-center  bg-light " style="padding: 50px;" >
      <div class="auth-box bg-light border border-danger" style="padding: 30px;">
        <div id="loginform">
          <div class="text-center pt-3 pb-3">
             <span class="db"><img src="{{ asset('assets/images/icon-logo.png')}}" alt="logo" width="100px" height="70px"></span>
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
                  <input type="hidden" name="fcm_token" id="fcm_token">          
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
                    <button class="btn btn-danger text-white" type="submit" data-submit="submit">Login</button>
                     <a href="{{ URL('forget_password')}}" class="btn btn-info float-end" id="to-recover">
                      <i class="mdi mdi-lock fs-6 me-1"></i> Forgot password?
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="row border-top border-secondary">
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
            </div> -->
          </form>
      </div>
    </div>
  </div>     
<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>

<script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-messaging.js"></script>
<script>

function detectWebcam(callback) {
  let md = navigator.mediaDevices;
  if (!md || !md.enumerateDevices) return callback(false);
  md.enumerateDevices().then(devices => {
    callback(devices.some(device => 'videoinput' === device.kind));
  })
}

    var firebaseConfig = {
        apiKey: "AIzaSyCZj9ALIgeu6JtQHvOzh0y4t9MKhQ-qKbk",
        authDomain: "chce-application.firebaseapp.com",
        projectId: "chce-application",
        storageBucket: "chce-application.appspot.com",
        messagingSenderId: "653227667756",
        appId: "1:653227667756:web:a9c4bf40ac17011e693c89",
    };

    $(document).ready(function() {
        initFirebaseMessagingRegistration();
    });

    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
  
    function initFirebaseMessagingRegistration() {
            messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken({ vapidKey: 'BB8lEWY62Ie4tX-QxPo53mZvClU8iYIShkIMO4AXdrvtEoamawZxTi4cRQfWS7ASxV6xZxmIPI2lHMrbYBKAOKM' })
            })
            .then(function(token) {
                console.log(token);
                $("#fcm_token").val(token);
                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                // });
  
                // $.ajax({
                //     url: "{{ route('fcmToken') }}",
                //     type: 'POST',
                //     data: {
                //         token: token
                //     },
                //     dataType: 'JSON',
                //     success: function (response) {
                //         alert('Token saved successfully.');
                //     },
                //     error: function (err) {
                //         console.log('User Chat Token Error'+ err);
                //     },
                // });
  
            }).catch(function (err) {
                console.log('User Chat Token Error'+ err);
            });
     }  
      
    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(noteTitle, noteOptions);
    });
   
</script>     
@endsection

