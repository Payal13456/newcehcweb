<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Classes\requestApi;
use Session;
use Redirect;
use Exception;

class FaqController extends Controller
{
    protected $requestApi ;

    public function __construct()
    {
        $this->requestApi = new requestApi();
    }
   public function index(){
        $faqs = [];
        $getAllFaqsData= $this->requestApi->ApiGetWithAuthtMethod('faqs');

        if(!empty($getAllFaqsData)){
            if($getAllFaqsData['statusCode'] =='200' && $getAllFaqsData['success']->messageCode == 1){
                $faqs = $getAllFaqsData['success']->data;
            }
        } 
        // echo "<pre>";print_r($faqs);die;
        return view('admin.faq.index',compact('faqs'));
    }

    public function create(){
        $categorys=[];
        $getAllCategoryssData= $this->requestApi->ApiGetWithAuthtMethod('categorys');
        if(!empty($getAllCategoryssData)){
            if($getAllCategoryssData['statusCode'] =='200' && $getAllCategoryssData['success']->messageCode == 1){
                $categorys = $getAllCategoryssData['success']->data;
            }
        }
        return view('admin.faq.create',compact('categorys'));
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
              "cat_id"=>$request->cat_id
            ];
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPostWithAuthMethod('faqs',$credentials);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/faq' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/faq' ; 
                }
            }
            echo json_encode($response);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }

    public function edit($id){
        $categorys=[];
        $getAllCategoryssData= $this->requestApi->ApiGetWithAuthtMethod('categorys');
        if(!empty($getAllCategoryssData)){
            if($getAllCategoryssData['statusCode'] =='200' && $getAllCategoryssData['success']->messageCode == 1){
                $categorys = $getAllCategoryssData['success']->data;
            }
        }
        $faq=[];
        $getFaqData= $this->requestApi->ApiGetWithAuthtMethod('faqs/'.$id);
        if(!empty($getFaqData)){
            if($getFaqData['statusCode'] =='200' && $getFaqData['success']->messageCode == 1){
                $faq = $getFaqData['success']->data;
            }
        }
        return view('admin.faq.edit',compact('faq','categorys'));
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
              "description" =>$request->description,
              "cat_id"=>$request->cat_id
            ];
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPutWithAuthMethod('faqs/'.$id,$credentials);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/faq' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/faq' ; 
                }
            }
            echo json_encode($response);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }
    public function changefaqStatus(Request $request){
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
                       $LoginData =$this->requestApi->ApiPutWithAuthMethod('faqStatusUpdate/'.$request->data['faqId'],$credentials);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       // $response['msgCommon'] =$LoginData['success']->message; 
                       $response['redirect'] ='/faq' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/faq' ; 
                }
            }
            echo json_encode($response);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }
}
