<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Category::count() == 0) {
			$randCount = mt_rand(15, 25);
			for($i = 0;$i<$randCount;$i++) {
				Category::create([
					'name' => fake()->words(mt_rand(1, 5), true),
					'enable' => mt_rand(0, 1),
				]);
			}
		}
    }
}
