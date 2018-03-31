<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'HomeController@index');

Route::get('/admin', ['middleware' => ['auth', 'admin'], function() { return "this page requires that you be logged in and an Admin"; }]);


Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/importproduct', 'ProdutController@ProductImportOption');
Route::get('/importdishwasher','ProdutController@ImportDiswashersProduct');
Route::get('/importsmallappliances','ProdutController@importSmallAppliances');
Route::get('/addtowishlist','ProdutController@addtowishlist');

