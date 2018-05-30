<?php

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

// Route::get('/admin/{vue_capture?}', function () {
//     return view('welcome');
// })->where('vue_capture', '[\/\w\.-]*');
Route::get('/', function() {
    return '<h1>Comming Soon</h1>';
});
Route::group(['prefix' => 'site'], function() {
    Route::get('/', 'FrontController@index')->name('home');
    Route::get('/pricing', 'FrontController@pricing')->name('pricing');
    Route::get('/become-a-tester', 'FrontController@becomeTester')->name('becomeTester');
});
Route::post('/login', 'Auth\LoginController@attemptLogin')->name('authenticate');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/resend-activation-email', 'Auth\RegisterController@resendActivation')->name('resendActivationEmail');
Route::get('/portal/{vue_capture?}', function () {
    return view('spa');
})->where('vue_capture', '[\/\w\.-]*');
Route::get('systems', 'Api\SystemsController@index');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');