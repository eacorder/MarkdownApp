<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/documents', [DocumentController::class,'index']);
Route::prefix('/document')->group( function () {
        Route::get('/{id}', [DocumentController::class,'edit']);
        Route::post('/store',[DocumentController::class,'store']);
        Route::put('/{id}',[DocumentController::class,'update']);
        Route::delete('/{id}',[DocumentController::class,'destroy']);
    }
);