<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettlementsController extends Controller
{
    //
    public function index(Request $request){
        $method = $request->isMethod('post');
        if($method){
            //process
            return back();
        }else{
            //
            return view('settlements.index');
        }
    }
    public function create(Request $request){
        $method = $request->isMethod('post');
        if($method){
            //process
        }else{
            //
            return view('settlements.create');
        }
    }
}
