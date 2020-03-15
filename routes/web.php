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
    return redirect('/images');
});

Route::get('/images', 'ImageController@imageList');
Route::get('/ajax-images', 'ImageController@ajaxImageList');
Route::get('/search-images/{query}', 'ImageController@searchImages');
Route::get('/remove-images/{id}', 'ImageController@removeImage');
Route::post('/images', 'ImageController@imageStore');
//Route::post('/on-up-image/delete','ImageController@fileDestroy');

Route::post('/upload-data', 'ImageController@imageUploadWithTitle');

