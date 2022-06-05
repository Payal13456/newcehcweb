@extends('admin.layouts.admin_layouts')
@section('content')
 <div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Notification</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('notifications.create') }}" class="btn btn-info">Add New Notification</a></li>
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
          <div class="card-body">
          <!-- <div class="todo-widget scrollable" style="height: 450px"> -->
            <div class="table-responsive">
              <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Notification Type</th>
                    <th>Title</th>
                    <th>Description</th>
                    <!-- <th>Status</th> -->
                    <!-- <th>Action</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php  $i=1 ?>
                  @if(!empty($notification))
                  @foreach($notification as $key => $n)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$n->notification_type}}</td>
                      <td>{{$n->title}}</td>
                      <td>{{$n->description}}</td>
                      <!-- <td>
                        <?php 
                          $statusColor = ($n->status == 0) ? 'text-danger' : 'text-success';
                          $blockColor = ($n->status == 1) ? 'text-danger' : 'text-success' 
                         ?>
                        <span><a href="javascript:void(0)" class="change_faqsStatus cursor fa fa-toggle-on fa-2x delete_random {{ $statusColor }}" data-type="status" data-toggle="tooltip" data-status="{{(($n->status == 1) ? '0' : '1')}}" data_faqId='{{ $n->id }}' data-placement="top" title="Active/Inactive"></a></span>
                      </td> -->
                      
                    </tr>

                  @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          <!-- </div>   -->
          </div>
        </div>
      </div>
    </div>
</div>
<div class="modal fade" role="dialog" style="" id="modal_remove_element_faq_status">
       <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Confirm Message</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="$('#modal_remove_element_faq_status').modal('hide');">&times;</button>
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
                 <button class="btn btn-primary btn-fw" data-dismiss="modal" onclick="$('#modal_remove_element_faq_status').modal('hide');"><?php echo('NO'); ?></button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).on('click', '.change_faqsStatus', function (e) {
         faqId= $(this).attr("data_faqId");
         status =$(this).attr("data-status");
         $("#remove_element_status").attr("data_faqId",faqId);
         $("#remove_element_status").attr("data-status",status);
         $("#modal_remove_element_faq_status").modal("show");

     });
    $(document).on('click', '#remove_element_status', function (e) {
         faqId= $(this).attr("data_faqId");
         status =$(this).attr("data-status");
        param = {};
        param.faqId = faqId;
        param.status = status;
        $("#modal_remove_element_faq_status").modal("hide");
        sendRequest($(this), base_url+"/changefaqStatus" ,'post', param);
     });
</script>
@endsection