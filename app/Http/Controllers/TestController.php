<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TestController extends Controller
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
        $dane = $object->rest_get('https://api.allegro.pl/sale/offers?limit=1000&publication.status=ACTIVE', $api_token);
        $dane = json_decode($dane, true);
        

        foreach($dane["offers"] as $product){
       
  
               $ean = $product["id"];
               $stock = $product["stock"]["available"];
               $sold = $product["stock"]["sold"];
            
         
           
        echo 'EAN '.$ean;
        echo '<br>';
        echo 'Ilość '.$stock;
        echo '<br>'; 
        echo 'Sprzedanych '.$sold;
        echo '<br>'; 
        if($stock > 0 && $sold > 0){
        $wspołczynnik = $stock / $sold;
        }else { $wspołczynnik = 2;}
        echo 'Współczynnik '.$wspołczynnik;
        echo '<br>';
        if($wspołczynnik <= 1){ 
       
            $per_day_sold =  $sold  / 30;
            $value1 = $per_day_sold  * 15;

            $per_day_stock=  $stock  / 30;
            $value2 = $per_day_stock * 15;

            $order = $value1 - $value2;
        }else{$order = 0;}
        echo 'Zamówić '. ceil($order); 
        echo '<br>'; 
        echo '<br>';
    
           };
           

    }


}
