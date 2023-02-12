<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'products';
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
		'description',
		'enable',
	];
	/**
	 * Get the categories for the product.
	 */
	public function categories() {
		return $this->hasManyThrough(
			Category::class,
			CategoryProduct::class,
			'product_id',
			'id',
			'id',
			'category_id'
		);
	}
	/**
	 * Get the images for the product.
	 */
	public function images() {
		return $this->hasManyThrough(
			Image::class,
			ProductImage::class,
			'product_id',
			'id',
			'id',
			'image_id'
		);
	}
}
