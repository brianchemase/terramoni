<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentsController;
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



Route::get('/', [AgentsController::class, 'dashboard'])->name('musicdash');
Route::get('/musiclist', [AgentsController::class, 'tables'])->name('musiclist');
Route::get('/tables', [AgentsController::class, 'tables'])->name('musictable');
Route::get('/blank', [AgentsController::class, 'blank'])->name('blankpage');
Route::get('/forms', [AgentsController::class, 'form'])->name('formpage');

// view available music
Route::get('/ViewUploadedMusic', [AgentsController::class, 'available_music'])->name('availableMusic');

//
// my view agents list
Route::get('/ViewmyagentsList', [AgentsController::class, 'agentstab'])->name('agentstab');
Route::post('/SaveAgent', [AgentsController::class, 'savenewagent'])->name('saveagentdata');// save agent data

// view aggregators list
Route::get('/ViewAggregatorsList', [AgentsController::class, 'aggregatorstab'])->name('aggregatorslist');


// view list of all POS Terminals
Route::get('/POSTerminalList', [AgentsController::class, 'postterminalstab'])->name('posterminalslist');

// upload music attempt
Route::get('/SubmitAttempt', [AgentsController::class, 'upload_attempt'])->name('musicattempt');

// user profile
Route::get('/UserProfile', [AgentsController::class, 'user_profile'])->name('userprofilepage');

// user profile
Route::get('/ViewMusicPage', [AgentsController::class, 'musicpage'])->name('musicpage');
