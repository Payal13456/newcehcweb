@extends('admin.layouts.admin_layouts')
@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Upload File</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Upload</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="card">
    <div class="card-body wizard-content">
      <form id="AddPatientForm" method="post" action="{{ route('patient.uploadfile') }}" name="AddPatientForm" autocomplete="off" enctype="multipart/form-data">
        <div class="row">
         <div class="col-lg-6 mt-3">
           <label for="customfile">Upload file <span style="font-size:10px;">(only xlsx)</span></label>
            <input type="file" class="custom-file-input form-control" id="customfile" name="customfile" onchange="encodeImageFileAsURL();" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  >
            <input type="hidden" name="uploadfile" id="uploadfile">
          </div>          
        </div>
        <div class="row">
          <div class="col-lg-6  mt-3">
            <button type="submit" class="btn btn-info" data-submit="submit">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('script')

<script type='text/javascript'>
  function encodeImageFileAsURL() {
    var filesSelected = document.getElementById("customfile").files;
    if (filesSelected.length > 0) {
      var fileToLoad = filesSelected[0];
      var fileReader = new FileReader();
      fileReader.onload = function(fileLoadedEvent) {
        var srcData = fileLoadedEvent.target.result; // <--- data: base64
        $("#imgTest").attr('value',srcData);
        // alert("Converted Base64 version is " + document.getElementById("imgTest").innerHTML);
        console.log($("#uploadfile").val());
      }
      fileReader.readAsDataURL(fileToLoad);
    }
  }
</script>
@endsection

