<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;

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
Route::get('Accounts', function () {
    return view('accounts');
});

Route::get('home', function () {
    return view('welcome');
});

Route::get('register', function () {
    return view('register');
});

Route::get('dbconn', function () {
    return view('dbconn');
});

Route::get('/', function () {
    return view('login');
});
