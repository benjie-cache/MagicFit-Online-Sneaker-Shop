<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerAddressResource extends JsonResource
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
            
            'type' => $this->type,
           
           
            'estate' => $this->estate,
            'address2' => $this->address2,
            'street_address' => $this->street_address,
            'apartment_name' => $this->apartment_name,
            'house_number' => $this->house_number,
           
        ];
    }
}
