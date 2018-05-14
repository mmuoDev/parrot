<?php

namespace App\Http\Controllers;

use App\Location;
use App\LocationLog;
use App\Product;
use App\ProductChangeLog;
use App\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth');
    }
    //
    public function sms_sender_id(Request $request){
        $method = $request->isMethod('post');
        if($method){

            //process
            $user_id = Auth::user()->id;
            $sender_id = $request->sms_sender_id;
            $user = User::find($user_id);
            //either create or update sender id.
            if(isset($request->create)){
                //create sender id
                $validator = Validator::make($request->all(), [
                    'sms_sender_id' => 'required|max:6'
                ]);
                if($validator->fails()){
                    return back()->withErrors($validator)->withInput();
                }
                $user->sms_sender_id = $sender_id;
                $user->save();
                $request->session()->flash('success', 'Sender ID has been added!');
                return redirect()->route('sms_sender');
            }elseif (isset($request->update)){
                //update sender id
                $validator = Validator::make($request->all(), [
                    'sms_sender_id' => 'required|max:6|unique:users'
                ]);
                if($validator->fails()){
                    return back()->withErrors($validator)->withInput();
                }
                $user->sms_sender_id = $sender_id;
                $user->save();
                $request->session()->flash('success', 'Sender ID has been updated!');
                return redirect()->route('sms_sender');
            }else{}
        }else{
            return view('settings.sms_sender_id');
        }
    }
    public function location(Request $request){
        $states = State::all();
        $method = $request->isMethod('post');
        if($method){
            //process
            $validator = Validator::make($request->all(), [
                'location' => 'required',
                'state_id' => 'required'
            ]);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $check = Location::where(['state_id' => $request->state_id, 'location' => $request->location])->count();
            if($check == 1){
                return back()->withErrors("This location already exists");
            }
            //new record
            Location::create([
                'state_id' => $request->state_id,
                'location' => $request->location
            ]);
            $notification = array(
                'notify' => 'Location added!',
                'alert-type' => 'success'
            );
//            $locations = DB::select("select s.name as state, l.id as location_id, l.state_id as state_id, l.location as location from
//            locations as l, states as s where l.state_id = s.id order by l.created_at DESC");

            //return back()->with($notification);
            $request->session()->flash('success', 'Location has been added!');
            return redirect()->route('locations')->with($notification);
            //return view('settings.location', compact('states', 'locations'));
        }else{
            $locations = DB::select("select s.name as state, l.id as location_id, l.state_id as state_id, l.location as location from 
            locations as l, states as s where l.state_id = s.id order by l.created_at DESC");
            return view('settings.location', compact('states', 'locations'));
        }
    }

    public function update_location(Request $request){
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'location' => 'required',
            'state_id' => 'required'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $check = Location::where(['state_id' => $request->state_id, 'location' => $request->location]);
        if(isset($check)){
            $count = $check->count();
        }
        if($count == 1){
            $state = State::where('id', $request->state_id)->first()->name;
            return back()->withErrors("This location -". $request->location." already exists in ".$state." state");
        }
        $location = Location::find($request->location_id);
        $location->location = $request->location;
        $location->state_id = $request->state_id;
        $location->save();
        //log changes
        LocationLog::create([
            'location' => $request->location,
            'state_id' => $request->state_id,
            'location_id' => $request->location_id,
            'user_id' => Auth::user()->id,
        ]);
        //
        $request->session()->flash('success', 'Changes have been saved!');
        return redirect()->route('locations');
    }
    public function products(Request $request){
        $method = $request->isMethod('post');
        if($method){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:products',
                'price' => 'required|numeric'
            ],[
                'name.unique' => $request->name." already exists"
            ]);
            if($validator->fails()){
                return back()->withErrors($validator);
            }
            //
            Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'status_id' => 1 //add to stock
            ]);
            $request->session()->flash('success', $request->name.' has been added!');
            return redirect()->route('products');
        }else{
            $products = Product::orderBy('id', 'DESC')->get();
            return view('settings.products', compact('products'));
        }
    }

    public function update_product(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }
        $check = Product::where([
            'name' => $request->name,
            'price' => $request->price
        ]);
        if(isset($check)){
            $count = $check->count();
        }
        if($count == 1){
            return back()->withErrors("This product already exists");
        }
        $product = Product::find($request->product_id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();
        //log changes
        ProductChangeLog::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::user()->id,
            'product_name' => $request->name,
            'price' => $request->price
        ]);
        //flash
        $request->session()->flash('success', 'Changes have been saved!');
        return redirect()->route('products');
    }

    public function update_product_status(Request $request){
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        if(isset($request->remove_stock)){
            $product->status_id = 2;
            $product->save();
        }elseif ($request->add_stock){
            $product->status_id = 1;
            $product->save();
        }else{}
        $request->session()->flash('success', 'Changes have been saved!');
        return redirect()->route('products');
    }
}
