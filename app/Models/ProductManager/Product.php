<?php


namespace App\Models\ProductManager;


use App\Models\ShoppingProcessManager\OrderItem;
use App\Models\Color;

use App\Models\Brand;
use App\Models\ProductColor;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;


    public function productcategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    //a single product has manycolors through product_color pivot table
    public function colors(): HasManyThrough
    {
        return $this->hasManyThrough(
            Color::class,
            ProductColor::class,
            'product_id',
            'color_id',
            'id',
            'color_id'
        );
    }

    //you can access many variants of the same product through productcolor table
    public function product_variants(): HasManyThrough
    {
        return $this->hasManyThrough(
            ProductVariant::class,
            ProductColor::class,
            'product_id',
            'product_color_id',
            'id',
            'id'
        );
    }

    public function product_images(): HasManyThrough
    {
        return $this->hasManyThrough(
            ProductImage::class,
            ProductColor::class,
            'product_id',
            'product_color_id',
            'id',
            'id'
        );
    }



    public function discount(): HasOne
    {
        return $this->hasOne(ProductDiscount::class);
    }

    public function orderitems(): HasOne
    {
        return $this->hasOne(OrderItem::class);
    }




    ///these are field that are mass assignable
    protected $fillable = [
        'products_category_id',
        'brand_id',
        'name',
        'slug',
        'description',


    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }
}
