<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentsController;
use App\Http\Controllers\AuthOtpController;
use App\Http\Controllers\PosTerminalController;
use App\Http\Controllers\AgentsDashboardController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\TokenUpdateController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ComplianceController;
use App\Http\Controllers\NibbsController;

use App\Http\Controllers\CommissionController;
use App\Http\Controllers\CommissionMatrixController;

use App\Http\Controllers\AggregatorsController;
use App\Http\Controllers\RoleBasedAccessController;


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

Route::get('/', function () {
    return view('welcome');
});

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

Route::get('/AgentTab', [AgentsController::class, 'agentselection'])->name('SelfRegisterLanding');

Route::get('/UpdateToken', [TokenUpdateController::class, 'generatenewtoken'])->name('newtoken');// prime airtime token
Route::get('/UpdateQoreIdToken', [TokenUpdateController::class, 'generatenewqoreidtoken'])->name('newqoreidtoken');//qoreid token
Route::get('/UpdateNibbsToken', [TokenUpdateController::class, 'generatenibstoken'])->name('newnibstoken');//nibs token

Route::get('/getNibbsToken', [NibbsController::class, 'nibstoken']);//nibs token


Route::get('/Selfcare', [AgentsController::class, 'agentselfregistration'])->name('SelfRegister');
Route::post('/RegisterSelfagents', [AgentsController::class, 'storeselfregagent'])->name('agentsselfregister');


Route::get('/CompSelfcare', [AgentsController::class, 'merchantagentselfregistration'])->name('CompSelfRegister');
Route::post('/RegisterSelfCompanyAgent', [AgentsController::class, 'storecompanyselfreg'])->name('compagentsselfregister');

Route::post('/ChangePasswordFunction', [ChangePasswordController::class, 'changePassword'])->name('change.password');

Auth::routes();
Route::middleware(['auth'])->group(function()
 {
    Route::group(['prefix' => 'admins'], function() {
    //Route::group(['prefix' => 'admins'], function() {

    Route::get('/', [AgentsController::class, 'dashboard'])->name('admindash')->middleware('permission:view-admin-dashboard');
    Route::get('/tables', [AgentsController::class, 'tables'])->name('musictable');
    Route::get('/blank', [AgentsController::class, 'blank'])->name('blankpage');
    Route::get('/forms', [AgentsController::class, 'form'])->name('formpage');


    Route::get('send-mail', [AgentsController::class, 'mailtest']);// mail demo
    // view available music
    Route::get('/ViewUploadedMusic', [AgentsController::class, 'available_music'])->name('availableMusic');

    //
    // my view agents list
    Route::get('/ViewmyagentsList', [AgentsController::class, 'agentstab'])->name('agentstab')->middleware('permission:admin-view-agents-dashboard');
    Route::post('/SaveAgent', [AgentsController::class, 'savenewagent'])->name('saveagentdata')->middleware('permission:admin-create-agent');// save agent data
    Route::get('/agent/UpdateAgent/{agent_id}', [AgentsController::class, 'edit_agent'])->name('agentedit')->middleware('permission:admin-edit-agent');
    Route::put('/agent/{agent_id}', [AgentsController::class, 'update_agent'])->name('update_agent')->middleware('permission:admin-update-agent');//up
    Route::any('/Suspendagent/{agent_id}', [AgentsController::class, 'suspend_agent'])->name('suspend_agent')->middleware('permission:admin-suspend-agent');//suspend agent
    Route::any('/rejectagent/{agent_id}', [AgentsController::class, 'reject_agent'])->name('reject_agent')->middleware('permission:admin-reject-agent');//reject agent
    Route::get('/ViewmyagentsList', [AgentsController::class, 'agentstab'])->name('agentstab');
    Route::post('/SaveAgent', [AgentsController::class, 'savenewagent'])->name('saveagentdata');// save agent data
    Route::get('/agent/UpdateAgent/{agent_id}', [AgentsController::class, 'edit_agent'])->name('agentedit');
    Route::put('/agent/{agent_id}', [AgentsController::class, 'update_agent'])->name('update_agent');//up
    Route::any('/Suspendagent/{agent_id}', [AgentsController::class, 'suspend_agent'])->name('suspend_agent');//suspend agent
    Route::any('/rejectagent/{agent_id}', [AgentsController::class, 'reject_agent'])->name('reject_agent');//reject agent
    Route::any('/Escalateagent/{agent_id}', [AgentsController::class, 'escalate_agent'])->name('escalate_agent');//escalate agent


    //pending agents table
    Route::get('/ViewmypendingagentsList', [AgentsController::class, 'compliance_agentstab'])->name('complianceagentstab')->middleware('permission:admin-view-pending-agents');

    //pending aggregators table
    Route::get('/ViewmypendingaggregatorsList', [AgentsController::class, 'compliance_aggregatorstab'])->name('complianceaggregatorsstab')->middleware('permission:admin-view-pending-aggregators');
    // kyc form
    Route::get('/KYCagents', [AgentsController::class, 'complianceform'])->name('complianceformpage')->middleware('permission:admin-view-agents-kyc');

   // Route::get('/KYCagentscompliance/{id}', [AgentsController::class, 'complianceformcheck'])->name('complianceagentformpage');
    Route::get('/KYCagentscompliance/{id}', [ComplianceController::class, 'queryIdentity'])->name('complianceagentformpage')->middleware('permission:admin-edit-agents-kyc');
    Route::post('/agentapprovalcompliance', [AgentsController::class, 'approveagent'])->name('approveagent')->middleware('permission:admin-approve-agents');

    // view aggregators list
    Route::get('/ViewAggregatorsList', [AgentsController::class, 'aggregatorstab'])->name('aggregatorslist')->middleware('permission:admin-view-aggregators');


    // view list of all POS Terminals
    Route::get('/POSTerminalList', [AgentsController::class, 'postterminalstab'])->name('posterminalslist');
    Route::get('/RegisterPOSTerminal', [AgentsController::class, 'savepostterminal'])->name('storeposterminal');
    Route::post('/savePOS', [AgentsController::class, 'savePosData'])->name('saveposdata');// save pos data


    Route::get('/ViewAgentPOS/{id}', [AgentsController::class, 'allocatedPOS'])->name('allocatedpos');

    // import terminals
    Route::post('/import-terminals', [PosTerminalController::class, 'import'])->name('import.terminals')->middleware('permission:admin-import-pos-terminal');// save pos data

    // POS Allocation to agents t
    Route::get('/AllocationToAgents', [AgentsController::class, 'agentsposallocation'])->name('agentsposallocation')->middleware('permission:admin-pos-terminal-allocation');
    Route::get('/giveAllocationToAgents', [AgentsController::class, 'updateagentposallocation'])->name('assignagentspos')->middleware('permission:admin-update-pos-terminal-allocation');

    // user profile
    Route::get('/UserProfile', [AgentsController::class, 'user_profile'])->name('userprofilepage')->middleware('permission:admin-user-profile');

    // user change password
    Route::get('/ChangeAdminPass', [AgentsController::class, 'ChangeAdminPass'])->name('changepasspage')->middleware('permission:admin-change-password');

    Route::get('/TransactionTable', [TransactionsController::class, 'getTransactions'])->name('primetransactions')->middleware('permission:admin-get-transactions');
    Route::get('/TransactionData/{trans_id}', [TransactionsController::class, 'retreiveTrans'])->name('retreiveTrans')->middleware('permission:admin-retrieve-transactions');

    // agent transaction history
    Route::get('/AgentTransaction/{id}', [TransactionsController::class, 'agentTransactions'])->name('agenttrans')->middleware('permission:admin-agent-transactions-history');

    // full transaction history
    Route::get('/TotalTransaction', [TransactionsController::class, 'FullTransactions'])->name('totaltrans')->middleware('permission:admin-transactions-history');

    // user profile
    Route::get('/ViewMusicPage', [AgentsController::class, 'musicpage'])->name('musicpage');


     // user profile
     Route::get('/UsersManagement', [UsersController::class, 'userslist'])->name('AllUsers');
     Route::post('/register-user', [UsersController::class, 'registerUser'])->name('register_user');
     Route::post('/update-user', [UsersController::class, 'updateUser'])->name('update_user');
    
     Route::any('/users/{user}/change-password', [UsersController::class, 'changePassword'])->name('change_password');
     
     Route::get('/UsersManagement', [UsersController::class, 'userslist'])->name('AllUsers')->middleware('permission:admin-user-profile');
        // permissions matrix
     Route::get('/PermissionsMatrix', [AgentsController::class, 'permissions'])->name('permissionsmatrix');


     //Role based management
     Route::get('/roles', [RoleBasedAccessController::class, 'getAllRoles'])->name('AllRoles')->middleware('permission:admin-view-roles');
     Route::post('/create-role', [RoleBasedAccessController::class, 'createRole'])->name('CreateRole')->middleware('permission:admin-create-role');
     Route::get('/permissions', [RoleBasedAccessController::class, 'getAllPermissions'])->name('AllPermissions')->middleware('permission:admin-view-permissions');
     Route::post('/create-permission', [RoleBasedAccessController::class, 'createPermission'])->name('CreatePermission')->middleware('permission:admin-create-permission');
     Route::get('/roles-permissions', [RoleBasedAccessController::class, 'getAssignableRole'])->name('AssignRole');//
     Route::post('/get-permissions-role/{id}', [RoleBasedAccessController::class, 'getAssignablePermissions'])->name('AssignPermissionsToRolesTest');
     Route::post('/assign-permissions-role', [RoleBasedAccessController::class, 'AssignPermissionsToRoles'])->name('AssignPermissionsToRoles');

     //Commissions
     Route::get('/Commissions', [CommissionController::class, 'manageCommissions'])->name('allcommissions');


     //Commission Matrix
     Route::get('/commissionmatrix', [CommissionMatrixController::class, 'index'])->name('commissionmatrix')->middleware('permission:admin-view-commission-matrix');
     Route::get('/commissionmatrix/create', [CommissionMatrixController::class, 'create'])->name('agents.modals.create')->middleware('permission:admin-create-commission-matrix');
     Route::post('/commissionmatrix', [CommissionMatrixController::class, 'store'])->name('commissionmatrix.store')->middleware('permission:admin-view-commission-matrix');
     Route::get('/commissionmatrix/{id}/edit', [CommissionMatrixController::class, 'edit'])->name('commissionmatrix.edit')->middleware('permission:admin-edit-commission-matrix');
     Route::post('/commissionmatrix/{id}', [CommissionMatrixController::class, 'update'])->name('commissionmatrix.update')->middleware('permission:admin-update-commission-matrix');
     Route::delete('/commissionmatrix/{id}', [CommissionMatrixController::class, 'destroy'])->name('commissionmatrix.destroy')->middleware('permission:admin-delete-commission-matrix');
     



    });

}); // end of auth

Auth::routes();

Route::middleware(['auth'])->group(function()
 {

    Route::group(['prefix' => 'agents'], function() {

        Route::get('/', [AgentsDashboardController::class, 'dashboard'])->name('agentsdash')->middleware('permission:view-agents-dashboard');
        Route::get('/tables', [AgentsDashboardController::class, 'tables'])->name('agentsmusictable');
        Route::get('/blank', [AgentsDashboardController::class, 'blank'])->name('agentsblankpage');
        Route::get('/forms', [AgentsDashboardController::class, 'form'])->name('agentsformpage');

         // view list of all POS Terminals
        Route::get('/POSTerminalList', [AgentsDashboardController::class, 'allocatedterminals'])->name('allocatedterminals');

         // user change password
         Route::get('/ChangeAgentPass', [AgentsController::class, 'ChangeAgentPass'])->name('Agentchangepasspage');


    });

});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
