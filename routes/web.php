<?php

use App\Http\Controllers\Auth\LoginController;
use App\Notifications\NotificationLaporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
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
    return redirect('/login');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route for General Manager
Route::group(['middleware' => ['auth','RoleLevel:1,2,3,4,5']], function(){
    Route::get('/laporan', 'LaporanController@index')->name('laporan');
});

Route::group(['middleware' => ['auth','RoleLevel:1,2,5']], function(){
    Route::get('/laporan/create', 'LaporanController@create')->name('laporan.create');
    Route::post('/laporan/store', 'LaporanController@store')->name('laporan.store');
    Route::put('/laporan/{id}/update', 'LaporanController@update')->name('laporan.update');
    Route::get('/laporan/{id}/edit', 'LaporanController@edit')->name('laporan.edit');
    Route::get('/laporan/{id}/destroy', 'LaporanController@destroy')->name('laporan.destroy');
});

Route::group(['middleware' => ['auth','RoleLevel:1,2']], function(){
    Route::get('/laporan/{id}/group', 'LaporanController@group')->name('laporan.group');
    Route::put('/laporan/{id}/groupping', 'LaporanController@groupping')->name('laporan.groupping');
});

Route::group(['middleware' => ['auth','RoleLevel:1,2,3,4,5']], function(){
    Route::get('/laporan/{id}/detail', 'LaporanController@show')->name('laporan.show');
});

Route::group(['middleware' => ['auth','RoleLevel:1,3,4']], function(){
    Route::put('/laporan/{id}/confirm', 'LaporanController@setuju')->name('laporan.agree');
});

Route::group(['middleware' => ['auth','RoleLevel:1']], function(){
    Route::get('/user' , 'PenggunaController@index')->name('user.index');
    Route::get('/user/create' , 'PenggunaController@create')->name('user.create');
    Route::post('/user/store' , 'PenggunaController@store')->name('user.store');
    Route::get('/user/{id}/edit' , 'PenggunaController@edit')->name('user.edit');
    Route::put('/user/{id}/update' , 'PenggunaController@update')->name('user.update');
    Route::get('/user/{id}/destroy' , 'PenggunaController@destroy')->name('user.destroy');
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
