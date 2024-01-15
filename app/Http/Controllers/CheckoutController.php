<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\shopping_process\Order;
use App\Models\shopping_process\OrderItem;
use App\Models\customer_management\Customer;
use App\Models\customer_management\CustomerAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CustomerResource;
use App\Models\shopping_process\OrderDetail;
use App\Models\shopping_process\Payment;
use Illuminate\Support\Facades\DB;
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

            //If customer account doesn't exist, create a new one
            $customer = new Customer([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'phone' => $request->input('phone'),
                'type' => 'authenticated',
              //  'user_id' => $user->id,
            ]);
            $customer->user_id = $user->id;
          
          
            
            $customer->save();
            $customer_address= new CustomerAddress(
                [
                    //'customer_id'=> $customer->id,
                    'type'=>'billing',
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'phone' => $request->input('phone'),
                    'estate'=> $request->input('estate'),
                    'street_address'=> $request->input('street_address'),
                    'apartment_name'=> $request->input('apartment_name'),
                    'house_number'=> $request->input('house_number'),
                ]
                );
            $customer_address->customer_id = $customer->id;
            $customer_address->save();

            return response()->json(['message' => 'Information saved successfully'], 200);
        } else {
            return response()->json(['message' => 'No user is currently authenticated'], 401);
        }
    }
  

    public function processOrder(Request $request)
    {
        try {
            DB::beginTransaction();
    
            $order_data = $request->all();
            $user = Auth::user();
            $customer = Customer::where('user_id', $user->id)->first();
    
            // Create the main order
            $order = Order::create([
                'total_price' => $order_data['cartTotal'],
                'status' => 'paid',
                'user_id' => $user->id,
                'customer_id' => $customer->id
            ]);
    
            // Create order items
            foreach ($order_data['orderItems'] as $item) {
                OrderItem::create([
                    'quantity' => $item['count'],
                    'unit_price' => $item['price'],
                    'total' => $item['subtotal'],
                    'order_id' => $order->id,
                    'product_id' => $item['id']
                ]);
            }
    
            // Create payment record
            $payment = Payment::create([
                'order_id' => $order->id,
                'name' => $customer->first_name,
                'lastname' => $customer->last_name,
                'amount' => $order_data['cartTotal'],
                'status' => 'process',
                'type' => 'mpesa'
            ]);
    
            DB::commit();
    
            return response()->json(['message' => 'Order processed'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
    
            // Log or handle the exception as needed
            return response()->json(['error' => 'Order processing failed', 'message' => $e->getMessage()], 500);
        }
    }
    
}