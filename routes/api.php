<?php

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

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

Route::get('/user', function (Request $request) {
    return new UserResource($request->user()->load(['roles', 'statuses']));
});
Route::group(['prefix' => '/admin'], function () {
    Route::get('/wallet-histories', 'TransactionHistoriesController@forAdmin');
    Route::get('/transaction-histories', 'PaymentsController@forAdmin');
    Route::get('/transaction-histories/pending-withdrawal', 'TransactionHistoriesController@forAdminPendingWithdrawal');
    Route::post('/process-withdraw', 'WithdrawProcessingController@process');
});
Route::get('getCountries', 'DataController@getCountries');
Route::get('getPackages', 'PackagesController@index');
Route::get('devices', 'DataController@getDevices');
Route::get('get-systems', 'SystemsController@index');

Route::get('/wallet', 'WalletsController@index');
Route::get('/transaction-histories', 'TransactionHistoriesController@index');
Route::get('/transaction-histories/pending-withdrawal', 'TransactionHistoriesController@pendingWithdrawal');
/** Tester test route */
Route::get('tester/user/{id}', 'TestController@testUser'); // fetch user relational data require for giving test
Route::post('tester/update-test-status/{id}', 'TestController@updateTestStatus');
Route::get('tester/test-project-accepted', 'TestController@isTestProjectAccepted');
Route::get('tester/dashboard/{id}', 'TestersController@dashboard');
Route::resource('tester', 'TestersController')->only(['store', 'update', 'destroy', 'index', 'show']);
Route::get('getProfile', 'UsersController@show');
Route::post('unique-user', 'UsersController@uniqueUser');
Route::resource('publisher', 'PublishersController')->only(['store', 'update', 'destroy', 'index', 'show']);
Route::get('publisher-projects', 'ProjectsController@publisherProjects');
Route::resource('device', 'DevicesController')->only(['store', 'update', 'destroy', 'index', 'show']);
Route::resource('systems', 'SystemsController')->only(['store', 'update', 'destroy', 'index', 'show']);

Route::resource('project-type', 'ProjectTypeController')->only(['store', 'update', 'destroy', 'index', 'show']);
Route::get('project-types', 'DataController@getProjectTypes');
Route::resource('projects', 'ProjectsController')->only(['store', 'update', 'destroy', 'index', 'show']);
Route::get('moderate-projects', 'TestController@moderateProjects');
Route::get('test-status/{id}', 'TestController@testStatus');
Route::post('test/{id}/status', 'TestController@changeTestStatus');
Route::resource('projects.invoice', 'InvoiceController', ['only' => ['index']]);
Route::get('/payments', 'PaymentsController@index');
Route::post('invoices/{id}/pay', 'PaymentsController@store');
Route::post('invoices/{id}/paid', 'PaymentsController@invoicePaid');
Route::get('paypal-config', 'PaymentsController@paypalConfig');
Route::get('tester-projects', 'ProjectsController@testerProjects'); // All Projects of that tester
Route::get('project-tester/{projectTesterId}', 'TestersController@project');// Particular Project of tester
// when admin/publisher give rating to the tester
Route::post('projects/{id}/rating/{testerId}', 'ProjectRatingsController@tester');
// when tester give rating to the project
Route::post('tester/{id}/rating/{projectId}', 'TesterRatingsController@project');
Route::get('projects/{id}/ratings/{testerId}', 'TesterRatingsController@testerRatingsForProject');
Route::get('projects/{id}/testing-inputs/{testerId}', 'TesterRatingsController@testerInputsForProject');
Route::get('projects/{id}/rated', 'ProjectRatingsController@ratedTesters');
Route::get('projects/{id}/paid', 'TesterEarningsController@forProjects');
Route::resource('tester-earnings', 'TesterEarningsController', ['only' => 'store']);
Route::resource('/withdraw', 'WithdrawalsController', ['only' => 'store']);
Route::resource('/packages', 'PackagesController', ['only' => ['store', 'update', 'destroy', 'index', 'show']]);
Route::resource('/payment-methods', 'PaymentMethodsController', ['only' => ['store', 'update', 'destroy', 'index', 'show']]);
Route::post('/project-cost', 'ProjectCostController@calculate');
Route::resource('projects.testers.attachments', 'TesterAttachmentController', ['only' => ['store', 'destroy', 'index']]);
Route::get('publisher-projects/activity', 'ProjectsController@activitiesLog');