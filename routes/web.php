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

Route::GET('dashboard', [HomeController::class, 'renderDashboard'])->name('dashboard');

Route::get('customers', [UserController::class, 'getAllUsers'])->name('allegebruikers')->middleware('check.user');;

Route::get('dashboardOld', function () {
    return view('dashboard/dashboardOldMyDesign')->middleware('check.user');
});

Route::POST('logincheck', [UserController::class, 'getUser'])->name('login_check');

Route::POST('cretateUser', [UserController::class, 'createUser'])->name('create_user_check');

// gebruikt kortere class path - minty pawel
Route::POST('createPassword', [UserController::class, 'createPassword'])->name('setPassword');

Route::POST('resetPass', [UserController::class, 'resetPass'])->name('reset_password');

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

//Route::get('alleproducten', [ProductController::class, 'getAllProducts'])->name('alleproducten')->middleware('check.user');
//Route::get('productinfo/{id}', [ProductController::class, 'getSingleProduct'])->name('productinfo')->middleware('check.user');
//Route::POST('updatePoduct/{id}', [ProductController::class, 'updatePoduct'])->name('updatePoduct')->middleware('check.user');

Route::get('logout', [HomeController::class, 'logout'])->name('logout')->middleware('check.user');

// Route::get('dashboard', function () {
//     return view('dashboard/dashboard');
// })->name('dashboard')->middleware('check.user');

Route::get('passwordreset', function () {
    return view('auth/passwords/password');
})->name('passwordreset');

Route::get('resettest', function () {
    return view('auth/passwords/resettest');
})->name('resettest');

Route::get('2FA', function () {
    return view('designv2/2FA');
})->name('2FA');



Route::get('allemodules', function () {
    return view('dashboard/module/allemodules');
})->name('allemodules')->middleware('check.user');


Route::get('modules', [ModuleController::class, 'GetAllModules'])->name('GetAllModules')->middleware('CheckBolAccount');


Route::get('GetSingleModule/{moduleId}', [ModuleController::class, 'GetSingleModule'])->name('GetSingleModule')->middleware('check.user');
Route::get('EnableSingleModule/{moduleId}', [ModuleController::class, 'EnableSingleModule'])->name('EnableSingleModule')->middleware('check.user');
Route::get('DisableSingleModule/{moduleId}', [ModuleController::class, 'DisableSingleModule'])->name('DisableSingleModule')->middleware('check.user');


Route::post('createBolUser/{id}', [UserController::class, 'createBolUser'])->name('createBolUser')->middleware('check.user');
Route::post('createWooUser/{id}', [UserController::class, 'createWooUser'])->name('createWooUser')->middleware('check.user');






//test routes
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





Route::get('orderWachtagentPlugin', function () {
    return view('dashboard/module/orderWachtagentPlugin', ["singleModule" => $singlemodule]);
})->name('bol.mintyconnect.order.wachtagent');

Route::POST('verlengVervaldatum/{id}', [HomeController::class, 'verlengVervaldatum'])->name('verlengVervaldatum')->middleware('check.user');




Route::POST('veranderPrijs}', [HomeController::class, 'veranderPrijs'])->name('veranderPrijs')->middleware('check.user');



Route::POST('veranderWachtwoord/{id}}', [HomeController::class, 'veranderWachtwoordLogged'])->name('veranderWachtwoordLogged')->middleware('check.user');



//Test paginas na nieuw design
Route::get('bol-settings', [HomeController::class, 'toonBolSetting'])->name('toonBolSetting')->middleware('check.user');

Route::get('testpage', function () {
    return view('testpage');
})->name('testpage');

Route::get('testBol', function () {
    return view('testBol');
})->name('testBol');


//Vernieuwde design!!!
Route::get('SignUp', function () {
    return view('designv2/SignUp');
})->name('SignUp');
Route::get('persoons', function () {
    return view('designv2/persoonsgegevens');
})->name('persoons');
//Route::get('instellingen', function () {
//    return view('designv2/instellingen');
//})->name('instellingen');
//Route::get('modules', function () {
//    return view('designv2/modules');
//})->name('modules');
Route::get('alleGebruikers', function () {
    return view('designv2/alleGebruikers');
})->name('alleGebruikers');
Route::get('test', function () {
    return view('designv2/Testjesss');
})->name('testentesten');
Route::get('gebruikerinfo', function () {
    return view('designv2/gebruikerInfo');
})->name('gebruikerinfo');

Route::get('dashboardv2', function () {
    return view('designv2/home');
})->name('dashboardv2');

Route::get('info', function () {
    return view('designv2/info');
})->name('info');

Route::get('loggert', function () {
    return view('designv2/login2FA');
})->name('loggert');


Route::get('profielfotoGravatar', [HomeController::class, 'profielfotoGravatar'])->name('profielfotoGravatar')->middleware('check.user');
Route::get('userName', [HomeController::class, 'userName'])->name('userName')->middleware('check.user');



Route::get('/gravatar', 'GravatarController@gravatar');


Route::get('underConstruction', function () {
    return view('designv2/underConstruction');
})->name('underConstruction');



Route::POST('AuthRequest/{id}', [HomeController::class, 'AuthRequest'])->name('AuthRequest');
Route::POST('check2FAInput', [HomeController::class, 'check2FAInput'])->name('check2FAInput');
Route::GET('security', [HomeController::class, 'beveiligen'])->name('beveiligen');


