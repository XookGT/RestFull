<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Log;


class JwtAuthenticateController extends Controller
{

    public function index()
    {
        return response()->json(['auth'=>Auth::user(), 'users'=>User::all()]);
    }

    public function getRole()
    {

        if(Auth::user()->hasRole('admin'))
        {
            return response(['role'=>'admin'],200);
        }
        else if(Auth::user()->hasRole('tutor'))
        {
            return response(['role'=>'tutor'],200);
        }
        else if(Auth::user()->hasRole('user'))
        {
            return response(['role'=>'user'],200);
        }
        else
        {
            return response(['role'=>'whitout role'],403);
        }

    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Logged out'], 200);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }

    public function createRole(Request $request){
        $role = new Role();
        $role->name = $request->input('name');
        $role->save();

        return response()->json("created");  
    }

    public function createPermission(Request $request){
        $viewUsers = new Permission();
        $viewUsers->name = $request->input('name');
        $viewUsers->save();

        return response()->json("created");
    }

    public function assignRole(Request $request){
        
        $user = User::where('email', '=', $request->input('email'))->first();

        $role = Role::where('name', '=', $request->input('role'))->first();
        //$user->attachRole($request->input('role'));
        $user->roles()->attach($role->id);

        return response()->json("created");
    }

    public function attachPermission(Request $request){

        $role = Role::where('name', '=', $request->input('role'))->first();
        $permission = Permission::where('name', '=', $request->input('name'))->first();
        $role->attachPermission($permission);

        return response()->json("created");

    }
    
    public function create(array $data)
    {
        validator($data);
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

    public function validator(array $data)
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
}
