<?php

use App\Http\Controllers\CountryCodeController;
use App\Http\Controllers\FileUploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    Route::get('/user', [AuthController::class, 'userProfile']);
    Route::post('/number-check', [AuthController::class, 'numberCheck']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    Route::post('/update', [AuthController::class, 'update']);
});

Route::get('countrycode', [CountryCodeController::class, 'index']);
Route::post('countrycode', [CountryCodeController::class, 'store']);
Route::get('countrycode/{countryCode}', [CountryCodeController::class, 'show']);
Route::put('countrycode/{countryCode}', [CountryCodeController::class, 'update']);
Route::delete('countrycode/{countryCode}', [CountryCodeController::class, 'destroy']);


Route::post('image', [FileUploadController::class, 'uploadImageFile']);
