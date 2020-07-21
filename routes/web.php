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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::view('/', 'home');
Route::view('/{any}', 'home');

Route::get('/test', function () {
    $sheet = \App\Sheet::first();
    $file = $sheet->file;
    $sc = new \App\Http\Controllers\SheetController();

    return $sc->leadStore($file, $sheet->id);
});
