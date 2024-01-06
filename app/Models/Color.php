<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\product_management\Product;
use App\Models\Stock;
use  Illuminate\Database\Eloquent\Relations\HasMany;
class Color extends Model
{
    use HasFactory;
    // public function products():HasMany{
    //     return $this->hasMany(Product::class);
    // }
    public function stocks():HasMany
    {
        return $this->hasMany(Stock::class);
    }


}
