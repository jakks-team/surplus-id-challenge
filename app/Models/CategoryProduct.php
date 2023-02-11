<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryProduct extends Pivot {
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'category_products';
}
