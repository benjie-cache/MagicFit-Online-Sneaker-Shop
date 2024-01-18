<?php

namespace App\Http\Controllers\product_management;

use Illuminate\Support\Facades\Log;
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
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 12);
     
        $query = Product::with(['images', 'discount','colors','sizes']);

        // Log::info('the query', $query);


        // Check if the 'filters' key exists in the request
        $filters = json_decode($request->input('filters'), true);

        if ($filters) {

            if (isset($filters['brands']) && is_array($filters['brands']) && count($filters['brands']) > 0) {
                $query->whereIn('brand_id', $filters['brands']);
                // Log::info('Brands filter applied:', $filters['brands']);
            }
            if (isset($filters['categories']) && is_array($filters['categories']) && count($filters['categories']) > 0) {
                $query->whereIn('products_category_id', $filters['categories']);
                // Log::info('Brands filter applied:', $filters['brands']);
            }
        }






        // Paginate the results
        $products = $query->paginate($perPage);

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
