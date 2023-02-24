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
        $dane = $object->rest_get('https://api.allegro.pl/sale/offers?limit=100', $api_token);
        $dane = json_decode($dane, true);
       
        echo '<br>';
        echo 'Dodać rezerwacje zamówionych już produktów i przycisk do dodawania produktów które przyszły do allegro';
        echo '<br><br>'; 
        foreach($dane["offers"] as $product){
       
  
               $offer_id = $product["id"];
               $stock = $product["stock"]["available"];
               $sold = $product["stock"]["sold"];
            
         
      
       
            $per_day_sold =  $sold  / 30;
            $value1 = $per_day_sold  * 15;

            $per_day_stock=  $stock  / 30;
            $value2 = $per_day_stock * 15;

            $order = $value1 - $value2;
      
        if ($order > 1.9){
        echo'<br>';
        echo $offer_id;
        echo ' stock: '.$stock;
        echo ' sold: '.$sold;
        echo ' order: '.$order;
   
        echo'<br>';
        }
        }
    }


}
