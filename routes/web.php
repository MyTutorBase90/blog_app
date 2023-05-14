<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\BlogController;

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

Route::prefix('category')->group(function(){
    Route::get('/json_index', [CategoryController::class, 'json_index']);
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/store', [CategoryController::class, 'store']);
    Route::get('/{slug}/edit', [CategoryController::class, 'edit']);
    Route::post('/{slug}/update', [CategoryController::class, 'update']);
    Route::delete('/{slug}/delete', [CategoryController::class, 'delete']);
});

Route::prefix('tag')->group(function(){
    Route::get('/json_index', [TagController::class, 'json_index']);
    Route::get('/', [TagController::class, 'index']);
    Route::post('/store', [TagController::class, 'store']);
    Route::get('/{slug}/edit', [TagController::class, 'edit']);
    Route::post('/{slug}/update', [TagController::class, 'update']);
    Route::delete('/{slug}/delete', [TagController::class, 'delete']);
});

Route::prefix('blog')->group(function(){
    Route::get('/json_index', [BlogController::class, 'json_index']);
    Route::get('/', [BlogController::class, 'index']);
    Route::get('/create', [BlogController::class, 'create']);
    Route::post('/store', [BlogController::class, 'store']);
    Route::get('/{slug}/detail', [BlogController::class, 'detail']);
    Route::get('/{slug}/edit', [BlogController::class, 'edit']);
    Route::post('/{slug}/update', [BlogController::class, 'update']);
    Route::delete('/{slug}/delete', [BlogController::class, 'delete']);
});
