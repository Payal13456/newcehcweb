@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Blog</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('blog.create') }}" class="btn btn-info">Add New Blog</a></li>
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
                  <th>Category</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
            
              <tbody>
                <?php  $i = 1; ?>
                @if (!empty($blogs))
                  @foreach($blogs as $key =>  $blog)
                    <tr>
                      <td>{{$i++}}</td>
                      <td><?php if(!empty($blog->category)){ print_r($blog->category->category_name);} ?></td>
                      <td>{{$blog->title}}</td>
                      <td>{{$blog->description}}</td>
                      <td>
                        <?php $statusColor = ($blog->status == 0) ? 'text-danger' : 'text-success';
                        $blockColor = ($blog->status == 1) ? 'text-danger' : 'text-success' 
                         ?>
                        <span><a href="javascript:void(0)" class="change_blogStatus cursor fa fa-toggle-on fa-2x delete_random {{ $statusColor }}" data-type="status" data-toggle="tooltip" data-status="{{(($blog->status == 1) ? '0' : '1')}}" data_blogId='{{ $blog->id }}' data-placement="top" title="Active/Inactive"></a></span>
                      </td>
                      <td>
                        <a  href="{{ route('blog.edit',$blog->id) }}" data_id='' class="cursor fa fa-edit fa-2x delete_random" data-toggle="tooltip" data-placement="top" title="Edit blog details">&nbsp;</a>
                        <a href="javascript:void(0)" data-parent="blogListTable" class="tdDeleteColumnData cursor fa fa-trash fa-2x text-danger delete_random"  data-toggle="tooltip" data-placement="top" title="Delete Blog" data-type="blogListDataType" data_id="{{ $blog->id }}" data-id="{{ $blog->id }}" data-row-remove-message="Do you really want to Delete ?" onclick="deleteRowDatatable($(this))"></a>
                    </td>
                    </tr>

                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
          <!-- </div> -->
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
        <button type="button" class="close" data-dismiss="modal" onclick="$('#modal_remove_element_blog_status').modal('hide');">&times;</button>
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
        <button class="btn btn-primary btn-fw" data-dismiss="modal" onclick="$('#modal_remove_element_blog_status').modal('hide');"><?php echo('NO'); ?></button>
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