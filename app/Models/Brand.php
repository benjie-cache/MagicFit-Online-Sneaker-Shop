<?php

namespace App\Models;
use App\Models\product_management\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Brand extends Model
{
    use HasFactory;
    public function products():HasMany
    {
        return $this->hasMany(Product::class);
    }
}