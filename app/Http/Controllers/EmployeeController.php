<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Classes\requestApi;
use Session;
use Redirect;
use Exception;

class EmployeeController extends Controller
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
    public function index()
    {
       $employees = [];
       $role_name =['role_name'=>''] ;
        $getAllDoctorsData= $this->requestApi->ApiGetWithAuthtMethod('getRolewiseAllUser', $role_name);
        if(!empty($getAllDoctorsData)){
            if($getAllDoctorsData['statusCode'] =='200' && $getAllDoctorsData['success']->messageCode == 1){
                $employees = $getAllDoctorsData['success']->data;
            }
        } 
        // echo "<pre>";print_r($employees);die;
        return view('admin.employee.index', compact('employees'));
    }

    public function pendingList()
    {
        $employees = [];
        $getAllDoctorsData= $this->requestApi->ApiGetWithAuthtMethod('pendingList');
        if(!empty($getAllDoctorsData)){
            if($getAllDoctorsData['statusCode'] =='200' && $getAllDoctorsData['success']->messageCode == 1){
                $employees = $getAllDoctorsData['success']->data;
            }
        } 
        
      return view('admin.employee.list', compact('employees'));
    }

    public function changeStatus($id, $status){
        $employees = [];
        $getAllDoctorsData= $this->requestApi->ApiGetWithAuthtMethod('changeStatus/'.$id.'/'.$status);
        if(!empty($getAllDoctorsData)){
            if($getAllDoctorsData['statusCode'] =='200' && $getAllDoctorsData['success']->messageCode == 1){
                return redirect('/pending-list');
            }
        } 
        return redirect('/pending-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getAllRoles =$getAllspecializations = [];
        $getAllRolesData=$this->requestApi->ApiGetMethod('getAllRoles');
        if (!empty($getAllRolesData))
        {
            if ($getAllRolesData['statusCode'] == "200" && $getAllRolesData['success']->messageCode == 1)
            {
                $getAllRoles = $getAllRolesData['success']->data;
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
        $getAllspec=$this->requestApi->ApiGetMethod('specializations');
        if (!empty($getAllspec))
        {
            if ($getAllspec['statusCode'] == "200" && $getAllspec['success']->messageCode == 1)
            {
                $getAllspecializations = $getAllspec['success']->data;
            }
        }
       return view('admin.employee.add',compact('getAllRoles','getAllspecializations','getAllState'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // echo "<pre>";print_r($request->all());die;
        try { 
            $response = array();
            $response['status'] = 0;
            $response['class'] = 'alert alert-danger';
            $response['validate_error']  = false;
            $response['script'] = "$('.text-danger').css('display','none');";
            $validator = Validator::make($request->all(), [ 
                'first_name' => 'required',
                'last_name' => 'required',
                'emailAddress' => 'required|email',
                'phonenumber' => 'required|max:10',
                'adharNumber' => 'required|min:11|max:12',
                'gender' => 'required',
                'dob' => 'required',
                'role' => 'required',
                'qualification' => 'required',
                'description' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state_id' => 'required',
                'password'=>'required',
                'customfile'=>'image|mimes:jpeg,png,jpg,gif,svg'
            ]);

            if ($validator->fails()) {
                $response['validate_error']  = true;
                $response['error'] = $validator->errors();
                echo json_encode($response);
            }else{
              //   if ($request->hasFile('profilePic')) {
              //     if($request->file('profilePic')->isValid()) {
              //       $file = $request->file('profilePic');
              //       $image = base64_encode(base64_encode(file_get_contents($file)));
              //       echo $image;die;
              //     }
              // }

              $credentials =[
                "specialization_id"=>$request->specialization,
                "first_name" =>ucfirst($request->first_name),
                "last_name" =>ucfirst($request->last_name),
                "month_dob" =>$request->dob,
                "phonenumber" =>$request->phonenumber,
                "aadharnumber" =>$request->adharNumber,
                "gender" =>$request->gender,
                "education_qulaification"=>ucfirst($request->qualification),
                "description" =>ucfirst($request->description),
                "address" =>ucfirst($request->address),
                "password" =>$request->password,
                "role_id" =>$request->role,
                "email"=>$request->emailAddress,
                "city"=>$request->city,
                "state_id"=>$request->state_id,
                "profilePic"=>$request->profilePic
              ];
              if(!empty($credentials)){
                $LoginData =$this->requestApi->ApiPostWithAuthMethod('users',$credentials);
                // echo "<pre>";print_r($LoginData);die; 
                  if(!empty($LoginData)){
                      if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                         $response['redirect'] ='/employee' ; 
                      }else{              
                          $response['msgCommon'] =$LoginData['error']->message;
                      }    
                  }else{
                      $response['redirect'] ='/employee' ; 
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
       $employee = [];
       $role_name =['role_name'=>''] ;
        $getAllDoctorsData= $this->requestApi->ApiGetWithAuthtMethod('users/'.$id);
        
        if(!empty($getAllDoctorsData)){
            if($getAllDoctorsData['statusCode'] =='200' && $getAllDoctorsData['success']->messageCode == 1){
                $employee = $getAllDoctorsData['success']->data;
            }
        } 
        //echo "<pre>";print_r($getAllDoctorsData);die;
        return view('admin.employee.details', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $getAllEmp = [];
        $getAllEmpData=$this->requestApi->ApiGetWithAuthtMethod('users/'.$id);
        if (!empty($getAllEmpData))
        {
            if ($getAllEmpData['statusCode'] == "200" && $getAllEmpData['success']->messageCode == 1)
            {
                $getAllEmp = $getAllEmpData['success']->data;
            }
        }
        $getAllRoles =$getAllspecializations = [];
        $getAllRolesData=$this->requestApi->ApiGetMethod('getAllRoles');
        if (!empty($getAllRolesData))
        {
            if ($getAllRolesData['statusCode'] == "200" && $getAllRolesData['success']->messageCode == 1)
            {
                $getAllRoles = $getAllRolesData['success']->data;
            }
        }
        $getAllspec=$this->requestApi->ApiGetMethod('specializations');
        if (!empty($getAllspec))
        {
            if ($getAllspec['statusCode'] == "200" && $getAllspec['success']->messageCode == 1)
            {
                $getAllspecializations = $getAllspec['success']->data;
            }
        }
       return view('admin.employee.edit',compact('getAllEmp','getAllRoles','getAllspecializations','getAllState'));
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
                'phonenumber' => 'required|max:10',
                'adharNumber' => 'required|min:11|max:12',
                'gender' => 'required',
                'dob' => 'required',
                'role' => 'required',
                'qualification' => 'required',
                'description' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state_id' => 'required',
                'customfile'=>'image|mimes:jpeg,png,jpg,gif,svg'
            ]);
            if ($validator->fails()) {
                $response['validate_error']  = true;
                $response['error'] = $validator->errors();
                echo json_encode($response);
            }else{
              $credentials =[
                "specialization_id"=>$request->specialization,
                "first_name" =>ucfirst($request->first_name),
                "last_name" =>ucfirst($request->last_name),
                "month_dob" =>$request->dob,
                "phonenumber" =>$request->phonenumber,
                "aadharnumber" =>$request->adharNumber,
                "gender" =>$request->gender,
                "education_qulaification"=>ucfirst($request->qualification),
                "description" =>ucfirst($request->description),
                "address" =>ucfirst($request->address),
                "password" =>$request->password,
                "role_id" =>$request->role,
                "email"=>$request->emailAddress,
                "state_id"=>$request->state_id,
                "city"=>$request->city,
                "profilePic"=>$request->profilePic
              ];
              if(!empty($credentials)){
                $LoginData =$this->requestApi->ApiPutWithAuthMethod('users/'.$id,$credentials);

                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/employee' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/employee' ; 
                }
              }
              echo json_encode($response);
            }
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
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
    public function changeEmpStatus(Request $request){
        try { 
            $response = array();
            $response['status'] = 0;
            $response['class'] = 'alert alert-danger';
            $response['validate_error']  = false;
            $response['script'] = "$('.text-danger').css('display','none');";
            $credentials=[];
            if($request->data['type']=="block"){
                  $credentials =[
                  "is_block" =>$request->data['status'],
                ];
            }
            if($request->data['type']=="status"){
                $credentials =[
                  "status" =>$request->data['status'],
                ];
            }
             if(!empty($credentials)){
                 if($request->data['type']=="block"){
                        $LoginData =$this->requestApi->ApiPutWithAuthMethod('userBlock/'.$request->data['userId'],$credentials);
                    }
                    else{
                        $LoginData =$this->requestApi->ApiPutWithAuthMethod('statusUpdate/'.$request->data['userId'],$credentials);
                    }
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       // $response['msgCommon'] =$LoginData['success']->message; 
                       $response['redirect'] ='/employee' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/employee' ; 
                }
            }
            echo json_encode($response);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }
     public function ddd(Request $request){
     dd("in"); 
    }

    public function change_password(){
        return view('admin.profile.changepassword');
     }

    public function changePassword(Request $request){
         try { 
            $response = array();
            $response['status'] = 0;
            $response['class'] = 'alert alert-danger';
            $response['validate_error']  = false;
            $response['script'] = "$('.text-danger').css('display','none');";
            $credentials =[
              "oldPassword" =>$request->oldPassword,
              "newPassword"=>$request->newPassword,
            ];
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPostWithAuthMethod('changePassword',$credentials);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/home' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/home' ; 
                }
            }
            echo json_encode($response);
        }catch(\Exception $e) {
            return $e->getMessage();
        }
     }

    public function doctorsBySpecification($id){
        $doctors = [];
        $getAllrolecodesData= $this->requestApi->ApiGetWithAuthtMethod('doctorsBySpecification/'.$id);
        // echo "<pre>";print_r($getAllrolecodesData);die;
        if(!empty($getAllrolecodesData)){
            if($getAllrolecodesData['statusCode'] =='200' && $getAllrolecodesData['success']->messageCode == 1){
                $doctors = $getAllrolecodesData['success']->data;
            }
        } 
        $res = "<option>Select Doctor</option>";
        if(count($doctors) > 0){
          foreach($doctors as $d){
            $res .= "<option value='".$d->user_id."'>".$d->first_name." ".$d->last_name."</option>";
          }
        }
        return $res;
    }

    public function doctorsByDate($id , $date){
        $doctors = [];
        $getAllrolecodesData= $this->requestApi->ApiGetWithAuthtMethod('doctorsByDate/'.$id.'/'.$date);
        // echo "<pre>";print_r($getAllrolecodesData);die;
        if(!empty($getAllrolecodesData)){
            if($getAllrolecodesData['statusCode'] =='200' && $getAllrolecodesData['success']->messageCode == 1){
                $doctors = $getAllrolecodesData['success']->data;
            }
        } 
        $res = "<option>Select Doctor</option>";
        if(count($doctors) > 0){
          foreach($doctors as $d){
            $res .= "<option value='".$d->user_id."'>".$d->first_name." ".$d->last_name."</option>";
          }
        }
        return $res;
    }
    
    public function specializationDoctor($id){
    	$doctors = [];
    	$getAllrolecodesData= $this->requestApi->ApiGetWithAuthtMethod('doctorsBySpecification/'.$id);
        // echo "<pre>";print_r($getAllrolecodesData);die;
        if(!empty($getAllrolecodesData)){
            if($getAllrolecodesData['statusCode'] =='200' && $getAllrolecodesData['success']->messageCode == 1){
                $doctors = $getAllrolecodesData['success']->data;
            }
        } 
        
        return count($doctors);
    }
}
