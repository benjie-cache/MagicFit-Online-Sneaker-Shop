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