<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Classes\requestApi;
use Session;
use Redirect;
use Exception;

class ProfileController extends Controller
{
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
        $userId = Session::get('user')->id;
        $getprofile=[];
        $profileData = $this->requestApi->ApiGetWithAuthtMethod('getProfile/'.$userId);
        if (!empty($profileData))
        {
            if ($profileData['statusCode'] == "200" && $profileData['success']->messageCode == 1)
            {
                $getprofile = $profileData['success']->data;
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
       
        return view("admin.profile.profile",compact('getprofile','getAllRoles','getAllspecializations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
       $getAllEmp = [];
       $profileData = $this->requestApi->ApiGetWithAuthtMethod('/'.$id);
       print_r($profileData);die();
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
        return view('admin.profile.profile',compact('getAllEmp','getAllRoles','getAllspecializations'));
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
                'phonenumber' => 'required',
                'gender' => 'required',
                'dob' => 'required|before:today',
                'qualification' => 'required',
                'specialization' => 'required',
                'description' => 'required',
                'address' => 'required',
            ]);
            if ($validator->fails()) {
                $response['validate_error']  = true;
                $response['error'] = $validator->errors();
            }else{
                $credentials =[
                  "specialization_id"=>$request->specialization,
                  "first_name" =>ucfirst($request->first_name),
                  "last_name" =>ucfirst($request->last_name),
                  "month_dob" =>$request->dob,
                  "phonenumber" =>$request->phonenumber,
                  "gender" =>$request->gender,
                  "education_qulaification"=>ucfirst($request->qualification),
                  "description" =>ucfirst($request->description),
                  "address" =>ucfirst($request->address),
                  "password" =>$request->password,
                  "role_id" =>$request->role,
                ];
                if(!empty($credentials)){
                  $LoginData =$this->requestApi->ApiPutWithAuthMethod('profile_update/'.$id,$credentials);
                    if(!empty($LoginData)){
                        if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                           $response['redirect'] ='/profile' ; 
                        }else{              
                            $response['msgCommon'] =$LoginData['error']->message;
                        }    
                    }else{
                        $response['redirect'] ='/profile' ; 
                    }
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
}
