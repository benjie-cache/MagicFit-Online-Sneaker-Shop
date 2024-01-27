<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'brand_id' => $this->brand_id,
            'category_id' => $this->products_category_id,
            'name' => $this->name,
            'productColors' => ProductColorResource::collection($this->whenLoaded('productColors')),
        ];

        // Check if it's a request for a single product
        if ($request->routeIs('products.show')) {
           
            $data = array_merge($data, [
                'description' => $this->description,
            ]);
        }

        return $data;
    }
}
