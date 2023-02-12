<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Image::chunk(20, function($images){
			foreach($images as $image) {
				$products = Product::inRandomOrder()->limit(mt_rand(2, 5))->get();
				foreach($products as $product) {
					$prodImg = ProductImage::where([
						'product_id' => $product->id,
						'image_id' => $image->id,
					])->first();
					if(!$prodImg) {
						ProductImage::create([
							'product_id' => $product->id,
							'image_id' => $image->id,
						]);
					}
				}
			}
		});
		Product::chunk(20, function($products){
			foreach($products as $product) {
				$images = Image::inRandomOrder()->limit(mt_rand(2, 5))->get();
				foreach($images as $image) {
					$prodImg = ProductImage::where([
						'product_id' => $product->id,
						'image_id' => $image->id,
					])->first();
					if(!$prodImg) {
						ProductImage::create([
							'product_id' => $product->id,
							'image_id' => $image->id,
						]);
					}
				}
			}
		});
	}
}
