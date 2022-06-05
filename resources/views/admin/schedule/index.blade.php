@extends('admin.layouts.admin_layouts')


@section('content')
	<div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Hospital Schedule</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('schedule.edit',$id) }}" class="btn btn-info">Add/Edit Schedule</a></li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>

     <div class="container-fluid">
          <!-- ============================================================== -->
          <!-- Start Page Content -->
          <!-- ============================================================== -->
           <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <!-- <h5 class="card-title"></h5> -->
            <div class="table-responsive">
              <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Sr.no.</th>
                    <!-- <th>Doctor Name</th> -->
                    <th>Day</th>
                    <th>Type</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Break</th>
                    <th>Mode</th>
                    <th>Status</th>
                    <!-- <th>Action</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php  $i=1; ?>
                  @if(!empty($schedule))
                  @foreach($schedule as $k => $d)
                  @foreach($d->details as $key=>$s)
                    @if($s->status != 2)
                      <tr>
                        <td>{{$i++}}</td>
                        <!-- <td>{{$s->userinfo->first_name}} {{$s->userinfo->last_name}}</td> -->
                        <td>{{ucfirst($s->day)}}</td>
                        <td>{{ucfirst($s->type)}}</td>
                        <td>{{date('h:i A',strtotime($s->start_time))}}</td>
                        <td>{{date('h:i A',strtotime($s->end_time))}}</td>
                        <td>{{$s->break}}</td>
                        <td>{{ucwords($s->appointment_mode)}}</td>
                        <td>
                          <?php $statusColor = ($s->status == 1) ? 'text-danger' : 'text-success';
                          $blockColor = ($s->status == 1) ? 'text-danger' : 'text-success' 
                           ?>
                          <span><a href="javascript:void(0)" class="change_scheduleStatus cursor fa fa-toggle-on fa-2x delete_random {{ $statusColor }}" data-type="status" data-toggle="tooltip" data-status="{{(($s->status == 1) ? '0' : '1')}}" data_scheduleId='{{ $s->id }}' data-placement="top" title="Enable/Disable"></a></span>
                        </td>
                       <!--  <td>
                          <a  href="{{ route('schedule.edit',$s->id) }}" data_id='' class="cursor fa fa-edit fa-2x delete_random" data-toggle="tooltip" data-placement="top" title="Edit Role">&nbsp;</a>
                          <a href="javascript:void(0)" data-parent="roleListTable" class="tdDeleteColumnData cursor fa fa-trash fa-2x delete_random"   data-placement="top" title="Delete Role" data-type="roleListDataType" data_id="{{ $s->id }}" data-id="{{ $s->id }}" data-row-remove-message="Do you really want to Delete ?" onclick="deleteRowDatatable($(this))"></a> -->
                      <!-- </td> -->
                      </tr>
                    @endif
                  @endforeach
                  @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  <div class="modal fade" role="dialog" style="" id="modal_remove_element_promocode_status">
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
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).on('click', '.change_scheduleStatus', function (e) {
         scheduleId= $(this).attr("data_scheduleId");
         status =$(this).attr("data-status");
         $("#remove_element_status").attr("data_scheduleId",scheduleId);
         $("#remove_element_status").attr("data-status",status);
         $("#modal_remove_element_promocode_status").modal("show");
     });
    
    $(document).on('click', '#remove_element_status', function (e) {
        scheduleId= $(this).attr("data_scheduleId");
        status =$(this).attr("data-status");
        param = {};
        param.scheduleId = scheduleId;
        param.status = status;
        $("#modal_remove_element_promocode_status").modal("hide");
        sendRequest($(this), base_url+"/changescheduleStatus" ,'post', param);
     });
</script>
@endsection
