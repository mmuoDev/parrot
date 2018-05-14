<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Libraries\Utilities;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class CustomersController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function purchases($phone){
        //get customer name
        $name = Customer::where('phone_number', $phone)->first()->customer_name;
        //get purchases for this customer
        $purchases = DB::select("select p.product, p.price, p.quantity, p.total, p.created_at as created from purchases as p, customers as c where p.customer_id = c.id and
        c.phone_number = '$phone' order by p.created_at DESC");
        return view('customers.purchases', compact('purchases', 'name'));
    }
    public function getdata(){
        $customers = DB::select("select * from customers order by created_at DESC");
        //dd($customers);
        return DataTables::of($customers)
            ->editColumn('s_n', function ($customers){
                $i = 1;
                return $i++;
            })->editColumn('name', function ($customers){
                return ucwords($customers->customer_name);
            })->editColumn('phone_number', function ($customers){
                return $customers->phone_number;
            })->editColumn('total_purchase', function ($customers){
                $total = Utilities::getTotalPurchasePerCustomer($customers->id);
                return number_format($total, 2);
            })->editColumn('date_joined', function ($customers){
                $date_joined = date('l jS \of F Y', strtotime($customers->created_at));
                return $date_joined;
            })->editColumn('last_purchase', function ($customers){
                $last_purchase = date('l jS \of F Y', strtotime($customers->last_purchase));
                return $last_purchase;
            })->editColumn('action', function ($customers){
                return '
                <a class="btn btn-default btn-sm" href="customers/purchases/'.$customers->phone_number.'"><i class="fa fa-history"></i></a>
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#'.$customers->id.'_"><i class="fa fa-envelope-open"></i></button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function index(Request $request){
        $method = $request->isMethod('post');
        if($method){
            //process
        }else{
            $customers = DB::select("select * from customers order by created_at DESC");
            return view('customers.index', compact('customers'));
        }
    }
    public function update(Request $request, $phone){
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required',
            'customer_phone_number' => 'required'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        //custom validation
        $location = $request->location;
        $state_id = $request->state_id;
        $phone_number = $request->customer_phone_number;
        //check if phone number already exists
        if($phone != $phone_number){
            $count = Customer::where('phone_number', $phone_number)->count();
            if($count > 0){
                return back()->withErrors("This phone number already exists");
            }
        }
        if(isset($location) && !isset($state_id)){
            //select a state
            return back()->withErrors("Please select a state!");
        }
        if(isset($state_id) && !isset($location)){
            return back()->withErrors("Please enter your location!");
        }
        if (isset($state_id) && isset($location)){
            //create new location
            $locations = Location::create([
                'state_id' => $state_id,
                'location' => $location
            ]);
            $location_id = $locations->id;
        }else{
            $location_id = $request->location_id;
        }
        //update customer details
        DB::table('customers')
            ->where('phone_number', $phone)
            ->update([
                'customer_name' => $request->customer_name,
                'location_id' => $location_id,
                'phone_number' => $phone_number,
            ]);
        $request->session()->flash('success', 'Customer details have been updated!');
        return redirect()->route('transactions', ['id' => $phone]);
    }
}
