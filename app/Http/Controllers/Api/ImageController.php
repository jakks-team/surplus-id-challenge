<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImageRequest;
// use App\Http\Requests\StoreProductImageRequest;
use App\Http\Requests\UpdateImageRequest;
// use App\Http\Requests\DeleteProductImageRequest;
use App\Http\Resources\ImageResource;
use App\Http\Resources\ProductResource;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ImageController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$images = Image::all();
		return ImageResource::collection($images);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\StoreImageRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreImageRequest $request)
	{
		$image = Image::create($request->validated());
		return $image->toArray();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Image  $image
	 * @return \Illuminate\Http\Response
	 */
	public function show(Image $image)
	{
		return $image->toArray();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\UpdateImageRequest  $request
	 * @param  \App\Models\Image  $image
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateImageRequest $request, Image $image)
	{
		$image->update($request->validated());
		return $image->toArray();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Image  $image
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Image $image)
	{
		$image->delete();
		return response(null, 204);
	}
}
