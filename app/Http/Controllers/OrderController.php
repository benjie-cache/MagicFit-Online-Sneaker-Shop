<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\shopping_process\Order;
use App\Models\shopping_process\OrderItem;
use App\Models\product_management\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Create a new order for the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createOrder(Request $request)
    {
     

        // Get the authenticated user
        $user = Auth::user();

        // Create a new order for the user
        $order = Order::create([
            'total_price' => 0,
            'status' => 'paid',
            'user_id' => $user->id,
        ]);

        // Add order items
        foreach ($request->input('order_items') as $item) {
            $product = Product::findOrFail($item['id']);

            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'unit_price' => $product->price,
            ]);
        }

        // Update the total price of the order
        $order->update([
            'total_price' => $order->orderItems->sum(function ($item) {
                return $item->unit_price * $item->quantity;
            }),
        ]);

        // Return a response
        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }
}
