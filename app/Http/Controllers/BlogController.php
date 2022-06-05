<?php

namespace App\Http\Controllers;
use App\Classes\requestApi;
use Illuminate\Http\Request;
use Validator;
use Session;
use Redirect;
use Exception;

class BlogController extends Controller
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
        $blogs = [];
        $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('blogs');
        if(!empty($getAllBlogsData)){
            if($getAllBlogsData['statusCode'] =='200' && $getAllBlogsData['success']->messageCode == 1){
                $blogs = $getAllBlogsData['success']->data;
            }
        }
        return view('admin.blogs.index',compact('blogs'));
    }

    public function create(){
        $categorys=[];
        $getAllCategoryssData= $this->requestApi->ApiGetWithAuthtMethod('categorys');
        if(!empty($getAllCategoryssData)){
            if($getAllCategoryssData['statusCode'] =='200' && $getAllCategoryssData['success']->messageCode == 1){
                $categorys = $getAllCategoryssData['success']->data;
            }
        }
        return view('admin.blogs.create',compact('categorys'));
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
            $image = [];
            if($request->imgcount >= 0){
		for($i=0;$i<$request->imgcount;$i++){
			$image [] = $request->get('imgfile_'.$i);
		}
            }else{
            	$image = [];
            }
            
            
            $credentials =[
              "title"=>ucfirst($request->title),
              "description" =>ucfirst($request->description),
              "cat_id" =>$request->cat_id,
              "images" =>$image
            ];
            
            if(!empty($credentials)){
            echo "<pre>";print_r(json_encode($credentials));die;
              $LoginData =$this->requestApi->ApiPostWithAuthMethod('blogs',$credentials);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/blog' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/blog' ; 
                }
            }
            echo json_encode($response);
            
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }

    public function edit($id){
        $blog = [];
        $categorys=[];
        $getBlogsData= $this->requestApi->ApiGetWithAuthtMethod('blogs/'.$id);
        $getAllCategoryssData= $this->requestApi->ApiGetWithAuthtMethod('categorys');

        if(!empty($getAllCategoryssData)){
            if($getAllCategoryssData['statusCode'] =='200' && $getAllCategoryssData['success']->messageCode == 1){
                $categorys = $getAllCategoryssData['success']->data;
            }
        }

        if(!empty($getBlogsData)){
            if($getBlogsData['statusCode'] =='200' && $getBlogsData['success']->messageCode == 1){
                $blog = $getBlogsData['success']->data;
            }
        }
        return view('admin.blogs.edit',compact('blog','categorys'));

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
              "description" =>ucfirst($request->description),
              "cat_id" =>$request->cat_id,
            ];
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPutWithAuthMethod('blogs/'.$id,$credentials);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/blog' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/blog' ; 
                }
            }
            echo json_encode($response);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }

     public function changeBlogStatus(Request $request){
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
                       $LoginData =$this->requestApi->ApiPutWithAuthMethod('blogStatusUpdate/'.$request->data['blogId'],$credentials);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       // $response['msgCommon'] =$LoginData['success']->message; 
                       $response['redirect'] ='/blog' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/blog' ; 
                }
            }
            echo json_encode($response);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }
    
}
