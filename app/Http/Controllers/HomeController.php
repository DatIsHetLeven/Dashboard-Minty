<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    function checkLogin(Request $request)
    {
        $this->valildate($request, [
        'userName'      => 'required',
        'password'      => 'required' 
        ]);

        $user_data = array(
            'userName'  =>  $request->get('userName'),
            'password'  =>  $request->get('password'),
        );

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
