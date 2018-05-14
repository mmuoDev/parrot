<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Location;
use App\Purchase;
use App\PurchaseLog;
use App\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Product;

class TransactionsController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    //
    public function index(Request $request){
        //default transaction page
        $method = $request->isMethod('post');
        if($method){
            $validator = Validator::make($request->all(), [
                'phone' => 'required|numeric|digits:11'
            ]);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            return redirect()->route('transactions', ['id' => $request->phone]);
        }else{
            return view('transactions.index');
        }
    }
    //
    public function create(Request $request, $phone){
        $method = $request->isMethod('post');
        if($method){
            //process
            //dd($request->all());
            //all variables
            $customer_name = $request->customer_name;
            $customer_phone_number = $request->phone_number;
            $location_id = $request->location_id;
            $location = $request->location;
            $state_id = $request->state_id;
            $items = $request->item;

            $check = Customer::where('phone_number', $phone)->first();
            if(!isset($check)){
                $validator = Validator::make($request->all(), [
                    'customer_name' => 'required',
                    'phone_number' => 'required|numeric|digits:11|unique:customers'
                ],[
                    'customer_name.required' => 'Customer\'s name is needed',
                ]);
                if($validator->fails()){
                    return back()->withErrors($validator)->withInput();
                }
                //custom validations
                if($location_id == "" && $location == ""){
                    return back()->withErrors("A location is required!")->withInput();
                }
                if($location != "" && $state_id == ""){
                    return back()->withErrors("A state is required!")->withInput();
                }
            }

            if(isset($items)){ //purchase items
                foreach ($items as $key => $item){
                    $product_id = $item['item_id'];
                    $quantity = $item['quantity'];
                    if($product_id == ""){
                        return back()->withErrors("Please select a product!")->withInput();
                    }
                    if($quantity == ""){
                        return back()->withErrors("Please specify the quantity!")->withInput();
                    }
                }
            }
            //create records

            $check = Customer::where('phone_number', $phone)->first();
            if(!isset($check)){
                //check if to create location or not
                if($location_id != ""){
                    $location_id = $location_id;
                }else{
                    //create new location
                    $location = Location::create([
                        'state_id' => $state_id,
                        'location' => $location
                    ]);
                    $location_id = $location->id;
                }
                //dd("yehe");
                $customer = Customer::create([
                    'customer_name' => $customer_name,
                    'location_id' => $location_id,
                    'created_by' => Auth::user()->id,
                    'phone_number' => $customer_phone_number,
                ]);
                $customer_id = $customer->id;
            }else{
                $customer_id = Customer::where('phone_number', $phone)->first()->id;
            }
            //create purchase log
            $purchase_log = PurchaseLog::create([
                'customer_id' => $customer_id
            ]);
            $purchase_log_id = $purchase_log->id;
            //insert purchases
            if(isset($items)){
                foreach ($items as $key => $item){
                    $product_id = $item['item_id'];
                    $quantity = $item['quantity'];
                    $product = Product::where('id', $product_id)->first();
                    //create record
                    Purchase::create([
                        'product' => $product->name,
                        'price' => $product->price,
                        'quantity' => $quantity,
                        'total' => $product->price * $quantity,
                        'customer_id' => $customer_id,
                        'created_by' => Auth::user()->id,
                        'purchase_log_id' => $purchase_log_id
                    ]);
                }
            }
            //update last purchase for this customer
            $customer = Customer::find($customer_id);
            $customer->last_purchase = Carbon::now();
            $customer->save();

            $request->session()->flash('success', 'Record has been added!');
            return redirect()->route('transactions', ['id' => $phone]);
        }else{
            $count = Customer::where('phone_number', $phone)->count();
            $locations = Location::orderBy('id', 'DESC')->get();
            $states = State::all();
            $products = Product::where('status_id', 1)->get();
            //dd($count);
            return view('transactions.create', compact('count', 'locations', 'states', 'phone', 'products'));
        }
    }
}
