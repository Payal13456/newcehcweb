<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Classes\requestApi;
use Session;
use Redirect;
use Exception;

class ScheduleController extends Controller
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
        $schedule = [];
        $user = Session::get('user');
        if($user->role_id == 1){
            $id = $user->id;
            $getAllrolecodesData= $this->requestApi->ApiGetWithAuthtMethod('schedule/'.$id);
        }else{
            // $getAllrolecodesData= $this->requestApi->ApiGetWithAuthtMethod('schedule');
            $getAllrolecodesData= $this->requestApi->ApiGetWithAuthtMethod('doctorsList');
        }
        
        // echo "<pre>";print_r($getAllpromocodesData);die;
        if(!empty($getAllrolecodesData)){
            if($getAllrolecodesData['statusCode'] =='200' && $getAllrolecodesData['success']->messageCode == 1){
                $schedule = $getAllrolecodesData['success']->data;
            }
        } 
        if($user->role_id == 1){
          $id = $user->id;
          return view('admin.schedule.index',compact('schedule','id'));
        }
        // echo "<pre>";print_r($schedule);die;
        // return view('admin.schedule.index',compact('schedule'));
        return view('admin.schedule.list',compact('schedule'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function doctorsList()
    {
        $schedule = [];
        $getAllrolecodesData= $this->requestApi->ApiGetWithAuthtMethod('doctorsList');
        // echo "<pre>";print_r($getAllpromocodesData);die;
        if(!empty($getAllrolecodesData)){
            if($getAllrolecodesData['statusCode'] =='200' && $getAllrolecodesData['success']->messageCode == 1){
                $schedule = $getAllrolecodesData['success']->data;
            }
        } 
        // echo "<pre>";print_r($schedule);die;
        return view('admin.schedule.list',compact('schedule'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role_name =['role_name'=>'Doctor'] ;
        $getEmployees = []; $schedule = [];
        $getemployeeData= $this->requestApi->ApiGetWithAuthtMethod('getRolewiseAllUser', $role_name);
        if (!empty($getemployeeData))
        {
            if ($getemployeeData['statusCode'] == "200" && $getemployeeData['success']->messageCode == 1){
                $getEmployees = $getemployeeData['success']->data;
            }
        }

        $getAllrolecodesData= $this->requestApi->ApiGetWithAuthtMethod('doctorsList');
        
        if(!empty($getAllrolecodesData)){
            if($getAllrolecodesData['statusCode'] =='200' && $getAllrolecodesData['success']->messageCode == 1){
                $schedule = $getAllrolecodesData['success']->data;
            }
        } 
        
        $count = 0; $employee = [];
        if( count($getEmployees) > 0 ){
            if(count($schedule) > 0){
                foreach($getEmployees as $emp){
                    $count = 0;
                    foreach($schedule as $sc){
                        if($sc->doctor_id == $emp->user_id){
                            $count = 1;
                        }
                    }
                    if($count == 0){
                        $employee [] = $emp;
                    }
                }
            }else{
              $employee = $getEmployees;
            }
        }

        // echo "<pre>";print_r($schedule);die;

       return view('admin.schedule.create',compact('employee'));
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
            // echo "<pre>";print_r(json_encode($request->all()));die;
            $response = array();
            $response['status'] = 0;
            $response['class'] = 'alert alert-danger';
            $response['validate_error']  = false;
            $response['script'] = "$('.text-danger').css('display','none');";
            // if($request->send_to == 'specific'){
            //     $phone_number = $request->phone_number;
            // }else{
            //     $phone_number = '';
            // }
            // $credentials =[
            //   "doctor_id"=>$request->doctor_id,
            //   "day" => $request->day,
            //   "start_time"=> $request->start_time,
            //   "end_time"=> $request->end_time,
            //   "break" => $request->break,
            //   "type" => $request->type
            // ];

            $credentials = $inputs = $request->input();
            // echo "<pre>";print_r(json_encode($credentials));die; 
            if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPostWithAuthMethod('schedule',$credentials);
              
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       $response['redirect'] ='/schedule' ; 
                    }else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/schedule' ; 
                }
            }
            echo json_encode($response);
        } catch(\Exception $e) {
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
        $schedule = [];
        $getAllrolecodesData= $this->requestApi->ApiGetWithAuthtMethod('schedule/'.$id);
        // echo "<pre>";print_r($getAllrolecodesData);die;
        if(!empty($getAllrolecodesData)){
            if($getAllrolecodesData['statusCode'] =='200' && $getAllrolecodesData['success']->messageCode == 1){
                $schedule = $getAllrolecodesData['success']->data;
            }
        } 
        return view('admin.schedule.index',compact('schedule','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule = [];
        $getAllrolecodesData= $this->requestApi->ApiGetWithAuthtMethod('schedule/'.$id);
        // echo "<pre>";print_r($getAllrolecodesData);die;
        if(!empty($getAllrolecodesData)){
            if($getAllrolecodesData['statusCode'] =='200' && $getAllrolecodesData['success']->messageCode == 1){
                $schedule = $getAllrolecodesData['success']->data;
            }
        } 
        return view('admin.schedule.edit',compact('schedule','id'));
       // return view('admin.schedule.edit',compact('getSchedule','getEmployees'));
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
            // echo "<pre>";print_r(json_encode($request->all()));die;
            $response = array();
            $response['status'] = 0;
            $response['class'] = 'alert alert-danger';
            $response['validate_error']  = false;
            $response['script'] = "$('.text-danger').css('display','none');";
            // if($request->send_to == 'specific'){
            //     $phone_number = $request->phone_number;
            // }else{
            //     $phone_number = '';
            // }
            // $credentials =[
            //   "doctor_id"=>$request->doctor_id,
            //   "day" => $request->day,
            //   "start_time"=> $request->start_time,
            //   "end_time"=> $request->end_time,
            //   "break" => $request->break,
            //   "type" => $request->type
            // ];
            $credentials = $inputs = $request->input();
            
            if(!empty($credentials)){
                $LoginData =$this->requestApi->ApiPutWithAuthMethod('schedule/'.$id,$credentials);
                if(!empty($LoginData)){
                      if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                         $response['redirect'] ='/schedule/'.$id ; 
                      }else{              
                          $response['msgCommon'] =$LoginData['error']->message;
                      }    
                }else{
                      $response['redirect'] ='/schedule/'.$id ; 
                }
            }
            echo json_encode($response);
        } catch(\Exception $e) {
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

    public function changescheduleStatus(Request $request){
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
                       $LoginData =$this->requestApi->ApiPutWithAuthMethod('scheduleStatusUpdate/'.$request->data['scheduleId'],$credentials);
                if(!empty($LoginData)){
                    if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                       // $response['msgCommon'] =$LoginData['success']->message; 
                       $response['redirect'] ='/schedule'; 
                    } else{              
                        $response['msgCommon'] =$LoginData['error']->message;
                    }    
                }else{
                    $response['redirect'] ='/schedule'; 
                }
            }
            echo json_encode($response);
        }catch(\Exception $e) {
            return $e->getMessage();
        } 
    }

    public function doctorSchedule(Request $request){
      try{
        $doctors = [];
        $credentials = [
            "id" => $request->id,
            "date" => $request->date,
            "type" => $request->type

        ];
        if(!empty($credentials)){
              $LoginData =$this->requestApi->ApiPostWithAuthMethod('doctorSchedule',$credentials);
              if(!empty($LoginData)){
                if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                  $doctors = $LoginData['success']->data;
                }  else{
                  $doctors = [];
                }
              }
              $res = "";
              if(!empty($doctors)){
                if(count($doctors->slots) > 0){
                  foreach($doctors->slots as $slots){
                    $res .= "<div class='col-md-2'><input type='radio' name='slot_timing' value='".date("G:i",strtotime($slots))."'>&nbsp;&nbsp;".$slots."</div>";
                  }
                }else{
                  $res = "slots not available for selected date";
                }
              }else{
                $res = "slots not available for selected date";
              }
              
              return $res;
          }
        }catch(\Exception $e) {
          return $e->getMessage();
        }
      } 
}
