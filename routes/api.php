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

//--UJIAN : Create
//-----------------------------------------------------------------
Route::post('/create-ujian', [UjianController::class, 'create'])->middleware('auth:sanctum');
Route::post('/create-exam-by-category', [UjianController::class, 'createExamByCategory'])->middleware('auth:sanctum');
Route::get('/get-exam-question-by-category', [UjianController::class, 'getExamQuestionByKategori'])->middleware('auth:sanctum');
Route::get('/get-soal-ujian', [UjianController::class, 'getSoalUjianByKategori'])->middleware('auth:sanctum');
Route::post('/jawab-soal-ujian', [UjianController::class, 'jawabSoalUjian'])->middleware('auth:sanctum');
Route::get('/get-exam-result-by-category', [UjianController::class, 'getExamResultByKategori'])->middleware('auth:sanctum');
Route::get('/get-exam-result', [UjianController::class, 'getExamResult'])->middleware('auth:sanctum');

//--CONTENT
//-----------------------------------------------------------------
Route::apiResource('contents', \App\Http\Controllers\Api\ContentController::class)->middleware('auth:sanctum');

//--MATERI
//-----------------------------------------------------------------
Route::apiResource('materi', \App\Http\Controllers\Api\MateriController::class)->middleware('auth:sanctum');