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
    // public function colors():HasMany{
    //     return $this->hasMany(Color::class);
    // }
    // public function sizes():BelongsToMany
    // {
    //     return $this->belongsToMany(Size::class)->withPivot('id');
    // }
    public function brand():BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
    public function stocks():HasMany{
        return $this->hasMany(Stock::class);
    }

}
