<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'telephone' => 'required|string',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return response()->json([
                'message' => 'mauvais',
            ],500);       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('authToken')->accessToken;
        $success['name'] =  $user->name;
   
        return response()->json([
            'success' => true,
            'mesaage' => 'User register successfully.',
        ],200);
    }
   
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $user->token =  $user->createToken('authToken')->accessToken; 
   
            return response()->json($user);
        } 
        else{ 
            return response()->json([
                'message' => 'Connexion échoué',
            ],500); 
        } 
    }
    public function index(){
        $users = User::all();

       return response()->json([
        'Categorie' => $users,
       ]);
    }
}