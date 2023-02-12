<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\DeleteProductCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$products = Product::all();
		return ProductResource::collection($products);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreProductRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreProductRequest $request)
	{
		$product = Product::create($request->validated());
		return $product->toArray();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function show(Product $product)
	{
		return $product->toArray();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreProductRequest  $request
	 * @param  \App\Models\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function update(StoreProductRequest $request, Product $product)
	{
		$product->update($request->validated());
		return $product->toArray();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Product $product)
	{
		$product->delete();
		return response(null, 204);
	}

	/**
	 * Display a listing of Categories that belongs to the Product.
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function productCategories(Product $product) {
		return CategoryResource::collection($product->categories);
	}

	/**
	 * Add new Product relationship to the given Category.
	 *
	 * @param  \App\Http\Requests\StoreProductCategoryRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function storeProductCategories(StoreProductCategoryRequest $request, Product $product)
	{
		$isFound = $product->categories->filter(function($category) use ($request){
			return $category->id == $request->validated()['category_id'];
		})->count();
		if($isFound == 0) {
			CategoryProduct::create([
				'category_id' => $request->validated()['category_id'],
				'product_id' => $product->id,
			]);
		}
		$product->refresh();
		return CategoryResource::collection($product->categories);
	}

	/**
	 * Delete Product relationship to the given Category.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function deleteProductCategories(Product $product, Category $category)
	{
		$isFound = $product->categories->filter(function($eachCategory) use ($category){
			return $eachCategory->id == $category->id;
		})->count();
		if($isFound != 0) {
			CategoryProduct::where([
				'category_id' => $category->id,
				'product_id' => $product->id,
			])->delete();
		}
		$product->refresh();
		return CategoryResource::collection($product->categories);
	}
}
