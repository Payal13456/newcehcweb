<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Add Diagnosis</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="AddBlogForm" method="post" action="{{ route('diagnosis.update',$id) }}" name="AddBlogForm" autocomplete="off" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="modal-body">
    <div class="row">
      <div class="col-lg-12  mt-3">
        <input type="hidden" name="id" value="{{$diagnosis->id}}">
        <input type="hidden" name="appointment_id" value="{{$diagnosis->appointment_id}}" />
        <label for="name">Name *</label>
        <input id="name" name="name" type="text" class="required form-control" required value="{{$diagnosis->name}}" />
        
        <span class="text-danger error-text name_err"></span>
      </div>
      <div class="col-lg-6  mt-3">
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12  mt-3">
        <label for="instruction">Instruction *</label>
        <textarea  class="form-control" rows="7" cols="5" id="instruction" name="instruction" required type="text" >{{$diagnosis->instruction}}
        </textarea>
        <span class="text-danger error-text instruction_err"></span>
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