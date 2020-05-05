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


Route::get('/index', function () {
    return view('layout.login');
});
Route::get('', 'LoginController@showFormLogin')->name('login');
Route::post('', 'LoginController@login')->name('post.login');
Route::get('/register', function () {
    return view('buyer.register');})->name('register');
Route::post('/buyer', 'UserController@store')->name('create.buyer');

Route::middleware('CheckLogin')->group(function () {
    Route::get('/buyer', 'UserController@goToPageBuyer')->name('buyer.index');
    Route::get('/seller', 'UserController@goToPageSeller ')->name('seller.index');
    Route::get('/admin', 'UserController@goToPageAdmin')->name('admin.index');

    Route::post('/buyer', 'UserController@requestBuyerToSeller')->name('request.buyer');
    Route::post('/{id}/admin', 'UserController@destroyRequestUser')->name('destroyRequest');
    Route::post('/admin/{id}', 'UserController@activeRequestUser')->name('activeRequest');
});
