<?php

namespace App\Models\ProductManager;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class productDiscount extends Model
{
    use HasFactory;
    public function products():HasMany{
        return $this->hasMany(Product::class);
    }
}