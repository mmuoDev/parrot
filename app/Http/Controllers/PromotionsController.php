<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Libraries\Utilities;
use App\SmsLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\PromotionCategory;

class PromotionsController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index(Request $request){
        $method = $request->isMethod('post');
        if($method){
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $category_id = $request->category_id;
            $message = $request->message;

            //main validation
            $validator = Validator::make($request->all(), [
                'category_id' => 'required',
                'message' => 'required|max:100'
            ]);

            //validate dates if any is set
            if(isset($start_date) || isset($end_date)){
                $validator = Validator::make($request->all(), [
                    'start_date' => 'required|date_format:d/m/Y',
                    'end_date' => 'required|date_format:d/m/Y',
                ],[
                    'start_date.required' => 'A start date is required',
                    'end_date.required' => 'An end date is required'
                ]);
            }
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            //format the dates
            $date1 = strtr($request->from, '/', '-');
            $from = date('Y-m-d', strtotime($date1));
            $date2 = strtr($request->to, '/', '-');
            $to = date('Y-m-d', strtotime($date2));
            //formatting ends

            //start processing
            $success = 0;
            $failed = 0;
            if($category_id == 1){ //all customers
                if(isset($start_date, $end_date)){
                    $customers = DB::select("select * from customers where date(created_at) between '$from' and '$to'");
                }else{
                    $customers = Customer::all();
                }
                //send SMS here
//                $success = 0;
//                $failed = 0;
//                foreach ($customers as $customer){
//                    $res = Utilities::sendSMS($customer->phone_number, $message);
//                    if($res == true){ //sent
//                        $success++;
//                    }elseif ($res == false){ //not sent
//                        $failed++;
//                    }
//                }
            }elseif ($category_id == 2){ //Customers With Most Number of Purchases
                if(isset($start_date, $end_date)){
                    $customers = DB::select("select count(p.id) as count, c.phone_number from purchase_logs as p, customers as c
                    WHERE c.id = p.customer_id and date(created_at) between '$from' and '$to'group by customer_id order by count DESC LIMIT 5");
                }else{
                    $customers = DB::select("select count(p.id) as count, c.phone_number from purchase_logs as p, customers as c
                    WHERE c.id = p.customer_id group by customer_id order by count DESC LIMIT 5");
                }
                //send sms here
//                $success = 0;
//                $failed = 0;
//                foreach ($customers as $customer){
//                    $res = Utilities::sendSMS($customer->phone_number, $message);
//                    if($res == true){ //sent
//                        $success++;
//                    }elseif ($res == false){ //not sent
//                        $failed++;
//                    }
//                }
            }elseif ($category_id == 3){ //Customers With Least Number of Purchases
                if(isset($start_date, $end_date)){
                    $customers = DB::select("select count(p.id) as count, c.phone_number from purchase_logs as p, customers as c
                    WHERE c.id = p.customer_id and date(created_at) between '$from' and '$to'group by customer_id order by count ASC LIMIT 5");
                }else{
                    $customers = DB::select("select count(p.id) as count, c.phone_number from purchase_logs as p, customers as c
                    WHERE c.id = p.customer_id group by customer_id order by count ASC LIMIT 5");
                }
                //send sms here
//                $success = 0;
//                $failed = 0;
//                foreach ($customers as $customer){
//                    $res = Utilities::sendSMS($customer->phone_number, $message);
//                    if($res == true){ //sent
//                        $success++;
//                    }elseif ($res == false){ //not sent
//                        $failed++;
//                    }
//                }
            }elseif ($category_id == 4){ //Customers With Most Amount Spent
                if(isset($start_date, $end_date)){
                    $customers = DB::select("select sum(p.total) as total, c.phone_number from purchases as p, customers c
                    where p.customer_id = c.id and date(created_at) between '$from' and '$to' group by p.customer_id order by total DESC LIMIT 5");
                }else{
                    $customers = DB::select("select sum(p.total) as total, c.phone_number from purchases as p, customers c
                    where p.customer_id = c.id group by p.customer_id order by total DESC LIMIT 5");
                }
                //send sms here
//                $success = 0;
//                $failed = 0;
//                foreach ($customers as $customer){
//                    $res = Utilities::sendSMS($customer->phone_number, $message);
//                    if($res == true){ //sent
//                        $success++;
//                    }elseif ($res == false){ //not sent
//                        $failed++;
//                    }
//                }
            }elseif ($category_id == 5){ //Customers With Least Amount Spent
                if(isset($start_date, $end_date)){
                    $customers = DB::select("select sum(p.total) as total, c.phone_number from purchases as p, customers c
                    where p.customer_id = c.id and date(created_at) between '$from' and '$to' group by p.customer_id order by total ASC LIMIT 5");
                }else{
                    $customers = DB::select("select sum(p.total) as total, c.phone_number from purchases as p, customers c
                    where p.customer_id = c.id group by p.customer_id order by total ASC LIMIT 5");
                }
                //send sms here
//                $success = 0;
//                $failed = 0;
//                foreach ($customers as $customer){
//                    $res = Utilities::sendSMS($customer->phone_number, $message);
//                    if($res == true){ //sent
//                        $success++;
//                    }elseif ($res == false){ //not sent
//                        $failed++;
//                    }
//                }
            }else{}
            //log SMS report
            SmsLog::create([
                'user_id' => Auth::user()->id,
                'success' => $success,
                'failed' => $failed,
                'category_id' => $category_id,
                'message' => $message
            ]);
            //show message
            $request->session()->flash('success', 'SMS sent!');
            return back();
        }else{
            $categories = PromotionCategory::all();
            return view('promotions.index', compact('categories'));
        }
    }
}
