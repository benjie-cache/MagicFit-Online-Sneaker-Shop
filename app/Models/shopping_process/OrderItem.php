<?php

namespace App\Models\shopping_process;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product_management\Product;
use App\Models\shopping_process\Order;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class OrderItem extends Model
{
    use HasFactory;
    public function product():BelongsTo{
        return $this->belongsTo(Product::class);
    }
    public function order():BelongsTo{
        return $this->belongsTo(Order::class);
    }
}
