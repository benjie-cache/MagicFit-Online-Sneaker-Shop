<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'url' => $this->url,
            'color' => $this->color,
            'view' => $this->view,
        ];
    }
}
