<?php

use Illuminate\Database\Seeder;
use App\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = config('products');
        foreach($products as $key => $value) {
			Product::updateOrCreate(['product_code'=>$value['product_id']],
				[
					'name'=>$value['product_name'] ?? '',
					'product_code'=>$value['product_id'] ?? '',
					'type'=> $value['type'] ?? '',
					'category' => $value['category'] ?? '',
					'quantity' => $value['quantity'] ?? '',
					'unit_price' => $value['unit_price'] ?? '',
					'image'=> $value['image'] ?? '',
				]
			);
		}
    }
}
