<?php
namespace App\Http\Controllers;
use App\Http\Controllers\UserController;

use App\Models\User;

use Illuminate\Http\Request;

//Deze class wordt niet gebruikt - minty pawel
use Validator;
use Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function renderDashboard () {
        $userbytoken = UserController::getByCookie();
        return view('dashboard/dashboard', ['userByCookie' => $userbytoken]);
    }

    public function renderPersonalDetails () {
        $userbytoken = UserController::getByCookie();
        return view('dashboard/persoonsgegevens', ['userByCookie' => $userbytoken]);
    }

    public function resetPassword()
    {
        return view('auth/passwords/resettest');
    } 
}
