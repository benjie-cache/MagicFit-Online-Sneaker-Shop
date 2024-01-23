<?php

namespace App\Models;
use App\Models\Size;
use App\Models\ProductColor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ProductVariant extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();

        ///crete the sku before saving
        static::creating(function ($productVariant){
            $productVariant->sku = 'SKU_' . Str::uuid();
        });
    }
    public function size():BelongsTo
    {
        return $this->belongsTo(Size::class);
    }
    public function product_color():BelongsTo{
        return $this->belongsTo(ProductColor::class);
    }
}
