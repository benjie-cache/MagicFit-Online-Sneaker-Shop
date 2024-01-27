<?php

namespace App\Http\Controllers\ProductManager;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductManager\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Product::with(['productColors','productColors.productImages']);
   
        $filters = $request->input('filters');
        if ($filters) {
            $query->when(isset($filters['brands']), fn($q) => $q->whereIn('brand_id', $filters['brands']))
                  ->when(isset($filters['categories']), fn($q) => $q->whereIn('products_category_id', $filters['categories']));
        }
        return ProductResource::collection($query->paginate($request->input('per_page', 12)));
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
        return ProductResource::collection($product);
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
