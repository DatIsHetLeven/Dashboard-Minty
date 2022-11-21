<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Connection\MintyBol_API\MintyBolController;

use App\Models\bolApi;
use App\Models\descrBolAccount;
use App\Models\statusdetails;
use App\Models\User;


use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpMyAdmin\ConfigStorage\Features\DatabaseDesignerSettingsFeature;
use Validator;
use Auth;
use function Sodium\add;

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

        $getUser = $this->renderPersonalDetails();
//        $getUser = DB::table('statusdetails')
//        ->join('user', 'statusdetails.userId', '=', 'user.userId')
//        ->where('statusdetails.userId', '=', $userbytoken->userId)->first();
        if(empty($getUser))return view('welcome');

        $allUsers= DB::table('user')
            ->leftJoin('statusdetails', 'user.userId','=','statusdetails.userId')->get();

        return view('designv2/home', ['userByCookie' => $getUser]);
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
        $MintyBolApi = new MintyBolController();
        //ARRAY WEG WERKT HALF MET ARRAY WERKT OOK HALF. Vandaar deze lelijke oplossing -__-
        $AllBolConnection = ($MintyBolApi->getAllBolConnection());

        //return view('testpage', ['userByCookie' => $user]);
        if (is_countable($AllBolConnection)) {
            if (!empty($AllBolConnection) or count($AllBolConnection) != 1) {
                for ($x = 0; $x < count($AllBolConnection); $x++) {
                    //Check of er descript van bekend is.
                    //dd($AllBolConnection[0]);
                    $respond = $this->checkDescription($AllBolConnection[$x]->bolUserId);
                    if (!empty($respond)) $AllBolConnection[$x]->description = $respond;
                }


                return view('designv2/persoonsgegevens', ['userByCookie' => $user, 'bolConnection' => $AllBolConnection]);

            }
        }
        if (!is_countable($AllBolConnection)) {
            $AllBolConnection = array($MintyBolApi->getAllBolConnection());



            if (!empty($AllBolConnection) or count($AllBolConnection) != 1) {
                for ($x = 0; $x < count($AllBolConnection); $x++) {

                    if (!isset($AllBolConnection[$x]->bolUserId)) return redirect('underConstruction');

                    $respond = $this->checkDescription($AllBolConnection[$x]->bolUserId);
                    if (!empty($respond)) $AllBolConnection[$x]->description = $respond;
                }
                //return view('dashboard/persoonsgegevens', ['userByCookie' => $user, 'bolConnection' => $AllBolConnection]);
                return view('designv2/persoonsgegevens', ['userByCookie' => $user, 'bolConnection' => $AllBolConnection]);

                return view('testpage', ['userByCookie' => $user, 'bolConnection' => $AllBolConnection]);
                //return view('testBol', ['userByCookie' => $user, 'bolConnection' => $AllBolConnection]);
            }
        }


        //dd($AllBolConnection);
        //dd($AllBolConnection);
        return view('dashboard/persoonsgegevens', ['userByCookie' => $user]);
    }

    public function toonBolSetting(){
//        $url = Storage::disk("public")->url('details.json');
//        dump($url);
//        echo asset('storage/details.json');
//        echo phpinfo();
//
//        dd("");

        $user = $this->renderPersonalDetails();
        if (empty($user->naam))return redirect('login')->with(['error'=> "Geen actieve sessie, log opnieuw in"]);
        $MintyBolApi = new MintyBolController();
        //ARRAY WEG WERKT HALF MET ARRAY WERKT OOK HALF. Vandaar deze lelijke oplossing -_-
        $AllBolConnection = ($MintyBolApi->getAllBolConnection());
        $wooConnection =($MintyBolApi->getWooConnection());
        if (!empty($wooConnection)) {
            $wooConnection->wooKey = (substr($wooConnection->wooKey, 35));
            $wooConnection->secret = 0;
        }


        $userApiKey =$MintyBolApi->getApiKey();

        if (is_countable($AllBolConnection)) {
            if (!empty($AllBolConnection) or count($AllBolConnection) != 1) {
                for ($x = 0; $x < count($AllBolConnection); $x++) {
                    if (!isset($AllBolConnection[$x]->bolUserId)) return redirect('underConstruction');
                    $respond = $this->checkDescription($AllBolConnection[$x]->bolUserId);
                    if (!empty($respond)) $AllBolConnection[$x]->description = $respond;
                }
                if (!empty($wooConnection)) return view('designv2/instellingen', ['userByCookie' => $user, 'bolConnection' => $AllBolConnection, 'userApiKey' =>$userApiKey, 'wooConnection' => $wooConnection]);
                return view('designv2/instellingen', ['userByCookie' => $user, 'bolConnection' => $AllBolConnection, 'userApiKey' =>$userApiKey]);
                return view('testBol', ['userByCookie' => $user, 'bolConnection' => $AllBolConnection, 'userApiKey' =>$userApiKey]);
            }
        }
        if (!is_countable($AllBolConnection)) {
            $AllBolConnection = array($MintyBolApi->getAllBolConnection());

            if (!empty($AllBolConnection) or count($AllBolConnection) != 1) {
                for ($x = 0; $x < count($AllBolConnection); $x++) {
                    if (!isset($AllBolConnection[$x]->bolUserId)) return redirect('underConstruction');
                    $respond = $this->checkDescription($AllBolConnection[$x]->bolUserId);
                    if (!empty($respond)) $AllBolConnection[$x]->description = $respond;
                }
                if (!empty($wooConnection)) return view('designv2/instellingen', ['userByCookie' => $user, 'bolConnection' => $AllBolConnection, 'userApiKey' =>$userApiKey, 'wooConnection' => $wooConnection]);
                return view('designv2/instellingen', ['userByCookie' => $user, 'bolConnection' => $AllBolConnection, 'userApiKey' =>$userApiKey, 'wooConnection' => $wooConnection]);
                return view('designv2/instellingen', 'testBol', ['userByCookie' => $user, 'bolConnection' => $AllBolConnection, 'userApiKey' =>$userApiKey]);
                //return view('testBol', ['userByCookie' => $user, 'bolConnection' => $AllBolConnection, 'userApiKey' =>$userApiKey]);
            }
        }

        return view('dashboard/persoonsgegevens', ['userByCookie' => $user]);
    }

    public function checkDescription($id){

            $getUser = DB::table('descriptionBolAccount')
                ->where('bolId', '=', $id)->first();


        if ($getUser == null)return null;
        return $getUser->description;
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
        if(empty($getUser)) {
            $getUser = User::where('userId', '=', $userId)->first();
        }
            //dd("test");
        return view('designv2/gebruikerInfo')->with(['user'=> $getUser]);
        //return view('dashboard/gebruikerinfo')->with(['user'=> $getUser]);
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



    public function updateStatus()
    {
        $userbytoken = UserController::getByCookie();

        if ($userbytoken === null) return redirect('login');
        $getUser = statusdetails::join('user', 'statusdetails.userId', '=', 'user.userId')
            ->where('statusdetails.userId', '=', $userbytoken->userId)->first();
        //Update in db.
        $nieuwGeldig = date('Y-m-d', strtotime('+30 days', strtotime($getUser->geldig)));
        $getUser->geldig = $nieuwGeldig;
        $getUser->save();
        //Call Api Arthur -> expireDate

        $datum = (date('Y-m-d H:i:s'));
        $datum2 = (date('Y-m-d H:i:s', strtotime('+30 days', strtotime($datum))));

        $datumIso = (date(DATE_ISO8601, strtotime($datum2)));
        $str = str_replace('T', ' ', $datumIso);
        $str2 = str_replace('+0000', '', $str);
        $bolContoller = new MintyBolController();
        $bolContoller->updateExpireDate($str2);
    }
    public function verlengVervaldatum($id){
        $userbytoken = UserController::getByCookie();

        if(isset($_POST['btnAddDays']))$aantaldagen = $_POST['aantalDagen'];

        if ($userbytoken === null)return redirect('login');
        $getUser = statusdetails::join('user', 'statusdetails.userId', '=', 'user.userId')
            ->where('statusdetails.userId', '=', $id)->first();

        $this->updateBolUser($getUser->geldig, $aantaldagen );

        $nieuwGeldig =  date('Y-m-d',strtotime('+'.$aantaldagen.' days',strtotime($getUser->geldig)));
        $getUser->geldig = $nieuwGeldig;

        $getUser->save();
        return back();
    }

    public function updateBolUser($geldig, $aantaldagen){
        $datum = $geldig.' '.(date('H:i:s'));
        $newDate = (date('Y-m-d H:i:s', strtotime('+'.$aantaldagen.' days', strtotime($datum))));

        $bolContoller = new MintyBolController();
        $bolContoller->updateExpireDate($newDate);
    }

    public function deleteBolUser($id){
        $bolContoller = new MintyBolController();
        $bolContoller->deleteBolUser($id);

        return back();
    }
    public function deleteWooConnection($id){
        $bolContoller = new MintyBolController();
        $bolContoller->deleteWooConnection($id);

        return back();
    }

    public function veranderPrijs(){
        $variable = $_POST['newPrijs'];

        DB::table('dynamisch')
            ->where('bolPrijs', '>', 0)
            ->update(['bolPrijs' => $variable]);
        return back();
    }

    public function veranderWachtwoordLogged($userId){
        $wachtwoord1 = ($_POST['wachtwoord1']);
        $wachtwoord2 = ($_POST['wachtwoord2']);

        if ($wachtwoord2 === $wachtwoord1){
            //hash passw
            $hashPassword = password_hash($wachtwoord2, PASSWORD_DEFAULT);
            //insert db
            $getUser = User::where('userId',  $userId)->first();
            $getUser->password = $hashPassword;
            $getUser->save();
            //return melding ->succesvol!
            return back()->with(['succes'=> "Wachtwoord succesvol veranderd"]);
        }
        else return back()->with(['error'=> "Wachtwoord komt niet overeen"]);
    }

    public function profielfotoGravatar(){
        $getUser = $this->renderPersonalDetails();

        $hash =  md5( strtolower( trim( $getUser->email ) ) );
        $imageData = file_get_contents("https://www.gravatar.com/avatar/".$hash);

        echo $imageData;

    }
    public function userName(){
        $getUser = $this->renderPersonalDetails();
        echo $getUser->naam;
        return back()->with($getUser->naam);
    }

}
