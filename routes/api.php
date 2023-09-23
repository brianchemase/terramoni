<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentsController;
use App\Http\Controllers\AirtimeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillersController;
use App\Http\Controllers\BillPaymentController;
use App\Http\Controllers\AuthOtpController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\NibbsController;
use App\Http\Controllers\CommissionMatrixController;

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

Route::post('/AgentsAuth', [AuthOtpController::class, 'Appauthenticate']);//agents Login API


//agents change pinauth api

Route::post('/AgentsUpdatePin', [AuthOtpController::class, 'agentupdatePin']);//change agent pin

//agents registration api
Route::post('/RegisterAgents', [AuthOtpController::class, 'agentsregister']);//agents Register API


Route::post('/BillersList', [BillersController::class, 'billers_data']);//billers API

//agents registration api
Route::get('/getAgentsTransactions/{agent_id}', [TransactionsController::class, 'transactions']);//agents transactions API
//get agent transactionssammary
Route::get('/getAgentsTransactionsSummary/{agent_id}', [TransactionsController::class, 'eodtransactions']);//agents EOD transactions API

//agents transaction for reprint api
Route::get('/getTransactionReprint/{trans_id}', [TransactionsController::class, 'retrieveTransReprint']);//agents transactions API


Route::post('/transactions', [AgentsController::class, 'storeTransaction']);
Route::post('/smstransactions', [AgentsController::class, 'storeSms']);

//get providers for Airtime
Route::get('/CheckAirtimeProvider/{phone}', [AirtimeController::class, 'getAirtimeProviders']);

Route::post('/AirtimeTopup', [AirtimeController::class, 'topup']);
//get providers for Data
Route::get('/checkDataProvider/{phone}', [AirtimeController::class, 'getDataProviders']);
Route::post('/DataTopup', [AirtimeController::class, 'datatopup']);



//bill payments
// pay electricity
Route::post('/PayElectricity', [BillPaymentController::class, 'pay_electricity']);

//list electricity services
Route::get('/PayElectricityList', [BillPaymentController::class, 'getElectricityData']);

//list TV  services
Route::get('/PayTvList', [BillPaymentController::class, 'gettVData']);

//list product ids
Route::any('/TvproductsLists', [BillPaymentController::class, 'List_TVs_products']);

//list product ids
Route::post('/Tvproducts', [BillPaymentController::class, 'getTvDataListing']);



//pay for TV
Route::post('/PayTvSubscription', [BillPaymentController::class, 'payforTv']);

//Check for Startimes TV meter name
Route::post('/CheckStarTimesTV', [BillPaymentController::class, 'checkStartimesMeter']);


//pay for Startimes TV
Route::post('/PayStarTimesTV', [BillPaymentController::class, 'payforStartimesTv']);


//check for TV aCcount
Route::post('/ConfirmTvAccount', [BillPaymentController::class, 'checkTvAccount']);


//get agents' commission earned
Route::get('/GetAgentsCommission/{agent_id}', [CommissionController::class, 'showCommission']);

//list internet services
Route::get('/InternetServiceList', [BillPaymentController::class, 'getInternetData']);

//get list of products per product id
Route::get('/GetInternetProducts/{product_id}', [BillPaymentController::class, 'internetproductlist']);

//list  services
Route::get('/InternetServiceList', [BillPaymentController::class, 'getInternetData']);

Route::post('/PayInternetBill', [BillPaymentController::class, 'pay_internet']);





//nibs apis
//get institutions
Route::get('/nip/institutions', [NibbsController::class, 'getInstitutions']);

//get balance
Route::post('/nip/getbalance', [NibbsController::class, 'checkbalance']);

// do a fund transfer
Route::post('/nip/TrasfterFund', [NibbsController::class, 'fundstransfer']);

// query the name
Route::post('/nip/NameEnquery', [NibbsController::class, 'nameEnquiry']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});

//Commission Matrix logic
Route::post('/calculate-commission', [CommissionMatrixController::class, 'applyCommissions']);
