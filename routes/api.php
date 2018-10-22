<?php

use Illuminate\Http\Request;

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

//products
Route::group(['prefix'=>'product'],function(){
     Route::get('/','ProductsController@index')->name('products');
     Route::get('/{id}','ProductsController@show')->name('products.show');
     
});
//donhang
Route::group(['prefix'=>'donhang'],function(){
    Route::post('/add-donhang','DonhangsController@store')->name('donhangs.add');
    Route::post('/magiamgia','DonhangsController@magiamgia')->name('donhangs.magiamgia');
    Route::post('/chitiet','DonhangsController@chitietdonhang')->name('donhangs.chitiet');
    Route::post('/listsdonhang','DonhangsController@listsdonhang')->name('donhangs.listsdonhang');
    Route::get('/test','DonhangsController@kiemtra');
});



Route::post('auth/login', 'AuthController@login');
Route::post('auth/register', 'AuthController@register');
Route::group(['middleware' => 'jwt.auth'], function(){
  Route::get('auth/user', 'AuthController@user');
  Route::post('auth/logout', 'AuthController@logout');
  Route::get('auth/chuoi','AuthController@test');
});
Route::group(['middleware' => 'jwt.refresh'], function(){
  Route::get('auth/refresh', 'AuthController@refresh');
});


