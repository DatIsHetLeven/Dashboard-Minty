<?php
namespace App\Http\Controllers;
use App\Http\Controllers\UserController;

use App\Models\User;

use Illuminate\Http\Request;

//Deze class wordt niet gebruikt - minty pawel
use Validator;
use Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function renderDashboard () {
        $user = UserController::getByCookie();
        return view('dashboard/dashboard', ['test123' => $user]);
    }


//    niet gebruikte functie - minty pawel
    function checkLogin(Request $request)
    {
//        niet juiste maniier van de laravel validate - minty pawel
        $this->validate($request, [
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

    public function resetPassword()
    {
        return view('auth/passwords/resettest');
    } 
}
