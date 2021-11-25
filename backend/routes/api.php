<?php

use App\Http\Controllers\CountryCodeController;
use App\Http\Controllers\UploadFileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

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
    Route::post('/update', [AuthController::class, 'update']);
});

Route::get('countrycode', [HomeController::class, 'getCountryCodes']);
Route::post('image', [UploadFileController::class, 'uploadImageFile']);

Route::group(['middleware' => ['api', 'auth'], 'prefix' => 'dashboard'], function ($router) {
    Route::apiResources([
        'countrycode' => CountryCodeController::class,
    ]);
});

