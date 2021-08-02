<?php

use App\Http\Controllers\BalanceController;
use App\Services\JsonRpcServer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Роут для всех апи JSON-RPC
Route::post('/data', function (Request $request, JsonRpcServer $server) {
    return $server->handle($request);
});
