<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    //
    public function __construct()
    {
        //return $this->middleware('auth');
    }

    public function fund(Request $request){
        $method = $request->isMethod('post');
        if($method){
            //process
        }else{
            return view('wallet.fund');
        }
    }

}
