<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Connection\MintyBol_API\MintyBolController;

use App\Models\bolApi;
use App\Models\statusdetails;
use App\Models\User;


use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
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
        if(empty($userbytoken))return redirect('login');

        $getUser = DB::table('statusdetails')
        ->join('user', 'statusdetails.userId', '=', 'user.userId')
        ->where('statusdetails.userId', '=', $userbytoken->userId)->first();
        if(empty($getUser))return view('welcome');

        return view('dashboard/dashboard', ['userByCookie' => $getUser]);
    }

    public function renderPersonalDetails () {
        $userbytoken = UserController::getByCookie();

        if ($userbytoken === null)return redirect('login');
        $getUser = DB::table('statusdetails')
        ->join('user', 'statusdetails.userId', '=', 'user.userId')
        ->where('statusdetails.userId', '=', $userbytoken->userId)->first();
        return $getUser;

    }
    public function toonPersoonsgegevens(){
        $user = $this->renderPersonalDetails();
        if (empty($user->naam))return redirect('login')->with(['error'=> "Geen actieve sessie, log opnieuw in"]);
        return view('dashboard/persoonsgegevens', ['userByCookie' => $user]);
    }

    public function resetPassword()
    {
        return view('auth/passwords/resettest');
    }

    public function seeCustomerDetail($userId)
    {
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
        return view('dashboard/gebruikerinfo')->with(['user'=> $getUser]);
    }

    public function logout(){
        $cookie = $_COOKIE;
        DB::table('user')
        ->where('cookie_token', '=', $cookie)
        ->update(['cookie_token' => NULL]);

        $cookie_name = "user";
        setcookie($cookie_name, "", time() - (86400 * 30));

        return redirect('login');
    }

    public function getUserBolId($userId){
        $bolUser = DB::table('bolApi')
            ->where('userId', '=', $userId)->first();
        return $bolUser;
    }

    public function payments($id){
        $bolContoller = new MintyBolController();
        return $bolContoller->CheckMandateStatus($id);
    }

    public function payment(){
        $dayVandaag = date('Y-m-d');
        $geldigTot =  date('Y-m-d', strtotime("$dayVandaag + 30 day"));

        $loggedUser = $this->renderPersonalDetails();

        $NewStatusDetails = statusdetails::where('userId', '=', $loggedUser->userId)->first();
        $NewStatusDetails->geldig = $geldigTot;
        $NewStatusDetails->geverifieerd = 1;
        $NewStatusDetails->geabonneerd = 1;
        $NewStatusDetails->save();

        //Zet de user rol op gebruiker ipv proefaccount
        $user = User::where('userId', '=', $loggedUser->userId)->first();
        $user->rol = 2;
        $user->save();
        return view('dashboard/payment/payment');
    }

    public function checkCookieToken($token){
        $getUser = User::
        where('cookie_token', '=', $token)->first();
        if (empty($getUser))return false;
        return true;
    }

    public function blokApiVoorKlant($userId){
        $bolContoller = new MintyBolController();
        $bolUser = bolApi::where('userId', '=', $userId)->first();
        $bolUser->block = 1;
        $bolUser->save();
        $bolContoller->blokkeerApi($userId);

        return back();
    }

    public function checkBlokKlant($userId){
        $bolUser = bolApi::where('userId', '=', $userId)->first();
        if ($bolUser === null)return redirect('login');
        if ($bolUser->block === 1)return false;
        return true;
    }

    public function valideerUserRechten(){
        $MintyBolController = new MintyBolController();
        //Check of gebruiker userRole 2 heeft (betalende klant)
        $loggedUser = $this->renderPersonalDetails();
        if ($loggedUser->userId === 2){
            $MintyBolController->UpdateApiActief(1);
            return true;
        }
        //Check of gebruiker binnen de 14 dagen valt.
        $user = $this->renderPersonalDetails();
            $geldig = $user->geldig;
            $dayVandaag = date('Y-m-d');
            //Als de 14 dagen voorbij zijn
            if($geldig < $dayVandaag) {
                $MintyBolController->UpdateApiActief(0);
                return false;
            }
            // Als de klant binnen de 14 dagen valt (nog niet gevrf)
            if($geldig > $dayVandaag){
                $MintyBolController->UpdateApiActief(1);
                return true;
            }
    }



    public function updateStatus(){
        $userbytoken = UserController::getByCookie();

        if ($userbytoken === null)return redirect('login');
        $getUser = statusdetails::join('user', 'statusdetails.userId', '=', 'user.userId')
            ->where('statusdetails.userId', '=', $userbytoken->userId)->first();

        $nieuwGeldig =  date('Y-m-d',strtotime('+30 days',strtotime($getUser->geldig)));
        $getUser->geldig = $nieuwGeldig;
        $getUser->save();

    }
}
