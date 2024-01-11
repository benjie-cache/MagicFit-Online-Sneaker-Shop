<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer_management\Customer;
use Illuminate\Support\Facades\Auth;
class CheckoutController extends Controller
{
    public function save_checkout_information(Request $request)
    {
        $customer = Customer::where('user_id', Auth::user()->id)->firstOrNew();

        // set the necessary attributes
        if (!$customer->exists) {
            $customer->first_name = 'ben';
            $customer->last_name = 'munyasya';
            $customer->phone = null;
            $customer->type = 'authenticated';
            $customer->user_id = Auth::user()->id;

            // Save the new customer record
            $customer->save();

            // Return a JSON response indicating success
            return response()->json(['message' => 'Information saved successfully'], 200);
        }

        
        return response()->json(['message' => 'Customer information already exists'], 409);

    }
}
