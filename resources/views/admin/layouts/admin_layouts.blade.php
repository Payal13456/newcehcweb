<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta
      name="keywords"
      content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template"
    />
    <meta name="robots" content="noindex,nofollow" />
    <title>CEHC - Online Video Consultation</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png')}}" />
     <link href="{{ asset('assets/libs/jquery-steps/steps.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/select2/dist/css/select2.min.css')}}"/>
    <link href="{{ asset('dist/css/style.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/lib.css')}}" rel="stylesheet" />
    <script src="https://cdn.agora.io/sdk/release/AgoraRTCSDK-3.6.8.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src='{{asset("assets/js/fontawesome.js")}}' crossorigin='anonymous'></script>


    <style type="text/css">
      sup {
          top: -1.5em;
          padding: 2px 5px;
          background: red;
          color: white;
          border-radius: 50%;
      }
      select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        /* Some browsers will not display the caret when using calc, so we put the fallback first */ 
        background: url("http://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/br_down.png") white no-repeat 98.5% !important; /* !important used for overriding all other customisations */
        background: url("http://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/br_down.png") white no-repeat calc(100% - 10px) !important; /* Better placement regardless of input width */
        padding-right: 20px;
      }
      /*For IE*/
      select::-ms-expand { display: none; }

    </style>

    <link rel="stylesheet" type="text/css" href="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">

    <style type="text/css">
      table.dataTable tr.odd  {
        background-color: #ffffff;
      }
      table.dataTable tr.even td.sorting_1{
        background-color: white;
      }
      table.dataTable tr.odd td.sorting_1{
        background-color: #ffffff;
      }
      .sidebar-nav ul .sidebar-item .active {
	    background: #d27d3f;
	}}
    </style>
  </head>
  <body>
    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>
    @php $user = Session::get('user'); @endphp  
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5"
        data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full" >
      <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
          <div class="navbar-header" data-logobg="skin5">
            <a class="navbar-brand" href="{{ url('home')}}">
              <b class="logo-icon ps-2">
                <img src="{{ asset('assets/images/icon-logo.png') }}" alt="homepage" class="light-logo" width="25px" height="25px" />
              </b>
              <span class="logo-text ms-2">
              Doctor Consultation
                <!-- dark Logo text -->
                <!-- <img src="{{ asset('assets/images/logo-text.png')}}"
                  alt="homepage" class="light-logo" /> -->
              </span>
            </a>
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)" >
              <i class="ti-menu ti-close"></i>
            </a>
          </div>
          <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5" >
            <ul class="navbar-nav float-start me-auto">
              <li class="nav-item d-none d-lg-block">
                <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
              </li>
             
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider" /></li>
                  <li>
                    <a class="dropdown-item" href="#">Something else </a>
                  </li>
              </ul>
              </li>              
            </ul>
            <ul class="navbar-nav float-end">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"
                  href="{{url('notification')}}" id="navbarDropdown" >
                  <i class="mdi mdi-bell font-24"></i><sup id="super">0</sup>
                </a>
              <!-- <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider" /></li>
                  <li>
                    <a class="dropdown-item" href="#">Something else </a>
                  </li>
                </ul> -->
              </li>
             <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-muted waves-effect waves-darkpro-pic " href="#" role="button"
                  id="navbarDropdown" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{ asset('assets/images/users/1.jpg')}}"
                    alt="user" class="rounded-circle" width="31"/>
                </a>
                <ul
                  class="dropdown-menu dropdown-menu-end user-dd animated"
                  aria-labelledby="navbarDropdown" >
                  @if($user->role_id != 5)
                    <a class="dropdown-item" href="{{url('change_password')}}">
                      <i class="mdi mdi-account me-1 ms-1"></i> Change Password
                    </a>
                    <a class="dropdown-item" href="{{ route('profile.index')}}">
                      <i class="mdi mdi-account me-1 ms-1"></i> My Profile
                    </a>
                  @endif
                  
                  <!-- <div class="dropdown-divider"></div> -->
                  <!-- <a class="dropdown-item" href="#">
                    <i class="mdi mdi-settings me-1 ms-1"></i> 
                    Account Setting</a> -->
                    
                  <!-- <div class="dropdown-divider"></div> -->
                  <a class="dropdown-item" href="{{ url('/logout') }}">
                    <i class="fa fa-power-off me-1 ms-1"></i> Logout
                  </a>
                  <!-- <div class="dropdown-divider"></div> -->
                 <!--  <div class="ps-4 p-10">
                    <a href="javascript:void(0)"
                      class="btn btn-sm btn-success btn-rounded text-white">View Profile </a>
                  </div> -->
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <aside class="left-sidebar" data-sidebarbg="skin5">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav">
            <ul id="sidebarnav">
              @if($user->role_id == 5)
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('home')}}" aria-expanded="false">
                 <i class="mdi mdi-view-dashboard"></i>
                 <span class="hide-menu">Dashboard</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('specialization.index') }}" aria-expanded="false">
                  <i class="mdi mdi-ethernet"></i>
                  <span class="hide-menu">Specialization</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('employee.index') }}" aria-expanded="false">
                  <i class="mdi mdi-account-box"></i>
                  <span class="hide-menu">Employee</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('hospital.index') }}" aria-expanded="false">
                  <i class="mdi mdi-hospital-building"></i>
                  <span class="hide-menu">Hospitals/Clinic</span>
                </a>
              </li>
              <!-- <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('schedule.doctorslist') }}" aria-expanded="false">
                  <i class="mdi mdi-calendar"></i>
                  <span class="hide-menu">Doctors Schedule</span>
                </a>
              </li> -->
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('patient.index')}}" aria-expanded="false">
                  <i class="mdi mdi-account-multiple-plus"></i>
                  <span class="hide-menu">Patient</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('appointment.index') }}" aria-expanded="false">
                  <i class="mdi mdi-timer"></i>
                  <span class="hide-menu">Appointment</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('schedule.doctorslist') }}" aria-expanded="false">
                  <i class="mdi mdi-calendar"></i>
                  <span class="hide-menu">Doctors Schedule</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)" aria-expanded="false">
                  <i class="mdi mdi-receipt"></i>
                  <span class="hide-menu">Circulate Articles/Circular</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{route('notifications.index')}}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Firebase Push Notification</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{ route('category.index')}}" class="sidebar-link">
                      <i class="mdi mdi-ethernet"></i>
                      <span class="hide-menu">Category</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{ route('blog.index')}}" class="sidebar-link">
                      <i class="mdi fab fa-blogger-b"></i>
                      <span class="hide-menu">Blog</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{ route('faq.index')}}" class="sidebar-link">
                      <i class="mdi mdi-note-plus"></i>
                      <span class="hide-menu">FAQ</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)" aria-expanded="false">
                  <i class="mdi mdi-settings"></i>
                  <span class="hide-menu">Settings</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('plan.index')}}" aria-expanded="false">
                      <i class="mdi fas fa-file-code"></i>
                      <span class="hide-menu">Plans</span>
                    </a>
                  </li>
                  <!-- <li class="sidebar-item">
                    <a href="{{route('promocode.index')}}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Promo Code</span>
                    </a>
                  </li> -->
                  <li class="sidebar-item">
                    <a href="{{route('roles.index')}}" class="sidebar-link">
                      <i class="mdi mdi-note-plus"></i>
                      <span class="hide-menu">Roles & Permission</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{ route('privacy.index')}}" class="sidebar-link">
                      <i class="mdi mdi-note-plus"></i>
                      <span class="hide-menu">Privacy Policy</span>
                    </a>
                  </li>
                </ul>
              </li>

              @endif
              @if($user->role_id != 5 && $user->role_id != 3)
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('home')}}" aria-expanded="false">
                 <i class="mdi mdi-view-dashboard"></i>
                 <span class="hide-menu">Dashboard</span>
                </a>
              </li>
              @if($user->role_id == 1)
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('schedule.show',$user->id) }}" aria-expanded="false">
                  <i class="mdi mdi-calendar"></i>
                  <span class="hide-menu">Doctors Schedule</span>
                </a>
              </li>
              @else
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('patient.index')}}" aria-expanded="false">
                  <i class="mdi mdi-account-multiple-plus"></i>
                  <span class="hide-menu">Patient</span>
                </a>
              </li>
              @endif
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('appointment.index') }}" aria-expanded="false">
                  <i class="mdi mdi-timer"></i>
                  <span class="hide-menu">Appointment</span>
                </a>
              </li>
              @if($user->role_id == 1)
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('appointment.history') }}" aria-expanded="false">
                  <i class="fa fa-history"></i>
                  <span class="hide-menu">History</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('patient.list') }}" aria-expanded="false">
                  <i class="fa fa-history"></i>
                  <span class="hide-menu">Patient History</span>
                </a>
              </li>
              @endif
              @endif
<!--               <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-buttons.html" aria-expanded="false" >
                  <i class="mdi mdi-relative-scale"></i>
                  <span class="hide-menu">Buttons</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)" aria-expanded="false">
                  <i class="mdi mdi-face"></i>
                  <span class="hide-menu">Icons </span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="icon-material.html" class="sidebar-link">
                      <i class="mdi mdi-emoticon"></i>
                      <span class="hide-menu"> Material Icons </span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="icon-fontawesome.html" class="sidebar-link">
                      <i class="mdi mdi-emoticon-cool"></i>
                      <span class="hide-menu"> Font Awesome Icons </span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-elements.html"
                  aria-expanded="false">
                  <i class="mdi mdi-pencil"></i>
                  <span class="hide-menu">Elements</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)" aria-expanded="false">
                  <i class="mdi mdi-move-resize-variant"></i>
                  <span class="hide-menu">Addons </span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="index2.html" class="sidebar-link"
                      ><i class="mdi mdi-view-dashboard"></i
                      ><span class="hide-menu"> Dashboard-2 </span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="pages-gallery.html" class="sidebar-link"
                      ><i class="mdi mdi-multiplication-box"></i
                      ><span class="hide-menu"> Gallery </span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="pages-calendar.html" class="sidebar-link"
                      ><i class="mdi mdi-calendar-check"></i
                      ><span class="hide-menu"> Calendar </span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="pages-invoice.html" class="sidebar-link"
                      ><i class="mdi mdi-bulletin-board"></i
                      ><span class="hide-menu"> Invoice </span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="pages-chat.html" class="sidebar-link"
                      ><i class="mdi mdi-message-outline"></i
                      ><span class="hide-menu"> Chat Option </span></a
                    >
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="mdi mdi-account-key"></i
                  ><span class="hide-menu">Authentication </span></a
                >
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="authentication-login.html" class="sidebar-link"
                      ><i class="mdi mdi-all-inclusive"></i
                      ><span class="hide-menu"> Login </span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="authentication-register.html" class="sidebar-link"
                      ><i class="mdi mdi-all-inclusive"></i
                      ><span class="hide-menu"> Register </span></a
                    >
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="mdi mdi-alert"></i
                  ><span class="hide-menu">Errors </span></a
                >
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="error-403.html" class="sidebar-link"
                      ><i class="mdi mdi-alert-octagon"></i
                      ><span class="hide-menu"> Error 403 </span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="error-404.html" class="sidebar-link"
                      ><i class="mdi mdi-alert-octagon"></i
                      ><span class="hide-menu"> Error 404 </span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="error-405.html" class="sidebar-link"
                      ><i class="mdi mdi-alert-octagon"></i
                      ><span class="hide-menu"> Error 405 </span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="error-500.html" class="sidebar-link"
                      ><i class="mdi mdi-alert-octagon"></i
                      ><span class="hide-menu"> Error 500 </span></a
                    >
                  </li>
                </ul>
              </li> -->
            </ul>
          </nav>
          <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>
      <div class="page-wrapper">
         @yield('content')
      </div>
      <footer id="footerContent" class="footer text-center text-white">
        All Rights Reserved by Admin.  Designed and Developed by - <a href="https://tryambaka.com/" target="_blank" style="color:white;"><b>Tryambaka Techno Solutions</b></a>
      </footer>
      <div class="msg_topCommon displayNone text-center">
        <div> </div>
      </div>
    <div class="modal fade modalBackgroundNone" id="myModalBackNone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabelBackNone"></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                  <div class="popupmessage">
                      <div> </div>
                  </div>
                  <div id="myModalBodyBackNone" class=""></div>
              </div>
          </div>
      </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title modalLabelMargin" id="myModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="popupmessage">
                        <div> </div>
                    </div>
                    <div id="myModalBody" class="modalLabelMargin"></div>
                </div>
                <div class="modal-footer" id="myModalFooter"></div>
            </div>
        </div>
    </div>
    <div class="modal_remove_element_face modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Confirm Message</h5>
                <button type="button" class="close" data-dismiss="modal"  onclick="close_popup('remove_element')">&times;</button>
            </div>
             <div class="modal-body" id="detail" style="">
                <div class="row">
                    <div class="col s12 m12">
                        <div class="form-group col s12">
                             <div id="remove_element_message" style=""></div>
                       </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                 <button class="btn btn-primary btn-fw" style="" id="remove_element_button" onclick=""><?php echo('Yes'); ?></button>
                 <button class="btn btn-primary btn-fw"  onclick="close_popup('remove_element')"><?php echo('NO'); ?></button>
            </div>
          </div>
        </div>
    </div>
    <div class="modal_error_message_face modal fade" role="dialog" style="">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="error_element_title"></h5>
                <button type="button" class="close" data-dismiss="modal" onclick="close_popup('error_message')">&times;</button>
            </div>
             <div class="modal-body" id="detail" style="">
                <div class="row">
                    <div class="col s12 m12">
                        <div class="form-group col s12">
                             <div id="error_element_message" class="text-center" style=""></div>
                       </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                 <button id="btnErrorMessage" class="btn btn-primary btn-fw" style=" margin-top:0px;margin-left:10px;" onclick="close_popup('error_message')"><?php echo('Ok'); ?></button>
            </div>
        </div>
      </div>
    </div>  
  </div>
</div>
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
   <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

  <script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
  <script src="{{ asset('assets/extra-libs/sparkline/sparkline.js')}}"></script>
  <!--Wave Effects -->
  <script src="{{ asset('dist/js/waves.js')}}"></script>
  <!--Menu sidebar -->
  <script src="{{ asset('dist/js/sidebarmenu.js')}}"></script>
  <!--Custom JavaScript -->
   <script src="{{ asset('assets/libs/jquery-steps/build/jquery.steps.min.js')}}"></script>
  <script src="{{ asset('dist/js/custom.min.js')}}"></script>
  <script src="{{ asset('assets/libs/flot/excanvas.js')}}"></script>
  <script src="{{ asset('assets/libs/flot/jquery.flot.js')}}"></script>
  <script src="{{ asset('assets/libs/flot/jquery.flot.pie.js')}}"></script>
  <script src="{{ asset('assets/libs/flot/jquery.flot.time.js')}}"></script>
  <script src="{{ asset('assets/libs/flot/jquery.flot.stack.js')}}"></script>
  <script src="{{ asset('assets/libs/flot/jquery.flot.crosshair.js')}}"></script>
  <script src="{{ asset('assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>
  <script src="{{ asset('dist/js/pages/chart/chart-page-init.js')}}"></script>
  <script src="{{ asset('assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
  <script src="{{ asset('/dist/js/pages/mask/mask.init.js')}}"></script>
  <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
  <script src="{{ asset('assets/js/lib.js')}}"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js"></script>

<!-- <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script> -->
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
<script>
$(function(){
  $(".table").dataTable();
})

setTimeout(updatecount(), 1000);

function updatecount(){
	$.ajax({
		url : "{{url('notificationCount')}}",
		type : "GET",
		success : function(res){
			$("#super").html(res);
		}
	})
}
</script>
 
  <script>
        ERROR_CLASS = '<?php echo ('alert alert-danger'); ?>';
        base_url ='<?php echo url('/'); ?>';
        request_url ='<?php echo Request::url(); ?>';
        api_url ='<?php echo env('API_URL'); ?>';
        
       CKEDITOR.replace('editor11');
       CKEDITOR.replace('description1');
  </script>



   @yield('script')
  </body>
</html>
