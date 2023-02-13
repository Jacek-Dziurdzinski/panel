<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatusController extends Controller
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
        
        $api_token = DB::table('api_token')->where('name', '3SELL-ZDROWIE')->first(); 
        $api_token = $api_token->api_token;

        // api connection test
        $object = new AllegroApiController();
        $api_connection = $object->rest_get('https://api.allegro.pl/sale/categories', $api_token);
        $api_connection = json_decode($api_connection, true);
        if(isset($api_connection['error'])){
        DB::table('api_token')->where('api_token', $api_token)->update(['api_token' => '']); 
         //end
}
        $accounts = DB::table('api_token')->get();

        return view('status', ['accounts' => $accounts]);
    }


    public function add(Request $request)
    {
    
        $name = $request->all('name');
        $client = $request->all('client');
        $secret = $request->all('secret');
    
    
       DB::table('api_token')->insert([
        'name' => $name["name"],
        'client_id'=>$client['client'],
        'client_secret'=>$secret['secret'],
        'api_token' => '',
        'created_at' =>Carbon::now(),
        'updated_at' =>Carbon::now(),
     ]);
    
    
     $accounts = DB::table('api_token')->get();

     return view('status', ['accounts' => $accounts]);
    
    
    }
}
