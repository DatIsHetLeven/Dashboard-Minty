<?php

namespace App\Http\Controllers\Connection\Fs_Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Connection\Fs_API\fsnl_api;

class fsnl_api_Controller extends Controller
{

    private string $baseUrl;
    private fsnl_api $fSApi;

    public function  __construct(){

        $this->fSApi = new fsnl_api();
        $this->baseUrl = 'https://www.factuursturen.nl/api/v1/';

        $this->fSApi->setUsername('mintyarthur');
        $this->fSApi->setPassword('rS21906MiqgIFUSvQzayLHK7GLxRyqQPunFjzJNa');
    }

    private function urlBuilder($path) {
        return $this->baseUrl . $path;
    }
    //Stuur gebruiker naar Factuurtsuren
    public function CreateNewClient($clientData){
        $this->fSApi->setUrl($this->urlBuilder('clients'));
        $this->fSApi->setVerb("POST");
        $this->fSApi->buildPostBody($clientData);

        $this->fSApi->execute();
        if( $this->fSApi->getResponseInfo()['http_code']  > 299) {

            dump('het is niet gelukt :)');
            dd($this->fSApi);
            return false;
        }

        return $this->fSApi->getResponseBody();
    }

        //Haal gebruiker uit Fs op
        public function getFactuursturenUser($fsId){

            $test = $this->fSApi->setUrl($this->urlBuilder("clients/$fsId"));
            $this->fSApi->setVerb("GET");

            $this->fSApi->execute();

            if( $this->fSApi->getResponseInfo()['http_code']  > 299) {

                dump('het is niet gelukt :)');
                dd($this->fSApi);
                return false;
            }
            return $this->fSApi->getResponseBody();
        }

        //Haal alle producten op uit FS
        public function getAllProducts(){
            $this->fSApi->setUrl($this->urlBuilder('products'));
            $this->fSApi->setVerb("GET");

            $this->fSApi->execute();

            if( $this->fSApi->getResponseInfo()['http_code']  > 299) {

                dump('het is niet gelukt :)');
                dd($this->fSApi);
                return false;
            }

            return $this->fSApi->getResponseBody();
        }

        //Haal alle producten op uit FS
        public function getSingleProduct($productId){
            $this->fSApi->setUrl($this->urlBuilder("products/$productId"));
            $this->fSApi->setVerb("GET");

            $test = $this->fSApi->execute();

            if( $this->fSApi->getResponseInfo()['http_code']  > 299) {

                dump('het is niet gelukt :)');
                dd($this->fSApi);
                return false;
            }

            return $this->fSApi->getResponseBody();
        }

        //Haal alle producten op uit FS
        public function updateSingleProduct($updatedProduct, $productId){

            $productId = $productId;

            $this->fSApi->setUrl($this->urlBuilder("products/$productId"));
            $this->fSApi->setVerb("PUT");
            // $productJason = json_encode($updatedProduct);

            $this->fSApi->buildPostBody($updatedProduct);
            $this->fSApi->execute();

            if( $this->fSApi->getResponseInfo()['http_code']  > 299) {

                dump('het is niet gelukt :)');
                dd($this->fSApi);
                return false;
            }

            return $this->fSApi->getResponseBody();
        }


    public function createFactuurFS($id, $naam, $bolPrijs){
        $remove = array("{", "}","bolPrijs", '""', ":");
        $prijs = str_replace($remove, "", json_encode($bolPrijs));


        $newClient = [
            "clientnr" => $id,
            "lines" => array(
                array(
                    "amount" => 1,
                    "description" => "Minty Media's Bol-wooCommerce Koppeling",
                    "tax_rate" => 21,
                    "price" => 28,
                )
            ),
            "action" => "repeat",
           "initialdate" => date("Y-m-d"),
            "frequency" => "monthly",
            "repeattype" => "auto",
            "savename" => "BOLLERT_CUID_".$naam
        ];


        $this->fSApi->setUrl($this->urlBuilder('invoices'));
        $this->fSApi->setVerb("POST");
        $this->fSApi->buildPostBody($newClient);


        $this->fSApi->execute();

        if( $this->fSApi->getResponseInfo()['http_code']  > 299) {
            dump('het is niet gelukt :)');
            dd($this->fSApi);
            return false;
        }

        return $this->fSApi->getResponseBody();
    }

}
