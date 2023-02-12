<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductImage extends Pivot {
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'product_images';
	/**
	 * Indicates if the model's ID is NOT auto-incrementing.
	 *
	 * @var bool
	 */
	public $incrementing = false;
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
		'product_id',
		'image_id',
	];
}
