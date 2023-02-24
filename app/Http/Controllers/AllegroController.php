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

////OBSŁUGA ZAPYTAŃ DO API ALEGRO ///
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



////OBSŁUGA ZAPYTAŃ DO API ALEGRO ///


public function select($name) {
 
   
 $api_token = DB::table('api_token')->where('name', '3SELL-ZDROWIE')->first();  //wstawić zmienną zamiasy nazwy 3SELL-ZDROWIE
 $api_token = $api_token->api_token;



$dane = $this->rest_get('https://api.allegro.pl/sale/offers?limit=1000&publication.status=ACTIVE', $api_token);
$dane = json_decode($dane, true);

    return view('allegro', [
        'name' => $name, 
       'dane' => $dane,
    ]);

   
}





}
