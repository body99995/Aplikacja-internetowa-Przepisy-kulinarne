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

Route::get('/', function () {
    return view('welcome');
});


//Route::get('/console', 'SitesController@index');

Route::get('/console', [
    'uses' => 'SitesController@index',
    'as' => 'sites.console'
]);

Route::get('/search', 'SitesController@search');

Route::get('/add', 'SitesController@add');

Route::get('/raport', 'SitesController@raport');

/*Route::post('/save', [
    'uses' => 'SitesController@save',  //nazwa kontroloera który ma być uzyty do uruchomienia zasobu
    'as' => 'sites.save'  //identyfikator żeby odwołać się do routingu i wygenerowania URL
]);*/


Route::post('save','SitesController@save');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/console/{site}', [
    'uses' => 'SitesController@show',
    'as' => 'sites.show'  //identyfikator żeby odwołać się do routingu i wygenerowania URL
]);

Route::get('/console/edit/{site}', [
    'uses' => 'SitesController@edit',
    'as' => 'sites.edit'  //identyfikator żeby odwołać się do routingu i wygenerowania URL
]);

Route::put('/console/{site}', [
    'uses' => 'SitesController@update',
    'as' => 'sites.update'  //identyfikator żeby odwołać się do routingu i wygenerowania URL
]);

Route::delete('/console/{site}', [
    'uses' => 'SitesController@destroy',
    'as' => 'sites.delete'  //identyfikator żeby odwołać się do routingu i wygenerowania URL
]);
