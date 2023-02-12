<?php
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('categories', CategoryController::class);
Route::get('categories/{category}/products', [CategoryController::class, 'categoryProducts'])->name('categories.products.index');
Route::post('categories/{category}/products', [CategoryController::class, 'storeCategoryProducts'])->name('categories.products.store');
Route::delete('categories/{category}/products/{product}', [CategoryController::class, 'deleteCategoryProducts'])->name('categories.products.delete');
Route::apiResource('products', ProductController::class);
Route::get('products/{product}/categories', [ProductController::class, 'productCategories'])->name('products.categories.index');
Route::post('products/{product}/categories', [ProductController::class, 'storeProductCategories'])->name('products.categories.store');
Route::delete('products/{product}/categories/{category}', [ProductController::class, 'deleteProductCategories'])->name('products.categories.delete');
Route::get('products/{product}/images', [ProductController::class, 'productImages'])->name('products.images.index');
Route::post('products/{product}/images', [ProductController::class, 'storeProductImages'])->name('products.images.store');
Route::delete('products/{product}/images/{image}', [ProductController::class, 'deleteProductImages'])->name('products.images.delete');
Route::apiResource('images', ImageController::class);
Route::get('images/{image}/products', [ImageController::class, 'imageProducts'])->name('images.products.index');
Route::post('images/{image}/products', [ImageController::class, 'storeImageProducts'])->name('images.products.store');
Route::delete('images/{image}/products/{product}', [ImageController::class, 'deleteImageProducts'])->name('images.products.delete');