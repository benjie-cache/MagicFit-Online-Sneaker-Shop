<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 

use Illuminate\Support\Facades\Validator; 


class UserAuthenticationController extends Controller
{
    //
    public function index()
    {
        return response()->json(User::with(['orders'])->get());
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:20',
            'email' => 'required|email',
            'password' => 'required|min:4',
          
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $data = $request->only(['first_name', 'email', 'password']);
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        $token=$user->createToken('auth_token')->plainTextToken;
        
     
        return response()->json([
            'status'=>'ok',
            'data' => [
                'user' => $user,
                'token' =>$token
            ],
            'message' => 'Successfully Registered.'
          

        ],201);
    }

        

  
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        
        return response()->json([
            'status' => 200,
            'data' =>[
                'user' => $user,
                'token' => $token
            ],
            'message' => 'Login Successful'
        ], 200);
       

      
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Succesfully Logged out'
        ], 200);
    }
    public function show(User $user)
    {
        return response()->json($user);
    }

    public function showOrders(User $user)
    {
        return response()->json($user->orders()->with(['product'])->get());
    }
}
