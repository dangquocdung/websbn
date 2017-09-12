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



Route::get('/home', 'AdminController@getAdminHome');



Route::group(['prefix'=>'test'],function(){

  Route::get('/home', 'AdminController@getAdminHome');

  Route::get('/them', 'AdminController@getAdminHome');


  Route::get('/tin-bai/them/{idlt}', 'AdminController@getThemTinBai');

  Route::post('/tin-bai/them/{idlt}', 'AdminController@postThemTinBai');

  Route::get('/tin-bai/sua/{id}', 'AdminController@getSuaTinBai');
  Route::put('/tin-bai/sua/{id}', 'AdminController@putTinBai');

  Route::delete('/tin-bai/xoa/{id}', 'AdminController@deleteTinBai');


  Route::get('/tin-bai/loai-tin/danh-sach/{idlt}', 'AdminController@getDanhSachTinTheoLoai');


  Route::get('/{idmt}/danh-sach-loai-tin', 'AdminController@getLoaiTinTheoMenuTop');


});

Route::group(['prefix'=>'test','middleware'=>'adminLogin'],function(){


  Route::post('/them-Menu', 'AdminController@postThemMenu');
  Route::delete('/xoa-Menu/{id}', 'AdminController@deleteMenuTop');

  Route::get('/danh-sach-banner', 'AdminController@getBannerTop');

  Route::post('/them-banner', 'AdminController@postThemBannerTop');
  Route::delete('/xoa-banner/{id}', 'AdminController@deleteBannerTop');

  Route::post('/them-loai-tin', 'AdminController@postThemLoaiTin');

  Route::get('/danh-sach-menu', 'AdminController@getMenuTop');

});
