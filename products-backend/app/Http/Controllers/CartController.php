<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
class CartController extends Controller
{
    public function getCart(Request $request) {
        try {
            $user = $request->user();
            $cart = Cart::whereUserId($user->id)->with('product')->get()->map(function($val){
                return $val->product;
            });
            return ['success'=> !empty($cart) ? true : false, 'data'=>$cart];
        }
        catch(\Exception $e) {
            \Log::info('Cart addCart'. $e->getMessage());
            return ['success'=> false, 'message'=>'Something Went Wrong'];
        }
    }
    public function addCart(Request $request) {
    	try {
    		$user = $request->user();
	    	$product_id = $request->input('product_id');
    		$cart = Cart::create([
    			'user_id'=>$user->id,
    			'product_id'=>$product_id,
    			'quantity'=> 1
    		]);
	    	return ['success'=> true, 'message'=>'Cart Added Successfully'];
    	}
    	catch(\Exception $e) {
    		\Log::info('Cart addCart'. $e->getMessage());
	    	return ['success'=> false, 'message'=>'Something Went Wrong'];
    	}
    }
    public function removeCart(Request $request) {
    	try {
    		$user = $request->user();
	    	$product_id = $request->input('product_id');
	    	$cart = Cart::whereUserId($user->id)->whereProductId($product_id)->first();
	    	if(!empty($cart)) {
	    		$cart->delete();
	    		return ['success'=> true, 'message'=>'Product Removed from cart Successfully'];
	    	}
    		return ['success'=> false, 'message'=>'Something Went Wrong'];
    	}
    	catch(\Exception $e) {
    		\Log::info('Cart removeCart'. $e->getMessage());
	    	return ['success'=> false, 'message'=>'Something Went Wrong'];
    	}
    }
}
