<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Connection\MintyBol_API\MintyBolController;
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

        $bool = $MintyBolController->CheckIfBolUserExist();
        //dd($bool);
        if ($bool == false) return redirect()->route('persoonsgegevens')->with(['error'=> "Om de Modules te gebruiken moet je eerste je website koppelen!"]);;

        return $next($request);
    }
}
