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
