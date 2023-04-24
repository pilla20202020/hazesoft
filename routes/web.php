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
    return redirect(route('dashboard'));
});

// Route::get('/birthday', [App\Http\Controllers\HomeController::class, 'birthdayNotification'])->name('birthday');

Route::group(['as' => 'user.','namespace' => 'App\Http\Controllers', 'prefix' => 'user',], function () {
    Route::get('forget-password', 'User\UserController@forgetPassword')->name('forgetPassword');
    Route::post('update-password', 'User\UserController@updatePassword')->name('updatePassword');

});

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/dashboard','Dashboard\DashboardController@index')->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | User CRUD
    |--------------------------------------------------------------------------
    |
    */
    Route::resource('user', 'User\UserController');
    Route::get('user-data', 'User\UserController@getAllData')->name('user.data');
    Route::delete('user/{id}/destroy', 'User\UserController@destroy')->name('user.destroy');
    Route::post('userStore', 'User\UserController@userStore')->name('user.userStore');


    /*
    |--------------------------------------------------------------------------
    | State CRUD
    |--------------------------------------------------------------------------
    |
    */
    Route::resource('state', 'State\StateController');
    Route::get('state-data', 'State\StateController@getAllData')->name('state.data');
    Route::delete('state/{id}/destroy', 'State\StateController@destroy')->name('state.destroy');

    /*
    |--------------------------------------------------------------------------
    | District CRUD
    |--------------------------------------------------------------------------
    |
    */
    Route::resource('district', 'District\DistrictController');
    Route::get('district-data', 'District\DistrictController@getAllData')->name('district.data');
    Route::delete('district/{id}/destroy', 'District\DistrictController@destroy')->name('district.destroy');
    Route::post('districtStore', 'District\DistrictController@districtStore')->name('district.districtStore');


    /*
    |--------------------------------------------------------------------------
    | Car CRUD
    |--------------------------------------------------------------------------
    |
    */
    Route::resource('car', 'Car\CarController');
    Route::get('car-data', 'Car\CarController@getAllData')->name('car.data');
    Route::delete('car/{id}/destroy', 'Car\CarController@destroy')->name('car.destroy');


    /*
    |--------------------------------------------------------------------------
    | Car Model CRUD
    |--------------------------------------------------------------------------
    |
    */
    Route::resource('carmodel', 'CarModel\CarModelController');
    Route::get('carmodel-data', 'CarModel\CarModelController@getAllData')->name('carmodel.data');
    Route::delete('carmodel/{id}/destroy', 'CarModel\CarModelController@destroy')->name('carmodel.destroy');
    Route::post('carModelStore', 'CarModel\CarModelController@carModelStore')->name('carmodel.carModelStore');


    /*
    |--------------------------------------------------------------------------
    | Recieve Car CRUD
    |--------------------------------------------------------------------------
    |
    */
    Route::resource('recieve-car', 'RecieveCar\RecieveCarController');
    Route::get('recieve-car-data', 'RecieveCar\RecieveCarController@getAllData')->name('recieve-car.data');
    Route::delete('recieve-car/{id}/destroy', 'RecieveCar\RecieveCarController@destroy')->name('recieve-car.destroy');





});
