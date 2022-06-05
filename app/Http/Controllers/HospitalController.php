<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Classes\requestApi;
use Session;
use Redirect;
use Exception;

class HospitalController extends Controller
{
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
        $hospitals = [];
        $getAllHospitalsData= $this->requestApi->ApiGetWithAuthtMethod('hospitals');
        if(!empty($getAllHospitalsData)){
            if($getAllHospitalsData['statusCode'] =='200' && $getAllHospitalsData['success']->messageCode == 1){
                $hospitals = $getAllHospitalsData['success']->data;
            }
        } 
        return view('admin.hospitals.index',compact('hospitals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getEmployees=[];
        $getAllState=[];
        $getAllStateData=$this->requestApi->ApiGetMethod('states');
        // echo '<pre>';print_r($getAllStateData);die;
        if (!empty($getAllStateData))
        {
            if ($getAllStateData['statusCode'] == "200" && $getAllStateData['success']->messageCode == 1){
                $getAllState = $getAllStateData['success']->data;
            }
        }
        $role_name =['role_name'=>''] ;
        $getemployeeData= $this->requestApi->ApiGetWithAuthtMethod('getRolewiseAllUser', $role_name);
        if (!empty($getemployeeData))
        {
            if ($getemployeeData['statusCode'] == "200" && $getemployeeData['success']->messageCode == 1){
                $getEmployees = $getemployeeData['success']->data;
            }
        }
        return view('admin.hospitals.add',compact('getEmployees','getAllState'));
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
                'name' => 'required',
                'address' => 'required',
                'email'=>"required|email",
                'primary_number' =>  'required',
                'city' =>  'required',
                'state_id' =>  'required',
            ]);
            if ($validator->fails()) {
                $response['validate_error']  = true;
                $response['error'] = $validator->errors();
            }
            $credentials =[
              "user_id"=>$request->user_id,
              "name" =>ucfirst($request->name),
              "email"=>$request->email,
              "address" =>ucfirst($request->address),
              "primary_number" =>$request->primary_number,
              "secondary_number" =>$request->secondary_number,
              "location" =>$request->location,
               "city" =>$request->city,
              "state_id" =>$request->state_id,
            ];
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPostWithAuthMethod('hospitals',$credentials);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/hospital' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/hospital' ; 
                }
            }
            echo json_encode($response);
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
        $gethospital = [];
        $getEmployees=[];

        $getHospData=$this->requestApi->ApiGetWithAuthtMethod('hospitals/'.$id);
         $role_name =['role_name'=>''] ;
        $getemployeeData= $this->requestApi->ApiGetWithAuthtMethod('getRolewiseAllUser', $role_name);
        if (!empty($getemployeeData))
        {
            if ($getemployeeData['statusCode'] == "200" && $getemployeeData['success']->messageCode == 1)
            {
                $getEmployees = $getemployeeData['success']->data;
            }
        }
        if (!empty($getHospData))
        {
            if ($getHospData['statusCode'] == "200" && $getHospData['success']->messageCode == 1)
            {
                $getHospital = $getHospData['success']->data;
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
       return view('admin.hospitals.edit',compact('getHospital','getEmployees','getAllState'));
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
                'name' => 'required',
                'address' => 'required',
                'email'=>"required",
                'primary_number' =>  'required',
                 'city' =>  'required',
                'state_id' =>  'required',
            ]);
            if ($validator->fails()) {
                $response['validate_error']  = true;
                $response['error'] = $validator->errors();
            }
            $credentials =[
               "user_id"=>$request->user_id,
              "name" =>ucfirst($request->name),
              "email"=>$request->email,
              "address" =>ucfirst($request->address),
              "primary_number" =>$request->primary_number,
              "secondary_number" =>$request->secondary_number,
              "location" =>$request->location,
               "city" =>$request->city,
              "state_id" =>$request->state_id,
            ];
            // dd($LoginData);die();
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPutWithAuthMethod('hospitals/'.$id,$credentials);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/hospital' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/hospital' ; 
                }
            }
            echo json_encode($response);
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

     public function changeHospStatus(Request $request){
        try { 
            $response = array();
            $response['status'] = 0;
            $response['class'] = 'alert alert-danger';
            $response['validate_error']  = false;
            $response['script'] = "$('.text-danger').css('display','none');";

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
                         $LoginData =$this->requestApi->ApiPutWithAuthMethod('hospitalBlock/'.$request->data['hospitalId'],$credentials);
                    }
                    else{
                         $LoginData =$this->requestApi->ApiPutWithAuthMethod('hospitalstatusUpdate/'.$request->data['hospitalId'],$credentials);
                    }
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       // $response['msgCommon'] =$LoginData['success']->message; 
                       $response['redirect'] ='/hospital' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/hospital' ; 
                }
            }


            
            echo json_encode($response);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }
}
