<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Offer;
use App\Models\Producer;

class ShoppingController extends Controller
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
    public function index()
    {
        $api_token = DB::table('api_token')->where('name', '3SELL-ZDROWIE')->first(); 
        $api_token = $api_token->api_token;

        $object = new AllegroApiController();
        $dane = $object->rest_get('https://api.allegro.pl/sale/offers?limit=100', $api_token);
        $dane = json_decode($dane, true);
        
        echo 'Rozdzielić zamówienia na formeds i medicaline.';
        echo '<br>';
        echo 'Dodać rezerwacje zamówionych już produktów i przycisk do dodawania produktów które przyszły do allegro';
        echo '<br><br>'; 
        foreach($dane["offers"] as $product){
       
  
               $offer_id = $product["id"];
               $stock = $product["stock"]["available"];
               $sold = $product["stock"]["sold"];
            
         
        if($stock > 0 && $sold > 0){
        $wspołczynnik = $stock / $sold;
        }else { $wspołczynnik = 2;}
        if($wspołczynnik <= 1){ 
       
            $per_day_sold =  $sold  / 30;
            $value1 = $per_day_sold  * 15;

            $per_day_stock=  $stock  / 30;
            $value2 = $per_day_stock * 15;

            $order = $value1 - $value2;
        }else{$order = 0;}

        if ($order > 1.9){

        $offer = Offer::where('offer_id', $offer_id)->first(); 

    
    $shopping[] = [
        'producer' => $offer->products->producers->name,
        'producer_id' => $offer->products->producer,
        'name' => $offer->products->name,
        'ean' => $offer->ean,
        'quantinity' => ceil($order),
    ];
    
    }
           };
           
           $producer =   Producer::all();
   
return view('shopping', [
    'dane' => $shopping, 
    'producer' => $producer,
]);
    
    }



}
