<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class Authentication extends Controller {

    public function showLogin()
    {
        return view('auth/login');
    }

    public function doLogout()
    {
        Auth::logout();
        return view('auth/login');
    }

    public function doLogin()
    {

        $userdata = array(
            'login' => Input::get('login'),
            'password' => Input::get('password')
        );

        if (Auth::attempt($userdata)) {
            return redirect()->intended('');
        } else {
            return view('auth/login', ['error' => 'Jméno nebo heslo máte špatně zadané']);
        }
    }
}
