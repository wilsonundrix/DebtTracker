<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('/users', 'UserController', ['except' => ['show', 'store', 'create']]);
});

Route::resource('customer', 'CustomerController');
Route::get('create/receipt/{customer}','CustomerController@customerReceipt')->name('receipt_create');
Route::resource('receipt', 'ReceiptController', ['except' => ['edit', 'update', 'destroy']]);
Route::resource('payment', 'PaymentController', ['only' => ['create', 'store']]);
//Route::resource('account', 'AccountController', ['except' => ['show', 'store', 'create']]);
Route::resource('batch', 'BatchController', ['only' => ['store']]);