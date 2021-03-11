<?php

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


Route::group(["prefix"=>"v1/subject"],function(){
    Route::get('/detail', 'Api\SubjectApiController@detail');
    Route::get('/list', 'Api\SubjectApiController@list');
    Route::delete('/delete', 'Api\SubjectApiController@delete');
    Route::post('/create', 'Api\SubjectApiController@create');
    Route::put('/update', 'Api\SubjectApiController@update');
});

Route::group(["prefix"=>"v1/elo"],function(){
    Route::get('/detail', 'Api\EloApiController@detail');
    Route::delete('/delete', 'Api\EloApiController@delete');
    Route::post('/create', 'Api\EloApiController@create');
    Route::put('/update', 'Api\EloApiController@update');
});

Route::group(["prefix"=>"v1/setting"],function(){
    Route::get('/detail', 'Api\SettingApiController@detail');
    Route::put('/update', 'Api\SettingApiController@update');
});

Route::group(["prefix"=>"v1/assign"],function(){
    Route::get('/list', 'Api\AssignmentOutlineApiController@list');
    Route::get('/list/to', 'Api\AssignmentOutlineApiController@listAssign');
    Route::post('/add', 'Api\AssignmentOutlineApiController@add');
    Route::post('/remove', 'Api\AssignmentOutlineApiController@remove');
});

Route::group(["prefix"=>"v1/outline"],function(){
    Route::post('/create', 'Api\OutlineApiController@create');
    Route::post('/updateStatus', 'Api\AssignmentOutlineApiController@updateStatus');
    Route::put('/update', 'Api\OutlineApiController@update');
    Route::delete('/delete', 'Api\OutlineApiController@delete');
    Route::get('/detail', 'Api\OutlineApiController@detail');
    Route::get('/history', 'Api\OutlineApiController@history');
    Route::post('/clone-version', 'Api\OutlineApiController@cloneUpVersion');
    Route::get('/chart', 'Api\OutlineApiController@chart');
});

Route::group(["prefix"=>"v1/outline-detail"],function(){
    Route::get('/detail', 'Api\OutlineDetailApiController@detail');
    Route::put('/update', 'Api\OutlineDetailApiController@update');
});

Route::group(["prefix"=>"v1/user-api"],function(){
    Route::post('/import', 'Api\UserApiController@importUser');
});
