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

    public function getSingleProduct($productId){
        $fSApi = new fsnl_api_Controller();
        $singleProduct = $fSApi->getSingleProduct($productId);
        
        $fsClient = json_decode($singleProduct);
        $fsClient = $fsClient->product;

        return view('dashboard/setting/productinfo')->with(['productInfo'=> $fsClient]);
    }

    public function updatePoduct($productId){
        $fSApi = new fsnl_api_Controller();
        if(isset($_POST['btnUpdateProduct'])){
            $code = $_POST['code'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $taxes = $_POST['taxes'];


            $updatePoduct = [];

            $updatePoduct = [
                'code' => $code,
                'name' => $name,
                'price' => $price,
                'taxes' => $taxes,
            ];

            $fSApi->updateSingleProduct($updatePoduct, $productId);

            return redirect()->route('alleproducten')->with(['succes'=> "Succesvol aangepast"]);

        }
        








        $singleProduct = $fSApi->getSingleProduct($productId);
        
        $fsClient = json_decode($singleProduct);
        $fsClient = $fsClient->product;

        return view('dashboard/setting/productinfo')->with(['productInfo'=> $fsClient]);
    }


}


