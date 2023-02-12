<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model {
	use HasFactory;
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'images';
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
		'file',
		'enable',
	];
	/**
	 * Get the products for the category.
	 */
	public function products() {
		return $this->hasManyThrough(
			Product::class,
			ProductImage::class,
			'image_id',
			'id',
			'id',
			'product_id'
		);
	}
}
