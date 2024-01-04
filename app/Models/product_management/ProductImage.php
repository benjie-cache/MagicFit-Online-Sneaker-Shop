<?php

namespace App\Models\product_management;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
class ProductImage extends Model
{
    use HasFactory;
    public function product():HasOne{
       return $this->hasOne(Product::class);
    }
    
}
