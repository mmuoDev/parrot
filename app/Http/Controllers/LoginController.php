<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;

class LoginController extends Controller
{
    //
    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;

        //Make API call and store in sessions
        return redirect()->route('home');
    }
}
