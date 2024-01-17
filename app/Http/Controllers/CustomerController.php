<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Http\Resources\OrderResource;
use App\Models\customer_management\Customer;
use App\Models\customer_management\CustomerAddress;

use App\Models\shopping_process\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class CustomerController extends Controller
{

    public function update_delivery_info(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            $customer = Customer::where('user_id', $user->id)->first();
            $updated_customer_data=$request->all();

            $addresses=$updated_customer_data['addresses'][0];
            //Update the customer account if it already exists
            if ($customer) {
                try {
                DB::beginTransaction();
                $customer->update([
                    'first_name' => $updated_customer_data['first_name'],
                    'last_name' => $updated_customer_data['last_name'],
                    'phone' =>  $updated_customer_data['phone']
                ]);
                $customer_address = CustomerAddress::where('customer_id', $customer->id)->first();
              
                $customer_address ->update([
                    'type'=>'billing',
                    'first_name' => $updated_customer_data['first_name'],
                    'last_name' => $updated_customer_data['last_name'],
                    'phone' =>  $updated_customer_data['phone'],
                    'estate'=> $addresses['estate'],
                    'street_address'=> $addresses['street_address'],
                    'apartment_name'=> $addresses['apartment_name'],
                    'house_number'=>  $addresses['house_number'],

                ]);
                DB::commit();
                return response()->json(['message' => 'Informaton successfully saved'], 200);
            } catch (\Exception $e) {
                DB::rollBack();
        
                return response()->json(['error' => 'Customer info updated Failed', 'message' => $e->getMessage()], 500);
            }
               
            }elseif (!$customer) {
                try {
                DB::beginTransaction();
                $customer=Customer::create([
                    'first_name' => $updated_customer_data['first_name'],
                    'last_name' => $updated_customer_data['last_name'],
                    'phone' =>  $updated_customer_data['phone'],
                    'user_id'=>$user->id,
                ]);
                CustomerAddress::create([
                    'customer_id'=>$customer->id,
                    'type'=>'billing',
                    'first_name' => $updated_customer_data['first_name'],
                    'last_name' => $updated_customer_data['last_name'],
                    'phone' =>  $updated_customer_data['phone'],
                    'estate'=> $addresses['estate'],
                    'street_address'=> $addresses['street_address'],
                    'apartment_name'=> $addresses['apartment_name'],
                    'house_number'=>  $addresses['house_number'],
                ]);
                DB::commit();
                return response()->json(['message' => 'Your Customer Account has been Updated.Happy Shopping!!'], 201);
            } catch (\Exception $e) {
                DB::rollBack();
        
                return response()->json(['error' => 'Customer info updated Failed.Try Again', 'message' => $e->getMessage()], 500);
            }
            }else{
                return response()->json(['message' => 'There was an issue updating your account info.Try Again'], 500);
            }

          

        
        } else {
            return response()->json(['message' => 'No user is currently authenticated'], 401);
        }
    }
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
    public function getCustomerOrders(Request $request)
    {
        $user = Auth::user();
        //$customer = Customer::where('user_id', $user->id)->first();
         
        $per_page = $request->input('per_page',5);
        $orders = Order::with('orderItems')->where('user_id', $user->id)->latest()->paginate($per_page); 
        if($orders->total()  > 0) {
         
              return   OrderResource::collection($orders);
       
        } else {
            return response()->json([
                'message' => "This customer doesn't have orders"
            ], 404);
        }

      
      
    }
}
