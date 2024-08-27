<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsCategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// User Management 
Route::get('login', [UserController::class, 'UserLogin'])->name('login');
Route::get('register', [UserController::class, 'UserResgister'])->name('register');
Route::get('reset-password', [UserController::class, 'ResetPass'])->name('resetpassword');
Route::get('send-otp', [UserController::class, 'Sendotp'])->name('sentotp');
Route::get('verify-otp', [UserController::class, 'Verifyotp'])->name('verifyotp');

// Actions Methods
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::get('logout', [UserController::class, 'logout']);
Route::post('send-otp', [UserController::class, 'sentotp']);
Route::post('verify-otp', [UserController::class, 'otpverify']);

Route::group(['middleware' => ['user.login']], function () {
    Route::get('/home', [UserController::class, 'home']);
    // User api
    Route::get('user-profile', [UserController::class, 'UserProfileViews']);
    Route::post('reset-password', [UserController::class, 'resetpassword']);
    Route::get('userprofile', [UserController::class, 'UserProfile']);
    Route::post('update-profile', [UserController::class, 'UdateProfile']);
    // Products Category API
    Route::get('/products-category', [ProductsCategoryController::class, 'index']);
    Route::get('/products-category-list', [ProductsCategoryController::class, 'list']);

    Route::post('/products-category-create', [ProductsCategoryController::class, 'create']);
    Route::post('/products-category-delete', [ProductsCategoryController::class, 'delete']);
    Route::post('/category-by-id', [ProductsCategoryController::class, 'categorybyid']);
    Route::post('/products-category-update', [ProductsCategoryController::class, 'update']);

    // Customer API
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::get('/customers-list', [CustomerController::class, 'list']);

    Route::post('/customer-create', [CustomerController::class, 'create']);
    Route::post('/customer-delete', [CustomerController::class, 'delete']);
    Route::post('/customer-by-id', [CustomerController::class, 'customerbyid']);
    Route::post('/customer-update', [CustomerController::class, 'update']);

    // Products API
    Route::get('/products', [ProductController::class, 'ProductsPage']);
    Route::get('/products-list', [ProductController::class, 'ProductsList']);

    Route::post('/products-create', [ProductController::class, 'ProductCreate']);
    Route::post('/products-delete', [ProductController::class, 'DeleteProduct']);
    Route::post('/products-by-id', [ProductController::class, 'ProductsById']);
    Route::post('/products-update', [ProductController::class, 'ProductsUpdate']);
});
