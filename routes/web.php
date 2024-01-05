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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/create_pallet', 'PalletController@create')->name('pallet.create');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');
//rutas para agregar componentes
Route::get('/component_entry', function (){
    return view('component_entry');
});
Route::get('/create_pallet',function(){
    return view('create_pallet');
});
Route::get('/report',function(){
    return view('report');
});
Route::get('/scan-qrcode', 'QRcodeController@scan')->name('scan-qrcode');
Route::get('/incomingRequest', 'PalletController@checkIncoming')->name('incomingRequest');
Route::get('/about', function () {
    return view('about');
})->name('about');

