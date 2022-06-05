@extends('admin.layouts.admin_layouts')
@section('content')
 <div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Plan</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('plan.create') }}" class="btn btn-info">Add New Plan</a></li>
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
                    <th>Name</th>
                    <th>Consultation Fees</th>
                    <th>Booking Fees</th>
                    <th>GST</th>
                    <th>Total Amount</th>
                    <th>NumberOf Consultation</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php  $i=1; ?>
                <?php if(!empty($plans)){
                  foreach($plans as $key=>$plan){ ?>
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$plan->name}}</td>
                      <td>{{$plan->consultation_fees}}</td>
                      <td>{{$plan->booking_fees}}</td>
                      <td>{{$plan->gst}}</td>
                      <td>{{$plan->total_amount_after_gst}}</td>
                      <td>{{$plan->number_of_consultation}}</td>
                      <td>
                        <?php $statusColor = ($plan->status == 1) ? 'text-danger' : 'text-success';
                        $blockColor = ($plan->status == 1) ? 'text-danger' : 'text-success' 
                         ?>
                        <span><a href="javascript:void(0)" class="change_planStatus cursor fa fa-toggle-on fa-2x delete_random {{ $statusColor }}" data-type="status" data-toggle="tooltip" data-status="{{(($plan->status == 1) ? '0' : '1')}}" data_planId='{{ $plan->id }}' data-placement="top" title="Active/Inactive"></a></span>
                      </td>
                      <td>
                        <a  href="{{ route('plan.edit',$plan->id) }}" data_id='' class="cursor fa fa-edit fa-2x delete_random" data-toggle="tooltip" data-placement="top" title="Edit Plan details">&nbsp;</a>
                        <a href="javascript:void(0)" data-parent="planListTable" class="tdDeleteColumnData cursor fa fa-trash fa-2x text-danger delete_random"   data-placement="top" title="Delete Plan" data-type="planListDataType" data_id="{{ $plan->id }}" data-id="{{ $plan->id }}" data-row-remove-message="Do you really want to Delete ?" onclick="deleteRowDatatable($(this))"></a>
                    </td>
                    </tr>
                 <?php  } } ?>
                </tbody>
              </table>
            </div>
            <!-- </div> -->
          </div>
        </div>
      </div>
    </div>
</div>
<div class="modal fade" role="dialog" style="" id="modal_remove_element_plan_status">
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
    $(document).on('click', '.change_planStatus', function (e) {
         planId= $(this).attr("data_planId");
         status =$(this).attr("data-status");
         $("#remove_element_status").attr("data_planId",planId);
         $("#remove_element_status").attr("data-status",status);
         $("#modal_remove_element_plan_status").modal("show");

     });
    $(document).on('click', '#remove_element_status', function (e) {
         planId= $(this).attr("data_planId");
         status =$(this).attr("data-status");
        param = {};
        param.planId = planId;
        param.status = status;
        $("#modal_remove_element_plan_status").modal("hide");
        sendRequest($(this), base_url+"/changePlanStatus" ,'post', param);
     });
</script>
@endsection
