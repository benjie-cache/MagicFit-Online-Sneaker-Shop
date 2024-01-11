<?php


namespace App\Models\product_management;

use App\Models\shopping_process\CartItem;
use App\Models\shopping_process\OrderItem;
use App\Models\Color;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Stock;
use App\Models\product_management\ProductImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;


    //Define relationship between products and other models
    public function productcategory():BelongsTo{
        return $this->belongsTo(ProductCategory::class);
    }
    public function productinventory():HasOne{
        return $this->hasOne(productInventory::class);
    }
    public function images():HasMany
    {
        return $this->hasMany(ProductImage::class);
    }
    
    public function discount():HasOne
    {
        return $this->hasOne(ProductDiscount::class);
    }
    public function cartitem():HasOne{
        return $this->hasOne(CartItem::class);
    }
    public function orderitems():HasOne{
        return $this->hasOne(OrderItem::class);
    }
    public function brand():BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'stocks')->distinct();
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'stocks')->distinct();
    }
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'products_category_id',
        'brand_id',
        'name',
        'slug',
        'description',
        'price',
        'is_hot_deal_of_the_day',
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
