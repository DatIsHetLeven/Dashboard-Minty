<?php
namespace App\Http\Controllers;
use App\Http\Controllers\UserController;

use App\Models\User;
use DB;

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
        if(empty($userbytoken))return view('welcome');
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

    public function seeCustomerDetail($userId)
    {
        // $getUser = User::where('userId', '=', $userId)->first();
        
        $getUser = DB::table('statusdetails')
        ->join('user', 'statusdetails.userId', '=', 'user.userId')
        ->where('statusdetails.userId', '=', $userId)
        ->join('factuursturen', 'factuursturen.userId', '=', 'user.userId')
        ->where('factuursturen.userId', '=', $userId)->first();

        if(empty($getUser)){
            $getUser = DB::table('statusdetails')
            ->join('user', 'statusdetails.userId', '=', 'user.userId')
            ->where('statusdetails.userId', '=', $userId)->first();
        }
        
        if(empty($getUser)){
            $getUser = User::
            join('factuursturen', 'factuursturen.userId', '=', 'user.userId')
            ->where('factuursturen.userId', '=', $userId)->first();
        }
        if(empty($getUser)){
            $getUser = User::where('userId', '=', $userId)->first();
        }
        return view('bootstrTesttt')->with(['user'=> $getUser]);
        //return view('dashboard/gebruikerinfo')->with(['user'=> $getUser]);
    }
}
