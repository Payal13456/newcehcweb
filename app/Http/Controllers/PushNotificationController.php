<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Classes\requestApi;
use Session;
use Redirect;
use Exception;


class PushNotificationController extends Controller
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
        $notification = [];
        $getAllpromocodesData= $this->requestApi->ApiGetWithAuthtMethod('notification-list');
        // echo "<pre>";print_r($getAllpromocodesData);die;
        if(!empty($getAllpromocodesData)){
            if($getAllpromocodesData['statusCode'] =='200' && $getAllpromocodesData['success']->messageCode == 1){
                $notification = $getAllpromocodesData['success']->data;
            }
        } 
        // echo "<pre>";print_r($notification);die;
        return view('admin.pushNotification.index',compact('notification'));
    }
}
