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
    return view('auth/login');
})->name('welcome');

Route::get('reset', [HomeController::class, 'resetPassword'])->name('resetpassword');
Route::get('settings', [HomeController::class, 'toonPersoonsgegevens'])->name('persoonsgegevens')->middleware('check.user');;
Route::GET('dashboard', [HomeController::class, 'renderDashboard'])->name('dashboard')->middleware('CheckValidRequest');
Route::get('customers', [UserController::class, 'getAllUsers'])->name('allegebruikers')->middleware('check.user');;
Route::POST('logincheck', [UserController::class, 'getUser'])->name('login_check');
Route::POST('cretateUser', [UserController::class, 'createUser'])->name('create_user_check');
Route::POST('createPassword', [UserController::class, 'createPassword'])->name('setPassword');
Route::POST('resetPass', [UserController::class, 'resetPass'])->name('reset_password');
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('check.user');
Route::get('seeCustomerDetail/{id}', [HomeController::class, 'seeCustomerDetail'])->name('seeCustomerDetail')->middleware('check.user');
Route::get('createUserFactuursturen/{id}', [UserController::class, 'createUserFactuursturen'])->name('createUserFactuursturen')->middleware('check.user');
Route::POST('getFactuursturenUser', [UserController::class, 'getFactuursturenUser'])->name('getFactuursturenUser')->middleware('check.user');
Route::get('deleteUser/{id}', [UserController::class, 'deleteUser'])->name('deleteUser')->middleware('check.user');
Route::get('instellingen', [HomeController::class, 'instellingen'])->name('instellingen')->middleware('check.user');
Route::get('logout', [HomeController::class, 'logout'])->name('logout')->middleware('check.user');


Route::get('modules', [ModuleController::class, 'GetAllModules'])->name('GetAllModules')->middleware('CheckBolAccount');
Route::get('GetSingleModule/{moduleId}', [ModuleController::class, 'GetSingleModule'])->name('GetSingleModule')->middleware('check.user');
Route::get('EnableSingleModule/{moduleId}', [ModuleController::class, 'EnableSingleModule'])->name('EnableSingleModule')->middleware('check.user');
Route::get('DisableSingleModule/{moduleId}', [ModuleController::class, 'DisableSingleModule'])->name('DisableSingleModule')->middleware('check.user');
Route::post('createBolUser/{id}', [UserController::class, 'createBolUser'])->name('createBolUser')->middleware('check.user');
Route::post('createWooUser/{id}', [UserController::class, 'createWooUser'])->name('createWooUser')->middleware('check.user');
Route::post('UpdateUserDetails', [UserController::class, 'UpdateUserDetails'])->name('UpdateUserDetails')->middleware('check.user');

Route::get('CreateMandate', [MintyBolController::class, 'CreateMandate'])->name('CreateMandate')->middleware('check.user');
Route::get('payments/{id}', [HomeController::class, 'payments'])->name('payments')->middleware('check.user');
Route::get('payment', [HomeController::class, 'payment'])->name('payment')->middleware('check.user');
Route::post('updateOrderWachtagent', [MintyBolController::class, 'updateOrderWachtagent'])->name('updateOrderWachtagent')->middleware('check.user');
Route::post('updateProductWachtagent', [MintyBolController::class, 'updateProductWachtagent'])->name('updateProductWachtagent')->middleware('check.user');
Route::get('inloggenAlsKlant/{id}', [UserController::class, 'inloggenAlsKlant'])->name('inloggenAlsKlant')->middleware('check.user');
Route::get('herstellenEigenAccountInlog', [UserController::class, 'herstellenEigenAccountInlog'])->name('herstellenEigenAccountInlog')->middleware('check.user');
Route::get('blokkeerApi/{id}', [HomeController::class, 'blokApiVoorKlant'])->name('blokkeerApi')->middleware('check.user');
Route::get('deleteBolUser/{id}', [HomeController::class, 'deleteBolUser'])->name('deleteBolUser')->middleware('check.user');
Route::get('deleteWooConnection/{id}', [HomeController::class, 'deleteWooConnection'])->name('deleteWooConnection')->middleware('check.user');


Route::POST('verlengVervaldatum/{id}', [HomeController::class, 'verlengVervaldatum'])->name('verlengVervaldatum')->middleware('check.user');
Route::POST('veranderPrijs}', [HomeController::class, 'veranderPrijs'])->name('veranderPrijs')->middleware('check.user');
Route::POST('veranderWachtwoord/{id}}', [HomeController::class, 'veranderWachtwoordLogged'])->name('veranderWachtwoordLogged')->middleware('check.user');
Route::GET('getUserInvoice/{id}}', [UserController::class, 'getUserInvoice'])->name('getUserInvoice')->middleware('check.user');
Route::GET('wpae_after_export', [HomeController::class, 'wpae_after_export'])->name('wpae_after_export');


Route::get('bol-settings', [HomeController::class, 'toonBolSetting'])->name('toonBolSetting')->middleware('check.user');
Route::get('Producten', [HomeController::class, 'toonProducten'])->name('toonProducten')->middleware('check.user');

Route::get('login2FA', [HomeController::class, 'login2FA'])->name('login2FA')->middleware('check.user');
Route::get('info', [HomeController::class, 'info'])->name('info')->middleware('check.user');
Route::get('profielfotoGravatar', [HomeController::class, 'profielfotoGravatar'])->name('profielfotoGravatar')->middleware('check.user');
Route::get('userName', [HomeController::class, 'userName'])->name('userName')->middleware('check.user');
Route::get('/gravatar', 'GravatarController@gravatar');
Route::POST('AuthRequest/{id}', [HomeController::class, 'AuthRequest'])->name('AuthRequest');
Route::POST('check2FAInput', [HomeController::class, 'check2FAInput'])->name('check2FAInput');
Route::GET('security', [HomeController::class, 'beveiligen'])->name('beveiligen');



Route::POST('Producten', [HomeController::class, 'checkEanCode'])->name('checkEanCode')->middleware('check.user');

Route::get('underConstruction', function () {
    return view('designv2/underConstruction');
})->name('underConstruction');
Route::get('passwordreset', function () {
    return view('auth/passwords/password');
})->name('passwordreset');
Route::get('resettest', function () {
    return view('auth/passwords/resettest');
})->name('resettest');

