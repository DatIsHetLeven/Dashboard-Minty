<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Connection\MintyBol_API\MintyBolController;
use Illuminate\Support\Facades\DB;


class ModuleController extends Controller
{
    private $homeController;
    private $MintyBolApi;
    private $loggedUser;

    public function  __construct(){
        $this->homeController = new HomeController();
        $this->MintyBolApi = new MintyBolController();
        $this->loggedUser = $this->homeController->renderPersonalDetails();
    }

    public function GetAllModules(){

        if (empty($this->loggedUser->userId))return redirect('login')->with(['error'=> "Geen actieve sessie, log opnieuw in"]);
        //Get bolUserId (userid from arthurs api)
        $bolUser = DB::table('bolApi')
            ->where('userId', '=', $this->loggedUser->userId)->first();
        if (empty($bolUser))return redirect('login');
        $alleModules = $this->MintyBolApi->GetAllModules();
        if (!is_array($alleModules)){
            if ($alleModules->getStatusCode() > 299) return redirect('underConstruction');
        }


        //dd($alleModules);

        $logs = $this->GetLog();
        if ($logs === false)return redirect('underConstruction');
        $CheckModuleArray = array();

        for ($x = 0; $x < count($alleModules); $x++){
            $boolModule = $this->MintyBolApi->CheckModuleBolUser($bolUser->userIdApi, $alleModules[$x]->identifier);
            $CheckModuleArray[] = $boolModule;
        }
        $user = $this->homeController->renderPersonalDetails();

        return view('designv2/modules', ['allUsers' => $alleModules, 'allLogs' => $logs, 'boolModule' =>$CheckModuleArray, 'userByCookie' => $user]);
        //return view('dashboard/module/allemodules', ['allUsers' => $alleModules, 'allLogs' => $logs, 'boolModule' =>$CheckModuleArray, 'userByCookie' => $user]);
    }
    public function GetLog(){
        $singleModule = $this->MintyBolApi->GetLogs();
        return $singleModule;
    }

    //Toon de correcte module
    public function GetSingleModule($moduleNaam){

        $singleModule = $this->MintyBolApi->getSingleModuleUser();
        $changeName = str_ireplace(array('.', 'bol', 'minty', 'connect', 'management', 'wachtagent'), '',$moduleNaam);
        $changeName = $changeName."wachtagent";
        $correcteView = str_ireplace(array('wachtagent'), 'WachtagentPlugin',$changeName);

        for ($x = 0; $x <= count($singleModule); $x++){
            if ($singleModule[$x]->identifier === $moduleNaam) return view('dashboard/module/'.$correcteView, ['singleModule' => $singleModule[$x]]);
        }
//        oude manier
//        if ($moduleNaam === 'bol.mintyconnect.order.wachtagent')return view('dashboard/module/orderWachtagentPlugin', ['singleModule' => $singleModule[1]]);
//        if ($moduleNaam === 'bol.mintyconnect.product.wachtagent') return view('dashboard/module/productWachtagentPlugin', ['singleModule' => $singleModule[0]]);
        return view('dashboard/module/permodule', ['singleModule' => $singleModule]);
    }
    //Enable 1 module
    public function EnableSingleModule($moduleNaam){
        //Get bolUserId (userid from arthurs api)
        $bolUser = $this->homeController->getUserBolId($this->loggedUser->userId);
        $changeName = str_ireplace(array('.', 'bol', 'minty', 'connect', 'management','wachtagent'), '',$moduleNaam);
        //Omdat de naam van de plugins veranderd is -> zelfde structuur aanhouden.
        $changeName = $changeName."wachtagent";
        //1 module aanzetten obv modulenaam
        $this->MintyBolApi->$changeName($bolUser->userIdApi, $moduleNaam);

        return redirect()->route('GetAllModules');
    }
    //Disable 1 module
    public function DisableSingleModule($moduleNaam){
        $bolUser = $this->homeController->getUserBolId($this->loggedUser->userId);
        $this->MintyBolApi->deleteModuleBolUser($bolUser->userIdApi, $moduleNaam);

        return redirect()->route('GetAllModules');
    }


    public function getWachtagentPlugin(){
        $singleModule = $this->MintyBolApi->GetSingleModule("bol.mintyconnect.order.wachtagent");

        return view('dashboard/module/order_wachtagent_plugin.blade.php', ['singleModule' => $singleModule]);
    }

}


