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

     public function download_offer() {

        $api_token = DB::table('api_token')->where('name', '3SELL-ZDROWIE')->first(); 
        $api_token = $api_token->api_token;
       
       
       
       $dane = $this->rest_get('https://api.allegro.pl/sale/offers?limit=8', $api_token);
       $dane = json_decode($dane, true);
       
       foreach($dane["offers"] as $product){
       
         
          
           $product_details = $this->rest_get('https://api.allegro.pl/sale/offers/'.$product["id"], $api_token);
           $product_details = json_decode($product_details, true);
       
       
       foreach($product_details['parameters'] as $find_ean){
       
       if($find_ean["id"] == '225693'){
       
      
       DB::table('products')->insertOrIgnore([
           'ean' => $find_ean["values"][0],
           'name' => $product["name"],
           'stock' => $product["stock"]["available"],
           'buy_price' =>'',
           'created_at' =>Carbon::now(),
        ]);
       
        DB::table('offers')->insertOrIgnore([
           'ean' => $find_ean["values"][0],
           'offer_id' => $product["id"],
           'created_at' =>Carbon::now(),
        ]);
       
       }}};
       
    
    
    }


}
