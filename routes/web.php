<?php

use Illuminate\Support\Facades\Route;

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
    return redirect("/dashboard");
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');



Route::get('/subject', 'SubjectController@index');
Route::get('/outline', 'OutlineController@index');
Route::get('/outline/detail', 'OutlineDetailController@index');
Route::get('/outline/exportPdf', 'OutlineController@exportWord');

Route::get('/preview', 'OutlineController@preview');
Route::get('/elo', 'EloController@index');
Route::get('/setting', 'SettingController@index');
Route::get('/users', 'UserController@index');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/user-info', 'HomeController@userInfo');
Route::post('/user-info', 'HomeController@updateInfomation')->name("update-info");

Route::any('/admin/pages/{id}/build', 'PageBuilderController@build')->name('pagebuilder.build');
Route::any('/admin/pages/build', 'PageBuilderController@build');


Route::any('{uri}', [
    'uses' => 'WebsiteController@uri',
    'as' => 'page',
])->where('uri', '.*');
