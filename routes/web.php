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


Route::get('/index/', 'App\Http\Controllers\IndexController@index');

Route::get('/pelanggan/', 'App\Http\Controllers\PelangganController@index');
Route::get('/pelanggan/create', 'App\Http\Controllers\PelangganController@create');
Route::post('/pelanggan/add', 'App\Http\Controllers\PelangganController@add');
Route::get('/pelanggan/edit/{id}', 'App\Http\Controllers\PelangganController@edit');
Route::post('/pelanggan/set/{id}', 'App\Http\Controllers\PelangganController@set');
Route::get('/pelanggan/delete/{id}', 'App\Http\Controllers\PelangganController@delete');

Route::get('/barang/', 'App\Http\Controllers\BarangController@index');
Route::get('/barang/create', 'App\Http\Controllers\BarangController@create');
Route::post('/barang/add', 'App\Http\Controllers\BarangController@add');
Route::get('/barang/edit/{id}', 'App\Http\Controllers\BarangController@edit');
Route::post('/barang/set/{id}', 'App\Http\Controllers\BarangController@set');
Route::get('/barang/delete/{id}', 'App\Http\Controllers\BarangController@delete');


Route::get('/penjualan/', 'App\Http\Controllers\PenjualanController@index');
Route::get('/penjualan/create', 'App\Http\Controllers\PenjualanController@create');
Route::post('/penjualan/add', 'App\Http\Controllers\PenjualanController@add');
Route::get('/penjualan/edit/{id}', 'App\Http\Controllers\PenjualanController@edit');
Route::post('/penjualan/set/{id}', 'App\Http\Controllers\PenjualanController@set');
Route::get('/penjualan/delete/{id}', 'App\Http\Controllers\PenjualanController@delete');
