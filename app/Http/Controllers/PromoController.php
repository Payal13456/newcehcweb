<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Classes\requestApi;
use Session;
use Redirect;
use Exception;

class PromoController extends Controller
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
        $getAllpromocodesData= $this->requestApi->ApiGetWithAuthtMethod('promocodes');
        // echo "<pre>";print_r($getAllpromocodesData);die;
        if(!empty($getAllpromocodesData)){
            if($getAllpromocodesData['statusCode'] =='200' && $getAllpromocodesData['success']->messageCode == 1){
                $promocodes = $getAllpromocodesData['success']->data;
            }
        } 
        return view('admin.promocode.index',compact('promocodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.promocode.create');
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
            if($request->send_to == 'specific'){
                $phone_number = $request->phone_number;
            }else{
                $phone_number = '';
            }
            $credentials =[
              "name"=>ucfirst($request->name),
              "discount_by" => $request->discount_by,
              "discount_amount"=> $request->discount_amount,
              "send_to"=> $request->send_to,
              "phone_number" => $phone_number
            ];
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPostWithAuthMethod('promocodes',$credentials);
              // echo "<pre>";print_r($credentials);die; 
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/promocode' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/promocode' ; 
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
        $promocode=[];
        $getFaqData= $this->requestApi->ApiGetWithAuthtMethod('promocodes/'.$id);
        if(!empty($getFaqData)){
            if($getFaqData['statusCode'] =='200' && $getFaqData['success']->messageCode == 1){
                $promocode = $getFaqData['success']->data;
            }
        }
        return view('admin.promocode.edit',compact('promocode'));
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
              "discount_by" => $request->discount_by,
              "discount_amount"=> $request->discount_amount,
              "send_to"=> $request->send_to,
              "phone_number" => $phone_number
            ];
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPutWithAuthMethod('promocodes/'.$id,$credentials);

                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/promocode' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/promocode' ; 
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

    public function changepromocodesStatus(Request $request){
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
                       $LoginData =$this->requestApi->ApiPutWithAuthMethod('promocodeStatusUpdate/'.$request->data['promocodeId'],$credentials);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       // $response['msgCommon'] =$LoginData['success']->message; 
                       $response['redirect'] ='/promocode' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/promocode'; 
                }
            }
            echo json_encode($response);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }
}
