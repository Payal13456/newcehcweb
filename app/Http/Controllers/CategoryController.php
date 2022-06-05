<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Classes\requestApi;
use Session;
use Redirect;
use Exception;

class CategoryController extends Controller
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

       $categorys = [];
        $getAllCategorysData= $this->requestApi->ApiGetWithAuthtMethod('categorys');
        if(!empty($getAllCategorysData)){
            if($getAllCategorysData['statusCode'] =='200' && $getAllCategorysData['success']->messageCode == 1){
                $categorys = $getAllCategorysData['success']->data;
            }
        } 
        return view('admin.category.index',compact('categorys'));
    }

    public function create(){
        return view('admin.category.create');
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
              "category_name"=>ucfirst($request->category_name),
            ];
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPostWithAuthMethod('categorys',$credentials);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/category' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/category' ; 
                }
            }
            echo json_encode($response);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }

    public function edit($id){
       $getCategory = [];
        $getAllCategoryData=$this->requestApi->ApiGetWithAuthtMethod('categorys/'.$id);
        if (!empty($getAllCategoryData))
        {
            if ($getAllCategoryData['statusCode'] == "200" && $getAllCategoryData['success']->messageCode == 1)
            {
                $getCategory = $getAllCategoryData['success']->data;
            }
        }
        return view('admin.category.edit',compact('getCategory'));

    }
    
      public function update(Request $request, $id)
    {
       try { 
            $response = array();
            $response['status'] = 0;
            $response['class'] = 'alert alert-danger';
            $response['validate_error']  = false;
            $response['script'] = "$('.text-danger').css('display','none');";
            $credentials =[
              "category_name"=>ucfirst($request->category_name),
            ];
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPutWithAuthMethod('categorys/'.$id,$credentials);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/category' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/category' ; 
                }
            }
            echo json_encode($response);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }
}
