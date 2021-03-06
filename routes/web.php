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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/update/{mark}','PublicController@updateOdometer')->name('sharing_url');
Route::post('/update/{mark}','PublicController@saveOdometer')->name('save_odometer');
Route::get('/qr_code/{mark}','PublicController@getQRCode')->name('qr_code');

Route::prefix('driver')->middleware(['web','auth'])->group(function (){
    Route::get('list','DriverController@list')->name('driver_list');
    Route::get('new','DriverController@newDriver')->name('driver_new');
    Route::post('create','DriverController@saveDriver')->name('driver_create');
    Route::get('/{id}/delete','DriverController@removeDriver')->name('driver_delete');
    Route::get('/{id}/edit','DriverController@editDriver')->name('driver_edit');
    Route::post('/{id}/edit','DriverController@updateDriver')->name('driver_update');
});

Route::prefix('user')->middleware(['web','auth'])->group(function (){
    Route::get('list','UserController@list')->name('user_list');
    Route::get('new','UserController@newUser')->name('user_new');
    Route::get('/{id}/edit','UserController@editUser')->name('user_edit');
    Route::get('/{id}/delete','UserController@removeUser')->name('user_delete');
    Route::post('/{id}/edit','UserController@updateUser')->name('user_update');
    Route::post('create','UserController@saveCar')->name('user_create');
});

Route::prefix('car')->middleware(['web','auth'])->group(function (){
    Route::get('list','CarController@list')->name('car_list');
    Route::get('new','CarController@newCar')->name('car_new');
    Route::get('batch_edit','CarController@CarBatchEdit')->name('batch_edit');
    Route::post('batch_save','CarController@saveBatch')->name('batch_save');

    Route::get('new_digger','CarController@newDigger')->name('car_new_digger');
    Route::get('new_roller','CarController@newRoller')->name('car_new_roller');
    Route::get('new_compactor','CarController@newCompactor')->name('car_new_compactor');
    Route::get('/{id}/edit','CarController@editCar')->name('car_edit');
    Route::get('/{plate}/platedit','CarController@editCarByPlate')->name('car_edit_by_plate');
    Route::get('/{id}/detail','CarController@showCar')->name('car_detail');
    Route::get('/{id}/delete','CarController@removeCar')->name('car_delete');
    Route::post('/{id}/edit','CarController@updateCar')->name('car_update');
    Route::post('create','CarController@saveCar')->name('car_create');
    Route::post('/{id}/image/update','CarController@updateAvatar')->name('car_avatar_update');

    Route::get('/history/{car_id}','CarController@history')->name('car_history');
    Route::get('/history_print/{car_id}/{from}/{to}','CarController@history')->name('car_history_print');
});
