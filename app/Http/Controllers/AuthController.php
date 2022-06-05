<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Classes\requestApi;
use Session;
use Redirect;
use Exception;
use App\Models\User;
use Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
	public function __construct()
	{
      $this->middleware(function ($request, $next) {
              $this->accessProject = Session::get('access_token');
              $userData = Session::get('user') ;
              if(!empty($userData) && !empty($this->accessProject)){
                 return redirect('home/');
              }    
              return $next($request);
      });
	}
	public function login(){
    // echo env('API_URL');die;
        return view('admin.login');
  }
  
  public function authenticateData(Request $request){ 
      $requestApi = new requestApi();
      try { 
          $response = array();
          $response['status'] = 0;
          $response['class'] = 'alert alert-danger';
          $response['validate_error']  = false;
          $response['script'] = "$('.text-danger').css('display','none');";
          $validator = Validator::make($request->all(), [ 
              'emailAddress' => 'required|string|email',
              'password' => 'required|string'
          ]);
          if ($validator->fails()) {
              $response['validate_error']  = true;
                $response['error'] = $validator->errors();
          }
          $credentials =[
            "email" =>$request->emailAddress,
            "password" =>$request->password,
            "fcm_token" => $request->fcm_token
          ];
          if(!empty($credentials)){
            // echo "Here";die;
            $LoginData =$requestApi->ApiPostMethod('login',$credentials);
            // echo "<pre>";print_r($LoginData);die;

              if(!empty($LoginData)){
                // Log::info($LoginData->headers);
                  if($LoginData['statusCode']== "200" && $LoginData['success']->messageCode == 1){
                    Session::put('access_token', $LoginData['success']->data->access_token);
                    Session::put('token_id',$LoginData['success']->data->token_id);
                    Session::put('user',$LoginData['success']->data->user);
                     $response['redirect'] ='/home' ; 
                  }else{
                    $response['msgCommon'] =$LoginData['error']->message;
                  }    
              }else{
                  $response['redirect'] ='/login' ; 
              }
          }
          echo json_encode($response);
      }catch(\Exception $e) {
          return $e->getMessage();
      }    
    }
    public function forget_password(){
    	return view('admin.forgetPassword');
    }

    public function changePassword($id){
    
    	$ciphering = "AES-128-CTR";
    	// Non-NULL Initialization Vector for decryption
	$decryption_iv = '1234567891011121';
	 $iv_length = openssl_cipher_iv_length($ciphering);
		$options = 0;
	// Store the decryption key
	$decryption_key = "CEHCVIDEOAPP";
	  
	// Use openssl_decrypt() function to decrypt the data
	$decryption=openssl_decrypt ($id, $ciphering, 
		$decryption_key, $options, $decryption_iv);
	$user = User::where('email',$decryption)->first();
	$id = $user->id;
      return view('admin.resetPassword',compact('id'));
    }
    public function sendResetMail(Request $request){
      try { 
          $response = array();
        $response['status'] = 0;
        $response['class'] = 'alert alert-danger';
        $response['validate_error']  = false;
        $response['script'] = "$('.text-danger').css('display','none');";
        $user = User::where('email',$request->email)->first();

        if(!empty($user)){
            // if ($user->is_verify == 0) {
            //     $message = 'Your account is not active, please activate account first.';
            //     Session::flash('danger', $message);
            //     return redirect()->back(); 
            // }
            // if ($user->role_id != 2) {
            //     $message = 'You are not authorize to access this.';
            //     $response = ['status' => false, 'message' => $message];
            //     return $response; 
            // }
            $subject = "Reset your CEHC App Account!";
            $to = $user->email;
            // Store the cipher method
            $ciphering = "AES-128-CTR";
	  
	    // Use OpenSSl Encryption method
		$iv_length = openssl_cipher_iv_length($ciphering);
		$options = 0;
	  
		// Non-NULL Initialization Vector for encryption
		$encryption_iv = '1234567891011121';
	  
		// Store the encryption key
		$encryption_key = "CEHCVIDEOAPP";
	  
		// Use openssl_encrypt() function to encrypt the data
		$encryption = openssl_encrypt($user->email, $ciphering,
		$encryption_key, $options, $encryption_iv);
            $data = ['user'=>$user,"encryption_key"=>$encryption];
            //echo "<pre>";print_r($data);die;
            Mail::send('emails.reset_password', $data, function($message) use ($to, $subject){
                $message->from('appointment@cehcchennai.com', "CEHC - Online Video Consultation");
                $message->subject($subject);
                $message->to($to);                
            });

            $message = "Reset Password Link sent to your email!";
            Session::flash('success', $message);
            $response['redirect'] ='/login' ; 
            echo json_encode($response);
        }else{
            $response['msgCommon'] = "Sorry your email cannot be identified.";
            
            $response['redirect'] ='/forget_password' ; 
            echo json_encode($response);
        }
      }catch(\Exception $e) {
          return $e->getMessage();
      } 
    }

    public function reset_password(Request $request){
      $response = array();
      $response['status'] = 0;
      $response['class'] = 'alert alert-danger';
      $response['validate_error']  = false;
      $response['script'] = "$('.text-danger').css('display','none');";
      $user = User::find($request->id);
      if($request->password === $request->confirm_password){
        $user->password = Hash::make($request->password);
        $user->save();
        $response['redirect'] ='/login' ; 
      }else{
         $response['redirect'] ='/change-password/'.$request->id ;  
         $response['msgCommon'] =$LoginData['error']->message; 
      }
      echo json_encode($response);
    }
}
   
