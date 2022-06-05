<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class BasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $accessProject;
    public function handle(Request $request, Closure $next)
    {
        $this->accessProject = Session::get('access_token');
        $userData = Session::get('user');
        if(!$userData || !$this->accessProject){
            return redirect('login/');
        }
        $baseURL = env('API_URL');
        $access = (Session::get('token_id')) ? Session::get('token_id'):"";
        $client = new Client(['headers' => [ 'Content-Type' => 'application/json'],'proxy'=> '']);
        $array = array('token'=>$access);
        $response = $client->post($baseURL.'verifyAccessToken',['body' => json_encode($array)]);
        $data = array(
            'statusCode' => $response->getStatusCode(),
            'success' => json_decode($response->getBody())
        );
        $checkTokenValid = $data['success']->data->user_found;
        if($checkTokenValid==0){
            Session::forget('user');
            Session::forget('access_token');
            Session::forget('token_id');
            return redirect()->route('logout');
        }
        return $next($request);
    }
}
