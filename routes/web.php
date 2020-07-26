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

Route::get('/', 'BbsController@getArticleList');

Route::post('/', 'BbsController@registerArticle');

Route::get('/edit/{id}', 'BbsController@getArticleEdit');

Route::post('/update', 'BbsController@updateArticle');

Route::get('/delete/confirm/{id}', 'BbsController@getDeleteConfirm');

Route::post('/delete', 'BbsController@deleteArticle');