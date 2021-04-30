<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class ProductController extends Controller
{
    public function index() {
    	$products = Product::select(['product_code','name','image'])->get();
    	return ['data'=> $products, 'success'=> !empty($products) ? true : false];	
    }
    public function singleProduct(Request $request) {
    	$product_code = $request->input('product_code');
    	$singleProduct = Product::select(['id','product_code','name','image','type','category','unit_price'])->where('product_code', $product_code)->first();
    	return ['data'=> $singleProduct, 'success'=> !empty($singleProduct) ? true : false];
    }
}
