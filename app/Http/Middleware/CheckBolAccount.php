<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Connection\MintyBol_API\MintyBolController;
use App\Http\Controllers\HomeController;
use Closure;
use Illuminate\Http\Request;


class CheckBolAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //Check if cookie sessie geldig is
        $MintyBolController = new MintyBolController();
        $HomeController = new HomeController();

        //Controleren of gebruiker zowel bol als woo account hebben in de API
        $bool = $MintyBolController->CheckIfBolUserExist();
        $bool2 = $MintyBolController->CheckIfWooUserExist();
        $boolCheckBlock = $MintyBolController->checkBlokKlant();

        if ($boolCheckBlock == false)return redirect()->route('toonBolSetting')->with(['error'=> "API geblokkeerd, neem contact op met de klantenservice"]);
        if ($bool == false)return redirect()->route('toonBolSetting')->with(['error'=> "Om de Modules te gebruiken moet je eerst je bol account koppelen"]);
        if ($bool2 == false) return redirect()->route('toonBolSetting')->with(['error'=> "Om de Modules te gebruiken moet je eerste je Woo account koppelen"]);
        //Valideren of gebruiker het recht heeft om de modules in te zien.
        $boolValideerAccount = $HomeController->valideerUserRechten();

        if ($boolValideerAccount == false)return redirect()->route('dashboard')->with(['error'=> "Uw proefperiode is voorbij. Om gebruik blijven te maken van de koppelling, kunt u zich aten abonneren!"]);
        //Als account aanwezig zijn zet API op actief in de db.
        return $next($request);
    }
}
