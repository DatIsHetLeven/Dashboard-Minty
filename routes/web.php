<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\CheckUser;

// ongebruikte classes
use App\Http\Controllers\MailController;
use App\Providers\RouteServiceProvider;
use App\Providers\FortifyServiceProvider;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('reset', [HomeController::class, 'resetPassword'])->name('resetpassword');

Route::get('persoonsgegevens', [HomeController::class, 'renderPersonalDetails'])->name('persoonsgegevens');

Route::GET('dashboard', [HomeController::class, 'renderDashboard'])->name('dashboard')->middleware('check.user');

Route::get('gebruikers', [UserController::class, 'getAllUsers'])->name('allegebruikers');

Route::get('dashboardOld', function () {
    return view('dashboard/dashboardOldMyDesign');
});

Route::POST('logincheck', [UserController::class, 'getUser'])->name('login_check');

Route::POST('cretateUser', [UserController::class, 'createUser'])->name('create_user_check');

// gebruikt kortere class path - minty pawel
Route::POST('createPassword', [UserController::class, 'createPassword'])->name('set_password');

Route::POST('resetPass', [UserController::class, 'resetPass'])->name('reset_password');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('gebruikerinfo', function () {
    return view('dashboard/gebruikerinfo');
})->name('gebruikerinfo');

Route::get('seeCustomerDetail/{id}', [HomeController::class, 'seeCustomerDetail'])->name('seeCustomerDetail');

Route::get('createUserFactuursturen/{id}', [UserController::class, 'createUserFactuursturen'])->name('createUserFactuursturen');
Route::get('deleteUser/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');




// Route::get('dashboard', function () {
//     return view('dashboard/dashboard');
// })->name('dashboard')->middleware('check.user');

// Route::get('reset', function () {
//     return view('auth/passwords/resettest');
// })->name('resetpassword');


