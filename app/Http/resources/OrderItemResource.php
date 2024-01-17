<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'quantity'=>$this->quantity,
            'unit_price'=>$this->unit_price,
            'total'=>$this->total,
            'order_id'=>$this->order_id,
            'product_id'=>$this->product_id
        ];
    }
}
