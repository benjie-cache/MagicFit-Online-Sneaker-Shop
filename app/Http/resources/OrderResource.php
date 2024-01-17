<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
        'id'=>$this->id,
        'date' => $this->created_at->format('Y-m-d'), 
        'total_price'=>$this->total_price,
        'status'=>$this->status,
        'user_id'=>$this->user_id,
        'customer_id'=>$this->customer_id,
        'orderItems' => OrderItemResource::collection($this->whenLoaded('orderItems')),
        'item_quantity' => $this->orderItems->sum('quantity'),


       ];
    }
}
