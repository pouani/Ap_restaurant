<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\RestaurantController;

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
//route authentification et listing des users
Route::post('register', [RegisterController::class,'register'])->name('register');
Route::post('login', [RegisterController::class,'login'])->name('login');
Route::get('users', [RegisterController::class,'index']);
Route::middleware('auth:api')->get('/users/{id}', [RegisterController::class,'show']);
Route::middleware('auth:api')->delete('/users/{id}', [RegisterController::class,'destroy']);


//routes categories
Route::get('/categories', [CategorieController::class,'index']);
Route::middleware('auth:api')->post('/categories', [CategorieController::class,'store']);
Route::get('/categories/{id}', [CategorieController::class,'show']);
Route::middleware('auth:api')->delete('/categories/{id}', [CategorieController::class,'destroy']);
Route::middleware('auth:api')->put('/categories/{categorie}', [CategorieController::class,'update']);

//route restaurant
Route::get('/restaurants', [RestaurantController::class,'index']);
Route::middleware('auth:api')->post('/restaurants', [RestaurantController::class,'store']);
Route::get('/restaurants/{id}', [RestaurantController::class,'show']);
Route::middleware('auth:api')->delete('/restaurants/{id}', [RestaurantController::class,'destroy']);
Route::middleware('auth:api')->put('/restaurants/{restaurant}', [RestaurantController::class,'update']);


//routes produits
Route::get('/produits', [ProductController::class,'index']);
Route::middleware('auth:api')->post('/produits', [ProductController::class,'store']);
Route::middleware('auth:api')->delete('/produits/{id}', [ProductController::class,'destroy']);
Route::get('/produits/{id}', [ProductController::class,'show']);
Route::middleware('auth:api')->put('/produits/{product}', [ProductController::class,'update']);


//routes carts
Route::get('/carts', [CartController::class,'index']);
Route::post('/carts', [CartController::class,'store']);
Route::get('/carts/increase/{id}', [CartController::class,'increase']);
Route::get('/carts/decrease/{id}', [CartController::class,'decrease']);
Route::delete('/carts/{id}', [CartController::class,'destroy']);

// Route::Apiresource('restaurant', 'RestaurantController');


// Route::apiResource('/categories','CategorieController');
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
