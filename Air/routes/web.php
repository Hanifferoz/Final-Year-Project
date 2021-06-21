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
    return view('welcome');
});
Route::get('/predict','PredictCont@predict');
Route::post('/predict','PredictCont@test');


Auth::routes(['register'=>false]);

Route::group(['middleware' => ['web','auth']], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::prefix('airport')->group(function () {
        Route::get('/','AirportController@index');
        Route::get('/add','AirportController@create');
        Route::post('/add','AirportController@store');
        Route::get('/edit/{id}','AirportController@edit');
        Route::get('/view/{id}','AirportController@show');
        Route::post('/edit/{id}','AirportController@update');
        Route::get('/delete/{id}','AirportController@destroy');
    });
    Route::prefix('flightgroup')->group(function () {
        Route::get('/','FlightGroupController@index');
        Route::get('/add','FlightGroupController@create');
        Route::post('/add','FlightGroupController@store');
        Route::get('/edit/{id}','FlightGroupController@edit');
        // Route::get('/view/{id}','FlightGroupController@show');
        Route::post('/edit/{id}','FlightGroupController@update');
        Route::get('/delete/{id}','FlightGroupController@destroy');
    });
    Route::prefix('fleet')->group(function () {
        Route::get('/','FleetController@index');
        Route::get('/add','FleetController@create');
        Route::post('/add','FleetController@store');
        Route::get('/edit/{id}','FleetController@edit');
        Route::get('/view/{id}','FleetController@show');
        Route::post('/edit/{id}','FleetController@update');
        Route::get('/delete/{id}','FleetController@destroy');
    });
    Route::prefix('routes')->group(function () {
        Route::get('/','RoutesController@index');
        Route::get('/add','RoutesController@create');
        Route::post('/add','RoutesController@store');
        Route::get('/edit/{id}','RoutesController@edit');
        Route::get('/view/{id}','RoutesController@show');
        Route::post('/edit/{id}','RoutesController@update');
        Route::get('/delete/{id}','RoutesController@destroy');
    });

    Route::prefix('schedules')->group(function () {
        Route::get('/','SchedulesController@index');
        Route::get('/add','SchedulesController@create');
        Route::post('/add','SchedulesController@store');
        Route::get('/edit/{id}','SchedulesController@edit');
        Route::get('/view/{id}','SchedulesController@show');
        Route::post('/edit/{id}','SchedulesController@update');
        Route::get('/delete/{id}','SchedulesController@destroy');
    });
});
