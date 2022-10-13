<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Connection\MintyBol_API\MintyBolController;


class ModuleController extends Controller
{
    public function GetAllModules(){
        $MintyBolApi = new MintyBolController();
        $alleModules = $MintyBolApi->GetAllModules();

        return view('dashboard/module/allemodules', ['allUsers' => $alleModules]);
    }

}


