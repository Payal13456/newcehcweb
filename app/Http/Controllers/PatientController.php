<?php

namespace App\Http\Controllers;

use App\Classes\requestApi;
use Illuminate\Http\Request;
use Validator;
use Session;
use Redirect;
use Exception;


class PatientController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = [];
        $getPatientsBlogsData= $this->requestApi->ApiGetWithAuthtMethod('patients');
        if(!empty($getPatientsBlogsData)){
            if($getPatientsBlogsData['statusCode'] =='200' && $getPatientsBlogsData['success']->messageCode == 1){
                $patients = $getPatientsBlogsData['success']->data;
            }
        }
       return view('admin.patient.index',compact('patients'));
    }

    public function patientHistory($id)
    {
        $history = []; $patient = [];
        $getPatientsBlogsData= $this->requestApi->ApiGetWithAuthtMethod('bookingHistory/'.$id);
        if(!empty($getPatientsBlogsData)){
            if($getPatientsBlogsData['statusCode'] =='200' && $getPatientsBlogsData['success']->messageCode == 1){
                $history = $getPatientsBlogsData['success']->data;
            }
        }

        $getPatientsBlogsData= $this->requestApi->ApiGetWithAuthtMethod('patients/'.$id);
        if(!empty($getPatientsBlogsData)){
            if($getPatientsBlogsData['statusCode'] =='200' && $getPatientsBlogsData['success']->messageCode == 1){
                $patient = $getPatientsBlogsData['success']->data;
            }
        }
        // echo "<pre>";print_r($patient);die;
       return view('admin.patient.patient-history',compact('history','patient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getAllState=[];
        $getAllStateData=$this->requestApi->ApiGetMethod('states');
        if (!empty($getAllStateData))
        {
            if ($getAllStateData['statusCode'] == "200" && $getAllStateData['success']->messageCode == 1)
            {
                $getAllState = $getAllStateData['success']->data;
            }
        }
       return view('admin.patient.add',compact('getAllState'));
    }

    public function getUploadFile()
    {
        return view('admin.patient.upload');   
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

            $validator = Validator::make($request->all(), [ 
                'first_name' => 'required',
                'last_name' => 'required',
                'email_address' => 'required|email',
                'phone_number_primary' => 'required|max:10',
                'adhar_card' => 'required|min:11|max:12',
                'gender' => 'required',
                'date_of_birth' => 'required',
                'blood_group' => 'required',
                'password' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state_id' => 'required',
                "pincode" => 'required',
                'type_of_patient' =>'required'
            ]);
            if ($validator->fails()) {
                $response['validate_error']  = true;
                $response['error'] = $validator->errors();
                echo json_encode($response);
            }else{
                $credentials =[
                    "parent_id"=>0,
                    "first_name"=>ucfirst($request->first_name),
                    "last_name"=>ucfirst($request->last_name),
                    "email_address"=>$request->email_address,
                    "password"=>$request->password,
                    "phone_number_primary"=>$request->phone_number_primary,
                    "phone_number_secondary"=>'',
                    "date_of_birth"=>$request->date_of_birth,
                    "blood_group" =>$request->blood_group,
                    "gender" =>$request->gender,
                    "adhar_card" =>$request->adhar_card,
                    "city" =>ucfirst($request->city),
                    "pincode" =>$request->pincode,
                    "address" =>ucfirst($request->address),
                    "type_of_patient" =>$request->type_of_patient,
                    "state_id"=>$request->state_id,
                ];
                if(!empty($credentials)){
                //echo "<pre>";print_r(json_encode($credentials));die;
                  $LoginData =$this->requestApi->ApiPostWithAuthMethod('patients',$credentials);
                    if(!empty($LoginData)){
                        
                        if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                           $response['redirect'] ='/patient' ; 
                        }else{              
                            $response['msgCommon'] =$LoginData['error']->message;
                        }    
                    }else{
                        $response['redirect'] ='/patient' ; 
                    }
                }
                echo json_encode($response);
            }
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = [];
        $getPatientsData= $this->requestApi->ApiGetWithAuthtMethod('patients/'.$id);

        if(!empty($getPatientsData)){
            if($getPatientsData['statusCode'] =='200' && $getPatientsData['success']->messageCode == 1){
                $patient = $getPatientsData['success']->data;
            }
        }
         $getAllState=[];
        $getAllStateData=$this->requestApi->ApiGetMethod('states');
        if (!empty($getAllStateData))
        {
            if ($getAllStateData['statusCode'] == "200" && $getAllStateData['success']->messageCode == 1)
            {
                $getAllState = $getAllStateData['success']->data;
            }
        }
        return view('admin.patient.edit',compact('patient','getAllState'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      try { 
            $response = array();
            $response['status'] = 0;
            $response['class'] = 'alert alert-danger';
            $response['validate_error']  = false;
            $response['script'] = "$('.text-danger').css('display','none');";
            $validator = Validator::make($request->all(), [ 
                'first_name' => 'required',
                'last_name' => 'required',
                'email_address' => 'required|email',
                'phone_number_primary' => 'required|max:10',
                'adhar_card' => 'required|min:11|max:12',
                'gender' => 'required',
                'date_of_birth' => 'required',
                'blood_group' => 'required',
                'password' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state_id' => 'required',
                "pincode" => 'required',
                'type_of_patient' =>'required'
            ]);
            if ($validator->fails()) {
                $response['validate_error']  = true;
                $response['error'] = $validator->errors();
                echo json_encode($response);
            }else{
                $credentials =[
                    "parent_id"=>1,
                    "first_name"=>ucfirst($request->first_name),
                    "last_name"=>ucfirst($request->last_name),
                    "email_address"=>$request->email_address,
                    "password"=>$request->password,
                    "phone_number_primary"=>$request->phone_number_primary,
                    "phone_number_secondary"=>$request->phone_number_primary,
                    "date_of_birth"=>$request->date_of_birth,
                    "blood_group" =>$request->blood_group,
                    "gender" =>$request->gender,
                    "adhar_card" =>$request->adhar_card,
                    "city" =>ucfirst($request->city),
                    "pincode" =>$request->pincode,
                    "address" =>ucfirst($request->address),
                    "type_of_patient" =>$request->type_of_patient,
                     "state_id" =>$request->state_id,
                ];

                if(!empty($credentials)){
                  $LoginData =$this->requestApi->ApiPutWithAuthMethod('patients/'.$id,$credentials);
                    if(!empty($LoginData)){
                    //echo "<pre>";print_r($LoginData);die;
                        if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                           $response['redirect'] ='/patient' ; 
                        }else{              
                            $response['msgCommon'] =$LoginData['error']->message;
                        }    
                    }else{
                        $response['redirect'] ='/patient' ; 
                    }
                }
                echo json_encode($response);
            }
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }
    
    public function patientDetails($id){
    	 $patients = [];
        $getPatientsBlogsData= $this->requestApi->ApiGetWithAuthtMethod('patients/'.$id);
        if(!empty($getPatientsBlogsData)){
            if($getPatientsBlogsData['statusCode'] =='200' && $getPatientsBlogsData['success']->messageCode == 1){
                $employee = $getPatientsBlogsData['success']->data;
            }
        }
        //echo "<pre>";print_r($patients);die;
       return view('admin.patient.details',compact('employee'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changePatientStatus(Request $request){
        try { 
            $response = array();
            $response['status'] = 0;
            $response['class'] = 'alert alert-danger';
            $response['validate_error']  = false;
            $response['script'] = "$('.text-danger').css('display','none');";
            $credentials=[];
                $credentials =[
                  "status" =>$request->data['status'],
                ];
             if(!empty($credentials)){
                       $LoginData =$this->requestApi->ApiPutWithAuthMethod('patientStatusUpdate/'.$request->data['paitentId'],$credentials);
                      // dd($LoginData);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['msgCommon'] =$LoginData['success']->message; 
                       $response['redirect'] ='/patient' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/patient' ; 
                }
            }
            echo json_encode($response);
            //return redirect('/patient');
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }
    
    public function patientList(){
        $patients = [];
        $user = Session::get('user');
        $getPatientsBlogsData= $this->requestApi->ApiGetWithAuthtMethod('patientList/'.$user->id);
        if(!empty($getPatientsBlogsData)){
            if($getPatientsBlogsData['statusCode'] =='200' && $getPatientsBlogsData['success']->messageCode == 1){
                $patients = $getPatientsBlogsData['success']->data;
            }
        }
        // echo "<pre>";print_r($patients);die;
       return view('admin.patient.index',compact('patients'));
    }    
    
    public function familyMembers($id){
    	$patients = [];
        $user = Session::get('user');
        $getPatientsBlogsData= $this->requestApi->ApiGetWithAuthtMethod('getPatients/'.$user->id);
        if(!empty($getPatientsBlogsData)){
            if($getPatientsBlogsData['statusCode'] =='200' && $getPatientsBlogsData['success']->messageCode == 1){
                $patients = $getPatientsBlogsData['success']->data;
            }
        }
        // echo "<pre>";print_r($patients);die;
       return view('admin.patient.list',compact('patients'));
    }
}
