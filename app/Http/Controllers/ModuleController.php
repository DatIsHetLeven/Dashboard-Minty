<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Connection\MintyBol_API\MintyBolController;


class ModuleController extends Controller
{
    public function GetAllModules(){
        $MintyBolApi = new MintyBolController();
        $alleModules = $MintyBolApi->GetAllModules();

        $logs = $this->GetLog();

        return view('dashboard/module/allemodules', ['allUsers' => $alleModules, 'allLogs' => $logs]);
    }
    public function GetLog(){
        $MintyBolApi = new MintyBolController();
        $singleModule = $MintyBolApi->GetLogs();

        return $singleModule;

    }

    public function GetSingleModule($id){
        $MintyBolApi = new MintyBolController();
        $singleModule = $MintyBolApi->GetSingleModule($id);


        if ($id === 'bol.mintyconnect.order.wachtagent')return view('dashboard/module/orderWachtagentPlugin', ['singleModule' => $singleModule]);
        if ($id === 'bol.mintyconnect.product.wachtagent')return view('dashboard/module/productWachtagentPlugin', ['singleModule' => $singleModule]);

        return view('dashboard/module/permodule', ['singleModule' => $singleModule]);
    }

    public function getWachtagentPlugin(){
        $MintyBolApi = new MintyBolController();
        $singleModule = $MintyBolApi->GetSingleModule("bol.mintyconnect.order.wachtagent");

        return view('dashboard/module/order_wachtagent_plugin.blade.php', ['singleModule' => $singleModule]);
    }




}


