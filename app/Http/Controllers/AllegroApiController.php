<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AllegroApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


     
     
     function getAuthorizationCode() {
       
     }
     
     
     function getCurl($headers, $content) {
         $ch = curl_init();
         curl_setopt_array($ch, array(
             CURLOPT_URL => 'https://allegro.pl/auth/oauth/token',
             CURLOPT_HTTPHEADER => $headers,
             CURLOPT_SSL_VERIFYPEER => false,
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_POST => true,
             CURLOPT_POSTFIELDS => $content
         ));
         return $ch;
     }
     
     
     function getAccessToken($authorization_code) {

        $dane = DB::table('api_token')->where('name', '3SELL-ZDROWIE')->first(); 
        define('CLIENT_ID', $dane->client_id); 
        define('CLIENT_SECRET', $dane->client_secret); 
        define('REDIRECT_URI', 'https://panel.3sell.pl/allegro_api'); 
       
         $authorization = base64_encode(CLIENT_ID.':'.CLIENT_SECRET);
         $authorization_code = urlencode($authorization_code);
         $headers = array("Authorization: Basic {$authorization}","Content-Type: application/x-www-form-urlencoded");
         $content = "grant_type=authorization_code&code=${authorization_code}&redirect_uri=" . REDIRECT_URI;
         $ch = $this->getCurl($headers, $content);
         $tokenResult = curl_exec($ch);
         $resultCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
         curl_close($ch);
     
         if ($tokenResult === false || $resultCode !== 200) {
             exit ("Something went wrong $resultCode $tokenResult");
         }
         return json_decode($tokenResult)->access_token;
     }
     
     
     function main(){
         if ($_GET["code"]) {
             $access_token = $this->getAccessToken($_GET["code"]);
          
           DB::table('api_token')->where('api_token', '')->update(['api_token' => $access_token]); 
            
           return view('status');
     

         } else {    
            $this->getAuthorizationCode();
         }
     }
     
     
     function rest_get($uri, $generatedKey, array $params = []) {
        $headers = [
            'Accept: application/vnd.allegro.public.v1+json',
            'Content-Type: application/vnd.allegro.public.v1+json',
            'Authorization: Bearer '.$generatedKey.'',
        ];
        
        
    
    
        $curl = curl_init($uri);
    
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
        $data = json_encode($params);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);    
    
        return curl_exec($curl);
    }
    
     

}
