<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Classes\requestApi;
use Session;
use Redirect;
use Exception;
class HomeController extends Controller
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
        $dashboardCount = "";
        $getAllRolesData=$this->requestApi->ApiGetMethod('dashboard-count');
        
        // echo "<pre>";print_r($getAllRolesData);die;
        if (!empty($getAllRolesData))
        {
            if ($getAllRolesData['statusCode'] == "200" && $getAllRolesData['success']->messageCode == 1)
            {
                $dashboardCount = $getAllRolesData['success']->data;
            }
        }
        $appointments = []; $cancelled = [];

        $user = Session::get('user');
        if($user->role_id == 1){
            $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('appointmentlist/'.$user->id);
        }else{
            $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('appointment');
        }
        // $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('appointment');
        if(!empty($getAllBlogsData)){
            if($getAllBlogsData['statusCode'] =='200' && $getAllBlogsData['success']->messageCode == 1){
                $appointments = $getAllBlogsData['success']->data;
            }
        }

        if($user->role_id == 1){
            $getAllBlogsData= $this->requestApi->ApiGetWithAuthtMethod('cancelledAppointment/'.$user->id);
            // echo "<pre>";print_r($getAllBlogsData);die;
            if($getAllBlogsData['statusCode'] =='200' && $getAllBlogsData['success']->messageCode == 1){
                $cancelled = $getAllBlogsData['success']->data;
            }
        }
        // echo "<pre>";print_r($dashboardCount);die;
        return view('admin.home',compact('dashboardCount','appointments','cancelled'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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

    public function logout(request $request)
    {
        try{
            $logoutData =  $this->requestApi->ApiPostWithAuthMethod('logout');
                if (!empty($logoutData)) {
                    if ($logoutData['statusCode'] == "200") {
                        Session::flush();
                        return redirect('/login')
                            ->with('message', 'User logged out successfully');
                    }else if($logoutData['statusCode'] == "401"){
                         Session::flush();
                        return redirect('/login');
                    }
                }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function updateToken(request $request)
    {
        try{
            $logoutData =  $this->requestApi->ApiPostWithAuthMethod('updateToken');
                if (!empty($logoutData)) {
                    if ($logoutData['statusCode'] == "200") {
                        Session::flush();
                        return redirect('/')
                            ->with('message', 'Verified token successfully');
                    }else if($logoutData['statusCode'] == "401"){
                         Session::flush();
                        return redirect('/login');
                    }
                }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
