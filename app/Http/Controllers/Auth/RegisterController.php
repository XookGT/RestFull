<?php

namespace App\Http\Controllers\Auth;

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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'lastname' => 'required|max:45',
            'celphone' => 'required|max:20|unique:users',
            'celphone2' => 'max:20',
            'url_crimina_record' => 'max:100',
            'birthdate' => 'required|Date',
            'dni' => 'required|max:13',
            'dni_pdf' => 'max:100',
            'url_cv' => 'max:100',
            'id_profile_status' => 'required|numeric',
            'super' => 'numeric'


        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'lastname' => $data['lastname'],
            'celphone' => $data['celphone'],
            'celphone2' => $data['celphone2'],
            'url_crimina_record' => $data['naurl_crimina_recordme'],
            'birthdate' => $data['birthdate'],
            'dni' => $data['dni'],
            'dni_pdf' => $data['dni_pdf'],
            'url_cv' => $data['url_cv'],
            'id_profile_status' => $data['id_profile_status'],
            'super' => $data['super'],
        ]);
    }
}
