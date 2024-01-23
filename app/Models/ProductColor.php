<?php

namespace App\Models;

use App\Models\ProductManager\Product;
use App\Models\ProductManager\ProductImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;
class ProductColor extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();

        ///crete the sku before saving
        static::creating(function ($productColor){
            $productColor->sku = 'SKU_' . Str::uuid();
        });
    }


    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function color():BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id');
    }


    public function sizes():HasManyThrough
    {
    return $this->hasManyThrough(
        Size::class,     
        ProductVariant::class,     
        'product_color_id',          
        'size_id',   
        'id',                  
        'id'                     
    );
    }
    
 


    public function product_images():HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function product_variants():HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }
}
