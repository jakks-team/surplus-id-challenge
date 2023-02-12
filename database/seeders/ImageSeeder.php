<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;

class ImageSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		if(Image::count() == 0) {
			$randCount = mt_rand(15, 25);
			for($i = 0;$i<$randCount;$i++) {
				Image::create([
					'name' => fake()->words(mt_rand(1, 5), true),
					'file' => fake()->imageUrl(),
					'enable' => mt_rand(0, 1),
				]);
			}
		}
	}
}
