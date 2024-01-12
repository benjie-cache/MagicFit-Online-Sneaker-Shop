<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\customer_management\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function save_checkout_information(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
            
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            $customer = Customer::where('user_id', $user->id)->first();

            // Update the customer account if it already exists
            if ($customer) {
                $customer->update([
                    'first_name' => $request->input('first_name', $customer->first_name),
                    'last_name' => $request->input('last_name', $customer->last_name),
                    'phone' => $request->input('phone', $customer->phone),
                ]);

                return response()->json(['message' => 'Information updated successfully'], 200);
            }

            // If customer account doesn't exist, create a new one
            $customer = new Customer([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'phone' => $request->input('phone'),
                'type' => 'authenticated',
                'user_id' => $user->id,
            ]);

            $customer->save();

            return response()->json(['message' => 'Information saved successfully'], 200);
        } else {
            return response()->json(['message' => 'No user is currently authenticated'], 401);
        }
    }
    public function process_payment(Request $request){
        
    }
}