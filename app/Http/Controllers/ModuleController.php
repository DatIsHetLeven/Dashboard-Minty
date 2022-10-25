<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Connection\MintyBol_API\MintyBolController;
use App\Http\Controllers\HomeController;
use App\Models\bolApi;
use Illuminate\Support\Facades\DB;


class ModuleController extends Controller
{
    public function GetAllModules(){
        $MintyBolApi = new MintyBolController();
        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();
        //Get bolUserId (userid from arthurs api)
        $bolUser = DB::table('bolApi')
            ->where('userId', '=', $loggedUser->userId)->first();

        $alleModules = $MintyBolApi->GetAllModules();

        $logs = $this->GetLog();


        $CheckModuleArray = array();
        for ($x = 0; $x < count($alleModules); $x++){
            $boolModule = $MintyBolApi->CheckModuleBolUser($bolUser->userIdApi, $alleModules[$x]->identifier);
            $CheckModuleArray[] = $boolModule;
        }

        return view('dashboard/module/allemodules', ['allUsers' => $alleModules, 'allLogs' => $logs, 'boolModule' =>$CheckModuleArray]);
    }
    public function GetLog(){
        $MintyBolApi = new MintyBolController();
        $singleModule = $MintyBolApi->GetLogs();

        return $singleModule;

    }



    //Toon de correcte module
    public function GetSingleModule($moduleNaam){
        $MintyBolApi = new MintyBolController();
        $singleModule = $MintyBolApi->getSingleModuleUser();


        if ($moduleNaam === 'bol.mintyconnect.order.wachtagent')return view('dashboard/module/orderWachtagentPlugin', ['singleModule' => $singleModule[0]]);
        if ($moduleNaam === 'bol.mintyconnect.product.wachtagent') return view('dashboard/module/productWachtagentPlugin', ['singleModule' => $singleModule[1]]);

        return view('dashboard/module/permodule', ['singleModule' => $singleModule]);
    }
    //Enable 1 module
    public function EnableSingleModule($moduleNaam){

        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();
        //Get bolUserId (userid from arthurs api)

        $bolUser = $homeController->getUserBolId($loggedUser->userId);

//        $bolUser = DB::table('bolApi')
//            ->where('userId', '=', $loggedUser->userId)->first();
        $MintyBolApi = new MintyBolController();
        $MintyBolApi->CreateModuleBolUser($bolUser->userIdApi, $moduleNaam);

        return redirect()->route('GetAllModules');
    }
    //Disable 1 module
    public function DisableSingleModule($moduleNaam){
        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();

        $bolUser = $homeController->getUserBolId($loggedUser->userId);

        $MintyBolApi = new MintyBolController();
        $MintyBolApi->deleteModuleBolUser($bolUser->userIdApi, $moduleNaam);

        return redirect()->route('GetAllModules');
    }


    public function getWachtagentPlugin(){
        $MintyBolApi = new MintyBolController();
        $singleModule = $MintyBolApi->GetSingleModule("bol.mintyconnect.order.wachtagent");

        return view('dashboard/module/order_wachtagent_plugin.blade.php', ['singleModule' => $singleModule]);
    }




}


