<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('auth.auth-login');
});

// use App\Http\Controllers\AuthController;
 
// Route::get('login', [AuthController::class, 'login']);
// Route::get('register', [AuthController::class, 'reg']);

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.dashboard');
    })->name('home');

    //--Users:
    //-----------------------------------------------------------------
    Route::put('users/profile/{user}', [UserController::class, 'profile'])->name('users.profile');
    Route::get('users/changepass/{user}', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::post('users/changepass/{user}', [UserController::class, 'updatePassword']);
    Route::resource('users', UserController::class);

    //--Category
    //-----------------------------------------------------------------
    Route::group(['namespace' => 'App\Http\Controllers'], function(){
        Route::Resource('/category', CategoryController::class);
    });

    //--Product
    //-----------------------------------------------------------------
    Route::group(['namespace' => 'App\Http\Controllers'], function(){
        Route::Resource('/product', ProductController::class);
    });

    //--Order
    //-----------------------------------------------------------------
    Route::group(['namespace' => 'App\Http\Controllers'], function(){
        Route::Resource('/order', OrderController::class);
    });
});

//--Category
//-----------------------------------------------------------------
// Route::group(['namespace' => 'App\Http\Controllers'], function(){
//     Route::get('category/list', 'CategoryController@list');
//     Route::Resource('/category', CategoryController::class);
// });
