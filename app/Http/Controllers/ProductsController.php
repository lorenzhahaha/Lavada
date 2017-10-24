<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;
use App\CartItem;

class ProductsController extends Controller
{

    public function processCartProducts(Request $request) {
    	$product_id = $request -> product_id;
    	$product_name = $request -> product_name;
    	$customer_id = $request -> customer_id;
        $product_price = $request -> product_price;
        $product_picture = $request -> product_picture;

        $check_if_exist = DB::table('cart_items') -> where([
            ['product_id', '=', $product_id],
            ['customer_id', '=', $customer_id],
            ]) -> count();
        if ($check_if_exist == 1) {
            $product_existed = DB::table('cart_items') -> where([
                    ['product_id', '=', $product_id],
                    ['customer_id', '=', $customer_id],
                ]) -> increment('product_quantity');
            $products = DB::table('products') -> get();
            $product_name = DB::table('cart_items') -> where('product_id', '=', $product_id) -> value('product_name');
            $count_cart = DB::table('cart_items') -> where('customer_id', '=', $customer_id) -> count();

            // $request->session()->flash('goingCart.content', ' is already in Cart. (Increased quantity by 1)');

            return view('home', [
                'products' => $products,
                'product_name' => $product_name,
                'count_cart' => $count_cart
                ]);
        } 
        else {
        	$cart = new CartItem;
        	$cart -> product_id = $product_id;
        	$cart -> product_name = $product_name;
        	$cart -> customer_id = $customer_id;
            $cart -> product_price = $product_price;
            $cart -> product_picture = $product_picture;
        	$cart -> save();

        	$in_cart = DB::table('cart_items') -> where([
                ['product_id', '=', $product_id],
                ['customer_id', '=', $customer_id],
                ]) -> update(['in_cart' => 1]);
            $products = DB::table('products') -> get();
            $product_name = DB::table('cart_items') -> where('product_id', '=', $product_id) -> value('product_name');
            $count_cart = DB::table('cart_items') -> where('customer_id', '=', $customer_id) -> count();

        // $request->session()->flash('goingCart.content', ' was successfully added in your cart!');

    	return view('home', [
            'products' => $products,
            'product_name' => $product_name,
            'count_cart' => $count_cart
            ]);
        }
    }
    
    public function showCart(Request $request) {
    	$customer_id = $request -> customer_id;

    	$carts = DB::table('cart_items') -> leftJoin('users', 'cart_items.customer_id', '=', 'users.id') -> where([
                ['users.id', '=', $customer_id], 
                ['cart_items.in_cart', '=', '1'],
            ]) -> get();
        $count_cart = DB::table('cart_items') -> where('customer_id', '=', $customer_id) -> count();

    	return view('cart-items', [
    		'carts' => $carts,
            'count_cart' => $count_cart
    		]);
    }

    public function removeToCart(Request $request) {
    	$product_id = $request -> product_id;
    	$customer_id = $request -> customer_id;

        $removed = DB::table('cart_items') -> where('product_id', '=', $product_id) -> delete();
        $carts = DB::table('cart_items') -> leftJoin('users', 'cart_items.customer_id', '=', 'users.id') -> where('id', '=', $customer_id) -> get();
        $product_name = DB::table('products') -> where('product_id', '=', $product_id) -> value('product_name');
        $count_cart = DB::table('cart_items') -> where('customer_id', '=', $customer_id) -> count();

        // $request->session()->flash('removeInCart.content', ' was removed in your cart.');

    	return view('cart-items', [
    		'carts' => $carts,
            'product_name' => $product_name,
            'count_cart' => $count_cart
    		]);
    }

    public function addQuantityProduct(Request $request) {
        $product_id = $request -> product_id;
        $customer_id = $request -> customer_id;
        $product_quantity = $request -> product_quantity;

        if ($product_quantity == 0) {
            $zeroQuantity = DB::table('cart_items') -> leftJoin('users', 'cart_items.customer_id', '=', 'users.id') -> where([
                ['id', '=', $customer_id],
                ['product_id', '=', $product_id],
            ]) -> delete();

            // $request->session()->flash('editQuantity.content', 'Item was removed in your cart. Since the quantity was set to 0.');
        } 
        else {
            $addQuantity = DB::table('cart_items') -> leftJoin('users', 'cart_items.customer_id', '=', 'users.id') -> where([
                    ['id', '=', $customer_id],
                    ['product_id', '=', $product_id],
                ]) -> update(['product_quantity' => $product_quantity]);

            // $request->session()->flash('editQuantity.content', ' quantity has been updated!');
        }
        
        $carts = DB::table('cart_items') -> leftJoin('users', 'cart_items.customer_id', '=', 'users.id') -> where('id', '=', $customer_id) -> get();
        $product_name = DB::table('cart_items') -> where('product_id', '=', $product_id) -> value('product_name');
        $count_cart = DB::table('cart_items') -> where('customer_id', '=', $customer_id) -> count();

        return view('cart-items', [
            'carts' => $carts,
            'product_name' => $product_name,
            'count_cart' => $count_cart
            ]);
    }
}
