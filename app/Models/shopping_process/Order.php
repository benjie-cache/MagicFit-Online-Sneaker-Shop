<?php

namespace App\Models;

use App\Models\shopping_process\OrderItem;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function order_items():HasMany{
        return $this->hasMany(OrderItem::class);
    }
}
