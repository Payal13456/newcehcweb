<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Classes\requestApi;
use Session;
use Redirect;
use Exception;

class RoleController extends Controller
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
        $promocodes = [];
        $getAllrolecodesData= $this->requestApi->ApiGetWithAuthtMethod('getAllRoles');
        // echo "<pre>";print_r($getAllpromocodesData);die;
        if(!empty($getAllrolecodesData)){
            if($getAllrolecodesData['statusCode'] =='200' && $getAllrolecodesData['success']->messageCode == 1){
                $roles = $getAllrolecodesData['success']->data;
            }
        } 
        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = [];
        $permissions= $this->requestApi->ApiGetWithAuthtMethod('getAllPermissions');
        // echo "<pre>";print_r($getAllpromocodesData);die;
        if(!empty($permissions)){
            if($permissions['statusCode'] =='200' && $permissions['success']->messageCode == 1){
                $permissions = $permissions['success']->data;
            }
        } 
        // echo "<pre>";print_r($permissions);die;
        return view('admin.roles.create',compact('permissions'));
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
            
            $credentials =[
              "name"=>ucfirst($request->name),
              "guard_name" => $request->guard_name,
              "permissions" => $request->permissions 
            ];
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPostWithAuthMethod('roles',$credentials);
              // return $LoginData;
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/roles' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/roles' ; 
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
        $roles=[];$permissions = [];$rolePermission = [];
        $getFaqData= $this->requestApi->ApiGetWithAuthtMethod('roles/'.$id);
        $permissions= $this->requestApi->ApiGetWithAuthtMethod('getAllPermissions');
        $rolePermissions= $this->requestApi->ApiGetWithAuthtMethod('getRolePermission/'.$id);
        if(!empty($getFaqData)){
            if($getFaqData['statusCode'] =='200' && $getFaqData['success']->messageCode == 1){
                $roles = $getFaqData['success']->data;
            }
            if($permissions['statusCode'] =='200' && $permissions['success']->messageCode == 1){
                $permissions = $permissions['success']->data;
            }
            if($rolePermissions['statusCode'] =='200' && $rolePermissions['success']->messageCode == 1){
                $rolePermission = $rolePermissions['success']->data;
            }
        }
        // echo '<pre>';print_r($rolePermissions);die;
        return view('admin.roles.edit',compact('roles','permissions','rolePermission'));
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
            if($request->send_to == 'specific'){
                $phone_number = $request->phone_number;
            }else{
                $phone_number = '';
            }
            $credentials =[
              "name"=>ucfirst($request->name),
              "guard_name" => $request->guard_name,
              "permissions" => $request->permissions 
            ];
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPutWithAuthMethod('roles/'.$id,$credentials);
              // return json_encode($LoginData);
                // echo '<pre>';print_r($LoginData);die;
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/roles' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/roles' ; 
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
