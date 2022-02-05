<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FojingsController;
use App\Http\Controllers\LoginSessionController;
use App\Http\Controllers\Auth\LoginSMSController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/albums/{category_id}/{page?}', [AlbumsController::class, 'index']);
Route::get('/album/{album}', [AlbumsController::class, 'show']);
Route::get('/fojing/{fojing}', [FojingsController::class, 'show']);
Route::post('/sendsms', [LoginSMSController::class, 'create']);

Route::post('/login', [LoginSessionController::class, 'store']);

Route::post('/search', [SearchController::class, 'index']);
