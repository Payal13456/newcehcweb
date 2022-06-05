<?php

namespace App\Http\Controllers;

use App\Classes\requestApi;
use Illuminate\Http\Request;
use Validator;
use Session;
use Redirect;
use Exception;

class PrivacyController extends Controller
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
        $privacy = [];
        $getAllPrivacyData= $this->requestApi->ApiGetWithAuthtMethod('policies');
        if(!empty($getAllPrivacyData)){
            if($getAllPrivacyData['statusCode'] =='200' && $getAllPrivacyData['success']->messageCode == 1){
                $privacy = $getAllPrivacyData['success']->data;
            }
        } 
        return view('admin.policy.index',compact('privacy'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys=[];
        $getAllCategoryssData= $this->requestApi->ApiGetWithAuthtMethod('categorys');
        if(!empty($getAllCategoryssData)){
            if($getAllCategoryssData['statusCode'] =='200' && $getAllCategoryssData['success']->messageCode == 1){
                $categorys = $getAllCategoryssData['success']->data;
            }
        }
        return view('admin.policy.create',compact('categorys'));
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
              "title"=>ucfirst($request->title),
              "description" =>ucfirst($request->description)
            ];
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPostWithAuthMethod('policies',$credentials);
              // echo '<pre>';print_r($LoginData);die;
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/privacy' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/privacy' ; 
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
        $blog = [];
        $categorys=[];
        $getBlogsData= $this->requestApi->ApiGetWithAuthtMethod('policies/'.$id);
        $getAllCategoryssData= $this->requestApi->ApiGetWithAuthtMethod('categorys');

        if(!empty($getAllCategoryssData)){
            if($getAllCategoryssData['statusCode'] =='200' && $getAllCategoryssData['success']->messageCode == 1){
                $categorys = $getAllCategoryssData['success']->data;
            }
        }

        if(!empty($getBlogsData)){
            if($getBlogsData['statusCode'] =='200' && $getBlogsData['success']->messageCode == 1){
                $privacy = $getBlogsData['success']->data;
            }
        }
        return view('admin.policy.edit',compact('privacy','categorys'));
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
            $credentials =[
              "title"=>ucfirst($request->title),
              "description" =>$request->description
            ];

            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPutWithAuthMethod('policies/'.$id,$credentials);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/privacy' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/privacy' ; 
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
        
    }

    public function changepolicyStatus(Request $request){
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
                       $LoginData =$this->requestApi->ApiPutWithAuthMethod('policiesStatusUpdate/'.$request->data['planId'],$credentials);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       // $response['msgCommon'] =$LoginData['success']->message; 
                       $response['redirect'] ='/privacy' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/privacy' ; 
                }
            }
            echo json_encode($response);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }
}
