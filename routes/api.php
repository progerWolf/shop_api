<?php

use App\Http\Controllers\CountryCodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Models\Category;

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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/check-number', [AuthController::class, 'checkNumber']);
    Route::post('/confirm-number', [AuthController::class, 'confirmNumber']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);
});

Route::get('countrycode', [CountryCodeController::class, 'index']);
Route::post('image', [UploadFileController::class, 'uploadImageFile']);
Route::resource('shops', ShopController::class);
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::get("get-products-by-id", [ProductController::class, "getProductsById"]);

Route::group(['middleware' => ['api', 'auth'], 'prefix' => 'dashboard'], function ($router) {
    Route::apiResources([
        'countrycode' => CountryCodeController::class,
    ]);
    Route::apiResources([
        'user' => UserController::class
    ]);
});

Route::group(['middleware' => ['api', 'auth'], 'prefix' => 'profile'], function ($router) {
    Route::get('/', [ProfileController::class, 'show']);
    Route::post('/update', [ProfileController::class, 'update']);
    Route::post('/delete', [ProfileController::class, 'delete']);
});

