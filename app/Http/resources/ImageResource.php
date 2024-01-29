<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $context = $request->routeIs('products.show') ? 'single_product' : 'multiple_products';

        if ($context === 'multiple_products') {
            
            if (!in_array($this->view, [ 'side','top','rear'])) {
                return null;
            }
        }

        return [
            'url' => $this->image_path,
            'view' => $this->view,
        ];
    }
}
