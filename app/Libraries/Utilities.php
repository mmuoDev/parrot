<?php
/**
 * Created by PhpStorm.
 * User: uche
 * Date: 4/25/18
 * Time: 1:10 PM
 */
namespace App\Libraries;

use App\Customer;
use App\Mail\notifyNewUser;
use App\Mail\notifyNewUsers;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Utilities
{
    //get role
    public static function getUserRole($user_id){
        //get role first
        $role_id = User::where('id', $user_id)->first()->role_id;
        $role = Role::where('id', $role_id)->first()->role;
        return $role;
    }
    //today's new customer
    public static function getTodayNewCustomers($date = null){
        if($date == null){
            $customers = DB::select("select count(id) as count from customers WHERE date(created_at) = CURDATE()");
        }else{
            $customers = DB::select("select count(id) as count from customers WHERE date(created_at) = '$date'");
        }
        return $customers[0]->count;
    }
    //today's total customer
    public static function getTodayTotalCustomers(){
        $customers = DB::select("select count(DISTINCT customer_id) as count from purchase_logs WHERE date(created_at) = CURDATE()");
        return $customers[0]->count;
    }
    //today amount spent today
    public static function totalAmountSpentToday(){
        $total = DB::select("select sum(total) as total from purchases where date(created_at) = CURDATE()");
        return $total[0]->total;
    }

    //New customers for the last 7 days
    public static function get7daysNewCustomers(){
        $customers = DB::select("select count(id) as count from customers WHERE 
        DATE(created_at) BETWEEN DATE(NOW())-INTERVAL 7 DAY AND DATE(NOW())");
        return $customers[0]->count;
    }
    //total customers for the last 7 days
    public static function get7daysTotalCustomers(){
        $customers = DB::select("select count(DISTINCT customer_id) as count from purchase_logs WHERE  
        DATE(created_at) BETWEEN DATE(NOW())-INTERVAL 7 DAY AND DATE(NOW())");
        return $customers[0]->count;
    }
    //total amount spent for the last 7 days
    public static function totalAmountSpent7days(){
        $total = DB::select("select sum(total) as total from purchases where DATE(created_at) BETWEEN DATE(NOW())-INTERVAL 7 DAY AND DATE(NOW())");
        return $total[0]->total;
    }
    //customer behavior
    public static function customerBehaviour(){
        $data = DB::select("select date(created_at) as tdate, count(DISTINCT customer_id) as count, sum(total) as total from purchases
        group by date(created_at)");
        return $data;
    }
    public static function sendSMS($phone, $message){
        $owneremail=env('owneremail');
        $subacct=env('subacct');
        $subacctpwd=env('subacctpwd');
        $sendto= $phone; /* destination number */
        $sender= Auth::user()->sms_sender_id; /* sender id */
        $message= $message;
        /* message to be sent */
        /* create the required URL */
        $url = "http://www.smslive247.com/http/index.aspx?"
            . "cmd=sendquickmsg"
            . "&owneremail=" . UrlEncode($owneremail)
            . "&subacct=" . UrlEncode($subacct)
            . "&subacctpwd=" . UrlEncode($subacctpwd)
            . "&message=" . UrlEncode($message)
            . "&sendto=" . UrlEncode($sendto);
        /* call the URL */
        if ($f = @fopen($url, "r")){
            $answer = fgets($f, 255);
            if (substr($answer, 0, 1) == "OK"){
                //echo "SMS to $dnr was successful.";
                return true;
            } else{
                //echo "an error has occurred: [$answer].".$sendto;
                return false;
            }
            //echo "url working";
        }else{
            //return false;

        }
    }
    public static function customers_by_location($from = null, $to = null){
        if($from == null || $to == null){
            $queries = DB::select("select l.location, COUNT(c.id) as count from customers as c, locations as l WHERE c.location_id = l.id
        group by c.location_id");
        }else{
            $queries = DB::select("select l.location, COUNT(c.id) as count from customers as c, locations as l WHERE c.location_id = l.id and 
        date(c.created_at) BETWEEN '$from' and '$to' group by c.location_id");
        }
        $array = [];
        foreach ($queries as  $query){
            $array[] = ['name' => $query->location, 'y' => $query->count];
        }
        return $array;
    }
    //email newly created user
    public static function  notifyNewUser($email, $content){
        Mail::to($email)->send(new notifyNewUser($content));
    }
    //
    public static function mostNumberOfPurchases($from = null, $to = null){
        if($from == null || $to == null){
            $queries = DB::select("select count(id) as count, customer_id from purchase_logs
       group by customer_id order by count DESC LIMIT 5");
        }else{
            $queries = DB::select("select count(id) as count, customer_id from purchase_logs
        where date(created_at) between '$from' and '$to' group by customer_id order by count DESC LIMIT 5");
        }
        //dd($queries);
        foreach ($queries as $query){
            $categories[] = ucwords(Customer::where('id', $query->customer_id)->first()->customer_name);
            $count[] = $query->count;
            $customer_ids[] = $query->customer_id;
        }
        if($from == null || $to == null){
            $name = 'All time';
        }else{
            $name = date('d-m-Y', strtotime($from)).' to '.date('d-m-Y', strtotime($to));
        }
        //ensure error is not thrown if queries are empty
        $count = isset($count)?$count:"";
        $categories = isset($categories)?$categories:"";
        $customer_ids = isset($customer_ids)?$customer_ids:"";
        //ends
        $series = ['name' => $name, 'data' => $count];
        $data = [$categories, $series, $customer_ids];
        //dd($data);
        return $data;
    }
    public static function leastNumberOfPurchases($from = null, $to = null){
        if($from == null || $to == null){
            $queries = DB::select("select count(id) as count, customer_id from purchase_logs
       group by customer_id order by count ASC LIMIT 5");
        }else{
            $queries = DB::select("select count(id) as count, customer_id from purchase_logs
        where date(created_at) between '$from' and '$to' group by customer_id order by count ASC LIMIT 5");
        }
        //dd($queries);
        foreach ($queries as $query){
            $categories[] = ucwords(Customer::where('id', $query->customer_id)->first()->customer_name);
            $count[] = $query->count;
            $customer_ids[] = $query->customer_id;
        }
        if($from == null || $to == null){
            $name = 'All time';
        }else{
            $name = date('d-m-Y', strtotime($from)).' to '.date('d-m-Y', strtotime($to));
        }
        //ensure error is not thrown if queries are empty
        $count = isset($count)?$count:"";
        $categories = isset($categories)?$categories:"";
        $customer_ids = isset($customer_ids)?$customer_ids:"";
        //ends
        $series = ['name' => $name, 'data' => $count];
        $data = [$categories, $series, $customer_ids];
        //dd($data);
        return $data;
    }
    public static function mostAmountSpent($from = null, $to = null){
        if($from == null || $to == null){
            $queries = DB::select("select sum(total) as total, customer_id from purchases
       group by customer_id order by total DESC LIMIT 5");
        }else{
            $queries = DB::select("select sum(total) as total, customer_id from purchases
        where date(created_at) between '$from' and '$to' group by customer_id order by total DESC LIMIT 5");
        }
        //dd($queries);
        foreach ($queries as $query){
            $categories[] = ucwords(Customer::where('id', $query->customer_id)->first()->customer_name);
            $count[] = $query->total;
            $customer_ids[] = $query->customer_id;
        }
        if($from == null || $to == null){
            $name = 'All time';
        }else{
            $name = date('d-m-Y', strtotime($from)).' to '.date('d-m-Y', strtotime($to));
        }
        //ensure error is not thrown if queries are empty
        $count = isset($count)?$count:"";
        $categories = isset($categories)?$categories:"";
        $customer_ids = isset($customer_ids)?$customer_ids:"";
        //ends
        $series = ['name' => $name, 'data' => $count];
        $data = [$categories, $series, $customer_ids];
        //dd($data);
        return $data;
    }
    public static function leastAmountSpent($from = null, $to = null){
        if($from == null || $to == null){
            $queries = DB::select("select sum(total) as total, customer_id from purchases
       group by customer_id order by total ASC LIMIT 5");
        }else{
            $queries = DB::select("select sum(total) as total, customer_id from purchases
        where date(created_at) between '$from' and '$to' group by customer_id order by total ASC LIMIT 5");
        }
        //dd($queries);
        foreach ($queries as $query){
            $categories[] = ucwords(Customer::where('id', $query->customer_id)->first()->customer_name);
            $count[] = $query->total;
            $customer_ids[] = $query->customer_id;
        }
        if($from == null || $to == null){
            $name = 'All time';
        }else{
            $name = date('d-m-Y', strtotime($from)).' to '.date('d-m-Y', strtotime($to));
        }
        //ensure error is not thrown if queries are empty
        $count = isset($count)?$count:"";
        $categories = isset($categories)?$categories:"";
        $customer_ids = isset($customer_ids)?$customer_ids:"";
        //ends
        $series = ['name' => $name, 'data' => $count];
        $data = [$categories, $series, $customer_ids];
        //dd($data);
        return $data;
    }
    //email new companies
    public static function  notifyNewUsers($email, $content){
        Mail::to($email)->send(new notifyNewUsers($content));
    }
    //get total purchases for a customer
    public static function getTotalPurchasePerCustomer($customer_id){
        $total = DB::select("select SUM(total) as total from purchases where customer_id = '$customer_id' group by '$customer_id'");
        $getTotal = isset($total[0])?$total[0]->total: 0;
        return $getTotal;
    }

    public static function getCustomerPurchases($customer_id){
        //get purchases for this customer
        $purchases = DB::select("select p.product, p.price, p.quantity, p.total, p.created_at as created from purchases as p, customers as c 
        where p.customer_id = c.id and
        c.phone_number = '$customer_id' order by p.created_at DESC");
        return $purchases;
    }

    public static function getTotalCustomers(){
        $count = Customer::all()->count();
        return $count;
    }
}