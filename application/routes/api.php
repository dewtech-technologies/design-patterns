<?php

use App\Http\Controllers\File\FileController;
use App\Http\Controllers\Pagamento\PagamentoController;
use App\Http\Controllers\Pedido\PedidoController;
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

Route::prefix('/v1/dewtech')->group(function () {
    Route::post('/pagar', [PagamentoController::class, 'pagar']);
    Route::post('/process-file', [FileController::class, 'processFile']);
    Route::post('/pedido/concluir/{pedidoId}', [PedidoController::class, 'concluir']);
});

