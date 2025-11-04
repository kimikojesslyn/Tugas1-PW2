<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PenulisController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/penulis', [PenulisController::class, 'index']);
Route::get('/blog', [BlogController::class, 'index']);

Route::post('/penulis', [PenulisController::class, 'store']);
Route::post('/blog', [BlogController::class, 'store']);

Route::patch('/penulis/{id}', [PenulisController::class, 'update']);
Route::patch('/blog/{id}', [BlogController::class, 'update']);

Route::delete('/penulis/{id}', [PenulisController::class, 'destroy']);
Route::delete('/blog/{id}', [BlogController::class, 'destroy']);

// Route::post('/penulis', [PenulisController::class,'store'])->middleware('auth:sanctum');
// Route::post('/blog', [BlogController::class,'store'])->middleware('auth:sanctum');;

// Route::patch('/penulis/{id}', [PenulisController::class,'update'])->middleware('auth:sanctum');;
// Route::patch('/blog/{id}', [BlogController::class,'update'])->middleware('auth:sanctum');;

// Route::delete('/penulis/{id}', [PenulisController::class,'destroy'])->middleware('auth:sanctum');;
// Route::delete('/blog/{id}', [BlogController::class,'destroy'])->middleware('auth:sanctum');;

Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);