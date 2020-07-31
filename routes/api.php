<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('sheet', 'SheetController')->except('show', 'edit', 'update');
Route::resource('lead', 'LeadController')->except('show', 'edit', 'update', 'store', 'destroy');
Route::post('lead/search', 'LeadController@search');
Route::post('lead/csv', 'LeadController@csvDownload');
