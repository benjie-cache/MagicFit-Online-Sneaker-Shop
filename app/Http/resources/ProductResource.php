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
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => round($this->price),
            'is_hot_deal_of_the_day' => $this->is_hot_deal_of_the_day,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];

        // Include images if available
        if ($this->relationLoaded('images') && $this->images->isNotEmpty()) {
            $data['images'] = ImageResource::collection($this->images);
        }
     // Include stock information if available
     if ($this->relationLoaded('stocks') && $this->stocks->isNotEmpty()) {
        $stocks = StockResource::collection($this->stocks);
           // Calculate total quantity for each product
           $totalQuantities = $stocks->groupBy('product_id')
           ->map(function ($groupedStocks) {
               return $groupedStocks->sum('quantity');
           });

       $data['stocks'] = $stocks;
       $data['total_quantities'] = $totalQuantities;
    }

      //  Include discount information if available
        if ($this->relationLoaded('discount') && $this->discount){
            $data['discount'] = [
                'discount_percentage' => $this->discount->discount_percentage,
                'discount_amount' => $this->discount->discount_amount,
                'start_date' => $this->discount->start_date,
                'end_date' => $this->discount->end_date,
                'original_price' => $this->calculateOriginalPrice(),
                'price_after_discount' => $this->calculateDiscountedPrice(),
            ];
        }

        return $data;
    }

    /**
     * Calculate the original price before discount.
     *
     * @return float
     */
    private function calculateOriginalPrice()
    {
        return round( $this->price);
    }

    /**
     * Calculate the discounted price.
     *
     * @return float
     */
    private function calculateDiscountedPrice()
    {
        if ($this->discount) {
            $discountPercentage = $this->discount->discount_percentage;
            $discountedAmount = ($this->price * $discountPercentage) / 100;
            $discountedPrice = $this->price - $discountedAmount;

        // Round the discounted price to the nearest whole number
        return round($discountedPrice);
        }

        // If no discount, return the regular price
        return $this->price;
    }
}