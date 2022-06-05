@extends('admin.layouts.admin_layouts')
@section('content')
 <div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Patient</h4>
      <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('patient.upload') }}" class="btn btn-info">Upload File</a></li>
            <li class="breadcrumb-item"><a href="{{ route('patient.create') }}" class="btn btn-info">Add New Patient</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);" id="exportButton" onclick="exportData()" class="btn btn-info"><i class="fa fa-print"></i></a></li>
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
            <!-- <h5 class="card-title"></h5> -->
            <?php 
              $user = Session::get('user');
            ?>
            <!-- <div class="todo-widget scrollable" style="height: 450px"> -->
            <div class="table-responsive">
              <table id="patient_table" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Profile</th>
                    <th>UHID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Primary Number</th>
                    <th>Gender</th>
                    <th>Date Of Birth</th>
                    <th>Aadhar Number</th>
                    <th>Patient Type</th>
                    @if($user->role_id != 1)
                      <th>Status</th>
                    @endif
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                <?php  $i = 1; ?>
                @if (!empty($patients))
                  @foreach($patients as $key =>  $patient)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>
                      @if(!empty($patient->upload_of_picture))
                        <img src="{{ env('API_BASEURL') }}/{{$patient->upload_of_picture}}" alt="user" class="rounded-circle" width="30" />
                      @else
                        <img src="../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="30"/>
                      @endif</td>
                      <td>{{$patient->uhid}}</td>
                      <td>{{$patient->first_name}}</td>
                      <td>{{$patient->last_name}}</td>
                       <td>{{$patient->email_address}}</td>
                       <td>{{$patient->phone_number_primary}}</td>
                        <td>{{$patient->gender == 1 ? 'Male' : 'Female'}}</td>
                        <td>{{date('d M Y',strtotime($patient->date_of_birth))}}</td>
                        <td>{{$patient->adhar_card}}</td>
                        <td><?php echo  ($patient->type_of_patient==1) ? "Free" : "Paid"; ?></td>
                      @if($user->role_id != 1)
                        <td>
                          <?php $statusColor = ($patient->status == 0) ? 'text-danger' : 'text-success';?>
                          <span><a href="javascript:void(0)" class="change_patientStatus cursor fa fa-toggle-on fa-2x delete_random {{ $statusColor }}" data-type="status" data-toggle="tooltip" data-status="{{(($patient->status == 1) ? '0' : '1')}}" data_patientId='{{ $patient->id }}' data-placement="top" title="Active/Inactive"></a></span>
                        </td>
                      @endif
                      <td>
                      <a  href="{{ route('patient.details',$patient->id)}}" data_id='' class=" fa fa-info-circle fa-2x text-primary" data-toggle="tooltip" data-placement="top" title="Family Members">&nbsp;</a>
                        <a  href="{{ route('patient.history',$patient->id) }}" data_id='' class=" fa fa-history fa-2x" data-toggle="tooltip" data-placement="top" title="Appointment History">&nbsp;</a>
                        
                        @if($user->role_id != 1)
                        
                        <a  href="{{ route('patient.family',$patient->id) }}" data_id='' class=" fa fa-users fa-2x text-success" data-toggle="tooltip" data-placement="top" title="Family Members">&nbsp;</a>
                          <a  href="{{ route('patient.edit',$patient->id) }}" data_id='' class=" fa fa-edit fa-2x text-primary" data-toggle="tooltip" data-placement="top" title="Edit patient details">&nbsp;</a>
                          <a href="javascript:void(0)" data-parent="patientListTable" class="tdDeleteColumnData fa fa-trash fa-2x text-danger"  data-toggle="tooltip" data-placement="top" title="Delete Patient" 
                          data-type="patientListDataType" data_id="{{ $patient->id }}" data-id="{{ $patient->id }}" data-row-remove-message="Do you really want to Delete ?" onclick="deleteRowDatatable($(this))"></a>
                        @endif
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
<div class="modal fade" role="dialog" style="" id="modal_remove_element_patient_status">
       <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Confirm Message</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="$('#modal_remove_element_patient_status').modal('hide');">&times;</button>
            </div>
             <div class="modal-body" id="detail" style="">
                <div class="row">
                    <div class="col s12 m12">
                        <div class="form-group col s12">
                             <div id="remove_element_message_status" style="">Do you really want to update patient status</div>
                       </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                 <button class="btn btn-primary btn-fw" style="" id="remove_element_status" ><?php echo('Yes'); ?></button>
                 <button class="btn btn-primary btn-fw" data-dismiss="modal" onclick="$('#modal_remove_element_patient_status').modal('hide');"><?php echo('NO'); ?></button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

<script type="text/javascript">
  
    function exportData(){
    /* Get the HTML data using Element by Id */
    var table = document.getElementById("patient_table");
 
    /* Declaring array variable */
    var rows =[];
 
      //iterate through rows of table
    for(var i=0,row; row = table.rows[i];i++){
        //rows would be accessed using the "row" variable assigned in the for loop
        //Get each cell value/column from the row
        column1 = row.cells[0].innerText;
        column2 = row.cells[2].innerText;
        column3 = row.cells[3].innerText;
        column4 = row.cells[4].innerText;
        column5 = row.cells[5].innerText;
        column6 = row.cells[6].innerText;
        column7 = row.cells[7].innerText;
        column8 = row.cells[8].innerText;
        column9 = row.cells[9].innerText;
        column10 = row.cells[10].innerText;
 
    /* add a new records in the array */
        rows.push(
            [
                column1,
                column2,
                column3,
                column4,
                column5,
                column6,
                column7,
                column8,
                column9,
                column10
            ]
        );
 
        }
        csvContent = "data:text/csv;charset=utf-8,";
         /* add the column delimiter as comma(,) and each row splitted by new line character (\n) */
        rows.forEach(function(rowArray){
            row = rowArray.join(",");
            csvContent += row + "\r\n";
        });
 
        /* create a hidden <a> DOM node and set its download attribute */
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "patient-list.csv");
        document.body.appendChild(link);
         /* download the data file named "Stock_Price_Report.csv" */
        link.click();
    } 


  
    $(document).on('click', '.change_patientStatus', function (e) {
         paitentId= $(this).attr("data_patientId");
         status =$(this).attr("data-status");
         $("#remove_element_status").attr("data_patientId",paitentId);
         $("#remove_element_status").attr("data-status",status);
         $("#modal_remove_element_patient_status").modal("show");

     });
    $(document).on('click', '#remove_element_status', function (e) {
         paitentId= $(this).attr("data_patientId");
         status =$(this).attr("data-status");
          param = {};
        param.paitentId = paitentId;
        param.status = status;
         $("#modal_remove_element_patient_status").modal("hide");
        sendRequest($(this), base_url+"/changePatientStatus" ,'post', param);
     });
</script>

@endsection
