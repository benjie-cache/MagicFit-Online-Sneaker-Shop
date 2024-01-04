<?php

namespace App\Http\Controllers\shopping_process;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\shopping_process\CartItem;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cart_items=CartItem::all();
        return response()->json($cart_items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $cart_item=CartItem::create($request->all());
        return response()->json($cart_item,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cart_item)
    {
        //
        $cart_item=CartItem::findorFail($cart_item);
        return response()->json($cart_item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cart_item)
    {
        //
        $cart_item->update($request->all());

        return response()->json($cart_item,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cart_item)
    {
        //
        $cart_item->destroy($cart_item);
        return response()->json($cart_item);
    }
}
