<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
// 
Route::post('register', [RegisterController::class,'register'])->name('register');
Route::post('login', [RegisterController::class,'login'])->name('login');


Route::middleware('auth:api')->get('/categories', [CategorieController::class,'index']);
Route::middleware('auth:api')->post('/categories', [CategorieController::class,'store']);
Route::middleware('auth:api')->get('/categories/{id}', [CategorieController::class,'show']);
Route::middleware('auth:api')->delete('/categories/{id}', [CategorieController::class,'destroy']);
Route::middleware('auth:api')->put('/categories/{categorie}', [CategorieController::class,'update']);

//route restaurant
Route::get('/restaurants', [RestaurantController::class,'index']);
Route::middleware('auth:api')->post('/restaurants', [RestaurantController::class,'store']);
Route::get('/restaurants/{id}', [RestaurantController::class,'show']);
Route::middleware('auth:api')->delete('/restaurants/{id}', [RestaurantController::class,'destroy']);
Route::middleware('auth:api')->put('/restaurants/{restaurant}', [RestaurantController::class,'update']);


//route produit
Route::get('/produits', [ProductController::class,'index']);

// Route::Apiresource('restaurant', 'RestaurantController');


// Route::apiResource('/categories','CategorieController');
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
