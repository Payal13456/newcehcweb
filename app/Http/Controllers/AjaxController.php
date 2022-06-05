<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Classes\requestApi;
use Session;
use Redirect;
use Exception;
class AjaxController extends Controller
{

	protected $requestApi ;

    public function __construct()
    {
        $this->requestApi = new requestApi();
    }
    public function inlinedelete(Request $request) {
        
        $response = array();
        $response['status'] = 0;
        $response['msg_topCommon'] = 'Please try again!';
        $response['class'] = 'alert alert-danger';
        $response['script'] = "";
        try{
            if (isset($request->type)) {
              switch ($request->type) {
                case 'employeeListDataType':
                    $id = $request->id;
                   $UserDataList = $this->requestApi->ApiDeleteWithAuthMethod('users/'.$id);
                    if ($UserDataList['statusCode'] == "200" && $UserDataList['success']->messageCode == 1){
                    $response['status'] = 1;
                    $response['msg_topCommon'] = $UserDataList['success']->message;
                    $response['class'] = "alert alert-success";
                    $response["datatable"] = "employeeListTable";
                    $response["row"] = $request->div;
                     $response['script'] .= "$('#btnErrorMessage').attr('data-redirect', '/employee');";
                    } else {
                      $response['msg_topCommon'] = $UserDataList['error']->message;
                }
                break;
                case 'hospitalListDataType':
                    $id = $request->id;
                   $UserDataList = $this->requestApi->ApiDeleteWithAuthMethod('hospitals/'.$id);
                    if ($UserDataList['statusCode'] == "200" && $UserDataList['success']->messageCode == 1){
                    $response['status'] = 1;
                    $response['msg_topCommon'] = $UserDataList['success']->message;
                    $response['class'] = "alert alert-success";
                    $response["datatable"] = "hospitalListTable";
                    $response["row"] = $request->div;
                     $response['script'] .= "$('#btnErrorMessage').attr('data-redirect', '/hospital');";
                    } else {
                      $response['msg_topCommon'] = $UserDataList['error']->message;
                }
                break;
                case 'categoryListDataType':
                    $id = $request->id;
                   $UserDataList = $this->requestApi->ApiDeleteWithAuthMethod('categorys/'.$id);
                    if ($UserDataList['statusCode'] == "200" && $UserDataList['success']->messageCode == 1){
                    $response['status'] = 1;
                    $response['msg_topCommon'] = $UserDataList['success']->message;
                    $response['class'] = "alert alert-success";
                    $response["datatable"] = "categoryListTable";
                    $response["row"] = $request->div;
                     $response['script'] .= "$('#btnErrorMessage').attr('data-redirect', '/category');";
                    } else {
                      $response['msg_topCommon'] = $UserDataList['error']->message;
                }
                break;
                case 'blogListDataType':
                    $id = $request->id;
                   $UserDataList = $this->requestApi->ApiDeleteWithAuthMethod('blogs/'.$id);
                    if ($UserDataList['statusCode'] == "200" && $UserDataList['success']->messageCode == 1){
                    $response['status'] = 1;
                    $response['msg_topCommon'] = $UserDataList['success']->message;
                    $response['class'] = "alert alert-success";
                    $response["datatable"] = "blogListTable";
                    $response["row"] = $request->div;
                     $response['script'] .= "$('#btnErrorMessage').attr('data-redirect', '/blog');";
                    } else {
                      $response['msg_topCommon'] = $UserDataList['error']->message;
                }
                break;
                case 'faqListDataType':
                    $id = $request->id;
                   $UserDataList = $this->requestApi->ApiDeleteWithAuthMethod('faqs/'.$id);
                    if ($UserDataList['statusCode'] == "200" && $UserDataList['success']->messageCode == 1){
                    $response['status'] = 1;
                    $response['msg_topCommon'] = $UserDataList['success']->message;
                    $response['class'] = "alert alert-success";
                    $response["datatable"] = "faqListTable";
                    $response["row"] = $request->div;
                     $response['script'] .= "$('#btnErrorMessage').attr('data-redirect', '/faq');";
                    } else {
                      $response['msg_topCommon'] = $UserDataList['error']->message;
                }
                break;
                case 'policyListDataType':
                    $id = $request->id;
                   $UserDataList = $this->requestApi->ApiDeleteWithAuthMethod('policies/'.$id);
                    if ($UserDataList['statusCode'] == "200" && $UserDataList['success']->messageCode == 1){
                    $response['status'] = 1;
                    $response['msg_topCommon'] = $UserDataList['success']->message;
                    $response['class'] = "alert alert-success";
                    $response["datatable"] = "policyListTable";
                    $response["row"] = $request->div;
                     $response['script'] .= "$('#btnErrorMessage').attr('data-redirect', '/faq');";
                    } else {
                      $response['msg_topCommon'] = $UserDataList['error']->message;
                }
                break;
                case 'planListDataType':
                    $id = $request->id;
                   $UserDataList = $this->requestApi->ApiDeleteWithAuthMethod('plans/'.$id);
                    if ($UserDataList['statusCode'] == "200" && $UserDataList['success']->messageCode == 1){
                    $response['status'] = 1;
                    $response['msg_topCommon'] = $UserDataList['success']->message;
                    $response['class'] = "alert alert-success";
                    $response["datatable"] = "planListTable";
                    $response["row"] = $request->div;
                     $response['script'] .= "$('#btnErrorMessage').attr('data-redirect', '/plan');";
                    } else {
                      $response['msg_topCommon'] = $UserDataList['error']->message;
                }
                break;
                case 'promocodeListDataType':
                    $id = $request->id;
                   $UserDataList = $this->requestApi->ApiDeleteWithAuthMethod('promocodes/'.$id);
                    if ($UserDataList['statusCode'] == "200" && $UserDataList['success']->messageCode == 1){
                    $response['status'] = 1;
                    $response['msg_topCommon'] = $UserDataList['success']->message;
                    $response['class'] = "alert alert-success";
                    $response["datatable"] = "promocodeListTable";
                    $response["row"] = $request->div;
                     $response['script'] .= "$('#btnErrorMessage').attr('data-redirect', '/promocode');";
                    } else {
                      $response['msg_topCommon'] = $UserDataList['error']->message;
                }
                break;

                 case 'patientListDataType':
                    $id = $request->id;
                   $UserDataList = $this->requestApi->ApiDeleteWithAuthMethod('patients/'.$id);
                    if ($UserDataList['statusCode'] == "200" && $UserDataList['success']->messageCode == 1){
                    $response['status'] = 1;
                    $response['msg_topCommon'] = $UserDataList['success']->message;
                    $response['class'] = "alert alert-success";
                    $response["datatable"] = "patientnListTable";
                    $response["row"] = $request->div;
                     $response['script'] .= "$('#btnErrorMessage').attr('data-redirect', '/patient');";
                    } else {
                      $response['msg_topCommon'] = $UserDataList['error']->message;
                }
                break;
                case 'roleListDataType':
                    $id = $request->id;
                   $UserDataList = $this->requestApi->ApiDeleteWithAuthMethod('roles/'.$id);
                    if ($UserDataList['statusCode'] == "200" && $UserDataList['success']->messageCode == 1){
                    $response['status'] = 1;
                    $response['msg_topCommon'] = $UserDataList['success']->message;
                    $response['class'] = "alert alert-success";
                    $response["datatable"] = "roleListTable";
                    $response["row"] = $request->div;
                     $response['script'] .= "$('#btnErrorMessage').attr('data-redirect', '/roles');";
                    } else {
                      $response['msg_topCommon'] = $UserDataList['error']->message;
                }
                break;
                 case 'specializationListDataType':
                    $id = $request->id;
                   $UserDataList = $this->requestApi->ApiDeleteWithAuthMethod('specializations/'.$id);
                    if ($UserDataList['statusCode'] == "200" && $UserDataList['success']->messageCode == 1){
                    $response['status'] = 1;
                    $response['msg_topCommon'] = $UserDataList['success']->message;
                    $response['class'] = "alert alert-success";
                    $response["datatable"] = "roleListTable";
                    $response["row"] = $request->div;
                     $response['script'] .= "$('#btnErrorMessage').attr('data-redirect', '/specialization');";
                    } else {
                      $response['msg_topCommon'] = $UserDataList['error']->message;
                }
                break;
              }
            echo json_encode($response);
            }
        } catch (\Exception $e) {
           return $e->getMessage();
        }
    }
}
