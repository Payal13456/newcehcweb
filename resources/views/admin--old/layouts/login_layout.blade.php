<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta
      name="keywords"
      content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template"
    />
    <meta name="robots" content="noindex,nofollow" />
    <title> Admin Panel</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.ico')}}" />
    <link href="{{ asset('dist/css/style.min.css')}}" rel="stylesheet" />
  </head>
  <body class="bg-dark">
    @yield('content')  
  <footer class="footer text-center">
         Designed and Developed by
      <a href="https://www.wrappixel.com">Anjali & Pankaj :-)</a>
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
                <div id="myModalBodyBackNone" class="">

                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title modalLabelMargin" id="myModalLabel"></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                  <div class="popupmessage">
                      <div> </div>
                  </div>
                  <div id="myModalBody" class="modalLabelMargin">

                  </div>
              </div>
              <div class="modal-footer" id="myModalFooter">

              </div>
          </div>
      </div>
  </div>
  <div class="modal_remove_element_face modal fade" role="dialog" style="">
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
<script src="../assets/libs/jquery/dist/jquery.min.js"></script>

<script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/lib.js') }}"></script>

<script>
  $(".preloader").fadeOut();
</script> 
  @yield('script')
</body> 
</html>
