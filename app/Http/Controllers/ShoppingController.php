<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Offer;
use App\Models\Producer;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

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
       
        echo '<br>';
        echo 'Dodać rezerwacje zamówionych już produktów i przycisk do dodawania produktów które przyszły do allegro';
        echo '<br><br>'; 
        foreach($dane["offers"] as $product){
       
  
               $offer_id = $product["id"];
               $stock = $product["stock"]["available"];
               $sold = $product["stock"]["sold"];
            
   
            $per_day_sold =  $sold  / 30;
            $value1 = $per_day_sold  * 7;

            $per_day_stock=  $stock  / 30;
            $value2 = $per_day_stock * 7;

            $order = $value1 - $value2;
    

        if ($order > 1.9){
  
        $offer = Offer::where('offer_id', $offer_id)->first(); 
        $buy_price = $offer->products->buy_price;
        $discount = $offer->products->discount;
       

        $discountPrice = $buy_price - ($buy_price * ($discount/100));

      
        $shopping[] = [
        'offer_id' => $offer_id,
        'producer' => $offer->products->producers->name ?? '--------',
        'producer_id' => $offer->products->producer ?? '--------',
        'name' => $offer->products->name ?? '--------',
        'ean' => $offer->ean ?? '--------',
        'quantinity' => ceil($order),
    ];
    
    $total_buy_price = ceil($order) * round($discountPrice, 2);
    DB::table('shopping_temp')->insertOrIgnore([
        'offer_id' => $offer_id,
        'ean' => $offer->ean ?? '--------',
        'producer_id' => $offer->products->producer ?? '--------',
        'name' => $offer->products->name ?? '--------',
        'quantinity' => ceil($order),
        'buy_price' => $total_buy_price,
        'created_at' =>Carbon::now(),
     ]);



    }
           };
           
           $producer = Producer::all();


return view('shopping', [
    'dane' => $shopping, 
    'producer' => $producer,
]);
    
    }



    public function detail(int $producerId)
    {
        DB::table('shopping_temp')->where('producer_id', '!=', $producerId)->delete();
        $shoppingList = DB::table('shopping_temp')->where('producer_id', $producerId)->get();
       
        $total_price = 0;
        foreach($shoppingList as $price){
        
          $total_price += $price->buy_price;
       
        }
        return view('shoppingDetail', [
            'dane' => $shoppingList, 
            'total_price' => $total_price,
        ]);
    
    }


    public function export() 
    {
        return (new UsersExport)->download('invoices.xlsx');

    }




}
