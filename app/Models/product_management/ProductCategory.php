<?php

namespace App\Models\product_management;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
class ProductCategory extends Model
{
    use HasFactory;
    public function products(): HasMany{
        return $this->hasMany(Product::class);
    }
}
