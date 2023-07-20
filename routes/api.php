<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentsController;
use App\Http\Controllers\AirtimeController;
use App\Http\Controllers\BillersController;
use App\Http\Controllers\BillPaymentController;
use App\Http\Controllers\AuthOtpController;

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


//agents auth api

Route::post('/AgentsAuth', [AuthOtpController::class, 'Appauthenticate']);//billers API


Route::post('/BillersList', [BillersController::class, 'billers_data']);//billers API



Route::post('/transactions', [AgentsController::class, 'storeTransaction']);
Route::post('/smstransactions', [AgentsController::class, 'storeSms']);


Route::post('/AirtimeTopup', [AirtimeController::class, 'topup']);

Route::post('/DataTopup', [AirtimeController::class, 'datatopup']);


//bill payments
// pay electricity
Route::post('/PayElectricity', [BillPaymentController::class, 'pay_electricity']);

//list electricity services
Route::get('/PayElectricityList', [BillPaymentController::class, 'getElectricityData']);
