<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentsController;
use App\Http\Controllers\AuthOtpController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::controller(AuthOtpController::class)->group(function(){
//     Route::get('/otp/login', 'login')->name('otp.login');
//     Route::any('/otp/generate', 'generate')->name('otp.generate');
//     Route::get('/otp/verification/{user_id}', 'verification')->name('otp.verification');
//     Route::post('/otp/login', 'loginWithOtp')->name('otp.getlogin');
// });

Route::get('/otp/login', [AuthOtpController::class, 'login'])->name('otp.login');
Route::get('/otp/generate', [AuthOtpController::class, 'generate'])->name('otp.generate');
Route::any('/otp/verification/{user_id}', [AuthOtpController::class, 'verification'])->name('otp.verification');
Route::any('/otp/login', [AuthOtpController::class, 'loginWithOtp'])->name('otp.getlogin');
// Route::get('/validateOtp', [AuthOtpController::class, 'validateotp'])->name('validateotp');



Route::get('/', [AgentsController::class, 'dashboard'])->name('musicdash');
//Route::get('/musiclist', [AgentsController::class, 'tables'])->name('musiclist');
Route::get('/tables', [AgentsController::class, 'tables'])->name('musictable');
Route::get('/blank', [AgentsController::class, 'blank'])->name('blankpage');
Route::get('/forms', [AgentsController::class, 'form'])->name('formpage');

Route::get('/Selfcare', [AgentsController::class, 'agentselfregistration'])->name('SelfRegister');


Route::get('send-mail', [AgentsController::class, 'mailtest']);// mail demo
// view available music
Route::get('/ViewUploadedMusic', [AgentsController::class, 'available_music'])->name('availableMusic');

//
// my view agents list
Route::get('/ViewmyagentsList', [AgentsController::class, 'agentstab'])->name('agentstab');
Route::post('/SaveAgent', [AgentsController::class, 'savenewagent'])->name('saveagentdata');// save agent data
//pending agents table
Route::get('/ViewmypendingagentsList', [AgentsController::class, 'compliance_agentstab'])->name('complianceagentstab');

// view aggregators list
Route::get('/ViewAggregatorsList', [AgentsController::class, 'aggregatorstab'])->name('aggregatorslist');


// view list of all POS Terminals
Route::get('/POSTerminalList', [AgentsController::class, 'postterminalstab'])->name('posterminalslist');
Route::get('/RegisterPOSTerminal', [AgentsController::class, 'savepostterminal'])->name('storeposterminal');

// POS Allocation to agents t
Route::get('/AllocationToAgents', [AgentsController::class, 'agentsposallocation'])->name('agentsposallocation');
Route::get('/giveAllocationToAgents', [AgentsController::class, 'agentsposallocation'])->name('assignagentspos');

// user profile
Route::get('/UserProfile', [AgentsController::class, 'user_profile'])->name('userprofilepage');

// user profile
Route::get('/ViewMusicPage', [AgentsController::class, 'musicpage'])->name('musicpage');
