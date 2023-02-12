<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\CategoryProduct;

class CategoryProductSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Category::chunk(20, function($categories){
			foreach($categories as $category) {
				$products = Product::inRandomOrder()->limit(mt_rand(2, 5))->get();
				foreach($products as $product) {
					$catProd = CategoryProduct::where([
						'category_id' => $category->id,
						'product_id' => $product->id,
					])->first();
					if(!$catProd) {
						CategoryProduct::create([
							'category_id' => $category->id,
							'product_id' => $product->id,
						]);
					}
				}
			}
		});
		Product::chunk(20, function($products){
			foreach($products as $product) {
				$categories = Category::inRandomOrder()->limit(mt_rand(2, 5))->get();
				foreach($categories as $category) {
					$catProd = CategoryProduct::where([
						'category_id' => $category->id,
						'product_id' => $product->id,
					])->first();
					if(!$catProd) {
						CategoryProduct::create([
							'category_id' => $category->id,
							'product_id' => $product->id,
						]);
					}
				}
			}
		});
	}
}
