<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeGroupController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountryCodeController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PartnershipProposalController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\TariffController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\UserController;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
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
Route::get('attribute-groups', [AttributeGroupController::class, 'index']);
Route::get('attributes', [AttributeController::class, 'index']);
Route::post('image/{dir}', [UploadFileController::class, 'uploadImageFile']);
Route::apiResource('shops', ShopController::class)->middleware('auth', ['except' => ['index', 'show']]);
Route::apiResource('products', ProductController::class);
Route::apiResource('categories', CategoryController::class, ['except' => ['store', 'update', 'destroy']]);
Route::get('categories/subcategories/{id}', [CategoryController::class, 'subcategories']);
Route::get("get-products-by-id", [ProductController::class, "getProductsById"]);
Route::get('posts', [PostController::class, 'index']);
Route::get('posts/{slug}', [PostController::class, 'show']);
Route::get('about', [PostController::class, 'about']);
Route::get('faqs', [FaqController::class, 'index']);
Route::get('colors', [ColorController::class, 'index']);
Route::get('sizes', [SizeController::class, 'index']);

Route::group(['middleware' => ['api', 'auth'], 'prefix' => 'dashboard'], function ($router) {
    Route::apiResource('countrycode', CountryCodeController::class,);
    Route::apiResource('users', UserController::class);
    Route::apiResource('attribute-groups', AttributeGroupController::class);
    Route::apiResource('attributes', AttributeController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('partnership-proposals', PartnershipProposalController::class);
    Route::apiResource('posts', PostController::class);
    Route::apiResource('faqs', FaqController::class);
    Route::apiResource('tariffs', TariffController::class);
    Route::apiResource('deliveries', DeliveryController::class);
    Route::apiResource('shops', ShopController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('colors', ColorController::class);
    Route::apiResource('sizes', SizeController::class);
});

Route::group(['middleware' => ['api', 'auth'], 'prefix' => 'profile'], function ($router) {
    Route::get('/', [ProfileController::class, 'show']);
    Route::put('/update', [ProfileController::class, 'update']);
    Route::delete('/delete', [ProfileController::class, 'delete']);
    Route::get('/get-user-shops', [ShopController::class, 'getUserShops']);
    Route::get('/get-products/{shop}', [ProductController::class, 'getProductsWithShop']);
    Route::apiResource('partnership-proposal', PartnershipProposalController::class,[
        'except' => ['index']
    ]);
    Route::apiResource('posts', PostController::class);
    Route::apiResource('faqs', FaqController::class);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/my', [OrderController::class, 'myOrders']);
});

Route::get('tariffs', [TariffController::class, 'index']);
Route::get('deliveries', [DeliveryController::class, 'index']);
Route::apiResource('orders', OrderController::class)->except('index', 'destroy', 'update');
Route::post('orders/confirm_code', [OrderController::class, 'sendConfirmCode']);
Route::post('orders/confirm_order', [OrderController::class, 'confirmOrder']);
