<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //

    public function confirm($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            //throw new InvalidConfirmationCodeException;

        }

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if ( ! $user)
        {
            //throw new InvalidConfirmationCodeException;
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

        //Flash::message('You have successfully verified your account.');

        return redirect()->route('login');
    }
}
