<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
       
   
       $object = new AllegroApiController();
       $dane = $object->rest_get('https://api.allegro.pl/sale/offers?limit=1000&publication.status=ACTIVE', $api_token);
       $dane = json_decode($dane, true);
       

    if(isset($dane["error"])){

    DB::table('api_token')->where('api_token', $api_token)->update(['api_token' => '']); 
            
    return view('status',[

        'error' => 'Token wygasł, połącz ponownie!',

    ]);

}




       foreach($dane["offers"] as $product){
       
  
        $api_token = DB::table('api_token')->where('name', '3SELL-ZDROWIE')->first(); 
        $api_token = $api_token->api_token;
       
           $object = new AllegroApiController();
           $product_details = $object->rest_get('https://api.allegro.pl/sale/offers/'.$product["id"], $api_token);
        
       
           $product_details = json_decode($product_details, true);
       
          
        
    
       
       foreach($product_details['parameters'] as $find_ean){
       
       if($find_ean["id"] == '225693'){
       
    Storage::disk('public')->put($find_ean["values"][0].'.png', file_get_contents($product["primaryImage"]["url"]));     
       


       DB::table('products')->insertOrIgnore([
           'ean' => $find_ean["values"][0],
           'producer' => '0',
           'name' => $product["name"],
           'stock' => $product["stock"]["available"],
           'buy_price' =>'15.00',
           'discount' =>'0',
           'created_at' =>Carbon::now(),
        ]);
       
        DB::table('offers')->insertOrIgnore([
           'ean' => $find_ean["values"][0],
           'offer_id' => $product["id"],
           'sell_price' => $product["sellingMode"]["price"]["amount"],
           'promotion' => $product_details['promotion']['emphasized'],
           'created_at' =>Carbon::now(),
        ]);

        DB::table('offers')->insertOrIgnore([
            'ean' => $find_ean["values"][0],
            'offer_id' => $product["id"],
            'sell_price' => $product["sellingMode"]["price"]["amount"],
            'promotion' => $product_details['promotion']['emphasized'],
            'created_at' =>Carbon::now(),
         ]);
        
         DB::table('products')->where('ean', $find_ean["values"][0])->update(['stock' => $product["stock"]["available"]]); 
         DB::table('offers')->where('ean', $find_ean["values"][0])->update(['sell_price' => $product["sellingMode"]["price"]["amount"]]); 


       }}};
       
    
       return redirect()->route('products.index');
    }
  
    

}
