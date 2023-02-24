<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use App\Models\Product;
use App\Models\Offer;
use App\Models\Producer;

class ProductsController extends Controller
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

     public function index():View {

 
        
   
        $dane = Product::with('producers')->paginate(15);

     

        return view('products', [
            'dane' => $dane, 
        ]);

    
    }


    public function show(int $ean)
    {

        $dane =   Product::where(['ean'=> $ean])
        ->first();
        
    
        
        $earn = $this->earn( $dane->offers->offer_id);
        $dane['earn'] = round($earn, 2);


        $producers = Producer::all(); 


        return view('details', [
            'dane' => $dane, 
            'producers' => $producers,

        ]);




  
    }



    public function update(Request $request)
    {

if(isset($request->buy_price)){

     $nowa_cena = str_replace(',','.', $request->buy_price);
     $buy_price = str_replace(' ','', $nowa_cena);
}

if(isset($request->sell_price)){

    $nowa_cena = str_replace(',','.', $request->sell_price);
      $sell_price = str_replace(' ','', $nowa_cena);
}



        Product::where('ean', $request->ean)->update([
        'producer' => $request->producer,
        'name' => $request->name,
        'ean' => $request->ean,
        'stock' => $request->stock,
        'buy_price' => $buy_price,
        'discount' => $request->discount,
    
    
    ]); 

    Offer::where('ean', $request->ean)->update([
        'offer_id' => $request->offer_id,
        'sell_price' => $sell_price,
        'promotion' => $request->promotion,
        'coins' => $request->coins,
       
    
    
    ]); 
       
        return $this->index();
    }



    public function settings()
    {

        $producers = Producer::all(); 
    


        return view('settings', [
            'producers' => $producers, 
        ]);


}
public function settings_update(Request $request)
{

//discount settings
   foreach($request->except('_token') as $producer => $discount){


    if($producer == 0 | $producer == 3 || $producer == 4 ){
  
    Producer::where('id', $producer)->update([
        'discount' => $discount,
     ]);


     Product::where('producer', $producer)->update([
        'discount' => $discount,
     ]);
    }
  
   }
//coins settings


    Offer::whereBetween('sell_price', [$request->one_coin_from, $request->one_coin_to])->update([
        'coins' => 1,
     ]);


     Offer::whereBetween('sell_price', [$request->two_coin_from, $request->two_coin_to])->update([
        'coins' => 2,
     ]);



     return to_route('products.index');
}


public function earn($offer_id, $sell_price = null)
    {
    
        $dane = Offer::where(['offer_id'=> $offer_id])->first();
     
        $buy_price = $dane->products->buy_price;
        if($sell_price == null){$sell_price = $dane->sell_price;}
        $discount = $dane->products->discount;
        if($dane->products->discount == 0) {return 0;}
        $commission_additional_quantity = $dane->promotion;
        $coin_quantity = $dane->coins;





$tax = '8'; //%
$commission_primary = 11.1; //%
$commission_additional = 8.2; //%
$coin = 1.23;
$commission_delivery = 0.99;



$net_price = $buy_price - $this->get_percent($discount, $buy_price); // cena netto po rabacie

$gross_price = $net_price + $this->get_percent($tax, $net_price); // cena brutto po rabacie

$commission_additional = $commission_additional * $commission_additional_quantity; //sprawdza czy trzeba naliczać prowizje od wyróżnienia
$commission_allegro_in_percent = $commission_primary + $commission_additional; //suma prowizji allegro w %   

$commission_allegro_in_amount = $this->price_of_percent($commission_allegro_in_percent, $sell_price); // prowizja allegro w zł


$coin_price =  $coin * $coin_quantity; // sprawdza czy trzeba naliczyć opłate za monety
$earn = $sell_price - $commission_allegro_in_amount - $coin_price - $commission_delivery - $gross_price;

return $earn;



}



public function get_percent($percent,
$number)
{

  //  dd($number);
$per = 100 / $percent;
return $number / $per;
}


public function price_of_percent($percent,$number)
{
    
    $procent=$percent/100; 

    return ($number*$procent);
}

}