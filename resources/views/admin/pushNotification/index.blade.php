@extends('admin.layouts.admin_layouts')
@section('content')
<style type="text/css">
  .mt-0{
    padding: 0 14px;
  }
</style>
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Notifications</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <!-- <li class="breadcrumb-item"><a href="{{ route('blog.create') }}">Add New Blog</a></li> -->
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="comment-widgets scrollable">
          @if(count($notification) > 0)
            @foreach($notification as $k=>$not)
              @if($not->message != '')
                <div class="d-flex flex-row mt-0">
                  <div class="p-2">
                    <img
                      src="../assets/images/users/1.jpg"
                      alt="user"
                      width="30"
                      class="rounded-circle"
                    />
                  </div>
                  <div class="comment-text w-100">
                    <h6 class="font-medium"></h6>
                    <span class="d-block"
                      >{{$not->message}}
                    </span>
                    <div class="comment-footer">
                      <span class="text-muted float-end">{{date('M d, Y', strtotime($not->created_at))}} at {{date('H:i A', strtotime($not->created_at))}}</span>
                    </div>
                  </div>
                </div>
              @endif
            @endforeach
          @else
            <div class="d-flex flex-row mt-0">
              <div class="p-2">
                <p></p>
                <p>Great , You are Up to date.</p>
              </div>
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
    $(document).on('click', '.change_blogStatus', function (e) {
         blogId= $(this).attr("data_blogId");
         status =$(this).attr("data-status");
         $("#remove_element_status").attr("data_blogId",blogId);
         $("#remove_element_status").attr("data-status",status);
         $("#modal_remove_element_blog_status").modal("show");

     });
    $(document).on('click', '#remove_element_status', function (e) {
         blogId= $(this).attr("data_blogId");
         status =$(this).attr("data-status");
        param = {};
        param.blogId = blogId;
        param.status = status;
        $("#modal_remove_element_blog_status").modal("hide");
        sendRequest($(this), base_url+"/changeBlogStatus" ,'post', param);
     });
</script>
@endsection