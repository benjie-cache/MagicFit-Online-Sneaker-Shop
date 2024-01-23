<?php

namespace App\Models\ShoppingProcessManager;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductManager\Product;
use App\Models\ShoppingProcessManager\Order;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class OrderItem extends Model
{
    use HasFactory;
    protected $fillable=['quantity','unit_price','total','order_id','product_id'];
    public function product():BelongsTo{
        return $this->belongsTo(Product::class);
    }
    public function order():BelongsTo{
        return $this->belongsTo(Order::class);
    }
}
