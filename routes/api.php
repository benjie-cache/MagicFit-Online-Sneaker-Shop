<?php

use App\Http\Controllers\CheckoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\product_management\ProductController;
use App\Http\Controllers\shopping_process\ShoppingSessionController;
use App\Http\Controllers\UserAuthenticationController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\OrderController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request){
    return $request->user();
});
Route::prefix('auth')->group(function (){
    Route::post('login', [UserAuthenticationController::class, 'login'])->name('login');
    Route::post('register', [UserAuthenticationController::class, 'register'])->name('register');
});
Route::prefix('auth')->middleware('auth:sanctum')->group(function (){
    Route::post('logout', [UserAuthenticationController::class, 'logout']);
});
//Routes for product crud ...
Route::prefix('products')->group(function (){
    Route::get('/', [ProductController::class, 'index']);     //get a list of all products
    Route::get('/{product}', [ProductController::class, 'show']);///show a single product
    Route::post('/', [ProductController::class, 'store']);//store a newly created product
    Route::put('/{product}', [ProductController::class, 'update']);//edit or update product details
    Route::delete('/{product}', [ProductController::class, 'destroy']);//delete a single product 
});

Route::get('/entities', [EntityController::class, 'getEntities']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('checkout/save_checkout_information', [CheckoutController::class, 'save_checkout_information']);
    
 
});