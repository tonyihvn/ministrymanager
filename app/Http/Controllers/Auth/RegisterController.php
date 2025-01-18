<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\audit;
use App\Models\settings;
use App\Models\ministrymembers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;

// use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        if($data['email']==""){
            $email = "crmadmin@crmfct.org";
            $password = Hash::make("prayer22");
        }else{
            $email = $data['email'];
            $password = Hash::make($data['password']);

        }

        if(isset($data['ministry_name']) && $data['ministry_name']!=""){

            $settings_id = settings::create([
                'ministry_name' => $data['ministry_name'],
                'motto' => $data['motto'],
                'address' => $data['min_address'],
                'mode'=>$data['mode'],
                'ministrygroup_id'=>$data['ministrygroup_id'],
                'user_id'=>1
            ] )->id;

        }else{
            $settings_id = $data['settings_id'];
        }

        audit::create([
            'action'=>"New User Registration ".$data['email'],
            'description'=>'A new user was registered',
            'doneby'=>Auth::user()->id ?? 1,
            'settings_id'=>$settings_id
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'dob' => $data['dob'],
            'phone_number'=>$data['phone_number'],
            'password' => $password,
            'about' => $data['about'],
            'address' => $data['address'],
            'role'=>"Member",
            'status'=>"InActive",
            'settings_id'=>$settings_id
        ]);

        $mainmin = "";

        if(isset($data['ministry'])){

            $keys = array_keys($data['ministry']);
            $last_key = end($keys);

            // $mainmin = $request->ministry[0];
            foreach($data['ministry'] as $key=>$mins){

                if($mins!=""){
                    ministrymembers::updateOrCreate([
                        'member_id'=>$user->id,
                        'ministry_id'=>$mins
                    ],[
                        'member_id'=>$user->id,
                        'ministry_id'=>$mins
                    ]);

                    if ($key == $last_key) {
                        $mainmin.=$mins;
                    }else{
                        $mainmin.=$mins.",";
                    }
                }
            }
        }

        $user->ministry = $mainmin;
        $user->save();

        session()->flash('success', 'Registration successful! Welcome to the platform.');


        return $user;
    }
}
