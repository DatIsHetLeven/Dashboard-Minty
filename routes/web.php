<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Providers\RouteServiceProvider;
use App\Providers\FortifyServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Actions\Fortify;

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
Route::get('test', function () {
    return view('logintest');
});

Route::get('reset', function () {
    return view('auth/passwords/resettest');
})->name('resetpassword');

Route::get('password', function () {
    return view('auth/passwords/password');
})->name('reset');

Route::get('login', function () {
    return view('login');
})->name('login');

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function () {
    return view('dashboard/dashboard');
});

Route::get('dashboardOld', function () {
    return view('dashboard/dashboardOldMyDesign');
});

Route::POST('logincheck', [App\Http\Controllers\UserController::class, 'getUser'])->name('login_check');

Route::POST('cretateUser', [App\Http\Controllers\UserController::class, 'createUser'])->name('create_user_check');

Route::POST('createPassword', [App\Http\Controllers\UserController::class, 'createPassword'])->name('set_password');

Route::POST('resetPass', [App\Http\Controllers\UserController::class, 'resetPass'])->name('reset_password');

// Fortify::resetPassWorDView(function($request){
//     return view('auth.reset-password', ['request'=>$request]);
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('sendmail', [App\Http\Controllers\MailController::class, 'sendPassword']);

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');


