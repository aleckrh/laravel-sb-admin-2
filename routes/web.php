<?php

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

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/laporan', 'LaporanController@index')->name('laporan');
Route::get('/laporan/create', 'LaporanController@create')->name('laporan.create');
Route::post('/laporan', 'LaporanController@store')->name('laporan.store');
Route::get('/laporan/{id}/edit', 'LaporanController@edit')->name('laporan.edit');
Route::get('/laporan/{id}/detail', 'LaporanController@show')->name('laporan.show');
Route::delete('/laporan/{id}/destroy', 'LaporanController@destroy')->name('laporan.destroy');


Route::get('/error' ,'LaporanController@error');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');
