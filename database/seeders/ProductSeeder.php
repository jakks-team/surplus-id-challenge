<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		if(Product::count() == 0) {
			$randCount = mt_rand(15, 25);
			for($i = 0;$i<$randCount;$i++) {
				Product::create([
					'name' => fake()->words(mt_rand(1, 5), true),
					'description' => fake()->realTextBetween(mt_rand(5, 15), mt_rand(15, 300), mt_rand(1, 3)),
					'enable' => mt_rand(0, 1),
				]);
			}
		}
	}
}
