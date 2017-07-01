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

    public function getUser($email)
    {
        try
        {
            $user = USER::where('email',$email)->first();

            if($user != null)
            {
                return response($user, 200);
            }else
            {
                return response(['Error'=>'User does not exist'], 403);
            }
        }
        catch(\Exception $e)
        {
            return response(['Error'=>'It has ocurred an error. Erro: '.$e->getMessage()],500);
        }
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
        try
        {

            $user = User::where('email', '=', $request->input('email'))->first();

            $role = Role::where('name', '=', $request->input('role'))->first();
            
            if($user == null)
            {
                return response(['Error'=>'The User does not exist'],403);
            }

            if($role == null)
            {
                return response(['Error'=>'The Role does not exist'],403);
            }
            //$user->attachRole($request->input('role'));
            $user->roles()->attach($role->id);

            return response(['Msj'=>'Role assigned'],200);
        }
        catch (\Exception $e)
        {
            return response(['Error'=>'It has ocurred an error. Erro: '.$e->getMessage()],500);
        }
        
    }

    public function attachPermission(Request $request){

        $role = Role::where('name', '=', $request->input('role'))->first();
        $permission = Permission::where('name', '=', $request->input('name'))->first();
        $role->attachPermission($permission);

        return response()->json("created");

    }
    
    public function create(Request $request){
        //validar que los campos vienen
        try
        {
            /*$this->validate($request,[
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:6',
                'lastname' => 'required|max:45',
                'celphone' => 'required|max:20|unique:users,celphone',
                'celphone2' => 'max:20',
                'url_crimina_record' => 'max:100',
                'birthdate' => 'required',
                'dni' => 'min:13|max:13|numeric|unique:users,dni',
                'dni_pdf' => 'max:100',
                'url_cv' => 'max:100',
                'id_profile_status' => 'required|numeric',
                'super' => 'numeric',
                ]);*/
                
            //Crear un usuario en la base de datos

            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'lastname' => $request['lastname'],
                'celphone' => $request['celphone'],
                'celphone2' => $request['celphone2'],
                'url_crimina_record' => $request['naurl_crimina_recordme'],
                'birthdate' => $request['birthdate'],
                'dni' => $request['dni'],
                'dni_pdf' => $request['dni_pdf'],
                'url_cv' => $request['url_cv'],
                'id_profile_status' => $request['id_profile_status'],
                'super' => $request['super'],
            ]);

            return response()->json("created");  

        }
        catch (\Exception $e)
        {
            return response(['Error'=>'It has ocurred an error. Erro: '.$e->getMessage()],500);
        }

    }

        public function update(Request $request, $email){
        //validar que los campos vienen
        try
        {
            
            $user = USER::where('email',$email)->first();
            //return response(['msj'=>$user],200);
            if($user != null)
            {
                if($request->has('name'))
                {
                    $user->name = $request->name;
                }

                if($request->has('lastname'))
                {
                    $user->lastname = $request->lastname;
                }

                if($request->has('celphone'))
                {
                    $user->celphone = $request->celphone;
                }

                if($request->has('celphone2'))
                {
                    $user->celphone2 = $request->celphone2;
                }

                if($request->has('url_crimina_record'))
                {
                    $user->url_crimina_record = $request->url_crimina_record;
                }

                if($request->has('birthdate'))
                {
                    $user->birthdate = $request->birthdate;
                }

                if($request->has('dni'))
                {
                    $user->dni = $request->dni;
                }

                if($request->has('dni_pdf'))
                {
                    $user->dni_pdf = $request->dni_pdf;
                }

                if($request->has('url_cv'))
                {
                    $user->url_cv = $request->url_cv;
                }

                if($request->has('id_profile_status'))
                {
                    $user->id_profile_status = $request->id_profile_status;
                }

                if($request->has('super'))
                {
                    $user->super = $request->super;
                }

                $user->save();
                return response(['msj'=>'Successfull!!'],200); 
            }
            else
            {
                return response(['Error'=>'User does not exist'],403);
            }
            /*$this->validate($request,[
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:6',
                'lastname' => 'required|max:45',
                'celphone' => 'required|max:20|unique:users,celphone',
                'celphone2' => 'max:20',
                'url_crimina_record' => 'max:100',
                'birthdate' => 'required',
                'dni' => 'min:13|max:13|numeric|unique:users,dni',
                'dni_pdf' => 'max:100',
                'url_cv' => 'max:100',
                'id_profile_status' => 'required|numeric',
                'super' => 'numeric',
                ]);*/
                
            //Crear un usuario en la base de datos
        }
        catch (\Exception $e)
        {
            return response(['Error'=>'It has ocurred an error. Error: '.$e->getMessage()],500);
        }

    }

    public function saveDPI(Request $request)
{
 
       //obtenemos el campo file definido en el formulario
       try
       {
           
       $file = $request->file('file');
       
       //obtenemos el nombre del archivo
       //$nombre = $file->getClientOriginalName();
       //dd($nombre);
       //indicamos que queremos guardar un nuevo archivo en el disco local
       \Storage::disk('public')->put('test',  \File::get($file));
 
       return response(['msj'=>'Successfull!!'],200); 
       }
       catch(\Exception $e)
       {
           return response(['Error'=>'It has ocurred an error. Error: '.$e->getMessage()],500);
       }
}

}
