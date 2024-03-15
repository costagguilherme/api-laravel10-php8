<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix' => 'otp'], function () {
    Route::post('', [OtpController::class, 'store']);
    Route::post('login', [OtpController::class, 'login'])->middleware('otp:login');

});

Route::apiResource('/users', UserController::class);


Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'posts'], function () {
        Route::get('', [PostController::class, 'index']);
        Route::get('/{id}', [PostController::class, 'show']);
        Route::post('', [PostController::class, 'store']);
        Route::put('/{id}', [PostController::class, 'update']);
        Route::delete('/{id}', [PostController::class, 'destroy']);
    });

    Route::group(['prefix' => 'comments'], function () {
        Route::get('', [CommentController::class, 'index']);
        Route::post('', [CommentController::class, 'store']);
    });
});

