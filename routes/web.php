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
//     return view('pages.home',[
//         'user' => "An even cooler way to do the title"
//     ]);
// });

Route::get('/{any}', function () {
    return view('layouts.main');
})->where(['any' => '.*']);


// Route::get('/test','ProductsController@test');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
