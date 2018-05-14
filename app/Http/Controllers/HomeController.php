<?php

namespace App\Http\Controllers;

use App\Libraries\Utilities;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data
        $data = Utilities::customerBehaviour();
        return view('home', compact('data'));
    }
}
