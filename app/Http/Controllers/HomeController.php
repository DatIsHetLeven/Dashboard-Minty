<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Deze class wordt niet gebruikt - minty pawel
use Validator;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

//    niet gebruikte functie - minty pawel
    function checkLogin(Request $request)
    {
//        niet juiste maniier van de laravel validate - minty pawel
        $this->valildate($request, [
        'userName'      => 'required',
        'password'      => 'required'
        ]);

        $user_data = array(
            'userName'  =>  $request->get('userName'),
            'password'  =>  $request->get('password'),
        );

//        De  auth class wordt niet geimportteerd
//        authenticatie moet gedaan worden in de router
        if(Auth::attempts($user_data))
        {
            return redirect('main/successlogin');
        }
        else
        {
            return bacl()->with('error', 'Gegevens onjuist');
        }

    }

    function succeslogin()
    {
        return view('succeslogin');
    }
}
