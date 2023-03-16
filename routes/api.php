<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Rutas para autenticacion
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [App\Http\Controllers\AuthController::class,'login']);
    Route::post('logout', [App\Http\Controllers\AuthController::class,'logout']);
    Route::post('refresh', [App\Http\Controllers\AuthController::class,'refresh']);
    Route::post('me', [App\Http\Controllers\AuthController::class,'me']);
    Route::post('register', [App\Http\Controllers\AuthController::class,'register']);
});

//Ruta de redireccion
Route::get('login',function(){
    return response()->json(['error' => 'Unauthorized'], 403);
})->name('login');

//Rutas Clientes
Route::get('cliente',[App\Http\Controllers\ClienteController::class,'index']);
Route::post('cliente',[App\Http\Controllers\ClienteController::class,'store']);
Route::patch('cliente/{id}',[App\Http\Controllers\ClienteController::class,'update']);
Route::delete('cliente/{id}',[App\Http\Controllers\ClienteController::class,'destroy']);




