<?php

namespace App\Http\Controllers;

use App\Libraries\Utilities;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\RoleUser;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function change_password(Request $request){
        $method = $request->isMethod('post');
        if($method){
            $password1 = $request->password1;
            $password2 = $request->password2;
            $validator = Validator::make($request->all(), [
                'password1' => 'required',
                'password2' => 'required'
            ]);
            if($validator->fails()){
                $notification = array(
                    'error' => 'Both fields are required!',
                    'alert-type' => 'error'
                );
                return back()->with($notification);

            }else if($password1 !== $password2){
                $notification = array(
                    'error' => 'Passwords must be the same!',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            }else{
                //Update password
                $user_id = $request->user_id;
                $update = User::where('id', $user_id)
                    ->update([
                        'password' => Hash::make($password1)
                    ]);
                if($update){
                    $notification = array(
                        'notify' => 'Password updated!',
                        'alert-type' => 'success'
                    );
                    return back()->with($notification);
                }else{
                    return back();
                }
            }
        }else{}
    }
    public function index(Request $request){
        $company_id = Auth::user()->company_id;
        $user_id = Auth::user()->id;
        $users = DB::select("select u.name, u.email, u.id, r.role, u.enabled from users as u, roles as r, role_users as ru where 
        u.id = ru.user_id and ru.role_id = r.id and company_id = '$company_id' and u.id != '$user_id'");
        $categories = Role::where('id', '!=', '3')->get();

        //dd($company_id);
        return view('users.index', compact('users', 'categories'));
    }
    public function edit_user(Request $request){
        $mode=$_POST['mode'];

        if ($mode=='true') //mode is true when button is enabled
        {
            //Retrive the values from database you want and send using json_encode
            //example
            DB::table('users')->where('id', $_POST['member_id'])
                ->update(['enabled' => '1']);
            $message='User Enabled!!';
            $success='Enabled';
            echo json_encode(array('message'=>$message,'success'=>$success));
        }

        else if ($mode=='false')  //mode is false when button is disabled
        {
            //Retrive the values from database you want and send using json_encode
            //example
            DB::table('users')->where('id', $_POST['member_id'])
                ->update(['enabled' => '2']);
            $message='User disabled!!';
            $success='Disabled';
            echo json_encode(array('message'=>$message,'success'=>$success));

        }
    }
    public function add_user(Request $request){
        $method = $request->isMethod('post');
        $company_id = Auth::user()->company_id;
        dd($company_id);
        if($method){
            $items = $request->item;
            if(isset($items)){
                $sum =0;
                $y = 0;
                foreach ($items as $item => $value){
                    $name = $value['name'];
                    $email = $value['email'];
                    $password = $value['password'];
                    $category_id = $value['category_id'];

                    $getCount = User::where('email', $email)->count(); //check
                    if(!isset($name, $email, $password, $category_id)){
                        return back()->withErrors("All fields are required");
                    }else if($getCount == 1){
                        return back()->withErrors($email." is already taken!");
                    }else{
                        $user = User::create([
                            'name' => $name,
                            'email' => $email,
                            'password' => Hash::make($password),
                            'enabled' => 1,
                            'role_id' => $category_id,
                            'company_id' => $company_id
                        ]);
                        if($user){
                            $user_id = $user->id;
                            //Create role user
                            RoleUser::create([
                                'user_id' => $user_id,
                                'role_id' => $category_id
                            ]);
                            //Notify the user via email
                            $content = ['password' => $password, 'name' => $name];
                            Utilities::notifyNewUser($email, $content);
                            $y++;
                            $sum += $y;
                        }
                    }
                }
                $request->session()->flash('success', $sum.' user(s) added!');
                return redirect()->route('users');
            }
        }else{}
    }

}
