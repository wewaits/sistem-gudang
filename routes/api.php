<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
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
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('barangs', BarangController::class);
    Route::resource('mutasis', MutasiController::class);
    Route::get('mutasis/history/barang/{barangId}', [MutasiController::class, 'historyByBarang']);
    Route::get('mutasis/history/user/{userId}', [MutasiController::class, 'historyByUser']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::get('/public-data', [PublicController::class, 'index']);