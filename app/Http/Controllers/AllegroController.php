<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AllegroController extends Controller
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



function getCurl($headers, $url, $content = null) {
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true
    ));
    if ($content !== null) {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
    }


    return $ch;
}

function getAccessToken() {
    $authorization = base64_encode(CLIENT_ID.':'.CLIENT_SECRET);
    $headers = array("Authorization: Basic {$authorization}","Content-Type: application/x-www-form-urlencoded");
    $content = "grant_type=client_credentials";
    $url = "https://allegro.pl.allegrosandbox.pl/auth/oauth/token";
    $ch = $this->getCurl($headers, $url, $content);
    $tokenResult = curl_exec($ch);
    $resultCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($tokenResult === false || $resultCode !== 200) {
        exit ("Coś poszło nie tak");
    }
    return json_decode($tokenResult)->access_token;
}

 public function connect(Request $request)
{

    $name = $request->all('name');
    $client = $request->all('client');
    $secret = $request->all('secret');

    $client = $client['client'];
    $secret = $secret['secret'];

    define('CLIENT_ID', $client); 
    define('CLIENT_SECRET', $secret); 

    echo "access_token = ", $this->getAccessToken();
   $token = $this->getAccessToken();


   DB::table('token')->insert([
    'name' => $name["name"],
    'token' => $token,
    'created_at' =>Carbon::now(),
    'updated_at' =>Carbon::now(),
 ]);
}




}
