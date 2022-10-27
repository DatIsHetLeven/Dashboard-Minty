<?php

namespace App\Http\Middleware;

use App\Http\Controllers\HomeController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

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
        //Check if cookie sessie geldig is
        $homeController = new HomeController();
        if (!isset($_COOKIE['user'])) {
            return redirect()->route('welcome');
        }
        if (isset($_COOKIE['user'])){
            if ($homeController->checkCookieToken($_COOKIE['user']) === false) return redirect()->route('welcome');
        }

        return $next($request);
    }
}
