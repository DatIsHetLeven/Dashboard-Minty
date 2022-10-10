<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\statusdetails;
use App\Models\factuursturen;
use App\Http\Controllers\Connection\fsnl_api_Controller;


class ProductController extends Controller
{
    //
    public function getAllProducts(){
        $fSApi = new fsnl_api_Controller();

        $alleProducten = $fSApi->getAllProducts();

        $fsClient = json_decode($alleProducten);


        return view('dashboard/setting/alleproducten')->with(['alleProducten'=> $fsClient]);
    }
}
