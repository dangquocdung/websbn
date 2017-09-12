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
Route::get('/', ['as' => '/', 'uses' => 'FrontController@getHome']);
Route::get('/lich-cong-tac', 'FrontController@lichCongTac');
Route::get('/user/activation/{token}', 'Auth\RegisterController@userActivation');
// Route::get('/gioi-thieu/{id}-{tenkhongdau}', ['as' => 'gioi-thieu', 'uses' => 'FrontController@getGioiThieu']);
// Route::group(['prefix'=>'front'],function(){
//
//   Route::get('/{menutop}/{loaitin}/{id}-{tieudekhongdau}','FrontController@getChiTietTin');
//
//   Route::get('/{menutop}/{id}-{loaitin}','FrontController@getLoaiTin');
//
// });
Route::get('/chuyen-muc/{slug}', 'FrontController@getChuyenMuc');
Route::get('/loai-tin/video', 'FrontController@getVideo');
Route::get('/loai-tin/{slug}', 'FrontController@getLoaiTin');
Route::post('/ket-qua-tim-kiem', 'FrontController@postTimKiem');
Route::get('/chi-tiet-tin/{slug}', 'FrontController@getChiTietTin');
Route::get('/van-ban/{slug}', 'FrontController@getVanBan');
Route::get('/loai-van-ban/{slug}', 'FrontController@getLoaiVanBan');
Route::get('/gop-y', 'GopYController@front_index');
Route::get('/thu-gop-y', 'GopYController@create');
Route::post('/thu-gop-y', 'GopYController@store');
Route::get('/hoi-dap', 'DatCauHoiController@front_index');
Route::get('/dat-cau-hoi', 'DatCauHoiController@create');
Route::post('/dat-cau-hoi', 'DatCauHoiController@store');
// Route::post('/tra-loi-nhanh', 'DatCauHoiController@update');
Auth::routes();
Route::group(['prefix'=>'qtht'],function(){
  Route::resource('/', 'PostController');
  Route::get('/home', 'PostController@index');
  Route::get('/them-tin-bai', 'PostController@create');
  Route::post('/them-tin-bai', 'PostController@store');
  Route::get('/sua-tin-bai/{slug}', 'PostController@edit');
  Route::post('/sua-tin-bai','PostController@update');
  Route::get('/xoa-tin-bai/{id}', 'PostController@destroy');
  Route::get('/chi-tiet-tin/{slug}', 'PostController@show');
  Route::get('/doi-mat-khau', 'PostController@doiMatKhau');
  Route::post('/doi-mat-khau', 'PostController@postDoiMatKhau');
  Route::group(['prefix'=>'menu'],function(){
    Route::resource('/', 'MenuController');
    Route::get('/', 'MenuController@index');
    Route::post('/', 'MenuController@store');
    Route::get('/sua-loai-tin/{slug}', 'MenuController@edit');
    Route::post('/sua-loai-tin','MenuController@update');
    Route::get('/xoa-loai-tin/{id}', 'MenuController@destroy');
  });
  Route::group(['prefix'=>'chuyen-muc'],function(){
    Route::resource('/', 'ChuyenMucController');
    Route::get('/', 'ChuyenMucController@index');
    Route::post('/', 'ChuyenMucController@store');
    Route::get('/sua-chuyen-muc/{slug}', 'ChuyenMucController@edit');
    Route::post('/sua-chuyen-muc','ChuyenMucController@update');
    Route::get('/xoa-chuyen-muc/{id}', 'ChuyenMucController@destroy');
  });
  Route::group(['prefix'=>'hinh-slide'],function(){
    Route::resource('/', 'HinhSlideController');
    Route::get('/', 'HinhSlideController@index');
    Route::post('/', 'HinhSlideController@store');
    Route::get('/sua-hinh-slide/{id}', 'HinhSlideController@edit');
    Route::post('/sua-hinh-slide','HinhSlideController@update');
    Route::get('/xoa-hinh-slide/{id}', 'HinhSlideController@destroy');
  });
  Route::group(['prefix'=>'video-clip'],function(){
    Route::resource('/', 'VideoClipController');
    Route::get('/', 'VideoClipController@index');
    Route::post('/', 'VideoClipController@store');
    Route::get('/sua-video/{id}', 'VideoClipController@edit');
    Route::post('/sua-video','VideoClipController@update');
    Route::get('/xoa-video/{id}', 'VideoClipController@destroy');
  });
  Route::group(['prefix'=>'lich-cong-tac'],function(){
    Route::resource('/', 'LichCongTacController');
    Route::get('/home', 'LichCongTacController@index');
    Route::get('/them-lich-cong-tac', 'LichCongTacController@create');
    Route::post('/them-lich-cong-tac', 'LichCongTacController@store');
    Route::get('/sua-lich-cong-tac/{id}', 'LichCongTacController@edit');
    Route::post('/sua-lich-cong-tac','LichCongTacController@update');
    Route::get('/xoa-lich-cong-tac/{id}', 'LichCongTacController@destroy');
  });
  Route::group(['prefix'=>'van-ban'],function(){
    Route::resource('/', 'VanBanController');
    Route::get('/', 'VanBanController@index');
    Route::post('/', 'VanBanController@store');
    Route::get('/sua-van-ban/{slug}', 'VanBanController@edit');
    Route::post('/sua-van-ban','VanBanController@update');
    Route::get('/xoa-van-ban/{id}', 'VanBanController@destroy');
  });
  Route::group(['prefix'=>'thu-vien-hinh-anh'],function(){
    Route::resource('/', 'UploadsController');
    Route::post('/files-upload', 'UploadsController@multiple_uploads');
    Route::get('/xoa-hinh-anh/{id}','UploadsController@destroy');
  });
  Route::group(['prefix'=>'gop-y'],function(){
    Route::resource('/', 'GopYController');
    Route::get('/', 'GopYController@index');
    Route::post('/', 'GopYController@update');
    Route::get('/xoa/{id}', 'GopYController@destroy');
  });
  Route::group(['prefix'=>'hoi-dap'],function(){
    Route::resource('/', 'DatCauHoiController');
    Route::get('/', 'DatCauHoiController@index');
    Route::post('/', 'DatCauHoiController@update');
    Route::get('/xoa/{id}', 'DatCauHoiController@destroy');
  });
});
