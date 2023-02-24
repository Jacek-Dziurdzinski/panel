<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Offer;





class HomeController extends Controller
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
        $users = User::count();


         $orders = Order::orderBy('buy_time', 'DESC')->get();
      

 
$sum = 0;
foreach($orders as $earn){

    $sum+= $earn->offer;
}


       $alert = $this->orders();
   
        return view('home', [
            'users' => $users, 
            'orders'=> $orders,
            'alert'=> $alert,
            'suma'=> $sum,
        ]);
   
   

   
    }

    public function orders()
    {
        $api_token = DB::table('api_token')->where('name', '3SELL-ZDROWIE')->first(); 
        $api_token = $api_token->api_token;


        $object = new AllegroApiController();
        $orders = $object->rest_get('https://api.allegro.pl/order/checkout-forms?limit=100', $api_token);
        $orders = json_decode($orders, true);
     // dd( $orders);
if (isset($orders['error'])){ return $alert = 'Token wygasł. Zamówienia nie są pobierane!'; } 

foreach($orders["checkoutForms"] as $order){
            $buy_time = Carbon::parse($order['updatedAt'])->format('d.m.Y H:i');
            DB::table('orders')->insertOrIgnore([
                'order_id' => $order["id"],
                'buyer' => $order["buyer"]["login"],
                'buy_time'=> $buy_time,
                'offer' => '',
                'created_at' =>Carbon::now(),

]);



$sum = 0;
foreach($order["lineItems"] as $items){

    $object = new ProductsController();
    $earn   = round($object->earn($items["offer"]["id"], $items["price"]["amount"]), 2);
  
    
    $earn = $earn * $items["quantity"];

    $sum+= $earn;

}


DB::table('orders')->where('order_id', $order["id"])->update(['offer' => $sum]);  

}

}




}