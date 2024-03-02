<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EntregaController;

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

Route::apiResource('/deliveries', EntregaController::class);
Route::post('/deliveries', [EntregaController::class, 'filterEntregaByDestinarioCpf']);
Route::get('/delivery/{entrega_id}', [EntregaController::class, 'getEntrega']);
