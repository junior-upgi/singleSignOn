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
Route::get('phpinfo', function () {
    phpinfo();
});
Route::get('error', function() {
    return view('errors.503');
});
Route::get('/', 'LoginController@show');
Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');
Route::get('reset', 'ResetPasswordController@resetPassword');
Route::post('check', 'ResetPasswordController@checkPersonal');
Route::post('set', 'ResetPasswordController@setPassword');

Route::group(['middleware' => 'setting', 'prefix' => 'Authority'], function() {
    Route::get('SideList', 'AuthorityController@sideList');
    Route::get('RoleList', 'AuthorityController@roleList');
    Route::post('SaveData/{table}', 'AuthorityController@saveData');
    Route::get('SideAuth', 'AuthorityController@sideAuth');
    Route::get('RoleAuth', 'AuthorityController@roleAuth');
    Route::post('SaveAuth/{table}', 'AuthorityController@saveAuth');
    Route::get('GetUser', 'AuthorityController@getUser');

    
});
