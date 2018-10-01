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


Route::prefix('car')->middleware(['web','auth'])->group(function (){
    Route::get('list','CarController@list')->name('car_list');
    Route::get('new','CarController@newCar')->name('car_new');
    Route::get('/{id}/edit','CarController@editCar')->name('car_edit');
    Route::get('/{plate}/platedit','CarController@editCarByPlate')->name('car_edit_by_plate');
    Route::get('/{id}/detail','CarController@showCar')->name('car_detail');
    Route::get('/{id}/delete','CarController@removeCar')->name('car_delete');
    Route::post('/{id}/edit','CarController@updateCar')->name('car_update');
    Route::post('create','CarController@saveCar')->name('car_create');

});
