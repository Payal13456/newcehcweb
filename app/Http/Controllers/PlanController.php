<?php

namespace App\Http\Controllers;
use App\Classes\requestApi;
use Illuminate\Http\Request;
use Validator;
use Session;
use Redirect;
use Exception;

class PlanController extends Controller
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
        $plans = [];
        $getAllPlansData= $this->requestApi->ApiGetWithAuthtMethod('plans');
        if(!empty($getAllPlansData)){
            if($getAllPlansData['statusCode'] =='200' && $getAllPlansData['success']->messageCode == 1){
                $plans = $getAllPlansData['success']->data;
            }
        }
        return view('admin.plans.index',compact('plans'));
    }

    public function create(){
        
        return view('admin.plans.create');
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
                "consultation_fees" =>$request->consultation_fees,
                "booking_fees" =>$request->booking_fees,
                "gst" =>$request->gst,
                "total_amount_after_gst" =>$request->total_amount_after_gst,
                "number_of_consultation" =>$request->number_of_consultation,
            ];
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPostWithAuthMethod('plans',$credentials);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/plan' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/plan' ; 
                }
            }
            echo json_encode($response);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }


    public function edit($id){
        $plan = [];
        $getPlanData= $this->requestApi->ApiGetWithAuthtMethod('plans/'.$id);
        if(!empty($getPlanData)){
            if($getPlanData['statusCode'] =='200' && $getPlanData['success']->messageCode == 1){
                $plan = $getPlanData['success']->data;
            }
        }
        return view('admin.plans.edit',compact('plan'));
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
                "name"=>ucfirst($request->name),
                "consultation_fees" =>$request->consultation_fees,
                "gst" =>$request->gst,
                "booking_fees" =>$request->booking_fees,                
                "total_amount_after_gst" =>$request->total_amount_after_gst,
                "number_of_consultation" =>$request->number_of_consultation,
            ];
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPutWithAuthMethod('plans/'.$id,$credentials);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/plan' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/plan' ; 
                }
            }
            echo json_encode($response);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }
       public function changePlanStatus(Request $request){
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
                       $LoginData =$this->requestApi->ApiPutWithAuthMethod('planStatusUpdate/'.$request->data['planId'],$credentials);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       // $response['msgCommon'] =$LoginData['success']->message; 
                       $response['redirect'] ='/plan' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/plan' ; 
                }
            }
            echo json_encode($response);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }
}
