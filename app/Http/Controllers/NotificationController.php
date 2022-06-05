<?php

namespace App\Http\Controllers;

use App\Classes\requestApi;
use Illuminate\Http\Request;
use Validator;
use Session;
use Redirect;
use Exception;

class NotificationController extends Controller
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
        $notification = [];
        $getAllFaqsData= $this->requestApi->ApiGetWithAuthtMethod('notifications');
        // echo "<pre>";print_r($getAllFaqsData);die;
        if(!empty($getAllFaqsData)){
            if($getAllFaqsData['statusCode'] =='200' && $getAllFaqsData['success']->messageCode == 1){
                $notification = $getAllFaqsData['success']->data;
            }
        } 
        
        return view('admin.notification.index',compact('notification'));
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
        return view('admin.notification.create',compact('categorys'));
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
              "description" =>ucfirst($request->description),
              "notification_type"=>$request->notification_type
            ];
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPostWithAuthMethod('notifications',$credentials);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/notifications' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/notifications' ; 
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
        return view('admin.notification.edit');
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
        //
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

    public function notificationCount(){
        $categorys='';
        $getAllCategoryssData= $this->requestApi->ApiGetWithAuthtMethod('notificationCount');
        if(!empty($getAllCategoryssData)){
            if($getAllCategoryssData['statusCode'] =='200' && $getAllCategoryssData['success']->messageCode == 1){
                $categorys = $getAllCategoryssData['success']->data;
            }
        }
        return response()->json($categorys);
    }
}
