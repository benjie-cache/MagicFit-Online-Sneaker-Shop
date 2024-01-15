<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Models\customer_management\Customer;
use App\Models\shopping_process\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function getCustomerInfo()
    {
        $user = Auth::user();
        $customer = Customer::with('addresses')->where('user_id', $user->id)->first();

    
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
    
        return response()->json([
            'customer' => new CustomerResource($customer),
        ]);
    }
    public function getCustomerOrders()
    {
        $user = Auth::user();
        $customer = Customer::where('user_id', $user->id)->first();


        $orders = Order::where('customer_id',$customer->id)->paginate(10)->with('orderItems')->get();

      
       return response()->json(['orders' => $orders], 200);
    }
}
