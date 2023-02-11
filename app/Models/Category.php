<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    use HasFactory;
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';
	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'enable',
	];
	/**
	 * Get the products for the category.
	 */
	public function products() {
		return $this->hasManyThrough(
			Product::class,
			CategoryProduct::class,
			'product_id',
			'id',
			'category_id',
			'id'
		);
	}
}
