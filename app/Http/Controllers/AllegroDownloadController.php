<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AllegroDownloadController extends Controller
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

     public function download_offer() {

        $api_token = DB::table('api_token')->where('name', '3SELL-ZDROWIE')->first(); 
        $api_token = $api_token->api_token;
       
   
       
       $dane = $this->rest_get('https://api.allegro.pl/sale/offers?limit=8', $api_token);
       $dane = json_decode($dane, true);
       
       foreach($dane["offers"] as $product){
       
         
          
           $product_details = $this->rest_get('https://api.allegro.pl/sale/offers/'.$product["id"], $api_token);
         //  $product_details = $this->rest_get('https://api.allegro.pl/sale/offers/13097410968', $api_token);

       
           $product_details = json_decode($product_details, true);
       
          

         
           //promotion->emphasized // wyroznienie
       
       foreach($product_details['parameters'] as $find_ean){
       
       if($find_ean["id"] == '225693'){
       
       // dd($product_details['promotion']['emphasized']);

       DB::table('products')->insertOrIgnore([
           'ean' => $find_ean["values"][0],
           'name' => $product["name"],
           'stock' => $product["stock"]["available"],
           'buy_price' =>'15.00',
           'discount' =>'5',
           'created_at' =>Carbon::now(),
        ]);
       
        DB::table('offers')->insertOrIgnore([
           'ean' => $find_ean["values"][0],
           'offer_id' => $product["id"],
           'sell_price' => $product["sellingMode"]["price"]["amount"],
           'promotion' => $product_details['promotion']['emphasized'],
           'created_at' =>Carbon::now(),
        ]);
       
       }}};
       
    
       return redirect()->route('products.index');
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
