<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route for General Manager
Route::group(['middleware' => ['auth','RoleLevel:General Manager,Admin,Manager Teknik,Pelapor']], function(){
    Route::get('/laporan', 'LaporanController@index')->name('laporan');
});


Route::group(['middleware' => ['auth','RoleLevel:Admin,Manager Teknik,Pelapor']], function(){
    Route::get('/laporan/create', 'LaporanController@create')->name('laporan.create');
    Route::post('/laporan', 'LaporanController@store')->name('laporan.store');
    Route::put('/laporan/{id}/update', 'LaporanController@update')->name('laporan.update');
    Route::get('/laporan/{id}/edit', 'LaporanController@edit')->name('laporan.edit');
    Route::get('/laporan/{id}/detail', 'LaporanController@show')->name('laporan.show');
    Route::delete('/laporan/{id}/destroy', 'LaporanController@destroy')->name('laporan.destroy');
 
});



Route::group(['middleware' => ['auth','RoleLevel:Admin']], function(){
    Route::get('/user' , 'PenggunaController@index')->name('user.index');
    Route::get('/user/create' , 'PenggunaController@create')->name('user.create');
    Route::post('/user/store' , 'PenggunaController@store')->name('user.store');
    Route::get('/user/{id}/edit' , 'PenggunaController@edit')->name('user.edit');
    Route::put('/user/{id}/update' , 'PenggunaController@update')->name('user.update');
    Route::delete('/user/{id}/destroy' , 'PenggunaController@destroy')->name('user.destroy');
});

// Route::group(['middleware' => ['auth','RoleLevel:gm']], function(){

// });

// Route::group(['middleware' => ['auth','RoleLevel:mteknik']], function(){

// });

Route::get('/error' ,'LaporanController@error');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/logout', 'Auth\LoginController@logout')->name('user.logout');

Route::get('/about', function () {
    return view('about');
})->name('about');
