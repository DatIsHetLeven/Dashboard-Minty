<?php

namespace App\Http\Controllers\Connection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Connection\fsnl_api;

class fsnl_api_Controller extends Controller
{
    //
    public function connect(){
    $request = new fsnl_api('https://www.factuursturen.nl/api/v1/clients', 'GET');
    $request->setUsername('testtt');
    $request->setPassword('Hallo123!');

    // build the post body we are going to submit
    $request->buildPostBody(array(
        'code' => 'Soundboard-50S',
        'name' => 'Flash Soundboard 50 Samples',
        'price' => 39.95,
        'taxes' => 20
    ));
    
    $request->execute();
    $request->getResponseBody();
    $request->getResponseInfo();
    }

    



}
