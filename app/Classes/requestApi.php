<?php
namespace App\Classes;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Session;
use Illuminate\Support\Facades\Input;
class requestApi
{
        private $access_token;
        private $base_url;
        public function __construct()
        {
            $access = (Session::get('access_token')) ? Session::get('access_token') : "";
            $this->base_url = env('API_URL');
         }
        public function ApiPostMethod($url,$array = array()){
            try {
                $client = new Client(['headers' => [ 'Content-Type' => 'application/json' ],'proxy'=> '']);
                $response = $client->post($this->base_url.$url,['body' => json_encode($array)]);
                return array(
                        'statusCode' => $response->getStatusCode(),
                        'success' => json_decode($response->getBody())
                    );
            }catch (RequestException $e) {
                return array(
                    "statusCode" =>$e->getcode(),
                    "error" => json_decode($e->getResponse()->getBody())
                );
            }
        }
        public function ApiGetMethod($url,$array = array()){
            try {
                $client = new Client(['headers' => [ 'Content-Type' => 'application/json' ],'proxy'=> '']);
                $response = $client->get($this->base_url.$url);
                    return array(
                        'statusCode' => $response->getStatusCode(),
                        'success' => json_decode($response->getBody())
                    );
            }catch (RequestException $e) {
                return array(
                    "statusCode" =>$e->getcode(),
                    "error" => json_decode($e->getResponse()->getBody())
                );
            }
        }
        public function ApiPostWithAuthMethod($url,$array = array()){
            try{
                 $access = (Session::get('access_token')) ? Session::get('access_token') : "";
                 $this->access_token = (isset($access) ? $access : "");
                 $client = new Client(['headers' => [ 'Content-Type' => 'application/json','Authorization'=>'Bearer '.$this->access_token],'proxy'=> '']);
                 $response = $client->post($this->base_url.$url,['body' => json_encode($array)]);
                 return array(
                        'statusCode' => $response->getStatusCode(),
                        'success' => json_decode($response->getBody())
                    );
            }catch (RequestException $e) {
                return array(
                    "statusCode" =>$e->getcode(),
                    "error" => json_decode($e->getResponse()->getBody())
                );
            }
        }
        public function ApiDeleteWithAuthMethod($url,$array = array()){
            try{
                 $access = (Session::get('access_token')) ? Session::get('access_token') : "";
                 $this->access_token = (isset($access) ? $access : "");
                 $client = new Client(['headers' => [ 'Content-Type' => 'application/json','Authorization'=>'Bearer '.$this->access_token],'proxy'=> '']);
                 $response = $client->delete($this->base_url.$url,['body' => json_encode($array)]);
                    return array(
                        'statusCode' => $response->getStatusCode(),
                        'success' => json_decode($response->getBody())
                    );
            }catch (RequestException $e) {
                return array(
                    "statusCode" =>$e->getcode(),
                    "error" => json_decode($e->getResponse()->getBody())
                );
            }
        }
        public function ApiPutWithAuthMethod($url,$array = array()){
            try{
                 $access = (Session::get('access_token')) ? Session::get('access_token') : "";
                 $this->access_token = (isset($access) ? $access : "");
                 $client = new Client(['headers' => [ 'Content-Type' => 'application/json','Authorization'=>'Bearer '.$this->access_token],'proxy'=> '']);
                 $response = $client->put($this->base_url.$url,['body' => json_encode($array)]);
                  return array(
                        'statusCode' => $response->getStatusCode(),
                        'success' => json_decode($response->getBody())
                    );
            }catch (RequestException $e) {
               return array(
                    "statusCode" =>$e->getcode(),
                    "error" => json_decode($e->getResponse()->getBody())
                );
            }
        }
        public function ApiGetWithAuthtMethod($url,$array = array()){
            try{
              $access = (Session::get('access_token')) ? Session::get('access_token') : "";
               $this->access_token = (isset($access) ? $access : "");
                $client = new Client(['headers' => ['X-Requested-With'=>'XMLHttpRequest','Accept'=>'application/json','Content-Type' => 'application/json','Authorization'=>'Bearer '.$this->access_token],'proxy'=> '']);
                $response = $client->get($this->base_url.$url,['body' => json_encode($array)]);
                return array(
                        'statusCode' => $response->getStatusCode(),
                        'success' => json_decode($response->getBody())
                    );
            }catch (RequestException $e) {
               return array(
                    "statusCode" =>$e->getcode(),
                    "error" =>$e->getMessage()
                );
            }
        }
}
