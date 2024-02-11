<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductColorResource extends JsonResource
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
            'id' => $this->id,

            'color_name' => $this->color->name,
            'color_code' => $this->color->color_code,
            'price' => (int)$this->price,


            'productImages' => ImageResource::collection($this->whenLoaded('productImages')),
        ];
    }
}
