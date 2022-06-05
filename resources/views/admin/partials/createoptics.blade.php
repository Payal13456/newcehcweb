<style type="text/css">
.eye_details td, .eye_details th { padding: 0;
  }
</style>
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Add Optics</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="AddBlogForm" method="post" action="{{ route('optics.store') }}" name="AddBlogForm" autocomplete="off" enctype="multipart/form-data">
  @csrf
  <div class="modal-body">
    <input type="hidden" name="appointment_id" value="{{$id}}">
    <div class="row">
      <div class="col-lg-12  mt-3">
        <label for="remark">Remark *</label>
        <input id="remark" name="remark" type="text" class="required form-control" @if(count($optics) > 0) value="{{$optics[0]->remark}}" @endif required />
        <span class="text-danger error-text name_err"></span>
      </div>
      <div class="col-lg-6  mt-3">
      </div>
    </div>
    <div class="row">
     <!-- <table class="table eye_details" style="padding: 0;margin: 0;">
       <tr>
         <td></td>
         <td colspan="4" style="text-align: center;">Left Eye</td>
         <td colspan="4" style="text-align: center;">Right Eye</td>
       </tr>
       <tr>
         <td></td>
         <td>Dsph</td>
         <td>Dcyl</td>
         <td>Axis</td>
         <td>V/A</td>
         <td>Dsph</td>
         <td>Dcyl</td>
         <td>Axis</td>
         <td>V/A</td>
       </tr>
       <tr>
         <td><input type="hidden" name="type[]" value="dist">Dist.</td>
         <td><input type="text" style="width: 100%;" name="dsph_l[]"></td>
         <td><input type="text" style="width: 100%;" name="dcyl_l[]"></td>
         <td><input type="text" style="width: 100%;" name="axis_l[]"></td>
         <td><input type="text" style="width: 100%;" name="va_l[]"></td>
         <td><input type="text" style="width: 100%;" name="dsph_r[]"></td>
         <td><input type="text" style="width: 100%;" name="dcyl_r[]"></td>
         <td><input type="text" style="width: 100%;" name="axis_r[]"></td>
         <td><input type="text" style="width: 100%;" name="va_r[]"></td>
       </tr>
       <tr>
         <td><input type="hidden" name="type[]" value="near">Near</td>
         <td><input type="text" style="width: 100%;" name="dsph_l[]"></td>
         <td><input type="text" style="width: 100%;" name="dcyl_l[]"></td>
         <td><input type="text" style="width: 100%;" name="axis_l[]"></td>
         <td><input type="text" style="width: 100%;" name="va_l[]"></td>
         <td><input type="text" style="width: 100%;" name="dsph_r[]"></td>
         <td><input type="text" style="width: 100%;" name="dcyl_r[]"></td>
         <td><input type="text" style="width: 100%;" name="axis_r[]"></td>
         <td><input type="text" style="width: 100%;" name="va_r[]"></td>
       </tr>
     </table>  -->
     <table class="table eye_details" style="padding: 0;margin: 0;">
       <tr>
         <td></td>
         <td colspan="4" style="text-align: center;">Right Eye</td>
         <td colspan="4" style="text-align: center;">Left Eye</td>
       </tr>
       <tr>
         <td></td>
         <td>Dsph</td>
         <td>Dcyl</td>
         <td>Axis</td>
         <td>V/A</td>
         <td>Dsph</td>
         <td>Dcyl</td>
         <td>Axis</td>
         <td>V/A</td>
       </tr>
       @php $count1 = 0; $count2 = 0; $count3 = 0; $count4 = 0; @endphp
       @if(count($optics) > 0 )
         <tr>
           <td><input type="hidden" name="type[]" value="dist">Dist.</td>
           
           @foreach($optics as $eye_details)
            @if($eye_details->type == 'dist' && $eye_details->eye_details == 'right')
             <td><input type="text" style="width: 100%;" name="dsph_r[]" value="{{$eye_details->dsph}}"></td>
             <td><input type="text" style="width: 100%;" name="dcyl_r[]" value="{{$eye_details->dcyl}}"></td>
             <td><input type="text" style="width: 100%;" name="axis_r[]" value="{{$eye_details->axis}}"></td>
             <td><input type="text" style="width: 100%;" name="va_r[]" value="{{$eye_details->va}}"></td>
             @php $count2 = 1; break; @endphp
            @else
              @php $count2 = 0; @endphp
            @endif
           @endforeach
           @if($count2 == 0)
             <td><input type="text" style="width: 100%;" name="dsph_r[]"></td>
             <td><input type="text" style="width: 100%;" name="dcyl_r[]"></td>
             <td><input type="text" style="width: 100%;" name="axis_r[]"></td>
             <td><input type="text" style="width: 100%;" name="va_r[]"></td>
           @endif
           @foreach($optics as $eye_details)
            @if($eye_details->type == 'dist' && $eye_details->eye_details == 'left')
             <td><input type="text" style="width: 100%;" name="dsph_l[]" value="{{$eye_details->dsph}}"></td>
             <td><input type="text" style="width: 100%;" name="dcyl_l[]" value="{{$eye_details->dcyl}}"></td>
             <td><input type="text" style="width: 100%;" name="axis_l[]" value="{{$eye_details->axis}}"></td>
             <td><input type="text" style="width: 100%;" name="va_l[]" value="{{$eye_details->va}}"></td>
             @php $count1 = 1; break; @endphp
            @else
              $count1 = 0;
            @endif
           @endforeach
           @if($count1 == 0)
             <td><input type="text" style="width: 100%;" name="dsph_l[]"></td>
             <td><input type="text" style="width: 100%;" name="dcyl_l[]"></td>
             <td><input type="text" style="width: 100%;" name="axis_l[]"></td>
             <td><input type="text" style="width: 100%;" name="va_l[]"></td>
           @endif
         </tr>
         <tr>
           <td><input type="hidden" name="type[]" value="near">Near</td>
           
           @foreach($optics as $eye_details)
            @if($eye_details->type == 'near' && $eye_details->eye_details == 'right')
             <td><input type="text" style="width: 100%;" name="dsph_r[]" value="{{$eye_details->dsph}}"></td>
             <td><input type="text" style="width: 100%;" name="dcyl_r[]" value="{{$eye_details->dcyl}}"></td>
             <td><input type="text" style="width: 100%;" name="axis_r[]" value="{{$eye_details->axis}}"></td>
             <td><input type="text" style="width: 100%;" name="va_r[]" value="{{$eye_details->va}}"></td>
             @php $count4 = 1; break; @endphp
            @else
              @php $count4 = 0; @endphp
            @endif
           @endforeach
           @if($count4 == 0)
             <td><input type="text" style="width: 100%;" name="dsph_r[]"></td>
             <td><input type="text" style="width: 100%;" name="dcyl_r[]"></td>
             <td><input type="text" style="width: 100%;" name="axis_r[]"></td>
             <td><input type="text" style="width: 100%;" name="va_r[]"></td>
           @endif
           @foreach($optics as $eye_details)
            @if($eye_details->type == 'near' && $eye_details->eye_details == 'left')
             <td><input type="text" style="width: 100%;" name="dsph_l[]" value="{{$eye_details->dsph}}"></td>
             <td><input type="text" style="width: 100%;" name="dcyl_l[]" value="{{$eye_details->dcyl}}"></td>
             <td><input type="text" style="width: 100%;" name="axis_l[]" value="{{$eye_details->axis}}"></td>
             <td><input type="text" style="width: 100%;" name="va_l[]" value="{{$eye_details->va}}"></td>
             @php $count3 = 1; break; @endphp
            @else
              @php $count3 = 0; @endphp
            @endif
           @endforeach
           @if($count3 == 0)
             <td><input type="text" style="width: 100%;" name="dsph_l[]"></td>
             <td><input type="text" style="width: 100%;" name="dcyl_l[]"></td>
             <td><input type="text" style="width: 100%;" name="axis_l[]"></td>
             <td><input type="text" style="width: 100%;" name="va_l[]"></td>
           @endif
         </tr>
       @else
         <tr>
           <td><input type="hidden" name="type[]" value="dist">Dist.</td>
           <td><input type="text" style="width: 100%;" name="dsph_l[]"></td>
           <td><input type="text" style="width: 100%;" name="dcyl_l[]"></td>
           <td><input type="text" style="width: 100%;" name="axis_l[]"></td>
           <td><input type="text" style="width: 100%;" name="va_l[]"></td>
           <td><input type="text" style="width: 100%;" name="dsph_r[]"></td>
           <td><input type="text" style="width: 100%;" name="dcyl_r[]"></td>
           <td><input type="text" style="width: 100%;" name="axis_r[]"></td>
           <td><input type="text" style="width: 100%;" name="va_r[]"></td>
         </tr>
         <tr>
           <td><input type="hidden" name="type[]" value="near">Near</td>
           <td><input type="text" style="width: 100%;" name="dsph_l[]"></td>
           <td><input type="text" style="width: 100%;" name="dcyl_l[]"></td>
           <td><input type="text" style="width: 100%;" name="axis_l[]"></td>
           <td><input type="text" style="width: 100%;" name="va_l[]"></td>
           <td><input type="text" style="width: 100%;" name="dsph_r[]"></td>
           <td><input type="text" style="width: 100%;" name="dcyl_r[]"></td>
           <td><input type="text" style="width: 100%;" name="axis_r[]"></td>
           <td><input type="text" style="width: 100%;" name="va_r[]"></td>
         </tr>
        @endif
     </table> 
    </div>
    
    <div class="row">
      <div class="col-lg-12  mt-3">
        <label for="ipd">IPD (in mm)*</label>
        <input id="ipd" name="ipd" type="text" class="required form-control" @if(count($optics) > 0) value="{{$optics[0]->ipd}}" @endif required  />
        <span class="text-danger error-text ipd_err"></span>
      </div>
      <div class="col-lg-6 mt-3">
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-info" data-submit="submit">Submit</button>
  </div>
</form>

<script type="text/javascript">
  function getmedicinelist(keyword){
    console.log("keyword------"+keyword);
      $.ajax({
        url : "{{url('medicines')}}/"+keyword,
        type : "GET",
        success : function(res){
          $("#medicine_div").html(res);
        }
      })
    }

    function medicine(value){
      console.log($(value).html());
       $("#medicine_name").val($(value).html());
       $('#medicine_div') .html('');
    }
</script>
