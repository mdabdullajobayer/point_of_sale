<?php

use App\Http\Controllers\UserController;
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
    Route::get('user-profile', [UserController::class, 'UserProfileViews']);

    Route::post('reset-password', [UserController::class, 'resetpassword']);

    Route::get('userprofile', [UserController::class, 'UserProfile']);
    Route::post('update-profile', [UserController::class, 'UdateProfile']);
});
