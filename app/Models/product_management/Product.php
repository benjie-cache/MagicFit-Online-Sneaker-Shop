<?php


namespace App\Models\product_management;

use App\Models\shopping_process\CartItem;
use App\Models\shopping_process\OrderItem;
use App\Models\product_management\ProductImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    
    
}
