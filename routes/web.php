<?php

use App\Http\Controllers\Connection\MintyBol_API\MintyBolController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModuleController;




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

Route::get('reset', [HomeController::class, 'resetPassword'])->name('resetpassword')->middleware('check.user');

Route::get('persoonsgegevens', [HomeController::class, 'toonPersoonsgegevens'])->name('persoonsgegevens')->middleware('check.user');;

Route::GET('dashboard', [HomeController::class, 'renderDashboard'])->name('dashboard')->middleware('check.user');

Route::get('gebruikers', [UserController::class, 'getAllUsers'])->name('allegebruikers')->middleware('check.user');;

Route::get('dashboardOld', function () {
    return view('dashboard/dashboardOldMyDesign')->middleware('check.user');
});

Route::POST('logincheck', [UserController::class, 'getUser'])->name('login_check');

Route::POST('cretateUser', [UserController::class, 'createUser'])->name('create_user_check')->middleware('check.user');

// gebruikt kortere class path - minty pawel
Route::POST('createPassword', [UserController::class, 'createPassword'])->name('set_password')->middleware('check.user');

Route::POST('resetPass', [UserController::class, 'resetPass'])->name('reset_password')->middleware('check.user');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('check.user');


Route::get('gebruikerinfo', function () {
    return view('dashboard/gebruikerinfo');
})->name('gebruikerinfo')->middleware('check.user');;

Route::get('seeCustomerDetail/{id}', [HomeController::class, 'seeCustomerDetail'])->name('seeCustomerDetail')->middleware('check.user');

Route::get('createUserFactuursturen/{id}', [UserController::class, 'createUserFactuursturen'])->name('createUserFactuursturen')->middleware('check.user');
Route::POST('getFactuursturenUser', [UserController::class, 'getFactuursturenUser'])->name('getFactuursturenUser')->middleware('check.user');

Route::get('deleteUser/{id}', [UserController::class, 'deleteUser'])->name('deleteUser')->middleware('check.user');

Route::get('instellingen', function () {
    return view('dashboard/setting/setting');
})->name('instellingen')->middleware('check.user');

Route::get('alleproducten', [ProductController::class, 'getAllProducts'])->name('alleproducten')->middleware('check.user');

Route::get('productinfo/{id}', [ProductController::class, 'getSingleProduct'])->name('productinfo')->middleware('check.user');

Route::POST('updatePoduct/{id}', [ProductController::class, 'updatePoduct'])->name('updatePoduct')->middleware('check.user');

Route::get('logout', [HomeController::class, 'logout'])->name('logout')->middleware('check.user');

// Route::get('dashboard', function () {
//     return view('dashboard/dashboard');
// })->name('dashboard')->middleware('check.user');

Route::get('passwordreset', function () {
    return view('auth/passwords/password');
})->name('passwordreset');

Route::get('testpage', function () {
    return view('testpage');
})->name('testpage');

Route::get('allemodules', function () {
    return view('dashboard/module/allemodules');
})->name('allemodules')->middleware('check.user');


Route::get('GetAllModules', [ModuleController::class, 'GetAllModules'])->name('GetAllModules')->middleware('check.user');


Route::get('GetSingleModule/{moduleId}', [ModuleController::class, 'GetSingleModule'])->name('GetSingleModule')->middleware('check.user');
Route::get('EnableSingleModule/{moduleId}', [ModuleController::class, 'EnableSingleModule'])->name('EnableSingleModule')->middleware('check.user');


Route::post('createBolUser/{id}', [UserController::class, 'createBolUser'])->name('createBolUser')->middleware('check.user');




//test routes
Route::get('CreateMandate', [MintyBolController::class, 'CreateMandate'])->name('CreateMandate')->middleware('check.user');
Route::get('payments/{id}', [HomeController::class, 'payments'])->name('payments')->middleware('check.user');
Route::get('payment', [HomeController::class, 'payment'])->name('payment')->middleware('check.user');
Route::post('updateOrderWachtagent', [MintyBolController::class, 'updateOrderWachtagent'])->name('updateOrderWachtagent')->middleware('check.user');












