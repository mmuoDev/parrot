<?php

namespace App\Http\Controllers;

use App\Libraries\Utilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportsController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function most_number_purchases(Request $request){
        $method = $request->isMethod('post');
        if($method){
            //process
            //dd($request->all());
            $validator = Validator::make($request->all(), [
                'from' => 'date_format:d/m/Y',
                'to' => 'date_format:d/m/Y'
            ]);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            //format the date
            if(!empty($request->from) && !empty($request->to)){
                //dd("true");
                $date1 = strtr($request->from, '/', '-');
                $from = date('Y-m-d', strtotime($date1));
                $date2 = strtr($request->to, '/', '-');
                $to = date('Y-m-d', strtotime($date2));
            }else{
                $from = null;
                $to = null;
            }
            $results = Utilities::mostNumberOfPurchases($from, $to);
            return view('reports.customers.most_number_purchases')->with('data', json_encode($results, JSON_NUMERIC_CHECK));
        }else{
            $results = Utilities::mostNumberOfPurchases();
            return view('reports.customers.most_number_purchases')->with('data', json_encode($results, JSON_NUMERIC_CHECK));
        }
    }
    public function most_amount_purchases(Request $request){
        $method = $request->isMethod('post');
        if($method){
            //process
            //dd($request->all());
            $validator = Validator::make($request->all(), [
                'from' => 'date_format:d/m/Y',
                'to' => 'date_format:d/m/Y'
            ]);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            //format the date
            if(!empty($request->from) && !empty($request->to)){
                //dd("true");
                $date1 = strtr($request->from, '/', '-');
                $from = date('Y-m-d', strtotime($date1));
                $date2 = strtr($request->to, '/', '-');
                $to = date('Y-m-d', strtotime($date2));
            }else{
                $from = null;
                $to = null;
            }
            $results = Utilities::mostAmountSpent($from, $to);
            return view('reports.customers.most_amount_purchases')->with('data', json_encode($results, JSON_NUMERIC_CHECK));
        }else{
            $results = Utilities::mostAmountSpent();
            return view('reports.customers.most_amount_purchases')->with('data', json_encode($results, JSON_NUMERIC_CHECK));
        }
    }
    public function least_number_purchases(Request $request){
        $method = $request->isMethod('post');
        if($method){
            //process
            //dd($request->all());
            $validator = Validator::make($request->all(), [
                'from' => 'date_format:d/m/Y',
                'to' => 'date_format:d/m/Y'
            ]);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            //format the date
            if(!empty($request->from) && !empty($request->to)){
                //dd("true");
                $date1 = strtr($request->from, '/', '-');
                $from = date('Y-m-d', strtotime($date1));
                $date2 = strtr($request->to, '/', '-');
                $to = date('Y-m-d', strtotime($date2));
            }else{
                $from = null;
                $to = null;
            }
            $results = Utilities::leastNumberOfPurchases($from, $to);
            return view('reports.customers.least_number_purchases')->with('data', json_encode($results, JSON_NUMERIC_CHECK));
        }else{
            $results = Utilities::leastNumberOfPurchases();
            return view('reports.customers.least_number_purchases')->with('data', json_encode($results, JSON_NUMERIC_CHECK));
        }
    }
    public function least_amount_purchases(Request $request){
        $method = $request->isMethod('post');
        if($method){
            //process
            //dd($request->all());
            $validator = Validator::make($request->all(), [
                'from' => 'date_format:d/m/Y',
                'to' => 'date_format:d/m/Y'
            ]);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            //format the date
            if(!empty($request->from) && !empty($request->to)){
                //dd("true");
                $date1 = strtr($request->from, '/', '-');
                $from = date('Y-m-d', strtotime($date1));
                $date2 = strtr($request->to, '/', '-');
                $to = date('Y-m-d', strtotime($date2));
            }else{
                $from = null;
                $to = null;
            }
            $results = Utilities::leastAmountSpent($from, $to);
            return view('reports.customers.least_amount_purchases')->with('data', json_encode($results, JSON_NUMERIC_CHECK));
        }else{
            $results = Utilities::leastAmountSpent();
            return view('reports.customers.least_amount_purchases')->with('data', json_encode($results, JSON_NUMERIC_CHECK));
        }
    }

    public function customers_by_location(Request $request){
        $method = $request->isMethod('post');
        if($method){
            $validator = Validator::make($request->all(), [
                'from' => 'date_format:d/m/Y',
                'to' => 'date_format:d/m/Y'
            ]);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            //format the date
            if(!empty($request->from) && !empty($request->to)){
                //dd("true");
                $date1 = strtr($request->from, '/', '-');
                $from = date('Y-m-d', strtotime($date1));
                $date2 = strtr($request->to, '/', '-');
                $to = date('Y-m-d', strtotime($date2));
            }else{
                $from = null;
                $to = null;
            }
            $results = Utilities::customers_by_location($from, $to);
            return view('reports.customers.by_locations')->with('data', json_encode($results, JSON_NUMERIC_CHECK));
        }else{
            $results = Utilities::customers_by_location();
            return view('reports.customers.by_locations')->with('data', json_encode($results, JSON_NUMERIC_CHECK));
        }
    }
}
