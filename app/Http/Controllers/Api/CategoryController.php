<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StoreCategoryProductRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\DeleteCategoryProductRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$categories = Category::all();
		return CategoryResource::collection($categories);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreCategoryRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreCategoryRequest $request)
	{
		$category = Category::create($request->validated());
		return $category->toArray();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function show(Category $category)
	{
		return $category->toArray();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateCategoryRequest  $request
	 * @param  \App\Models\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateCategoryRequest $request, Category $category)
	{
		$category->update($request->validated());
		return $category->toArray();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Category $category)
	{
		$category->delete();
		return response(null, 204);
	}

	/**
	 * Display a listing of Products that belongs to the Category.
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function categoryProducts(Category $category) {
		return ProductResource::collection($category->products);
	}

	/**
	 * Add new Product relationship to the given Category.
	 *
	 * @param  \App\Http\Requests\StoreCategoryProductRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function storeCategoryProducts(StoreCategoryProductRequest $request, Category $category)
	{
		$isFound = $category->products->filter(function($product) use ($request){
			return $product->id == $request->validated()['product_id'];
		})->count();
		if($isFound == 0) {
			CategoryProduct::create([
				'category_id' => $category->id,
				'product_id' => $request->validated()['product_id'],
			]);
		}
		$category->refresh();
		return ProductResource::collection($category->products);
	}

	/**
	 * Delete Product relationship to the given Category.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function deleteCategoryProducts(Category $category, Product $product)
	{
		$isFound = $category->products->filter(function($eachProduct) use ($product){
			return $eachProduct->id == $product->id;
		})->count();
		if($isFound != 0) {
			CategoryProduct::where([
				'category_id' => $category->id,
				'product_id' => $product->id,
			])->delete();
		}
		$category->refresh();
		return ProductResource::collection($category->products);
	}
}
