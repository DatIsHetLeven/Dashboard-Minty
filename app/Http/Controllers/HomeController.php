<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Connection\MintyBol_API\MintyBolController;

use App\Models\bolApi;
use App\Models\descrBolAccount;
use App\Models\statusdetails;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


use GuzzleHttp\Exception\RequestException;

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

    public function AuthRequest($secret_key ){

        $user_provided_code = $_POST['userInputAuth'];
        $loggedUser = $this->renderPersonalDetails();


        $google2fa = new \PragmaRX\Google2FA\Google2FA();
        if ($google2fa->verifyKey($secret_key, $user_provided_code)) {
            $getUser = User::where('email',  $loggedUser->email)->first();
            $getUser->Auth =$secret_key;
            $getUser->save();
            return back()->with(['correct' => '2FA succesvol ingeschakeld']);
        } else {
            return back()->with(['error' => 'Ingevoerde code onjuist!']);
        }
    }



    public function beveiligen(){
        $user = $this->renderPersonalDetails();
        if (empty($user->naam))return redirect('login')->with(['error'=> "Geen actieve sessie, log opnieuw in"]);

        return view('designv2/beveiligen', ['userByCookie' => $user]);
    }

    public function check2FAInput(){
        $loggedUser = $this->renderPersonalDetails();
        $secret_key = $loggedUser->Auth;
        $user_provided_code = $_POST['authCodeInput'];
        $CheckUserLogin = User::Where('email', '=', $loggedUser->email)->first();

        $google2fa = new \PragmaRX\Google2FA\Google2FA();
        if ($google2fa->verifyKey($secret_key, $user_provided_code)) {
            return redirect()->route('dashboard');
        } else {
            return back()->with(['error' => 'Ingevoerde code onjuist']);
        }
    }






    /////////////////////////////////


    function wpae_after_export()
    {
        $relativeFilePath = "https://www.ruitersport-levade.nl/wp-load.php?security_token=be58612c5f2adf45&export_id=1&action=get_data";

        $ftp_server="marketplace-ftp.kentucky-horsewear.com";
        $ftp_user_name="000113";
        $ftp_user_pass='5W81V6975e$Zow1f';
        $file = "$relativeFilePath";//tobe uploaded
        $remote_file = "/file/serverFile.csv";

        // set up basic connection
        $conn_id = ftp_connect($ftp_server);
        // login with username and password
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

        // upload a file
        if (ftp_put($conn_id, $remote_file, $file, FTP_ASCII)) {
            echo "successfully uploaded $file\n";
//            exit;
        } else {
            echo "There was a problem while uploading $file\n";
//            exit;
        }
        // close the connection
        ftp_close($conn_id);
//        add_action('pmxe_after_export', 'wpae_after_export', 10, 1);


        dd("test");


        ////
        $ftp_host = "marketplace-ftp.kentucky-horsewear.com";
        $ftp_user = "000113";
        $ftp_pass = '5W81V6975e$Zow1f';

        $ftp = ftp_connect($ftp_host, 21);
        ftp_login($ftp, $ftp_user, $ftp_pass);

        $dest_file = "/file/test.csv";
        $source_file = "/storage/app/csv/current-kentucky-levade.csv";
        $local_dir = "https://mintydashboard.myio.nl/csv/current-kentucky-levade.csv";


        $ret = ftp_nb_put($ftp, $dest_file, $local_dir, FTP_ASCII);

        while (FTP_MOREDATA == $ret)
        {
            // display progress bar, or something
            $ret = ftp_nb_continue($ftp);
        }


dd("stop");


        ////////////////////////////
//        $ftp_host = "marketplace-ftp.kentucky-horsewear.com";
//        $ftp_user = "000113";
//        $ftp_pass = '5W81V6975e$Zow1f';
//
//        $ftp_connection = ftp_connect($ftp_host) or die("fail host");
//        ftp_login($ftp_connection, $ftp_user, $ftp_pass) or die("fail login");
//        ftp_pasv($ftp_connection, true);
//
//
//        $local_dir = "https://mintydashboard.myio.nl/csv/current-kentucky-levade.csv";
//        $filePAth = "https://mintydashboard.myio.nl/csv/current-kentucky-levade.csv";
//        $fileName = "current-kentucky-levade.csv";
//
////        dd($local_dir);
//        $remote_server_dir = "/file";
//
//        //dd($local_dir);
//        ftp_put($ftp_connection, $remote_server_dir, $local_dir, FTP_BINARY );
//
//        dd("");

    }












        // Retrieve export object.
//        $export = new PMXE_Export_Record();
//        $export->getById($export_id);

        // Check if "Secure Mode" is enabled in All Export > Settings.
//        $is_secure_export = PMXE_Plugin::getInstance()->getOption('secure');

        // Retrieve file path when not using secure mode.
//        if (!$is_secure_export) {
//            $filepath = get_attached_file($export->attch_id);

            // Retrieve file path when using secure mode.
//        } else {
//            $filepath = wp_all_export_get_absolute_path($export->options['filepath']);
//        }

//        // Path to the export file.
//        $localfile = file("csv/current-kentucky-levade.csv");
//
//        // File name of remote file (destination file name).
//        $remotefile = basename("/file");
//
//        // Remote FTP server details.
//        // The 'path' is relative to the FTP user's login directory.
//        $ftp = array(
//            'server' => 'marketplace-ftp.kentucky-horsewear.com:21',
//            'user' => '000113',
//            'pass' => '5W81V6975e$Zow1f',
//            'path' => '/file'
//        );
//
//        // Ensure username is formatted properly
//        $ftp['user'] = str_replace('@', '%40', $ftp['user']);
//
//        // Ensure password is formatted properly
//        $ftp['pass'] = str_replace(array('#', '?', '/', '\\'), array('%23', '%3F', '%2F', '%5C'), $ftp['pass']);
//
//        // Remote FTP URL.
//        $remoteurl = "ftp://{$ftp['user']}:{$ftp['pass']}@{$ftp['server']}{$ftp['path']}/{$remotefile}";
//
//        // Retrieve cURL object.
//        $ch = curl_init();
//
//        // Open export file.
//        $fp = fopen('csv/current-kentucky-levade.csv', "rb");
//        $filesize = filesize('csv/current-kentucky-levade.csv');
//        //dd("");
//        // Proceed if the local file was opened.
//        if ($fp) {
//
//            // Provide cURL the FTP URL.
//            curl_setopt($ch, CURLOPT_URL, 'marketplace-ftp.kentucky-horsewear.com');
//
//            // Prepare cURL for uploading files.
//            curl_setopt($ch, CURLOPT_UPLOAD, 1);
//
//            // Provide the export file to cURL.
//            curl_setopt($ch, CURLOPT_INFILE, $fp);
//
//            // Provide the file size to cURL.
//            curl_setopt($ch, CURLOPT_INFILESIZE, $filesize);
//
//            // Start the file upload.
//            curl_exec($ch);
//
//            // If there is an error, write error number & message to PHP's error log.
//            if ($errno = curl_errno($ch)) {
//                if (version_compare(phpversion(), '5.5.0', '>=')) {
//
//                    // If PHP 5.5.0 or greater is used, use newer function for cURL error message.
//                    $error_message = curl_strerror($errno);
//
//                } else {
//
//                    // Otherwise, use legacy cURL error message function.
//                    $error_message = curl_error($ch);
//                }
//
//                // Write error to PHP log.
//                error_log("cURL error ({$errno}): {$error_message}");
//
//            }
//
//            // Close the connection to remote server.
//            curl_close($ch);
//
//        } else {
//            // If export file could not be found, write to error log.
//            error_log("Could not find export file");
//
//        }
//
//        dd("");
//        //add_action('pmxe_after_export', 'wpae_after_export', 10, 1);
//
//    }









}
