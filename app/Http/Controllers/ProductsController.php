<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

     public function index() {

 
        
        $dane = DB::table('products')->get(); 
        $dane = json_decode($dane, true);
        return view('products', [
            'dane' => $dane, 
        ]);

    
    }


    public function show(int $ean)
    {


        $dane = DB::table('products')
        ->join('offers', 'products.ean', '=', 'offers.ean')
        ->where(['products.ean'=> $ean,'offers.ean'=> $ean ])
        ->get();
        $dane = json_decode($dane, true);
        
        $earn = $this->earn($dane[0]['buy_price'], $dane[0]['sell_price'], $dane[0]['discount'], $dane[0]['promotion'], $dane[0]['coins']);
        $earn = round($earn, 2);
        $dane[1] = ['earn' => $earn];
    
        $manufacturer = DB::table('product_manufacturer')->get(); 
        $manufacturer = json_decode($manufacturer, true);

        return view('details', [
            'dane' => $dane, 
            'manufacturer' => $manufacturer,
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



       DB::table('products')->where('ean', $request->ean)->update([
        'manufacturer' => $request->manufacturer,
        'name' => $request->name,
        'ean' => $request->ean,
        'stock' => $request->stock,
        'buy_price' => $buy_price,
        'discount' => $request->discount,
    
    
    ]); 

    DB::table('offers')->where('ean', $request->ean)->update([
        'offer_id' => $request->offer_id,
        'sell_price' => $sell_price,
        'promotion' => $request->promotion,
        'coins' => $request->coins,
       
    
    
    ]); 
       
        return $this->index();
    }



    public function settings()
    {

        $dane = DB::table('product_manufacturer')->get(); 
        $dane = json_decode($dane, true);


        return view('settings', [
            'dane' => $dane, 
        ]);


}
public function settings_update(Request $request)
{
   foreach($request->except('_token') as $manufacturer => $discount){

    DB::table('product_manufacturer')->where('manufacturer', $manufacturer)->update([
        'discount' => $discount,
     ]);


     DB::table('products')->where('manufacturer', $manufacturer)->update([
        'discount' => $discount,
     ]);

    }




}



public function earn($buy_price, $sell_price, $discount, $commission_additional_quantity, $coin_quantity)
    {



$tax = '8'; //%
$commission_primary = 12; //%
$commission_additional = 9; //%
$coin = 1.23;
$commission_delivery = 1;



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
$per = 100 / $percent;
return $number / $per;
}


public function price_of_percent($percent,$number)
{
    
    $procent=$percent/100; 
     
    return ($number*$procent);
}

}