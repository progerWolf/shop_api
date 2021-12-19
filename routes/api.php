<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountryCodeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\UserController;
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
Route::resource('categories', ProductCategoryController::class);
Route::resource('shops', ShopController::class);
Route::resource('products', ProductController::class);

Route::group(['middleware' => ['api', 'auth'], 'prefix' => 'dashboard'], function ($router) {
    Route::apiResources([
        'countrycode' => CountryCodeController::class,
    ]);
    Route::apiResources([
        'user' => UserController::class
    ]);
    Route::apiResources([
        'permission' => PermissionController::class,
    ]);
});

Route::group(['middleware' => ['api', 'auth'], 'prefix' => 'profile'], function ($router) {
    Route::get('/', [ProfileController::class, 'show']);
    Route::put('/update', [ProfileController::class, 'update']);
    Route::delete('/delete', [ProfileController::class, 'delete']);
});

