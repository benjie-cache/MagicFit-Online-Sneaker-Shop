<?php

namespace App\Http\Controllers\product_management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product_management\Product;
use App\Http\Resources\ProductResource;
class ProductController extends Controller
{
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //eager load the related table data wheew
        $products = Product::with(['images', 'discount','stocks'])->get();
        return ProductResource::collection($products);
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        //
        $product = Product::findOrFail($product);
        return response()->json($product,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
  
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {
        //
        $product->update($request->all());
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
  
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        //
        $product->delete();
        return response()->json(null, 204);
    }
}
