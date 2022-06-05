<?php

namespace App\Http\Controllers;

use App\Classes\requestApi;
use Illuminate\Http\Request;
use Validator;
use Session;
use Redirect;
use Exception;

class AppointmentController extends Controller
{
   	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $requestApi ;

    public function __construct()
    {
        $this->requestApi = new requestApi();
    }

    public function index(){    
        $appointments = [];
        $user = Session::get('user');
        if($user->role_id == 1){
            $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('appointmentlist/'.$user->id);
        }else{
            $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('appointment');
        }
        // $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('appointment');
        if(!empty($getAllBlogsData)){
            if($getAllBlogsData['statusCode'] =='200' && $getAllBlogsData['success']->messageCode == 1){
                $appointments = $getAllBlogsData['success']->data;
            }
        }
        // echo "<pre>";print_r($appointments);die;
        return view('admin.appointments.list',compact('appointments'));
    }
    
    public function cancelledAppointment(){    
        $cancelled = [];
        $user = Session::get('user');
        if($user->role_id == 1){
            $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('cancelledAppointment/'.$user->id);
            // echo "<pre>";print_r($getAllBlogsData);die;
            if($getAllBlogsData['statusCode'] =='200' && $getAllBlogsData['success']->messageCode == 1){
                $cancelled = $getAllBlogsData['success']->data;
            }
        }
        // echo "<pre>";print_r($appointments);die;
        return view('admin.appointments.cancelled',compact('cancelled'));
    }

    public function historyAppointment(){
        $appointments = [];
        $user = Session::get('user');
        if($user->role_id == 1){
            $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('appointmentHistory/'.$user->id);
        }
        // $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('appointment');
        if(!empty($getAllBlogsData)){
            if($getAllBlogsData['statusCode'] =='200' && $getAllBlogsData['success']->messageCode == 1){
                $appointments = $getAllBlogsData['success']->data;
            }
        }
        // echo "<pre>";print_r($appointments);die;
        return view('admin.appointments.history',compact('appointments'));
    }

    public function create(){
        $getAllspecializations=[]; $patients =[];
        $getAllspec=$this->requestApi->ApiGetMethod('specializations');
        if (!empty($getAllspec))
        {
            if ($getAllspec['statusCode'] == "200" && $getAllspec['success']->messageCode == 1)
            {
                $getAllspecializations = $getAllspec['success']->data;
            }
        }

        $getPatientsBlogsData= $this->requestApi->ApiGetWithAuthtMethod('patients');
        if(!empty($getPatientsBlogsData)){
            if($getPatientsBlogsData['statusCode'] =='200' && $getPatientsBlogsData['success']->messageCode == 1){
                $patients = $getPatientsBlogsData['success']->data;
            }
        }
        return view('admin.appointments.add',compact('getAllspecializations','patients'));
    }

    public function edit($id){
        $getAllspecializations=[]; $patients =[]; $appointment = []; $specialization_id = "";
        $getAllspec=$this->requestApi->ApiGetMethod('specializations');
        if (!empty($getAllspec))
        {
            if ($getAllspec['statusCode'] == "200" && $getAllspec['success']->messageCode == 1)
            {
                $getAllspecializations = $getAllspec['success']->data;
            }
        }

        $getPatientsBlogsData= $this->requestApi->ApiGetWithAuthtMethod('patients');
        if(!empty($getPatientsBlogsData)){
            if($getPatientsBlogsData['statusCode'] =='200' && $getPatientsBlogsData['success']->messageCode == 1){
                $patients = $getPatientsBlogsData['success']->data;
            }
        }

        $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('appointment/'.$id);
        if(!empty($getAllBlogsData)){
            if($getAllBlogsData['statusCode'] =='200' && $getAllBlogsData['success']->messageCode == 1){
                $appointment = $getAllBlogsData['success']->data;
            }
        }

        $specialization_id = $appointment->specification_id;

        $getAllrolecodesData= $this->requestApi->ApiGetWithAuthtMethod('doctorsBySpecification/'.$specialization_id);
        // echo "<pre>";print_r($getAllrolecodesData);die;
        if(!empty($getAllrolecodesData)){
            if($getAllrolecodesData['statusCode'] =='200' && $getAllrolecodesData['success']->messageCode == 1){
                $doctors = $getAllrolecodesData['success']->data;
            }
        }

        $data = ['id'=>$appointment->doctor_id, 'date' => $appointment->schedule_date];

        $LoginData =$this->requestApi->ApiPostWithAuthMethod('doctorSchedule',$data);
        if(!empty($LoginData)){
            if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
              $slotsData = $LoginData['success']->data;
            }  else{
              $slotsData = [];
            }
        }
        $slot = "";
        if(!empty($slotsData)){
            if(count($slotsData->slots) > 0){
              foreach($slotsData->slots as $slots){
                if(strtotime($slots) == strtotime($appointment->slot_timing)){
                    $slot .= "<div class='col-md-2'><input type='radio' name='slot_timing' checked  value='".date("G:i",strtotime($slots))."'>&nbsp;&nbsp;".$slots."</div>";
                }else{
                    $slot .= "<div class='col-md-2'><input type='radio' name='slot_timing'  value='".date("G:i",strtotime($slots))."'>&nbsp;&nbsp;".$slots."</div>";
                }
              }
            }else{
              $slot = "slots not available for selected date";
            }
        }else{
            $slot = "slots not available for selected date";
        }
        // echo "<pre>";print_r($appointment);die;
        
        return view('admin.appointments.edit',compact('getAllspecializations','patients','appointment','id','doctors','slot'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try { 
            $response = array();
            $response['status'] = 0;
            $response['class'] = 'alert alert-danger';
            $response['validate_error']  = false;
            $response['script'] = "$('.text-danger').css('display','none');";
            $credentials = $request->all();

            if($credentials['selecttype'] == 'doctor'){
                $credentials['doctor_id'] = $credentials['doctor_ids'];
                $credentials['schedule_date'] = $credentials['schedule_dates'];
            } else{
                $credentials['doctor_id'] = $credentials['doctor_id'];
                $credentials['schedule_date'] = $credentials['schedule_date'];
            }
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPostWithAuthMethod('appointment',$credentials);
              // echo "<pre>";print_r($LoginData);die;
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                        if(!empty($LoginData['success']->data) ){
                            $patient = '';
                            $patientid = $LoginData['success']->data->patient_id;
                            $getPatientsData= $this->requestApi->ApiGetWithAuthtMethod('patients/'.$patientid);

                            if(!empty($getPatientsData)){
                                if($getPatientsData['statusCode'] =='200' && $getPatientsData['success']->messageCode == 1){
                                    $patient = $getPatientsData['success']->data;
                                }
                            }
                            if(!empty($patient) && $patient->type_of_patient == 1){
                                $response['redirect'] ='/appointment' ; 
                            } else{
                                $response['redirect'] ='/payment-page/'.$LoginData['success']->data->id ; 
                            }
                        }else{
                            $response['msgCommon'] =$LoginData['success']->message;    
                        }
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/appointment' ; 
                }
            }
            echo json_encode($response);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }

    public function update(Request $request, $id)
    {
        try { 
            $response = array();
            $response['status'] = 0;
            $response['class'] = 'alert alert-danger';
            $response['validate_error']  = false;
            $response['script'] = "$('.text-danger').css('display','none');";
            $credentials = $request->all();
            // echo "<pre>";print_r($credentials);die;
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPutWithAuthMethod('appointment/'.$id,$credentials);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/appointment' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/appointment' ; 
                }
            }
            echo json_encode($response);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }

    public function upgradeAppointment($id){
        $summary = []; $diagnosis = []; $prescription = []; $optics = []; $medicine = [];
        $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('case-summary/'.$id);
        if(!empty($getAllBlogsData)){
            if($getAllBlogsData['statusCode'] =='200' && $getAllBlogsData['success']->messageCode == 1){
                $summary = $getAllBlogsData['success']->data;
            }
        }

        $getAllDiagnosis= $this->requestApi->ApiGetWithAuthtMethod('diagnosis-list/'.$id);
        if(!empty($getAllDiagnosis)){
            if($getAllDiagnosis['statusCode'] =='200' && $getAllDiagnosis['success']->messageCode == 1){
                $diagnosis = $getAllDiagnosis['success']->data;
            }
        }
        $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('prescription-details/'.$id);
        if(!empty($getAllBlogsData)){
            // echo "<pre>";print_r($getAllBlogsData);die;
            if($getAllBlogsData['statusCode'] =='200' && $getAllBlogsData['success']->messageCode == 1){
                $prescription = $getAllBlogsData['success']->data;
            }
        }

        $getAllOpticsData= $this->requestApi->ApiGetWithAuthtMethod('opticsList/'.$id);
        if(!empty($getAllOpticsData)){
            if($getAllOpticsData['statusCode'] =='200' && $getAllOpticsData['success']->messageCode == 1){
                $optics = $getAllOpticsData['success']->data;
            }
        }


        // echo "<pre>";print_r($prescription);die;

        return view('admin.appointments.upgrade',compact('summary','diagnosis','prescription','id','optics'));
    }

    public function addCaseStudy(Request $request){
        try { 
            $response = array();
            $response['status'] = 0;
            $response['class'] = 'alert alert-danger';
            $response['validate_error']  = false;
            $response['script'] = "$('.text-danger').css('display','none');";
            $credentials = $request->all();
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPostWithAuthMethod('casesummary',$credentials);
              $id = $request->input('appointment_id');
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/appointment-upgrade/'.$id ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/appointment-upgrade/'.$id ; 
                }
            }
            echo json_encode($response);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }

    public function createDiagnosis($id){
        return view('admin.partials.create-diagnosis',compact('id'));
    }

    public function editDiagnosis($id){
        $diagnosis = [];
        $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('diagnosis/'.$id);
        if(!empty($getAllBlogsData)){
            if($getAllBlogsData['statusCode'] =='200' && $getAllBlogsData['success']->messageCode == 1){
                $diagnosis = $getAllBlogsData['success']->data;
            }
        }
        return view('admin.partials.edit-diagnosis',compact('diagnosis','id'));
    }

    public function storeDiagnosis(Request $request){
        try { 
            $response = array();
            $response['status'] = 0;
            $response['class'] = 'alert alert-danger';
            $response['validate_error']  = false;
            $response['script'] = "$('.text-danger').css('display','none');";
            $credentials = $request->all();
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPostWithAuthMethod('diagnosis',$credentials);
              $id = $request->input('appointment_id');
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/appointment-upgrade/'.$id ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/appointment-upgrade/'.$id ; 
                }
            }
            // echo json_encode($response);
            return redirect('/appointment-upgrade/'.$id);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }

    public function updateDiagnosis(Request $request,$id){
        try { 
            $response = array();
            $response['status'] = 0;
            $response['class'] = 'alert alert-danger';
            $response['validate_error']  = false;
            $response['script'] = "$('.text-danger').css('display','none');";
            $credentials = $request->all();
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPostWithAuthMethod('diagnosis/'.$id,$credentials);
              $id = $request->input('appointment_id');
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/appointment-upgrade/'.$id ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/appointment-upgrade/'.$id ; 
                }
            }
            // echo json_encode($response);
            return redirect('/appointment-upgrade/'.$id);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }

    public function createPrescription($id){
        $medicine = [];
        $getAllOpticsData= $this->requestApi->ApiGetWithAuthtMethod('get-medicine');
        if(!empty($getAllOpticsData)){
            if($getAllOpticsData['statusCode'] =='200' && $getAllOpticsData['success']->messageCode == 1){
                $medicine = $getAllOpticsData['success']->data;
            }
        }

        return view('admin.partials.create-prescription',compact('id','medicine'));
    }

    public function opticsCreate($id){
        $optics = [];
        $getAllOpticsData= $this->requestApi->ApiGetWithAuthtMethod('opticsList/'.$id);
        if(!empty($getAllOpticsData)){
            if($getAllOpticsData['statusCode'] =='200' && $getAllOpticsData['success']->messageCode == 1){
                $optics = $getAllOpticsData['success']->data;
            }
        }
        return view('admin.partials.createoptics',compact('id','optics'));
    }

    public function editPrescription($id){
        $prescription = [];
        $medicine = [];
        $getAllOpticsData= $this->requestApi->ApiGetWithAuthtMethod('get-medicine');
        if(!empty($getAllOpticsData)){
            if($getAllOpticsData['statusCode'] =='200' && $getAllOpticsData['success']->messageCode == 1){
                $medicine = $getAllOpticsData['success']->data;
            }
        }
        $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('prescription/'.$id);
        if(!empty($getAllBlogsData)){
            if($getAllBlogsData['statusCode'] =='200' && $getAllBlogsData['success']->messageCode == 1){
                $prescription = $getAllBlogsData['success']->data;
            }
        }
        // echo "<pre>";print_r($prescription);die;
        return view('admin.partials.edit-prescription',compact('prescription','id','medicine'));
    }

    public function storePrescription(Request $request){
        try { 
            $response = array();
            $response['status'] = 0;
            $response['class'] = 'alert alert-danger';
            $response['validate_error']  = false;
            $response['script'] = "$('.text-danger').css('display','none');";
            $credentials = $request->all();
            $credentials['timing'] = implode(",",$credentials['time']);
            $credentials['food'] = implode(",",$credentials['food']);
            $credentials['days'] = $credentials['duration'];
            // echo "<pre>";print_r(json_encode($credentials));die;
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPostWithAuthMethod('prescription',$credentials);
              $id = $request->input('appointment_id');
            // echo "<pre>";print_r(json_encode($LoginData));die;
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/appointment-upgrade/'.$id ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/appointment-upgrade/'.$id ; 
                }
            }
            // echo json_encode($response);
            return redirect('/appointment-upgrade/'.$id);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }

    public function opticsStore(Request $request){
        try { 
            $response = array();
            $response['status'] = 0;
            $response['class'] = 'alert alert-danger';
            $response['validate_error']  = false;
            $response['script'] = "$('.text-danger').css('display','none');";
            $credentials = $request->all();
            // echo "<pre>";print_r(json_encode($credentials));die;
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPostWithAuthMethod('createOptics',$credentials);
              $id = $request->input('appointment_id');
                if(!empty($LoginData)){
                     // echo "<pre>";print_r(json_encode($LoginData));die;
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/appointment-upgrade/'.$id ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/appointment-upgrade/'.$id ; 
                }
            }
            // echo json_encode($response);
            return redirect('/appointment-upgrade/'.$id);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }


    public function updatePrescription(Request $request,$id){
        try { 
            $response = array();
            $response['status'] = 0;
            $response['class'] = 'alert alert-danger';
            $response['validate_error']  = false;
            $response['script'] = "$('.text-danger').css('display','none');";
            $credentials = $request->all();
            $credentials['timing'] = implode(",",$credentials['time']);
            $credentials['food'] = implode(",",$credentials['food']);
            $credentials['days'] = $credentials['dose'];
            $app_id = $credentials['appointment_id'];
            // echo "<pre>";print_r($credentials);die;
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPostWithAuthMethod('prescription/'.$id,$credentials);
              // $id = $request->input('appointment_id');
                if(!empty($LoginData)){
                    // echo "<pre>";print_r($LoginData);die;
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/appointment-upgrade/'.$app_id ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/appointment-upgrade/'.$app_id ; 
                }
            }
            // echo json_encode($response);
            return redirect('/appointment-upgrade/'.$app_id);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }

    public function payment(Request $request){
        try{
            $response = array();
            $response['status'] = 0;
            $response['class'] = 'alert alert-danger';
            $response['validate_error']  = false;
            $response['script'] = "$('.text-danger').css('display','none');";
            $credentials = $request->all();

            if(count($credentials)  && !empty($credentials['razorpay_payment_id'])) {
                $LoginData =$this->requestApi->ApiPostWithAuthMethod('payment',$credentials);
                if(!empty($LoginData)){
                    //echo "<pre>";print_r($LoginData);die;
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/appointment'; 
                      
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }  
                    return redirect('/appointment');  
                }else{
                    $response['redirect'] ='/appointment';
                }
                // return redirect('/appointment');
               // echo json_encode($response);
               return redirect('/appointment');
            }
            // echo json_encode($response);
            //return redirect('/appointment');
            return true;
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }

    public function paymentPage($id){
        $appointment = [];$payment = [];
        $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('appointment/'.$id);
        if(!empty($getAllBlogsData)){
            // echo "<pre>";print_r($getAllBlogsData);die;
            if($getAllBlogsData['statusCode'] =='200' && $getAllBlogsData['success']->messageCode == 1){
                $appointment = $getAllBlogsData['success']->data;
            }
        }
        $getAllPaymentData= $this->requestApi->ApiGetWithAuthtMethod('payment-detail');
        if(!empty($getAllPaymentData)){
            // echo "<pre>";print_r($getAllBlogsData);die;
            if($getAllPaymentData['statusCode'] =='200' && $getAllPaymentData['success']->messageCode == 1){
                $payment = $getAllPaymentData['success']->data;
            }
        }
        //echo "<pre>";print_r($appointment);die;
        return view('admin.appointments.payment-page',compact('appointment','payment'));
    }

    public function cancelBooking(Request $request){
        try { 
            $response = array();
            $response['status'] = 0;
            $response['class'] = 'alert alert-danger';
            $response['validate_error']  = false;
            $response['script'] = "$('.text-danger').css('display','none');";
            $credentials=[];
            
            if($request->data['type']=="status"){
                $credentials =[
                  "status" =>$request->data['status'],
                ];
            }
             if(!empty($credentials)){
                $LoginData =$this->requestApi->ApiPutWithAuthMethod('cancelBooking/'.$request->data['userId'],$credentials);
                // echo "<pre>";print_r($LoginData);die;
                if(!empty($LoginData)){
                    
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       // $response['msgCommon'] =$LoginData['success']->message; 
                       $response['redirect'] ='/appointment' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/appointment' ; 
                }
            }
            echo json_encode($response);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }
    public function medicines($keyword){
        try{
            $appointment = [];
            $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('search-medicine/'.$keyword);
            if(!empty($getAllBlogsData)){
                
                if($getAllBlogsData['statusCode'] =='200' && $getAllBlogsData['success']->messageCode == 1){
                    $appointment = $getAllBlogsData['success']->data;
                }
            }
            $res = "";
            
            if(count($appointment) > 0){
                foreach($appointment as $ap){
                    $res .= "<tr ><td style='border:1px;'><a href='javascript:void(0);' onclick='medicine(this);' style='text-decoration:none;color:black;' value=".$ap->medicine_name.">".$ap->medicine_name."</a></td></tr>";
                }
            }
            return $res;
        }catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    public function appointmentCall($id){
        try{
            $appointment = [];
            $credentials['id'] = $id;
            if( !empty($credentials['id'])) {
                $LoginData =$this->requestApi->ApiPostWithAuthMethod('agora-token',$credentials);
                if(!empty($LoginData)){
                    // echo "<pre>";print_r($LoginData);die;
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                        $data = $LoginData['success']->data;
                        return view('admin.agora-chat',compact('data','id'));
                    } else{              
                        return redirect()->back();
                    }    
                }else{
                    return redirect()->back();
                }
            }
            echo json_encode($response);
            return redirect('/appointment');
        }catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    public function detailAppointment($id){
        $summary = []; $diagnosis = []; $prescription = []; $optics = [];
        $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('case-summary/'.$id);
        if(!empty($getAllBlogsData)){
            if($getAllBlogsData['statusCode'] =='200' && $getAllBlogsData['success']->messageCode == 1){
                $summary = $getAllBlogsData['success']->data;
            }
        }

        $getAllDiagnosis= $this->requestApi->ApiGetWithAuthtMethod('diagnosis-list/'.$id);
        if(!empty($getAllDiagnosis)){
            if($getAllDiagnosis['statusCode'] =='200' && $getAllDiagnosis['success']->messageCode == 1){
                $diagnosis = $getAllDiagnosis['success']->data;
            }
        }
        $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('prescription-details/'.$id);
        if(!empty($getAllBlogsData)){
            if($getAllBlogsData['statusCode'] =='200' && $getAllBlogsData['success']->messageCode == 1){
                $prescription = $getAllBlogsData['success']->data;
            }
        }

        $getAllOpticsData= $this->requestApi->ApiGetWithAuthtMethod('opticsList/'.$id);
        if(!empty($getAllOpticsData)){
            if($getAllOpticsData['statusCode'] =='200' && $getAllOpticsData['success']->messageCode == 1){
                $optics = $getAllOpticsData['success']->data;
            }
        }

        $getAppointmentData= $this->requestApi->ApiGetWithAuthtMethod('appointment/'.$id);
        if(!empty($getAppointmentData)){
            if($getAppointmentData['statusCode'] =='200' && $getAppointmentData['success']->messageCode == 1){
                $appointment = $getAppointmentData['success']->data;
            }
        }
        // echo "<pre>";print_r($appointment);die;
        return view('admin.appointments.details',compact('summary','diagnosis','prescription','id','optics','appointment'));
    }   
    
    public function endConsultation($id){
    	try{
    		$getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('end-consultation/'.$id);
    		if(!empty($getAllBlogsData)){
		    if($getAllBlogsData['statusCode'] =='200' && $getAllBlogsData['success']->messageCode == 1){
		       return redirect('appointment');
		    }
		}
    	}catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    public function printPrescription($id){
        $summary = []; $diagnosis = []; $prescription = []; $optics = [];
        $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('case-summary/'.$id);
        if(!empty($getAllBlogsData)){
            if($getAllBlogsData['statusCode'] =='200' && $getAllBlogsData['success']->messageCode == 1){
                $summary = $getAllBlogsData['success']->data;
            }
        }

        $getAllDiagnosis= $this->requestApi->ApiGetWithAuthtMethod('diagnosis-list/'.$id);
        if(!empty($getAllDiagnosis)){
            if($getAllDiagnosis['statusCode'] =='200' && $getAllDiagnosis['success']->messageCode == 1){
                $diagnosis = $getAllDiagnosis['success']->data;
            }
        }
        $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('prescription-details/'.$id);
        if(!empty($getAllBlogsData)){
            if($getAllBlogsData['statusCode'] =='200' && $getAllBlogsData['success']->messageCode == 1){
                $prescription = $getAllBlogsData['success']->data;
            }
        }

        $getAllOpticsData= $this->requestApi->ApiGetWithAuthtMethod('opticsList/'.$id);
        if(!empty($getAllOpticsData)){
            if($getAllOpticsData['statusCode'] =='200' && $getAllOpticsData['success']->messageCode == 1){
                $optics = $getAllOpticsData['success']->data;
            }
        }

        $getAppointmentData= $this->requestApi->ApiGetWithAuthtMethod('appointment/'.$id);
        if(!empty($getAppointmentData)){
            if($getAppointmentData['statusCode'] =='200' && $getAppointmentData['success']->messageCode == 1){
                $appointment = $getAppointmentData['success']->data;
            }
        }
        // echo "<pre>";print_r($appointment);die;
        return view('admin.appointments.print',compact('summary','diagnosis','prescription','id','optics','appointment'));
    }   
}

