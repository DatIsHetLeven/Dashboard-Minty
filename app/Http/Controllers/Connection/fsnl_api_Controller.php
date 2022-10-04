<?php

namespace App\Http\Controllers\Connection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Connection\fsnl_api;

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




}
