<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UjianController;


//--API
//-----------------------------------------------------------------
// Route::post('/register', \App\Http\Controllers\Api\Auth\RegisterController::class);

//--register:
Route::post('/register', [AuthController::class, 'register']);
//--login:
Route::post('/login', [AuthController::class, 'login']);
//--logout:
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//-----------------------------------------------------------------
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//--AUTH
//-----------------------------------------------------------------
Route::post('update-fcm', [App\Http\Controllers\Api\AuthController::class, 'updateFcmId'])->middleware('auth:sanctum');

//--CATEGORY
//-----------------------------------------------------------------
Route::apiResource('category_api', \App\Http\Controllers\Api\CategoryController::class);//->middleware('auth:sanctum');

//--PRODUCT
//-----------------------------------------------------------------
// Route::apiResource('product', \App\Http\Controllers\Api\ProductController::class);//->middleware('auth:sanctum');
Route::get('product', [App\Http\Controllers\Api\ProductController::class, 'index']);//->middleware('auth:sanctum');

//--WARUNG
//-----------------------------------------------------------------
Route::apiResource('warung', \App\Http\Controllers\Api\WarungController::class);//->middleware('auth:sanctum');

//--ADDRESS
//-----------------------------------------------------------------
Route::get('address-by-user', [App\Http\Controllers\Api\AddressController::class, 'addressByUser'])->middleware('auth:sanctum');
Route::apiResource('address', \App\Http\Controllers\Api\AddressController::class)->middleware('auth:sanctum');
// Route::get('address', [App\Http\Controllers\Api\AddressController::class, 'index']);//->middleware('auth:sanctum');

//--UJIAN : Create
//-----------------------------------------------------------------
Route::post('/create-ujian', [UjianController::class, 'create'])->middleware('auth:sanctum');
Route::post('/create-exam-by-category', [UjianController::class, 'createExamByCategory'])->middleware('auth:sanctum');
Route::get('/get-exam-question-by-category', [UjianController::class, 'getExamQuestionByKategori'])->middleware('auth:sanctum');
Route::get('/get-soal-ujian', [UjianController::class, 'getSoalUjianByKategori'])->middleware('auth:sanctum');
Route::post('/jawab-soal-ujian', [UjianController::class, 'jawabSoalUjian'])->middleware('auth:sanctum');
Route::get('/get-exam-result-by-category', [UjianController::class, 'getExamResultByKategori'])->middleware('auth:sanctum');
Route::get('/get-exam-result', [UjianController::class, 'getExamResult'])->middleware('auth:sanctum');

//--ORDER
//-----------------------------------------------------------------
Route::get('/order/user/{id}', [App\Http\Controllers\Api\OrderController::class, 'getOrdersByUserId'])->middleware('auth:sanctum');
Route::get('/order/{id}', [\App\Http\Controllers\Api\OrderController::class, 'getOrderById'])->middleware('auth:sanctum');
Route::get('/order/status/{id}', [\App\Http\Controllers\Api\OrderController::class, 'checkOrderStatus'])->middleware('auth:sanctum');
Route::post('/make-order', [\App\Http\Controllers\Api\OrderController::class, 'makeOrder'])->middleware('auth:sanctum');

//--CALLBACK
//-----------------------------------------------------------------
Route::post('/callback-order', [\App\Http\Controllers\Api\CallbackController::class, 'callbackOrder']);
// https://9e14-2001-8f8-162d-a8e0-945c-b13f-6155-b77e.ngrok-free.app
