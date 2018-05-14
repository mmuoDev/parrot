<?php

namespace App\Http\Controllers\Auth;

use App\Company;
use App\Libraries\Utilities;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $confirmation_code = str_random(30);
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'confirmed' => 0,
            'confirmation_code' => $confirmation_code,
            'role_id' => 3, //Super-admin
            'enabled' => 1
        ]);
        if($user){
            $company = Company::create([
                'company' => $data['name'],
            ]);
            //add company id to users table
            if($company){
                $company_id = $company->id;
                $user_id = $user->id;
                DB::table('users')
                    ->where('id', $user_id)
                    ->update([
                        'company_id' => $company_id
                    ]);
            }
            //assign user to role
            RoleUser::create([
                'user_id' => $user->id,
                'role_id' => 3
            ]);
        }
        //email company
        $email = $data['email'];
        $content = ['fullname' => $data['name'], 'confirmation_code' => $confirmation_code];
        Utilities::notifyNewUsers($email, $content);

        return $user;
    }
}
