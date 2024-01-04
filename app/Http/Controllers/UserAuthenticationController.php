<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 


class UserAuthenticationController extends Controller
{
    //
    public function register(Request $request){
        $credentials = $request->only('first_name', 'email', 'password');
       
        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            return response()->json(['msg' => 'This user already exists'], 409);
        }
        $user = User::create([
            'first_name' => $credentials['first_name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password'])
        ]);
            $token=$user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status'=>200,
                'data' => [
                    'user' => $user,
                    'token' => $token
                ],
                'message' => 'Successfully Registered.'
              

            ],201);
    }
        

  
    public function login(Request $request){
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
}
