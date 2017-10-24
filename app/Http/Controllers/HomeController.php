<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;
use Auth;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $customer_id = Auth::user()->id;
        
        $count_cart = DB::table('cart_items') -> where('customer_id', '=', $customer_id) -> count();
        $products = DB::table('products') -> get();
        return view('home', [
            'products' => $products,
            'count_cart' => $count_cart
            ]);
    }
}
