<?php

namespace App\Http\Middleware;

use App\Http\Controllers\HomeController;
use Closure;
use Illuminate\Http\Request;

class CheckUser
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
        //dd("test");

            //Check if cookie sessie geldig is
        $homeController = new HomeController();
        if($homeController->checkCookieToken($_COOKIE['user']) === false) return redirect()->route('welcome');
        //dd($_COOKIE['user']);
        return $next($request);
    }
}
