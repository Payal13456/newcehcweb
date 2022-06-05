<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
      name="keywords"
      content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template"
    />
    <meta name="robots" content="noindex,nofollow" />
    <title>online consultation & Video Call</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.ico')}}" />
     <link href="../assets/libs/jquery-steps/steps.css" rel="stylesheet" />

    <link href="{{ asset('dist/css/style.min.css')}}" rel="stylesheet" />
     <link href="{{ asset('assets/css/lib.css')}}" rel="stylesheet" />
  </head>
  <body>
    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5"
        data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full" >
      <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
          <div class="navbar-header" data-logobg="skin5">
            <a class="navbar-brand" href="index.html">
              <b class="logo-icon ps-2">
                <img src="{{ asset('assets/images/logo-icon.png') }}" alt="homepage" class="light-logo" width="25" />
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
                  href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-bell font-24"></i>
                </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider" /></li>
                  <li>
                    <a class="dropdown-item" href="#">Something else </a>
                  </li>
                </ul>
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
                  <a class="dropdown-item" href="javascript:void(0)">
                    <i class="mdi mdi-account me-1 ms-1"></i> My Profile
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">
                    <i class="mdi mdi-settings me-1 ms-1"></i> 
                    Account Setting</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ url('/logout') }}">
                    <i class="fa fa-power-off me-1 ms-1"></i> Logout
                  </a>
                  <div class="dropdown-divider"></div>
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
            <ul id="sidebarnav" class="pt-4">
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('home')}}" aria-expanded="false">
                 <i class="mdi mdi-view-dashboard"></i>
                 <span class="hide-menu">Dashboard</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('employee.index') }}" aria-expanded="false">
                  <i class="mdi mdi-chart-bar"></i>
                  <span class="hide-menu">Employee</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('hospital.index') }}" aria-expanded="false">
                  <i class="mdi mdi-chart-bubble"></i>
                  <span class="hide-menu">Hospitals/Clinic</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('patient.index')}}" aria-expanded="false">
                  <i class="mdi mdi-border-inside"></i>
                  <span class="hide-menu">Patient</span>
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
                    <a href="form-basic.html" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Category</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="form-basic.html" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Blog</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="form-wizard.html" class="sidebar-link">
                      <i class="mdi mdi-note-plus"></i>
                      <span class="hide-menu">FAQ</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)" aria-expanded="false">
                  <i class="mdi mdi-receipt"></i>
                  <span class="hide-menu">Settings</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="" aria-expanded="false">
                      <i class="mdi mdi-blur-linear"></i>
                      <span class="hide-menu">Plans</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="form-basic.html" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">aaaa</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="form-wizard.html" class="sidebar-link">
                      <i class="mdi mdi-note-plus"></i>
                      <span class="hide-menu">Access</span>
                    </a>
                  </li>
                </ul>
              </li>
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
        All Rights Reserved by Admin. Designed and Developed by
        <a href="https://www.wrappixel.com">Anjali & Pankaj:-)</a>.
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
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
   <script src="../assets/libs/jquery-steps/build/jquery.steps.min.js"></script>
  <script src="{{ asset('dist/js/custom.min.js')}}"></script>
  <script src="{{ asset('assets/libs/flot/excanvas.js')}}"></script>
  <script src="{{ asset('assets/libs/flot/jquery.flot.js')}}"></script>
  <script src="{{ asset('assets/libs/flot/jquery.flot.pie.js')}}"></script>
  <script src="{{ asset('assets/libs/flot/jquery.flot.time.js')}}"></script>
  <script src="{{ asset('assets/libs/flot/jquery.flot.stack.js')}}"></script>
  <script src="{{ asset('assets/libs/flot/jquery.flot.crosshair.js')}}"></script>
  <script src="{{ asset('assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>
  <script src="{{ asset('dist/js/pages/chart/chart-page-init.js')}}"></script>
  <script src="{{ asset('assets/js/lib.js')}}"></script>
  <script>
        ERROR_CLASS = '<?php echo ('alert alert-danger'); ?>';
        base_url ='<?php echo url('/'); ?>';
        request_url ='<?php echo Request::url(); ?>';
        api_url ='<?php echo env('API_URL'); ?>';
  </script>
   @yield('script')
  </body>
</html>
